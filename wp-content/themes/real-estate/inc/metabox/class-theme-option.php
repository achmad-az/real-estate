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
if ( ! class_exists( 'ESTATEINthemeoption' ) ) {
    class ESTATEINthemeoption {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return ESTATEINthemeoption
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
            add_action( 'admin_footer', [ $this, 'script' ] );
            add_filter( 'tiny_mce_before_init', [ $this, 'tinymce_settings' ] );
        }

        /**
         * Register Theme Options Metabox
         * @return void
         */
        public function metabox() {
            Container::make('theme_options', __('Theme Options', 'real-estate'))
                ->where('current_user_capability', '=', 'manage_options')
                ->add_tab(__('<span class="dashicons dashicons-table-row-before"></span> General', 'real-estate'), [
                    Field::make('image', 'main_logo_image', __('Main Logo Image', 'real-estate'))
                        ->set_help_text(__('Upload an image for the hero logo.', 'real-estate')),
                ])
                ->add_tab(__('<span class="dashicons dashicons-table-row-before"></span> Header', 'real-estate'), [
                    Field::make('text', 'banner_text', __('Banner Text', 'real-estate'))
                        ->set_help_text(__('Enter the text to display in the banner.', 'real-estate')),
                    Field::make('select', 'banner_link', __('Banner Link', 'real-estate'))
                        ->add_options('get_pages_options')
                        ->set_help_text(__('Select a page for the banner button to link to.', 'real-estate')),
                    Field::make('image', 'menu_logo_image', __('Menu Logo Image', 'real-estate'))
                        ->set_help_text(__('Upload an image for the menu logo.', 'real-estate')),
                    Field::make('text', 'header_button_text', __('Banner Text', 'real-estate'))
                        ->set_help_text(__('Enter the text to display in the banner.', 'real-estate')),
                    Field::make('select', 'header_button_link', __('Banner Link', 'real-estate'))
                        ->add_options('get_pages_options')
                ])
                ->add_tab(__('<span class="dashicons dashicons-table-row-before"></span> Footer', 'real-estate'), [
                    Field::make('text', 'copyright_text', __('Copyright Text', 'real-estate'))
                        ->set_help_text(__('Enter the text to display in the footer.', 'real-estate')),
                    Field::make('select', 'tos_link', __('Term & Condition Link', 'real-estate'))
                        ->add_options('get_pages_options'),
                    Field::make('text', 'facebook', __('Facebook URL', 'real-estate'))
                        ->set_help_text(__('Enter the Facebook URL to display in the footer. Please include the full URL (e.g., https://www.facebook.com/your).', 'real-estate')),
                    Field::make('text', 'linkedin', __('LinkedIn URL', 'real-estate'))
                        ->set_help_text(__('Enter the LinkedIn URL to display in the footer. Please include the full URL (e.g., https://www.linkedin.com/your).', 'real-estate')),
                    Field::make('text', 'twitter', __('Twitter URL', 'real-estate'))
                        ->set_help_text(__('Enter the Twitter URL to display in the footer. Please include the full URL (e.g., https://www.twitter.com/your).', 'real-estate')),
                    Field::make('text', 'youtube', __('YouTube URL', 'real-estate'))
                        ->set_help_text(__('Enter the YouTube URL to display in the footer. Please include the full URL (e.g., https://www.youtube.com/your).', 'real-estate')),
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

ESTATEINthemeoption::get_instance()->init();