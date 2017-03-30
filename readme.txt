=== Plugin Name ===

Contributors: chrisliubeers
Tags: collapse, toggles, bootstrap
Requires at least: 3.8
Tested up to: 4.7
Stable tag: 1.0
Plugin Name: Simple Bootstrap Collapse
Plugin URI: http://www.tomatillodesign.com
Description: Using Bootstrap Collapse in WordPress
Author: Chris Liu-Beers
Version: 1.0
Author URI: http://www.tomatillodesign.com
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

This plugin adds Bootstrap Collapse functionality to WordPress. All you need to do is add the Collapse HTML mark up code.


== Description ==

This plugin adds Bootstrap v4 Collapse functionality to WordPress.

It adds just the Bootstrap Javascript Plugin for Collapse and associated CSS, along with a simple shortcode for use in the page editor.

This does not bring in any other Bootstrap javascript or CSS functionality.

There is sample HTML mark up code in the readme.txt for a selector and modal target element.

== Installation ==

Here is the shortcode usage:

[collapse title="Button Title Here"]
Your Content Here.
[/collapse]

Here is the complete HTML Collapse MarkUp
<code>
<div class="clb-collapse-area">

     <a class="collapse-section" data-toggle="collapse" href="#button-title-here" aria-expanded="false" aria-controls="button-title-here">
          <div class="collapse-button-area">Button Title Here</div>
     </a>

     <div class="collapse" id="button-title-here">
     <p>Your Content Here.</p>
     </div>

</div>
</code>

Also, here is the CSS that you may want to customize:

<code>
.collapse-button-area {
     text-align: center;
     width: 100%;
     padding: 20px;
     background: #333;
     color: #fff;
     border: 1px solid #333;
}

a.collapse-section {
     color: #fff;
     font-weight: 700;
     text-decoration: none;
}

.collapse, .collapsing {
     text-align: left;
     border: 1px solid #555;
     background: #fafafa;
     padding: 30px;
     color: #333;
}

.clb-collapse-area {
     margin-bottom: 20px;
}
</code>

== Changelog ==

= 1.0.0 =
* Initial release.
