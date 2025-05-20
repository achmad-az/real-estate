<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// use carbon fields
use Carbon_Fields\Container;
use Carbon_Fields\Block;
use Carbon_Fields\Field;

/**
 * This class intended to metabox in the goblin mode template.
 *
 * @package real-estate
 */

if ( ! class_exists( 'TULAservicesblock' ) ) {
    class TULAservicesblock {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return TULAservicesblock
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
         * Initialize the init
         * @return void
         */
        public function init() {
            if (did_action('carbon_fields_register_fields') === 0) {
                add_action('carbon_fields_register_fields', [$this, 'metabox']);
                //error_log('Carbon Fields blocks are being registered.');
            }
        }
        
        public function metabox() {
            //error_log('Registering Real Estate Services Block');
            $nonce = wp_create_nonce('rela_estate_ajax_nonce');
            Block::make( __( 'Real Estate Services Block' ) )
            ->add_fields( array(
                Field::make( 'text', 'heading_section', __( 'Heading Section' ) ),
                Field::make( 'rich_text', 'description_section', __( 'Description Section' ) ),
                Field::make( 'complex', 'our_services', 'Our Services' )
                    ->set_layout( 'tabbed-horizontal' )
                    ->set_max( 6 )
                    ->add_fields( array(
                        Field::make( 'image', 'image', __( 'Service Image' ) ),
                        Field::make( 'text', 'heading', __( 'Service Heading' ) ),
                        Field::make( 'textarea', 'content', __( 'Service Content' ) ),
                    ) ),
            ) )
            ->set_description( __( 'A block consisting of multiple services, each with an image, heading, and content.' ) )
            ->set_category( 'layout' )
            ->set_icon( 'cover-image' )
            ->set_keywords( [ __( 'block' ), __( 'image' ), __( 'services' ) ] )
            ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {

            // Get URL page from theme options
            $page_id = carbon_get_theme_option('selected_page');
            $page_url = $page_id ? get_permalink($page_id) : '#';
                ?>

            <div class="w-full">
                <div class="mx-auto max-w-6xl lg:px-8">
                    <div class="flex mx-auto max-w-3xl pb-8 flex-col justify-center items-center text-center">
                        <h2> <?php echo esc_html( $fields['heading_section'] ); ?> </h2>
                        <div><?php echo wp_kses_post( $fields['description_section'] ); ?></div>
                    </div>
                    <div class="mx-auto mt-6 max-w-2xl lg:max-w-none">
                        <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-14 lg:max-w-none lg:grid-cols-3">
                            <?php foreach ( $fields['our_services'] as $service ) : ?>
                            <div class="flex flex-col justify-center text-center items-center">
                                <dt class="font-semibold leading-7 text-gray-900">
                                    <div class="mb-6 flex h-20 w-20 items-center justify-center">
                                        <?php echo wp_get_attachment_image( $service['image'], 'thumbnail', false, array( 'class' => 'rounded-full' ) ); ?>
                                    </div>
                                    <h3 class="text-xl">
                                        <?php echo esc_html( $service['heading'] ); ?>
                                    </h3>
                                </dt>
                                <dd class="mt-1 flex flex-auto flex-col text-lg p-3">
                                    <p class="flex-auto font-secondary text-[#605e5e]">
                                        <?php echo esc_html( $service['content'] ); ?></p>
                                </dd>
                                <dt class="mt-5">
                                    <a href="<?php echo esc_url($page_url); ?>" class="btn-prm hover:opacity-90">
                                        <div class="inline-block align-middle text-center font-primary text-xl">Reserve Your Experience</div>
                                    </a>
                                </dt>
                            </div>
                            <?php endforeach; ?>
                        </dl>
                    </div>
                </div>
            </div>

                <?php
	        } );
        }

    }
}

TULAservicesblock::get_instance()->init();