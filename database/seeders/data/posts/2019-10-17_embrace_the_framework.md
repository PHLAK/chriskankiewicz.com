---
title: Embrace the Framework
featured_image_url: https://images.unsplash.com/photo-1465829235810-1f912537f253?ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&w=1600
featured_image_text: Photo by [Dayne Topkin](https://unsplash.com/@dtopkin1?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText) on [Unsplash](https://unsplash.com/s/photos/framework?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText)
tags: ['Code', 'Frameworks']
published: 2019-10-17 08:16:32
---

<excerpt>
Frameworks are among the most important tools we developers have and yet they
are often taken for granted. The way I see it is a framework has two primary
benefits: 1) saving individual developers time by providing predefined solutions
to common problems and 2) allowing teams to work more efficiently by giving them
a common model for coding standards, file organization, design language and
more. However, these benefits quickly break down when framework conventions are
broken or ignored, intentionally or otherwise.
</excerpt>

Picture the following: You find out that you'll be taking over a project built
by another person or team. It's mentioned that the project is built on a
framework you're somewhat familiar with. Immediately you start to develop a
mental map of the project. You can picture the file structure and know some of
the framework tooling probably in use. Depending on your level of familiarity
with the framework you may even be able to picture some of the lower level
details like the routes, interfaces, classes and/or methods implemented.

Now fast forward to reality. You gain access to the code base and start poking
around. You quickly notice that nothing is as you had imagined. The application
isn't following most framework conventions and those that it does are poorly
implemented at best. The provided tooling is either not used or, more than
likely, entirely broken. You even notice one or more features were developed
using third-party tools or from scratch when the framework provides the same
functionality out of the box. And let's not even get started on the database
design... 😭

Unfortunately we've all probably run into this at some point or another. I've
personally seen this on most major applications I've inherited late in their
development lifetime. This is why I believe we should all take the time to
develop a close relationship with the frameworks we use and embrace them more
completely. I would even argue that we should be spending more time learning to
use our frameworks to solve our problems then trying to solve the problems on
their own.

From now on, when you find yourself asking "How can I/we solve this problem?"
instead try asking "How can the framework solve this problem for us?" then take
the time to do exactly that. Read the docs, engage with the community,
experiment a little and only implement your own solution after understanding
WHY the framework couldn't solve your problem. The more you (and your team)
understand and embrace your framework, whether it be Laravel, React, Rails or
`{{ insert next big framework here }}`, the more efficient you will become.


