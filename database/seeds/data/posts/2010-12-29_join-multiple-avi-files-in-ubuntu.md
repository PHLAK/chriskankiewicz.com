---
title: Join multiple .avi files in Ubuntu
tags: ['Linux', 'Ubuntu']
published: 2016-02-01 11:12:13
---

I was just in a bit of a pickle and needed to join two .avi files together while
in Ubuntu. There are a number of solutions out there, but the most simple
solution I could find was via avimerge. Here's how I did it.

### Install avimerge

```shell
sudo apt-get update sudo apt-get install transcode-utils
```

### Merge your files

```shell
avimerge -i input_file1.avi input_file2.avi -o output_file.avi
```

It's as simple as that. I did this in Ubuntu 10.10, but this should work for
older versions as well.
