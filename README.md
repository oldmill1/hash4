Hash4
======

Getting started
----------------

- Put index.php on your sever somewhere. 
- You may wish to define a ROOT_URL constant 

<code>
define("ROOT_URL", "localhost/tumblelog/");
</code>

- Create a posts.txt. It needs to start with the following lines. 

Site Name My Tumbleong
Author Ankur Taxali

To write a post, edit the same file using "\####" as post separators.

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


WordPress-style Templates
--------------------------

You may also choose to edit the site's template to better suit your needs. We adhere to a WordPress-style API. 

<code>
<?php get_bloginfo(); ?/>
</code>


Releases
---------

1.0
- "just ship it" release 