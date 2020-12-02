---
title: Run Composer Binaries From Project Directories
featured_image_url: https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&w=1600
featured_image_text: Photo by [Arnold Francisca](https://unsplash.com/@clark_fransa?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText) on [Unsplash](https://unsplash.com/s/photos/code?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText)
tags: ['Linux', 'PHP']
published: 2020-12-04 09:00:00
---

<!-- excerpt -->
As a PHP developer I often find myself having to run executable files installed to a project via Composer (e.g. `php-cs-fixer`, `phpunit`, `psysh`, etc.). These binary files typically reside in `vendor/bin` relative to the root of a project and in order to run these binary files from the project root I would need to `cd` into the `vendor/bin` directory first or type out the relative path (e.g. `vendor/bin/php-cs-fixer fix`) every time I wanted to run one of these executables.
<!-- endexcerpt -->

Similarly, I have several Composer executables installed globally in `~/.config/composer/vendor/bin`. To run these I would have to type the **full** path to these files (e.g. `~/.config/composer/phpunit`) with each invocation.

The thing is, I have a low tolerance for even minor annoyances in my development workflow as they tend to add up quickly and get in the way of __actual__ work. So I went looking for a way to avoid these problems and improve my quality of life.

## The `PATH` variable

On all major operating systems the `PATH` environment variable specifies a set of directories to look in for an executable (or "binary") file when running a command from the command line. On Linux-based operating systems this variable will be composed of multiple directories separated by colons (`:`). For example a default `PATH` variable may have a value of `/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin`.

When using the command line to issue a command like `ls` your system will look for an executable file in the directories defined in `PATH`, from first to last, and execute the first matching executable found. For the default value above this would first look for an executable at `/usr/local/sbin/ls`, next at `/usr/local/bin/ls` and so on until it finds the executable at `/usr/bin/ls`.

There are two additional things worth mentioning: First, this variable can be customized allowing additional search directories to be added and second, those paths can be absolute or **relative**.

## The Solution

<div class="info">
    <p>This solution assumes you're familiar with <a href="https://www.gnu.org/software/bash/manual/html_node/Bash-Startup-Files.html">Bash startup files</a> (a.k.a. rc files) and setting environment variables.</p>
</div>

By now, it should be pretty obvious where this is going. We can add our Composer binary directories to our `PATH` environment variable! We can do this by adding the following to our `.bashrc` file.

```shell
export PATH="vendor/bin:${COMPOSER_HOME}/vendor/bin:${PATH}"
```

This will prepend the local (relative) and global (absolute) Composer binary directories to the existing `PATH` definition. Now, when executing commands the system will search for an executable at `vendor/bin/<something>` (relative to the current directory) first, then `${COMPOSER_HOME}/vendor/bin` and lastly fall back to the default directories. Therefor, when in a project directory and we attempt to run something like `phpunit` it will be executed from the locally or globally installed dependency if it exists or gracefully fall back and we never have to leave the comfort of our project root directory.

<div class="info">
    <p>See the <a href="https://getcomposer.org/doc/03-cli.md#composer-home">Composer docs</a> for additional information about the <code>COMPOSER_HOME</code> environment variable.</p>
</div>

There is, however, **one** caveat with this approach that was brought up by [Paul Redmond](https://twitter.com/paulredmond) when I shared this solution on Twitter.

<center>
	<blockquote class="twitter-tweet" data-conversation="none"><p lang="en" dir="ltr">The only gotcha here is vendor/bin/composer</p>&mdash; Paul Redmond 🇺🇸 (@paulredmond) <a href="https://twitter.com/paulredmond/status/1296547838814375937?ref_src=twsrc%5Etfw">August 20, 2020</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</center>

Specifically, if you have Composer installed globally _and_ installed to your project (i.e. `composer require composer/composer`) when you attempt to run `composer update` (or any other `composer ...` command) from your project root the binary in `vendor/bin` would take precedence over the global binary due to the `PATH` definition. To solve this I came up with the following bash alias and added it to my bash startup files as well.

```bash
[[ $(command -v composer) ]] && alias composer="$(command -v composer)"
```

Now, as long as Composer is installed globally, running `composer` from a project directory will execute the global binary, even if composer exists in `vendor/bin`! 🥳
