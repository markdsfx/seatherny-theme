# SDEV 2 (ACF Blocks) Theme Boilerplate Setup & Development

***Download this repository. Do not push here with your project. Remove git folder after downloading, then start your own project repository***

This theme uses ACF Blocks integrated with WordPress default editor.

---

## Prerequisites

You must have these softwares installed in your local machine:

1. Node JS v.14.15.1 and NPM
2. Localhost
3. PHP 8.0 and up
4. Latest Wordpress version
5. ACF Pro plugin

---

## Getting Started

1. Start a new WordPress project in local with he latest versions of PHP and WordPress.
2. Copy this repo to your themes folder. **NOTE: Do not copy the git folder and do not push your project to this repository. Start your own project repository.**
3. Activate the SDEV theme.
4. Install **ACF Pro** plugin in your local WordPress and update it to the latest version. (Ask PM or Dev Lead for the license key)
5. Download the latest **ACF backup file** inside the **acf/** directory in this repository.
6. Import the downloaded backup file into your local ACF plugin.
7. Make sure you have **node.js** and **npm** installed.
8. In your **terminal / cmd / git bash**, go inside the theme directory.
9. Install the dependencies by running the **npm install** command.

---

## Development & Build

Using webpack to compile and build dev files.

1. Build files are generated in **dist/** directory. Source files are located inside the **src/** directory.
2. To build & compile the source files, just run **npm run build** command.
3. To watch changes during development, run **npm run dev** command.
4. When uploading the distribution files to a production server, make sure you upload the **Build and Compiled** version. 

---

## Templating

1. This theme follows the default templating format of WordPress.

---

## ACF Blocks

You can follow the official ACF Blocks guide here: https://www.advancedcustomfields.com/resources/blocks/

1. View blocks ca be found inside the  **views/blocks** directory. 
2. Each block has its own director named after it and is consisted of three main files: block.json, the template php file, and a preview image.
3. Block.json is a configuration object that stores all the block metadata and settings.
4. The template php file is where you render your block.
5. Preview image is just an image or screenshot of the block when added to a page or post.
6. Sample blocks provided in this repo: Full width banner, and WYSIWYG block.

---

## Recommended Standard Plugins

1. Forminator - for forms, contact forms, subscribe, inquiry forms, surveys, etc.
2. Yoast SEO - for on-page SEO implementations
3. ACF PRO - for custom fields
4. ACF : Extended - for setting up custom post types, and taxonomies
5. Wordfence - security, scan, and firewall
6. Store Locator (if applicable) - for store locator features
7. Woocommerce (if applicable) - for e-commerce sites
8. All-in-one WP Migration - for import/export and backups

---

## Sample Javascript Modules

1. Lazyload module and panel animation.
2. XHR Helper
3. Form Helper
4. Visibilty API Wrapper
5. Youtube API Helper
6. Header and Menu

---

## SDEV PHP Library and Helpers

1. Source Files are located in lib/sdev/
2. To add a new php file to autoload, you must include the file in the dependecy list found in etc/di.php.
3. SDEV is loaded via the theme's functions.php

---

## Using the Panel Animation Module

1. Available options, default options are located in **src/js/app/lazyload/contentlazyload.ux.js**:
    - **data-offset** - how far the element will animate to its target position in px. *Default: 100*.
    - **data-origin** - value can be "y" for vertical animation, or "x" for horizon animation. *Default: 'y'*.
    - **data-delay** - delay in seconds. *Default: 0.1*.
    - **data-duration** - duration of the animation in seconds. *Default: 0.8*.
    - **data-opacity** - starting opacity. *Default: 0*.

2. Classes to use:
    - **anim-on-load** - animation will commence on page load.
    - **anim-on-scroll** - animation will commence when the element is visible in viewport when scrolling.

3. Example usage:
    ***<div class="anim-on-scroll" data-offset="100" ...></div>***

---