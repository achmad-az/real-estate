<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Use Carbon Fields
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * This class is intended to manage theme options using Carbon Fields.
 *
 * @package real-estate
 */
if ( ! class_exists( 'TULAthemeoption' ) ) {
    class TULAthemeoption {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return TULAthemeoption
         */
        public static function get_instance() {
            if ( null === self::$instance ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Constructor
         * @return void
         */
        private function __construct() {
        }

        /**
         * Initialize the class
         * @return void
         */
        public function init() {
            add_action( 'carbon_fields_register_fields', [ $this, 'metabox' ] );
            // add_action( 'admin_footer', [ $this, 'script' ] );
            // add_filter( 'tiny_mce_before_init', [ $this, 'tinymce_settings' ] );
        }

        /**
         * Register Theme Options Metabox
         * @return void
         */
        public function metabox() {
            //error_log('Registering Theme Options');
            Container::make('theme_options', __('Theme Options', 'real-estate'))
                // ->where('current_user_capability', '=', 'manage_options')
                ->add_tab(__('<span class="dashicons dashicons-admin-generic"></span> General', 'real-estate'), [
                    Field::make('image', 'hero_logo_image', __('Hero Logo Image', 'real-estate'))
                        ->set_help_text(__('Upload an image for the hero logo.', 'real-estate')),
                    Field::make('image', 'menu_logo_image', __('Menu Logo Image', 'real-estate'))
                        ->set_help_text(__('Upload an image for the menu logo.', 'real-estate')),
                    Field::make('text', 'video_bg', __('Video Background URL', 'real-estate'))
                        ->set_help_text(__('Enter the full URL of your video background. Supported formats: MP4, WebM. Example: https://example.com/video.mp4', 'real-estate'))
                        ->set_attribute('placeholder', 'https://')
                        ->set_attribute('type', 'url')
                        ->set_required(true),
                    Field::make('select', 'selected_page', __('Select Booking Page', 'real-estate'))
                        ->add_options('get_pages_options')
                        ->set_help_text(__('Choose a page from the list.', 'real-estate')),
                ])
                ->add_tab(__('<span class="dashicons dashicons-table-row-before"></span> Footer', 'real-estate'), [
                    Field::make('image', 'footer_logo_image', __('Footer Logo Image', 'real-estate'))
                        ->set_help_text(__('Upload an image for the footer logo.', 'real-estate')),
                    Field::make('rich_text', 'footer_text', __('Footer Text', 'real-estate'))
                        ->set_help_text(__('Enter the text to display in the footer.', 'real-estate')),
                        Field::make('text', 'copy_text', __('Copyright Text', 'real-estate'))
                        ->set_help_text(__('Enter the text to display in the footer.', 'real-estate')),
                ]);
        }

        /**
         * Add Custom Scripts
         * @return void
         */
        public function script() {
            // Add any custom scripts here if needed
        }

        /**
         * Customize TinyMCE Settings
         * @param array $settings TinyMCE settings.
         * @return array
         */
        public function tinymce_settings( $settings ) {
            // Customize TinyMCE settings if needed
            return $settings;
        }
    }
}

TULAthemeoption::get_instance()->init();