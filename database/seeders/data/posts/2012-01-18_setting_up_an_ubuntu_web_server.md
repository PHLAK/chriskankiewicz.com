---
title: Setting Up an Ubuntu Web Server
tags: ['Linux', 'Ubuntu']
featured_image_url: https://images.unsplash.com/photo-1591808216268-ce0b82787efe?ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&h=1000
featured_image_text: Photo by [Nathan Dumlao](https://unsplash.com/@nate_dumlao?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText) on [Unsplash](https://unsplash.com/s/photos/server?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText)
published: 2012-01-18 22:11:00
---

<!-- excerpt -->
Having set up several Debian and Ubuntu web servers in the past I thought it
would be a good idea to share my process. The following is a relatively
comprehensive guide to installing and configuring an Apache based web server
with some optimizations and basic resource monitoring. I primarily work with
Ubuntu servers, but most of the commands here should work exactly the same in
Debian or Ubuntu. I've tried to note where differences may occur.
<!-- endexcerpt -->

## Download and Install the OS

If you are setting up your own server, the first thing you will need to do is
download the ISO that corresponds to your hardware (32/64-bit), burn it to CD
and install it to your server.

  * For Ubuntu go to [http://www.ubuntu.com/download/server/download](http://www.ubuntu.com/download/server/download)
  * For Debian go to [http://www.debian.org/distrib/](http://www.debian.org/distrib/)

<div class="info">
    <p>It is strongly recommended that you choose the LTS (Long Term Service) release if you decide to go with Ubuntu.</p>
</div>

The installation process is relatively straight forward, so I will not be going
over that here, simply boot to the disc and follow the on-screen instructions.
Once the OS is installed continue with the instructions below.

-----

## Create a User Account

On most Ubuntu installations you should have created a user account during
installation and this wont be necessary. However, the following may be needed on
some web hosts or a VPS. After a Debian installation you are only given access
to the `root` account. It can be dangerous to run as root all the time and
creating a non-privelleged user account for yourself is recommended. Depending
on your installation some of the following may already be configured.

### Create a user account for yourself:

    # adduser <user_name>

### Install sudo:

    # apt-get install sudo

### Add the newly created user to the sudoers file by running:

    # visudo

### Add your username under the existing `root` entry:

    root ALL=(ALL) ALL
    <user_name> ALL=(ALL) ALL

Now log out and back in with the new user.

-----

## Update Your System

Most installations will not be up-to-date after installation and will be missing
several bug and security fixes. We must now update the system to pull in all the
latest patches.

### Run system updates:

    $ sudo apt-get update
    $ sudo apt-get upgrade
    $ sudo apt-get dist-upgrade

Once all updates are complete, restart your system.

-----

## Configure Hostname and Timezone

While the hostname is of minor importance for most things to run properly, it's
good practice to set it up after installation. The timezone on the other hand
can have critical effects on the applications and scripts that run on your
server if not configured properly.

### Set the Hostname:

    $ sudo nano /etc/hostname

Add your new hostname to this file and save it, then run:

    $ sudo /etc/init.d/hostname start

### Edit the hosts file:

    $ sudo nano /etc/hosts

Add the following if not already present:

    127.0.0.1 localhost.localdomain localhost
    <server_ip> <hostname>.example.com <hostname>

### Set the Timezone:

    $ sudo dpkg-reconfigure tzdata

-----

## Set Up LAMP Server with APC and PHPMyAdmin

Installing the LAMP stack is quick and painless with apt. Simply use the
following commands to get everything installed.

### Install LAMP stack on Ubuntu:

    $ sudo apt-get install lamp-server\^ php-apc phpmyadmin

### Install LAMP stack on Debian:

    $ sudo apt-get install apache2 mysql-server php5 php-pear php5-mysql php-apc phpmyadmin

We will also need a mail server to handle outgoing email requests.

### Insatll Postfix Mail Server:

    $ sudo apt-get install postfix

When installing postfix you'll go through some configuration screens. The
defaults should be fine for a basic web server setup.

-----

## Configure PHP and APC

Now that you have your LAMP stack setup you will need to configure it for
running in a production environment. Some of the following settings may already
be set, but it's a good idea to check them all anyway.

### Enable mod_rewrite:

    $ sudo a2enmod rewrite

### Configure PHP:

    $ sudo nano /etc/php5/apache2/php.ini

Now locate and modify the following values:

    short_open_tag = On
    max_execution_time = 30
    memory_limit = 128M
    error_reporting = E_ALL & \~E_DEPRECATED
    display_errors = Off
    log_errors = On
    post_max_size = 8M
    upload_max_filesize = 8M
    date.timezone = <your_timezone> ; See: http://php.net/date.timezone

### Edit your APC config:

    $ sudo nano /etc/php5/conf.d/apc.ini

Add the following:

    extension = apc.so
    apc.shm_size = 128

### Restart Apache:

    $ sudo /etc/init.d/apache2 restart

-----

## Set Web Directory User and Permissions

Now that you have everything installed and configured you'll need to set up some
file permissions to allow Apache to read from, and you to write to, the web
directory. This will be accomplished by changing the owner of the web directory,
adding the Apache user and your user to this group and setting the guid bit
forcing all new files/folders to have the same group permissions.

### Create a new group:

    $ sudo addgroup webdev

### Change the group of your web directory:

    $ sudo chgrp -R webdev /var/www/
    $ sudo chmod -R g+rw /var/www/

### Set the guid bit on all folders in your web directory:

    $ sudo find /var/www -type d -exec chmod +s {} \\;

### Add Apache to the webdev group:

    $ sudo usermod -a -G webdev www-data

### Add your user to the webdev group:

    $ sudo usermod -a -G webdev <user_name>

-----

## Enable System Monitoring and Alerts

Even the best configured servers have problems every now and again. To monitor
our servers resources we will install and configure
[Monit](http://mmonit.com/monit/). Monit allows us to set custom events to
monitor and define the actions to be taken.

### Install Monit:

    $ sudo apt-get install monit

### Edit the monitrc file:

    $ sudo nano /etc/monit/monitrc

Copy/paste the following configuration file and change values where you need to.

    ### Monit configuration:
    
    ################################################################################
    ## Monit control file
    ################################################################################
    
    set daemon 120 # Check services at 2-minute intervals
    set logfile syslog facility log_daemon # Set logging to the
    systemlog
    set alert <email_address> # Set your email address
    
    set mailserver localhost
    with timeout 15 seconds
    
    set httpd port 2812 and
    allow <user_name>: <password> # set user name and password here
    
    ################################################################################
    ## Services
    ################################################################################
    
    check system <hostname>
    if loadavg (1min) \> 4 then alert
    if loadavg (5min) \> 2 then alert
    if memory usage \> 80% then alert
    if cpu usage (user) \> 70% then alert
    if cpu usage (system) \> 30% then alert
    if cpu usage (wait) \> 20% then alert
    
    check process apache with pidfile /var/run/apache2.pid
    start program = "/etc/init.d/apache2 start" with timeout 60 seconds
    stop program = "/etc/init.d/apache2 stop"
    if cpu \> 60% for 2 cycles then alert
    if cpu \> 90% for 5 cycles then restart
    if totalmem \> 512.0 MB for 5 cycles then alert
    # if totalmem \> 512.0 MB for 5 cycles then restart
    if children \> 250 then restart
    if failed host localhost port 80 protocol http then restart
    if 3 restarts within 5 cycles then timeout
    
    check process mysql with pidfile /var/lib/mysql/<hostname>.pid
    group mysql
    start program = "/etc/init.d/mysql start"
    stop program = "/etc/init.d/mysql stop"
    if failed host localhost port 3306 then restart
    if 5 restarts within 5 cycles then timeout
    
    check process sshd with pidfile /var/run/sshd.pid
    start program "/etc/init.d/ssh start"
    stop program "/etc/init.d/ssh stop"
    if failed port 22 protocol ssh then restart
    if 5 restarts within 5 cycles then timeout

### Edit the monit config file:

    $ /etc/default/monit

Enable Monit by setting the following:

    # You must set this variable to for monit to start
    startup=1

### Start Monit:

    $ sudo /etc/init.d/monit start

-----

## Set Up UFW (Uncomplicated Firewall)

Being a production system, you shouldn't expose any ports that aren't being
used. This is where a firewall comes in handy. You will set up the Uncomplicated
Firewall (UFW), a simplified front-end for iptables.

### Install UFW:

    $ sudo apt-get install ufw

### Configure UFW:

    $ sudo ufw allow 22
    $ sudo ufw allow 80
    $ sudo ufw allow 443
    $ sudo ufw allow 2812
    $ sudo ufw default deny

### Enable UFW:

    $ sudo ufw enable

-----

## Set Up Unattended Upgrades

System updates are released frequently and while manually installing these
updates usually only takes a few minutes a day, automating these updates is
easy.

<div class="warning">
    <p>
        Applying any updates can potentially break your system and automating
        these may leave your system broken without your knowledge. However, in
        the several years I've been administering servers I've never personally
        seen an update do any damage. I also feel the benefits of automating
        security updates outweighs the potential downsides of missing a critical
        update that may leave your system vulnerable to attack.
    </p>
</div>

### Install Unattended Upgrades:

    $ sudo apt-get install unattended-upgrades

### Run the first time configuration:

    $ sudo dpkg-reconfigure unattended-upgrades

### Configure other settings:

    $ sudo nano /etc/apt/apt.conf.d/50unattended-upgrades

Edit the following:

    // Automatically upgrade packages from these (origin, archive) pairs
    Unattended-Upgrade::Allowed-Origins {
        "Ubuntu lucid-security";
        // "Ubuntu lucid-updates";
    };
    
    // List of packages to not update
    Unattended-Upgrade::Package-Blacklist {
        // "vim";
        // "libc6";
        // "libc6-dev";
        // "libc6-i686";
    };
    
    // Send email to this address for problems or packages upgrades
    // If empty or unset then no email is sent, make sure that you
    // have a working mail setup on your system. The package 'mailx'
    // must be installed or anything that provides /usr/bin/mail.
    Unattended-Upgrade::Mail "<your_email_address>";
    
    // Do automatic removal of new unused dependencies after the upgrade
    // (equivalent to apt-get autoremove)
    //Unattended-Upgrade::Remove-Unused-Dependencies "false";
    
    // Automatically reboot *WITHOUT CONFIRMATION* if a
    // the file /var/run/reboot-required is found after the upgrade
    Unattended-Upgrade::Automatic-Reboot "false";
    
    // Use apt bandwidth limit feature, this example limits the download
    // speed to 1024kb/sec
    Acquire::http::Dl-Limit "1024";

### Enable Unattended Upgrades:

    $ sudo nano /etc/apt/apt.conf.d/10periodic

Modify the following:

    APT::Periodic::Update-Package-Lists "1";
    APT::Periodic::Download-Upgradeable-Packages "1";
    APT::Periodic::AutocleanInterval "5";
    APT::Periodic::Unattended-Upgrade "1";

-----

## Disable Root Login via Password

One last step in securing your server is to disable logging in as root over SSH
with a password. This will prevent any automated bots from brute-forcing their
way into your root account. You will still be able to run as root by logging
into with your non-privileged user account and running `sudo su`.

### Edit your SSH config:

    $ sudo nano /etc/ssh/sshd_config

### Uncomment the following line:

    PermitRootLogin no

Save and exit this file.

### Restart the SSH daemon:

    $ sudo /etc/init.d/sshd restart

-----

## Set Up SSH Key Authentication

By default, your server will allow you to log in with a user name and password.
While secure, this method of logging in has some significant weaknesses and is
generally inconvenient. To remedy the situation generate an SSH key and
associate it with your server for future authentication.

<div class="info">
    <p>The following assumes you are using a derivative of Linux on your client workstation.</p>
</div>

Run these commands from your workstation, NOT the server.

### Generate your SSH key pair:

    $ ssh-keygen -t rsa -C <your_email_address>

### Copy your public key to the server:

    $ ssh-copy-id user@example.com

Now try and log into your server:

    $ ssh user@example.com

-----

## Install Some Other Useful Tools:

    $ sudo apt-get install bwm-ng htop pastebinit whois
