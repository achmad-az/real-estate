<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue js assets.
 * 
 * @return void
 * 
 */
if (!function_exists('rela_estate_enqueue_scripts')) {
    function rela_estate_enqueue_scripts() {
        $theme = wp_get_theme();

        $css_version = $theme->get( 'Version' ) . '.' . filemtime( get_template_directory() . '/assets/dist/css/app.css' );
        $js_version = $theme->get( 'Version' ) . '.' . filemtime( get_template_directory() . '/assets/dist/js/app.js' );
        wp_enqueue_style( 'real-estate', rela_estate_asset( 'css/app.css' ), array(), $css_version );
        wp_enqueue_script( 'real-estate', rela_estate_asset( 'js/app.js' ), array(), $js_version, array(
            'in_footer' => true,
            'strategy'  => 'defer',
        ) );
        wp_localize_script( 'real-estate', 'gns', rela_estate_js_args() );
    }
    add_action( 'wp_enqueue_scripts', 'rela_estate_enqueue_scripts' );
}

/**
 * Get js args.
 * 
 * @return array
 */
if (!function_exists('rela_estate_js_args')) {
    function rela_estate_js_args() {
        return [
            'ajax_endpoint' => esc_url(admin_url( 'admin-ajax.php' )),
            'home_url' => esc_url(home_url('/'))
        ];
    }
}

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
if (!function_exists('rela_estate_asset')) {
    function rela_estate_asset( $path, $is_font = false ) {
        if ( wp_get_environment_type() === 'production' || $is_font) {
            return get_stylesheet_directory_uri() . '/assets/dist/' . $path;
        }

        return add_query_arg( 'time', time(),  get_stylesheet_directory_uri() . '/assets/dist/' . $path );
    }
}

/**
 * Remove wp block css except for article page
 *
 */
if ( ! function_exists( 'rela_estate_remove_block_css' ) ) {
	function rela_estate_remove_block_css() {

		if(!is_admin()) {
			wp_dequeue_style( 'classic-theme-styles' ); // default wp
			wp_dequeue_style( 'global-styles' ); // default wp 
		}

		if (is_singular(GNS_POST_TYPE_ARTICLE)) return;
		if (is_admin()) return;

		wp_dequeue_style( 'wp-block-library' ); // Wordpress core
		wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
		wp_dequeue_style( 'wc-block-style' ); // WooCommerce
		wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme

		return;
	}
}
add_action( 'wp_enqueue_scripts', 'rela_estate_remove_block_css', 100 );

/**
 * Disable the emoji's
 */
if ( ! function_exists( 'rela_estate_disable_emojis' ) ) {
	function rela_estate_disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'rela_estate_disable_emojis_tinymce' );
		add_filter( 'wp_resource_hints', 'rela_estate_disable_emojis_remove_dns_prefetch', 10, 2 );
	}
}
add_action( 'init', 'rela_estate_disable_emojis' );
   
/**
* Filter function used to remove the tinymce emoji plugin.
* 
* @param array $plugins 
* @return array Difference betwen the two arrays
*/
if ( ! function_exists( 'rela_estate_disable_emojis_tinymce' ) ) {
	function rela_estate_disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}
}

/**
* Remove emoji CDN hostname from DNS prefetching hints.
*
* @param array $urls URLs to print for resource hints.
* @param string $relation_type The relation type the URLs are printed for.
* @return array Difference betwen the two arrays.
*/
if ( ! function_exists( 'rela_estate_disable_emojis_remove_dns_prefetch' ) ) {
	function rela_estate_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' == $relation_type ) {
			/** This filter is documented in wp-includes/formatting.php */
			$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
			$urls = array_diff( $urls, array( $emoji_svg_url ) );
		}

		return $urls;
	}
}

/**
 * Remove jQuery Migrate script from the jQuery bundle only in front end.
 *
 * @since 1.0
 *
 * @param WP_Scripts $scripts WP_Scripts object.
 */
if ( ! function_exists( 'rela_estate_remove_jquery_migrate' ) ) {
	function rela_estate_remove_jquery_migrate( $scripts ) {
		if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];
			
			if ( ! empty( $script->deps ) ) { // Check whether the script has any dependencies
				$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
			}
		}
	}
}
add_action( 'wp_default_scripts', 'rela_estate_remove_jquery_migrate' );

/**
 * Remove wp comment reply js
 *
 */
function rela_estate_remove_comment_js(){
    wp_deregister_script( 'comment-reply' );
}
add_action('init','rela_estate_remove_comment_js');

/**
 * Only load styles for used blocks
 * https://make.wordpress.org/core/2021/07/01/block-styles-loading-enhancements-in-wordpress-5-8/
 * 
 */
add_filter( 'should_load_separate_core_block_assets', '__return_true' );

/**
 * Remove global styles css
 * 
 */
if ( ! function_exists( 'rela_estate_remove_global_styles' ) ) {
	function rela_estate_remove_global_styles() {
		$split = explode('/real-estate/article/', strtolower($_SERVER['REQUEST_URI']));
		if (strpos(strtolower($_SERVER['REQUEST_URI']), '/article/') === false || empty($split[1])) {
			remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
			remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
			remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
		}
	}
}
add_action( 'init', 'rela_estate_remove_global_styles');

/**
 * Remove force underline on links
 * 
 */
add_filter( 'wp_theme_json_get_style_nodes', function($nodes) {
    if (!is_array($nodes)) {
        return $nodes;
    }

    $nodes = array_filter($nodes, function ($node) {
        if (
            !empty($node['selector']) &&
            $node['selector'] == 'a:where(:not(.wp-element-button))'
        ) {
            return false;
        }

        return true;
    });

    return $nodes;
});

function rela_estate_minify_css($css) {
    // Remove comments
    $css = preg_replace('!/\*.*?\*/!s', '', $css);
    // Remove whitespace
    $css = preg_replace('/\s+/', ' ', $css); // Replace multiple spaces with a single space
    $css = preg_replace('/\s*{\s*/', '{', $css); // Remove spaces before and after {
    $css = preg_replace('/\s*;\s*/', ';', $css); // Remove spaces before and after ;
    $css = preg_replace('/\s*}\s*/', '}', $css); // Remove spaces before and after }

    return trim($css); // Trim any leading/trailing whitespace
}

/**
 * Preload fonts
 * 
 */
function rela_estate_enqueue_styles() {
    wp_enqueue_style('fonts', get_template_directory_uri() . '/assets/src/css/styleguides/fonts.css', [], null);
}
add_action('wp_enqueue_scripts', 'rela_estate_enqueue_styles');


function rela_estate_fonts() {
	return [
		[
			'family' => 'Josefin Light',
			'src' => rela_estate_asset( 'fonts/JosefinSans-Light.ttf', true ),
			'format' => 'truetype',
			'weight' => 'normal',
			'style' => 'sans-serif',
			'display' => 'swap',
		],
		[
			'family' => 'Didot Italic',
			'src' => rela_estate_asset( 'fonts/Didot-w01-Italic.ttf', true ),
			'format' => 'truetype',
			'weight' => 'normal',
			'style' => 'serif',
			'display' => 'swap',
		]
	];
}