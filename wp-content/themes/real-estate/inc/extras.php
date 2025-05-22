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

/**
 * Handle newsletter signup form submissions
 */
function rela_estate_handle_newsletter_signup() {
    // Verify nonce
    if (!isset($_POST['newsletter_nonce']) || !wp_verify_nonce($_POST['newsletter_nonce'], 'newsletter_signup_nonce')) {
        wp_die('Security check failed. Please try again.');
    }
    
    // Get email from form
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    
    if (!is_email($email)) {
        wp_die('Please provide a valid email address.');
    }
    
    // Log submission for debugging
    error_log('Newsletter signup submitted with email: ' . $email);
    
    // Process the email - this is where you'd integrate with your newsletter provider
    // For now, just save to database or send an admin email
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    $subject = sprintf('[%s] New Newsletter Signup', $site_name);
    $message = sprintf('A new user has signed up for your newsletter: %s', $email);
    
    // Send notification to admin
    wp_mail($admin_email, $subject, $message);
    
    // Store in database
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    
    // Check if table exists, create if it doesn't
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        // Table doesn't exist, create it now
        rela_estate_create_newsletter_table();
        error_log('Newsletter table created on demand');
    }
    
    // Now insert the subscriber
    $result = $wpdb->insert(
        $table_name,
        array(
            'email' => $email,
            'date_added' => current_time('mysql'),
            'status' => 'subscribed'
        )
    );
    
    // Log the result
    if ($result === false) {
        error_log('Failed to insert subscriber: ' . $wpdb->last_error);
    } else {
        error_log('Subscriber inserted successfully with ID: ' . $wpdb->insert_id);
    }
    
    // Redirect user back with success message
    wp_safe_redirect(add_query_arg('newsletter', 'success', wp_get_referer()));
    exit;
}
add_action('admin_post_newsletter_signup', 'rela_estate_handle_newsletter_signup');
add_action('admin_post_nopriv_newsletter_signup', 'rela_estate_handle_newsletter_signup'); // For non-logged in users

/**
 * Display newsletter signup success message
 */
function rela_estate_newsletter_success_message() {
    if (isset($_GET['newsletter']) && $_GET['newsletter'] === 'success') {
        ?>
        <div class="newsletter-success-message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded fixed top-5 right-5 max-w-md shadow-md z-50" role="alert">
            <strong class="font-bold">Thank you!</strong>
            <span class="block sm:inline"> You've been successfully subscribed to our newsletter.</span>
            <button class="absolute top-0 right-0 mt-2 mr-2" onclick="this.parentElement.remove()">
                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
            </button>
        </div>
        <script>
            // Auto-hide the message after 5 seconds
            setTimeout(function() {
                const message = document.querySelector('.newsletter-success-message');
                if (message) {
                    message.remove();
                }
            }, 5000);
        </script>
        <?php
    }
}
add_action('wp_footer', 'rela_estate_newsletter_success_message');

/**
 * Create newsletter subscribers table
 */
function rela_estate_create_newsletter_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    $charset_collate = $wpdb->get_charset_collate();

    // Check if the table already exists
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            email varchar(100) NOT NULL,
            date_added datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            status varchar(20) DEFAULT 'subscribed' NOT NULL,
            PRIMARY KEY  (id),
            UNIQUE KEY email (email)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

// Run the function when theme is activated
add_action('after_switch_theme', 'rela_estate_create_newsletter_table');

/**
 * Add Newsletter Subscribers admin page
 */
function rela_estate_add_newsletter_admin_menu() {
    add_submenu_page(
        'tools.php',                   // Parent slug
        'Newsletter Subscribers',      // Page title
        'Newsletter Subscribers',      // Menu title
        'manage_options',              // Capability
        'newsletter-subscribers',      // Menu slug
        'rela_estate_newsletter_admin_page' // Function to display the page
    );
}
add_action('admin_menu', 'rela_estate_add_newsletter_admin_menu');

/**
 * Display Newsletter Subscribers admin page
 */
function rela_estate_newsletter_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    
    // Handle export action
    if (isset($_GET['action']) && $_GET['action'] === 'export' && current_user_can('manage_options')) {
        $subscribers = $wpdb->get_results("SELECT email, date_added, status FROM $table_name ORDER BY date_added DESC");
        
        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="newsletter-subscribers-' . date('Y-m-d') . '.csv"');
        
        $output = fopen('php://output', 'w');
        
        // Add CSV headers
        fputcsv($output, array('Email', 'Date Added', 'Status'));
        
        // Add subscriber data
        foreach ($subscribers as $subscriber) {
            fputcsv($output, array($subscriber->email, $subscriber->date_added, $subscriber->status));
        }
        
        fclose($output);
        exit;
    }
    
    // Get subscribers with pagination
    $page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    $per_page = 20;
    $offset = ($page - 1) * $per_page;
    
    $total_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
    $subscribers = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table_name ORDER BY date_added DESC LIMIT %d OFFSET %d",
        $per_page, $offset
    ));
    
    $total_pages = ceil($total_items / $per_page);
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Newsletter Subscribers</h1>
        <a href="<?php echo admin_url('tools.php?page=newsletter-subscribers&action=export'); ?>" class="page-title-action">Export CSV</a>
        
        <hr class="wp-header-end">
        
        <div class="tablenav top">
            <div class="tablenav-pages">
                <span class="displaying-num"><?php echo $total_items; ?> items</span>
                <span class="pagination-links">
                    <?php if ($page > 1) : ?>
                        <a class="first-page button" href="<?php echo admin_url('tools.php?page=newsletter-subscribers&paged=1'); ?>">
                            <span aria-hidden="true">«</span>
                        </a>
                        <a class="prev-page button" href="<?php echo admin_url('tools.php?page=newsletter-subscribers&paged=' . ($page - 1)); ?>">
                            <span aria-hidden="true">‹</span>
                        </a>
                    <?php endif; ?>
                    
                    <span class="paging-input">
                        <?php echo $page; ?> of <span class="total-pages"><?php echo $total_pages; ?></span>
                    </span>
                    
                    <?php if ($page < $total_pages) : ?>
                        <a class="next-page button" href="<?php echo admin_url('tools.php?page=newsletter-subscribers&paged=' . ($page + 1)); ?>">
                            <span aria-hidden="true">›</span>
                        </a>
                        <a class="last-page button" href="<?php echo admin_url('tools.php?page=newsletter-subscribers&paged=' . $total_pages); ?>">
                            <span aria-hidden="true">»</span>
                        </a>
                    <?php endif; ?>
                </span>
            </div>
            <br class="clear">
        </div>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Date Added</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($subscribers)) : ?>
                    <tr>
                        <td colspan="3">No subscribers found.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($subscribers as $subscriber) : ?>
                        <tr>
                            <td><?php echo esc_html($subscriber->email); ?></td>
                            <td><?php echo esc_html($subscriber->status); ?></td>
                            <td><?php echo esc_html(date('F j, Y, g:i a', strtotime($subscriber->date_added))); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Date Added</th>
                </tr>
            </tfoot>
        </table>
        
        <div class="tablenav bottom">
            <div class="tablenav-pages">
                <span class="displaying-num"><?php echo $total_items; ?> items</span>
                <span class="pagination-links">
                    <?php if ($page > 1) : ?>
                        <a class="first-page button" href="<?php echo admin_url('tools.php?page=newsletter-subscribers&paged=1'); ?>">
                            <span aria-hidden="true">«</span>
                        </a>
                        <a class="prev-page button" href="<?php echo admin_url('tools.php?page=newsletter-subscribers&paged=' . ($page - 1)); ?>">
                            <span aria-hidden="true">‹</span>
                        </a>
                    <?php endif; ?>
                    
                    <span class="paging-input">
                        <?php echo $page; ?> of <span class="total-pages"><?php echo $total_pages; ?></span>
                    </span>
                    
                    <?php if ($page < $total_pages) : ?>
                        <a class="next-page button" href="<?php echo admin_url('tools.php?page=newsletter-subscribers&paged=' . ($page + 1)); ?>">
                            <span aria-hidden="true">›</span>
                        </a>
                        <a class="last-page button" href="<?php echo admin_url('tools.php?page=newsletter-subscribers&paged=' . $total_pages); ?>">
                            <span aria-hidden="true">»</span>
                        </a>
                    <?php endif; ?>
                </span>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Handle AJAX newsletter signup
 */
function rela_estate_handle_newsletter_ajax_signup() {
    // Check ajax nonce for security
    check_ajax_referer('newsletter_signup_nonce', 'newsletter_nonce', false);
    
    // Get email from form
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    
    // Validate email
    if (!is_email($email)) {
        wp_send_json_error([
            'message' => 'Please provide a valid email address.'
        ]);
        exit;
    }
    
    // Log submission for debugging
    error_log('Newsletter signup submitted via AJAX with email: ' . $email);
    
    // Process the email - send admin notification
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    $subject = sprintf('[%s] New Newsletter Signup', $site_name);
    $message = sprintf('A new user has signed up for your newsletter: %s', $email);
    
    wp_mail($admin_email, $subject, $message);
    
    // Store in database
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    
    // Check if table exists, create if it doesn't
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        rela_estate_create_newsletter_table();
        error_log('Newsletter table created on demand via AJAX');
    }
    
    // Check if email already exists
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM $table_name WHERE email = %s",
        $email
    ));
    
    if ($existing) {
        wp_send_json_success([
            'message' => 'You are already subscribed to our newsletter.'
        ]);
        exit;
    }
    
    // Insert the subscriber
    $result = $wpdb->insert(
        $table_name,
        array(
            'email' => $email,
            'date_added' => current_time('mysql'),
            'status' => 'subscribed'
        )
    );
    
    // Log the result
    if ($result === false) {
        error_log('Failed to insert subscriber via AJAX: ' . $wpdb->last_error);
        wp_send_json_error([
            'message' => 'Failed to subscribe. Please try again later.'
        ]);
    } else {
        error_log('Subscriber inserted successfully via AJAX with ID: ' . $wpdb->insert_id);
        wp_send_json_success([
            'message' => 'You\'ve been successfully subscribed to our newsletter.'
        ]);
    }
    
    exit;
}
add_action('wp_ajax_newsletter_ajax_signup', 'rela_estate_handle_newsletter_ajax_signup');
add_action('wp_ajax_nopriv_newsletter_ajax_signup', 'rela_estate_handle_newsletter_ajax_signup');