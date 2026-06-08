<?php if (!defined('FW')) die('Forbidden'); ?>

##STEP 1

###Copy the breadcrumbs code

This code is what displays the breadcrumbs on your website. Copy the following to your clipboard:

<code>&lt;?php if( function_exists('fw_ext_breadcrumbs') ) { fw_ext_breadcrumbs(); } ?&gt;</code>

---

##STEP 2

###Paste the breadcrumbs code in your theme

Open Appearance/Editor and select <strong>single.php</strong> file to edit.

In the theme, paste the code where you want your breadcrumbs to appear (usually beneath the the_title() tag) and then save your theme.

---

##STEP 3

###Add the breadcrumbs to your archive listings

Copy the following code to your clipboard:

<code>&lt;?php if( function_exists('fw_ext_breadcrumbs') ) { fw_ext_breadcrumbs(); } ?&gt;</code>

Open Appearance/Editor and select <strong>archive.php</strong> file to edit.

In the theme, find the place where each item is rendered and paste the code inside that code block.

Then, save your theme.

---

##Shortcode

You can also drop the breadcrumbs into any post, page or text widget with the shortcode:

<code>[breadcrumbs]</code>

All settings can be overridden per shortcode, e.g.:

<code>[breadcrumbs separator="/" prefix="You are here:" link_last="yes" truncate="30"]</code>

---

##Customizing in code

Both <code>fw_ext_breadcrumbs()</code> and <code>fw_ext_get_breadcrumbs()</code> accept an
arguments array that overrides the saved settings for a single call:

<code>&lt;?php fw_ext_breadcrumbs( array( 'separator' =&gt; ' &amp;raquo; ', 'home_icon' =&gt; 'dashicons dashicons-admin-home', 'schema' =&gt; 'json-ld' ) ); ?&gt;</code>

Available arguments: <strong>separator</strong>, <strong>prefix</strong>, <strong>home_icon</strong>,
<strong>link_last</strong>, <strong>show_home</strong>, <strong>show_on_front</strong>,
<strong>truncate</strong>, <strong>post_taxonomy</strong>, <strong>show_post_type_archive</strong>,
<strong>schema</strong> (microdata / json-ld / none), <strong>container_class</strong>.

Passing a string is still supported for backward compatibility (it is treated as the separator).
