---
title: "Postfix: Using Gmail as a Relay Host"
tags: ['Linux', 'Ubuntu', 'Gmail']
published: 2012-07-06 15:35:42
---

<!-- excerpt -->
I maintain several Linux servers at any given moment. Every server has postfix
installed for sending emails, usually notifications or warning messages of some
sort and most of these servers are professionally hosted allowing outbound
emails with little to no configuration beyond installing postfix. However, my
home server lies behind my ISP and they block all outbound emails citing SPAM as
the reason. Regardless of their reasoning I had to find a workaround to allow me
to send email notifications from behind my ISP. Well, it turns out this is
rather painless with postfix and a Gmail account.
<!-- endexcerpt -->

First, set up a Gmail account, note the user name and password for later.

### Install postfix

    $ sudo apt-get install postfix

### Add the following to `/etc/postfix/main.cnf`

    # Forward mail through Gmail
    relayhost = [smtp.gmail.com]:587
    smtp_use_tls = yes
    smtp_sasl_auth_enable = yes
    smtp_sasl_password_maps = hash:/etc/postfix/sasl_passwd
    smtp_sasl_security_options = noanonymous
    smtp_tls_CAfile = /etc/ssl/certs/Equifax_Secure_CA.pem

### Create the file `/etc/postfix/sasl_passwd` and add the following:

    [smtp.gmail.com]:587 [username]@gmail.com:[password]

<div class="info">
    <p>Be sure to replace <code>[username]</code> and <code>[password]</code> with your account user name and password.</p>
</div>

### Modify file permissions and generate `sasl_passwd.db`

    $ cd /etc/postfix
    $ postmap sasl_passwd
    $ chmod 600 sasl_passwd sasl_passwd.db

### Restart postfix service

    $ sudo service postfix restart

### Send a test email

    $ sudo apt-get install mailutils $ echo 'Success!' | mailx -s 'Test Message' [email_address]

Replace `[email_address]` with your email address to receive a test message.
