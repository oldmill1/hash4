Hash4
======

Getting started
----------------

- Put index.php on your sever somewhere. 
- You may wish to define a ROOT_URL constant 

<code>
define("ROOT_URL", "localhost/tumblelog/");
</code>

- Create a posts.txt. It needs to start with the following lines. Replace anything inside the <>'s.

<code>
Site Name My Tumblelog
Author Ankur Taxali
</code>

To write a post, edit the same file using "\####" as post separators. Once you get the hang of it, it's really easy to write posts!

<code>
\####
I invented Hash4!
3/18/13
Hash4 is a blogging system anyone can use. 
Right now it is configured for very simple writing. 
Line breaks are supported!
####
My second post
3/20/13
This is some more content
</code>

You may also choose to edit the site's template.

Releases
---------

1.0
- "just ship it" release 