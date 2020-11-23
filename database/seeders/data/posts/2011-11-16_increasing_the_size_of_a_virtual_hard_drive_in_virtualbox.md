---
title: Increasing the Size of a Virtual Hard Drive in VirtualBox
tags: ['Linux']
featured_image_url: https://images.unsplash.com/photo-1597852074816-d933c7d2b988?ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&h=1000
featured_image_text: Photo by [benjamin lehman](https://unsplash.com/@benjaminlehman?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText) on [Unsplash](https://unsplash.com/s/photos/hard-drive?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText)
published: 2011-11-16 19:45:13
---

<!-- excerpt -->
I work in Linux primarily but run a Windows 7 virtual machine in VirtualBox so I
can use Photoshop and do some necessary testing. Today my VM ran out of space.
Silly me thought 20GB would be enough, but after installing service pack 1,
dozens of Windows updates and a few programs I had less than 1GB of space left.
After a little searching I found an easy way to increase the size of a virtual
disk.
<!-- endexcerpt -->

First, shut down your VM then run the following command from your host PC:

```shell
$ VBoxManage modifyhd /path/to/guest.vdi --resize <size_in_mb>
```

Once completed, boot into your VM and (for Windows) open up Control Panel →
Administrative Tools → Computer Management. In Computer Management navigate to
Storage → Disk Management then, in the right pane, right click your disk and
select "Extend Volume" and follow the prompts to resize your disk. And that's
it! Your disk will now be resized.

This also works from a Windows host, you just have to locate and use `VBoxManage.exe`.

<div class="info">
    <p>This method only allows you to INCREASE the size of a virtual disk. You cannot shrink one with this method.</p>
</div>
