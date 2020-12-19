---
title: Scheduled Tasks with Systemd Timers
featured_image_url: https://images.unsplash.com/photo-1501139083538-0139583c060f?ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&w=1600
featured_image_text: Photo by [Aron Visuals](https://unsplash.com/@aronvisuals?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText) on [Unsplash](https://unsplash.com/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText)
tags: ['Linux']
published: 2020-10-31 06:06:06
---

<!-- excerpt -->
Use a Linux system long enough and eventually you'll need to schedule a
recurring task. Of course the defacto scheduler is cron (and there's nothing
inherently wrong with it) but I've grown to like the flexibility and features of
systemd timers. Some of the benefits they provide over cron include:
<!-- endexcerpt -->

  - Easily enable/disable/run individual tasks
  - Logging included (with `journalctl`)
  - The ability to run a "missed" tasks at next boot
  - Easily configured randomized delays
  - And more...

Scheduling tasks with systemd is a little more verbose than cron but still
relatively easy. In order to show you an example let's take a look at a
use-case I had recently: updating my globally-installed
[Composer](https://getcomposer.org/) packages on a schedule.

## Preface

For those unfamilliar, systemd is composed of "units". A unit is composed of one
or more files that define what they do and how they behave. Systemd units cand
be either a "system" unit or a "user" unit. Both work exactly the same, however
there are some important difference.

**System** units

  - Live in `/etc/sytemd/system/`
  - Are configured globally
  - Run as the root user
  - Run all the time

**User** units

  - Live in `/etc/systemd/user/`
  - Are configured per-user
  - Run as the currently logged in user
  - Run only when the user is logged in

Also, working with systemd is primarily done via the `systemctl` (system
control) command which we'll be using here. By default the `systemctl` command
operates in the **system** context. If we wish to work in the **user** context
we must pass the `--user` flag with our `systemctl` commands.

## Creating a Task

To get started, the first thing we need to do is create our service file that
will do the actual work. For this task we will be configuring our service as a
user service which, as we learned, lives in `/etc/systemd/user/` so let's create
it there.

### `/etc/systemd/user/composer-update.service`

```ini
[Unit]
Description=Update global composer packages

[Service]
Type=oneshot
ExecStart=composer global update --no-interaction --verbose
```

This file defines our systemd unit, in this case a service (defined by the
`.service` file extension). It's here we will put the command we want to run.

First we add a description to the `[Unit]` section explaining what this service does.

Then, we set the command to run in the `[Service]` section with the `ExecStart`
option. In this case we're running `composer global update` with some arguments.

We will also set the `Type` option to `oneshot`. This tells systemd to run our
command and consider it successful after a successful run (that is when it exits
with an exit code of `0`) and not to worry about it after that since it's not a
persistent service.

<div class="info">
    <p>
        See the <a href="https://www.freedesktop.org/software/systemd/man/systemd.service.html">systemd.service documentation</a> for additional information on services.
    </p>
</div>

Let's check on the status of our service now.

```shell
$ systemctl --user status composer-update.service
```

You should see something like the following.

```
● composer-update.service - Update global composer packages
     Loaded: loaded (/etc/xdg/systemd/user/composer-update.service; static; vendor preset: enabled)
     Active: inactive (dead)
```

Here we can see the name of our service and it's description at the top. Below
that it shows us that the service is loaded and inactive.

Now let's test our service to make sure it works. To test it we can manually run
it with `systemctl start`.

```shell
$ systemctl --user start composer-update.service
```

Now if we check the status status again we should see the same info as before
followed by the last few lines of output from the command.

```
● composer-update.service - Update global composer packages
     Loaded: loaded (/etc/xdg/systemd/user/composer-update.service; static; vendor preset: enabled)
     Active: inactive (dead)

Oct 31 08:56:17 Starscream composer[38204]:   0/10 [>---------------------------]   0% < 1 sec
Oct 31 08:56:18 Starscream composer[38204]:  10/10 [============================] 100% < 1 secPackage padraic/phar-updater is abandoned, you should avoid using it. No replacement was suggest>
Oct 31 08:56:18 Starscream composer[38204]: Generating autoload files
Oct 31 08:56:18 Starscream composer[38204]: > post-autoload-dump: PackageVersions\Installer->dumpVersionsClass
Oct 31 08:56:18 Starscream composer[38202]: composer/package-versions-deprecated: Generating version class...
Oct 31 08:56:18 Starscream composer[38202]: composer/package-versions-deprecated: ...done generating version class
Oct 31 08:56:18 Starscream composer[38204]: 68 packages you are using are looking for funding.
Oct 31 08:56:18 Starscream composer[38204]: Use the `composer fund` command to find out more!
Oct 31 08:56:18 Starscream systemd[6614]: composer-update.service: Succeeded.
Oct 31 08:56:18 Starscream systemd[6614]: Finished Update global composer packages.
```

Great, we know our command worked! However, if we wish to see the full output we
can use `journalctl` to see the complete history log.

```shell
$ journalctl --user --unit composer-update.service
```

## Scheduling the Task

Now that we have a systemd service to do the work let's create a unit to run our
service periodically. To do this we create a systemd timer. The timer file must
have the same base name as our service file but with the `.timer` file extension
instead.

### `/etc/systemd/user/composer-update.timer`

```ini
[Unit]
Description=Run composer-update.service

[Install]
WantedBy=timers.target

[Timer]
OnCalendar=weekly
Persistent=true
```

Again we'll start by adding a `Description`.

Next, in order for systemd to configure our timers on boot we need to add the
`WantedBy=timers.target` line to the `[Install]` section. This will create the
proper symlinks required when we enable our timer later on and is an important
piece so don't forget it.

We can then define when to run the task with the `OnCalendar=weekly` option in
the `[Timer]` section. This, as the name implies, will run our task once per week.

Lastly, let's use the `Persistent=true` option to have our task run as soon as
possible if a scheduled run was missed. This is useful if your system doesn't
run 24/7 and might be off during a previously scheduled run.

<div class="info">
    <p>
        See the <a href="https://www.freedesktop.org/software/systemd/man/systemd.timer.html">systemd.timer documentation</a> for additional information on timers.
    </p>
</div>

### Enable the Schedule

At this point we have our service to do the work and our timer that defines when
to do the work but if we stop here it will never run. If we run
`systemctl --user list-timers` right now we'll see a list of your currently
enabled timers, however, our newly created timer is not in this list. Let's
enable the timer now.

```shell
$ systemctl --user enable composer-update.timer
```

Running `systemctl enable` tells systemd to automatically start the timer on
boot. Since our system is already running it hasn't been started yet. We _could_
reboot to get the timer running but let's manually start it instead.

```shell
$ systemctl --user start composer-update.timer
```

Now if we view our timers again we should see our timer in the list.

```
NEXT                        LEFT        LAST                        PASSED    UNIT                  ACTIVATES              
Mon 2020-11-02 00:00:00 MST 2 days left n/a                         n/a       composer-update.timer composer-update.service
```

And that's it! We now have our scheduled task running and it will work in the
background automatically.

<div class="info">
    <p>
        For additional information about systemd check out the
        <a href="https://www.freedesktop.org/software/systemd/man/index.html">man pages</a>.
    </p>
</div>
