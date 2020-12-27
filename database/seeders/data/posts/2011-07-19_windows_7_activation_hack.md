---
title: Windows 7 Activation Hack
tags: ['Microsoft', 'Windows']
featured_image_url: https://images.unsplash.com/photo-1573867975080-15a3d9445345?ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&h=1000
featured_image_text: Photo by [Halacious](https://unsplash.com/@halacious?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText) on [Unsplash](https://unsplash.com/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText)
published: 2011-07-19 12:34:56
---

<div class="danger">
    <p><strong>Still using Windows 7?</strong> As of January 2020 Windows 7 has been discontinued and will no longer receive new features or security patches.</p>
</div>

<div class="info">
    <p><strong>Don't want to upgrade to Windows 10?</strong> <a href="https://ubuntu.com/download/esktop">Give Ubuntu a try!</a> It's 100% free, more secure and runs better on the same hardware than Windows.</p>
</div>

<excerpt>
When installing Windows 7 it's very picky about which installation disc you use
(Full vs. Upgrade) and if improperly matched with your key can prevent you from
activating your copy of Windows usually returning an "Invalid Product Key" error
message. You may also see the same or similar error when you do a full, clean
installation with an upgrade disc. This can be very annoying, especially when
you have a legitimate key and disc but just didn't install it the way Microsoft
thinks you should. In the event that you are having trouble activating your
Windows 7 installation with a legitimate key, try the following registry hack:
</excerpt>

  1. First make sure there are no pending tasks requiring a reboot.This is
     indicated by an orange shield icon next to your shutdown button on the
     Start menu or in the notification tray.
  
  2. Open the Registry Editor (Start → search for "regedit" and hit Enter)

  3. Navigate to the following registry key:
     
         HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Setup\OOBE

  4. Double click on `MediaBootInstall` in the right pane and change "Value data" to `0`

  5. Open a command prompt with administrative rights (Start → search for "cmd" and hit Enter)

  6. Run the following command to reset Windows activation status: `slmgr -rearm`

  7. Reboot your computer.

  8. Run the Activate Windows utility (Start → search for "Activate Windows"),
     enter your upgrade product key and activate Windows.

<div class="info">
    <p>This activation hack will only work if you have a legitimate key. This method wont help if you have a pirated copy of Windows.</p>
</div>
