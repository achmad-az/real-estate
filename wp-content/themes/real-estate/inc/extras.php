<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * This file intended to be use only for defining global functions that will be utilized on 
 * template files such as page-about-us.php, footer.php, etc.
 * 
 * 
 */



function get_main_class( $css_class ) {

	$classes = array();

	$classes[] = 'main';

	if ( ! empty( $css_class ) ) {
		if ( ! is_array( $css_class ) ) {
			$css_class = preg_split( '#\s+#', $css_class );
		}
		$classes = array_merge( $classes, $css_class );
	} else {
		// Ensure that we always coerce class to being an array.
		$css_class = array();
	}

	/**
	 * Filters the list of CSS body class names for the current post or page.
	 *
	 * @since 2.8.0
	 *
	 * @param string[] $classes   An array of body class names.
	 * @param string[] $css_class An array of additional class names added to the body.
	 */
	$classes = apply_filters( 'main_class', $classes, $css_class );

	return array_unique( $classes );

}

function main_class( $css_class = '' ) {
	// Separates class names with a single space, collates class names for body element.
	echo 'class="' . esc_attr( implode( ' ', get_main_class( $css_class ) ) ) . '"';
}

/**
 * Determine whether it is an AMP response.
 *
 * @return bool Is AMP response.
 */
function is_amp_page()
{
	if (function_exists('amp_is_request')) {
		return amp_is_request();
	} else if (function_exists('is_amp_endpoint')) {
		return is_amp_endpoint();
	}
	return false;
}

/**
 * Get single category from post id
 * 
 * @return WP_Term
 */
function rela_estate_get_single_category( $post_id = null ) {

  $categories = get_the_category($post_id);

  if (!empty($categories)) return $categories[0];

   return null;
}

/**
 * Get array category ids from post id
 * 
 * @return Array
 */
function rela_estate_get_categories_ids( $post_id = null ) {

  $cat = [];

  $categories = get_the_category($post_id);

  foreach($categories as $category) {
      $cat[] = $category->term_id;
  }

   return $cat;
}

/**
 * Check whether a page is in goblin mode
 * 
 * @return boolean
 */
function rela_estate_is_goblin_mode( $post = null ) {
  if (!$post)  {
    global $post;
  }
  $post_id = ($post) ? $post->ID : 0;
  $post_template = get_post_meta( $post_id, '_wp_page_template', true );

  if (has_category(['goblin-mode', 'Goblin Mode'], $post)) return true;
  
  if ($post_template == 'page-goblin-mode.php') return true;

  return false;
}

/**
 * check whether a page is goblin mode landing page
 * 
 * @return boolean
 */
function rela_estate_is_goblin_mode_landing_page() {
  global $post;

  $post_id = ($post) ? $post->ID : 0;
  $post_template = get_post_meta( $post_id, '_wp_page_template', true );
  
  if ($post_template == 'page-goblin-mode.php') return true;

  return false;
}

/**
 * Convert url string into clickable link
 *
 * @return string.
 */
function rela_estate_autolink($content) {
  $content = preg_replace('/\b(https?|ftp):\/\/[^\s<]+/', '<a target="_blank" class="!text-[--theme-text-link-color]" rel="noopener noreferrer" href="$0">$0</a>', $content);

  return $content;
}

/**
 * Get social media data
 *
 * @return array.
 */
function rela_estate_social_media($page_style, $force_style_dark = false, $shared_url = null) {
  if ($force_style_dark) {
    $page_style = 'dark';
  }
  $social_icons = [
      'youtube' => [
          'url_social' => get_theme_mod("rela_estate_social_youtube_url"),
          'label_social' => 'Watch our YouTube channel',
          'icon' => ($page_style === 'dark') ? 'icon-youtube-light.svg' : 'icon-youtube.svg',
          'icon_path' => ($page_style === 'dark') ? get_template_directory() . '/assets/dist/images/icon-youtube-light.svg' : get_template_directory() . '/assets/dist/images/icon-youtube.svg',
          'icon_url' => ($page_style === 'dark') ? get_template_directory_uri() . '/assets/dist/images/icon-youtube-light.svg' : get_template_directory_uri() . '/assets/dist/images/icon-youtube.svg',
          'url_share' => '',
          'label_share' => 'Share on YouTube',
      ],
      'instagram' => [
          'url_social' => get_theme_mod("rela_estate_social_instagram_url"),
          'label_social' => 'Follow us on Instagram',
          'icon' => ($page_style === 'dark') ? 'icon-instagram-light.svg' : 'icon-instagram.svg',
          'icon_path' => ($page_style === 'dark') ? get_template_directory() . '/assets/dist/images/icon-instagram-light.svg' : get_template_directory() . '/assets/dist/images/icon-instagram.svg',
          'icon_url' => ($page_style === 'dark') ? get_template_directory_uri() . '/assets/dist/images/icon-instagram-light.svg' : get_template_directory_uri() . '/assets/dist/images/icon-instagram.svg',
          'url_share' => '',
          'label_share' => 'Share on Instagram',
      ],
      'facebook' => [
          'url_social' => get_theme_mod("rela_estate_social_facebook_url"),
          'label_social' => 'Follow us on Facebook',
          'icon' => ($page_style === 'dark') ? 'icon-facebook-light.svg' : 'icon-facebook.svg',
          'icon_path' => ($page_style === 'dark') ? get_template_directory() . '/assets/dist/images/icon-facebook-light.svg' : get_template_directory() . '/assets/dist/images/icon-facebook.svg',
          'icon_url' => ($page_style === 'dark') ? get_template_directory_uri() . '/assets/dist/images/icon-facebook-light.svg' : get_template_directory_uri() . '/assets/dist/images/icon-facebook.svg',
          'url_share' => 'https://www.facebook.com/sharer/sharer.php?u='. $shared_url,
          'label_share' => 'Share on Facebook',
      ],
      'tiktok' => [
          'url_social' => get_theme_mod("rela_estate_social_tiktok_url"),
          'label_social' => 'Follow us on TikTok',
          'icon' => ($page_style === 'dark') ? 'icon-tiktok-light.svg' : 'icon-tiktok.svg',
          'icon_path' => ($page_style === 'dark') ? get_template_directory() . '/assets/dist/images/icon-tiktok-light.svg' : get_template_directory() . '/assets/dist/images/icon-tiktok.svg',
          'icon_url' => ($page_style === 'dark') ? get_template_directory_uri() . '/assets/dist/images/icon-tiktok-light.svg' : get_template_directory_uri() . '/assets/dist/images/icon-tiktok.svg',
          'url_share' => '',
          'label_share' => 'Share on TikTok',
      ],
  ];

  return $social_icons;
}

/**
 * Check remote image exist
 *
 * @return boolean
 */
function rela_estate_image_exists($url) {
    $headers = @get_headers($url);
    
    if ($headers && strpos($headers[0], '200') !== false) {
        return true;
    } else {
        return false;
    }
}

/**
 * Hide tags from quick edit if user does not have admin priviledges
 */
function rela_estate_hide_playlist_from_quick_edit( $show_in_quick_edit, $taxonomy_name, $post_type ) {
    if ( GNS_TAXONOMY_PLAYLIST === $taxonomy_name ) {
        return false;
    } else {
        return $show_in_quick_edit;
    }
}
add_filter( 'quick_edit_show_taxonomy', 'rela_estate_hide_playlist_from_quick_edit', 10, 3 );

class Walker_Nav_Menu_Custom extends Walker_Nav_Menu {
  /**
   * Start Level
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int    $depth  Depth of menu item. Used for padding.
   * @param array  $args   An array of arguments. @see wp_nav_menu()
   */
  public function start_lvl(&$output, $depth = 0, $args = null) {
      $indent = str_repeat("\t", $depth);
      $classes = 'relative mt-2 w-full bg-white shadow-lg rounded-lg'; // Sub-menu is now relative
      $output .= "\n$indent<ul class=\"$classes space-y-2 py-2\" x-show=\"open\" x-transition>\n";
  }

  /**
   * Start Element
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param object $item   Menu item data object.
   * @param int    $depth  Depth of menu item. Used for padding.
   * @param array  $args   An array of arguments. @see wp_nav_menu()
   * @param int    $id     Current item ID.
   */
  public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
      $indent = ($depth) ? str_repeat("\t", $depth) : '';
      $classes = empty($item->classes) ? array() : (array) $item->classes;
      $classes[] = 'menu-item';

      if ($depth === 0) {
          $classes[] = 'relative'; // Parent menu is relative
      }

      $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
      $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

      $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
      $id = $id ? ' id="' . esc_attr($id) . '"' : '';

      // Add Alpine.js x-data for parent menu items with sub-menus
      $x_data = in_array('menu-item-has-children', $classes) ? ' x-data="{ open: false }"' : '';

      $output .= $indent . '<li' . $id . $class_names . $x_data . '>';

      $atts = array();
      $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
      $atts['target'] = !empty($item->target) ? $item->target : '';
      $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
      $atts['href'] = !empty($item->url) ? $item->url : '';
      $atts['class'] = 'flex justify-between items-center px-3 py-2 text-base font-semibold leading-7 text-black hover:text-black hover:bg-black';

      $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

      $attributes = '';
      foreach ($atts as $attr => $value) {
          if (!empty($value)) {
              $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
              $attributes .= ' ' . $attr . '="' . $value . '"';
          }
      }

      $item_output = $args->before;

      // Add toggle button for parent menu items with sub-menus
      if (in_array('menu-item-has-children', $classes)) {
          $item_output .= '<a' . $attributes . ' class="flex items-center justify-between">';
          $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
          $item_output .= '<svg @click.prevent="open = !open" class="w-6 h-6 ml-2 transform" :class="{ \'rotate-180\': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                           </svg>';
          $item_output .= '</a>';
      } else {
          $item_output .= '<a' . $attributes . '>';
          $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
          $item_output .= '</a>';
      }

      $item_output .= $args->after;

      $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}