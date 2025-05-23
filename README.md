# Estatein - Real Estate WordPress Theme

**Version:** 1.0  
**Author:** Achmad Az  
**License:** GPL2

## Overview

Estatein is a modern, feature-rich WordPress theme designed specifically for real estate agencies and property management companies. Built with best practices in mind, this theme offers a seamless user experience for both administrators and visitors, with a focus on clean design, responsiveness, and performance.
you can check the design here: https://www.figma.com/community/file/1314076616839640516

**DEMO:** https://bcodes.top/estatein

## Features

- **Modern Design** - Contemporary design with dark mode aesthetics and professional color schemes 
- **Responsive Layout** - Fully responsive across all devices (mobile, tablet, desktop)
- **Custom Blocks** - Gutenberg-compatible custom blocks built with Carbon Fields
  - Hero Services Block
  - Property Value Block
  - Contact Form Block
  - And more...
- **Dynamic Forms** - Ajax-powered contact form with client and server-side validation
- **Shortcodes** - Easy-to-use shortcodes for displaying office locations and other content
- **Developer-Friendly** - Well-organized code structure for easy customization
- **Tailwind CSS** - Modern utility-first CSS framework for styling
- **Performance Optimized** - Optimized for speed and performance

## Technology Stack

- **WordPress** (5.0 or higher)
- **PHP** (7.4 or higher)
- **Carbon Fields** (bundled with theme) - For custom fields and blocks
- **Tailwind CSS** - For styling
- **jQuery** - Minimally used for enhanced functionality
- **AJAX** - For form submissions without page refresh

## Installation

1. **Install WordPress**:
   - Set up a fresh WordPress installation

2. **Install the Theme**:
   - Upload the `real-estate` theme folder to your `wp-content/themes` directory
   - Activate the theme from Appearance > Themes in the WordPress admin

3. **Required Plugins**:
   - Carbon Fields is bundled with the theme and will be automatically loaded
   - Download link (if needed): [Carbon Fields on GitHub](https://github.com/htmlburger/carbon-fields)

4. **Recommended Plugins**:
   - Yoast SEO (for SEO optimization)

## Theme Structure

```
real-estate/
│
├── assets/
│   ├── src/
│   │   ├── css/
│   │   ├── images/
│   │   └── js/
│   └── dist/ (compiled assets)
│
├── inc/
│   ├── constants.php
│   ├── enqueue.php
│   ├── extras.php
│   ├── hooks.php
│   ├── widget.php
│   ├── features/
│   ├── metabox/
│   └── setups/
│
├── vendor/ (Carbon Fields and dependencies)
│
├── template-parts/
│
└── functions.php
```

## Custom Blocks & Fields

The theme uses Carbon Fields to create custom blocks for Gutenberg editor. These blocks are defined in the `/inc/metabox/` directory.

### Hero Services Block

```php
// Usage in Gutenberg editor
// Select the "Real Estate Hero Services Block" from the blocks list
```

Features:
- Custom heading and content area
- Up to 4 services with custom icons
- Link selection for each service
- Responsive grid layout

### Property Value Block

```php
// Usage in Gutenberg editor
// Select the "Real Estate Property Value Block" from the blocks list  
```

Features:
- Custom heading and content area
- Value propositions with icons
- CTA section with custom link

### Contact Form Block

```php
// Usage in Gutenberg editor
// Select the "Real Estate Contact Form Block" from the blocks list
```

Features:
- AJAX-powered form submission
- Client and server-side validation
- Custom form fields (name, email, phone, message, etc.)
- Styled success/error notifications

## Shortcodes

### Office Locations

```php
// Usage in any post or page
[office_locations]
```

Displays office locations from Carbon Fields theme options with:
- 2-column responsive grid layout
- Contact information (address, phone, email)
- Map location links
- Custom styling

## Theme Options

Navigate to Carbon Fields > Theme Options in the WordPress admin to configure:

1. **Global Settings**
   - Logo uploads
   - Color scheme options
   - Typography settings

2. **Contact Information**
   - Company details
   - Social media links
   - Office locations

3. **Homepage Settings**
   - Featured properties
   - Testimonials
   - Call-to-action content

## Developer Notes

### Adding Custom Blocks

1. Create a new PHP file in `/inc/metabox/` directory
2. Define the block structure using Carbon Fields syntax
3. Register the block in `/inc/metabox/index.php`

Example:
```php
Block::make( __( 'Custom Block Name' ) )
    ->add_fields( array(
        Field::make('text', 'heading', __('Block Heading')),
        Field::make('rich_text', 'content', __('Block Content')),
    ) )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        // HTML structure for the block
    } );
```

### Working with Shortcodes

Custom shortcodes are registered in `functions.php`. To create a new shortcode:

1. Define the shortcode callback function
2. Register it using `add_shortcode()`
3. Use output buffering for clean HTML generation

## Custom CSS

The theme uses Tailwind CSS utility classes for styling. Custom CSS can be added:

1. Via WordPress Customizer
2. By editing Tailwind configuration

## Support

For support or issues, please contact me at achmad.azman@gmail.com.

## License

This theme is licensed under GPL2. See the LICENSE file for more details.
