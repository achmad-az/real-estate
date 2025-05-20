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

if ( ! class_exists( 'TULAoffersblock' ) ) {
    class TULAoffersblock {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return TULAoffersblock
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
            // Ensure the block is registered only once
            if (did_action('carbon_fields_register_fields') === 0) {
                add_action('carbon_fields_register_fields', [$this, 'metabox']);
                //error_log('Carbon Fields blocks are being registered.');
            }
        }
        
        public function metabox() {
            //error_log('Registering Real Estate Offers Block');
            $nonce = wp_create_nonce('rela_estate_ajax_nonce');
            Block::make( __( 'Real Estate Offers Block' ) )
            ->add_fields( array(
                Field::make( 'complex', 'our_services', 'Our Offers' )
                    ->set_layout( 'tabbed-horizontal' )
                    ->add_fields( array(
                        Field::make( 'image', 'image', __( 'Offer Image' ) ),
                        Field::make( 'text', 'heading', __( 'Offer Heading' ) ),
                        Field::make( 'textarea', 'content', __( 'Offer Content' ) ),
                    ) ),
            ) )
            ->set_description( __( 'A block consisting of multiple offers, each with an image, heading, and content.' ) )
            ->set_category( 'layout' )
            ->set_icon( 'cover-image' )
            ->set_keywords( [ __( 'block' ), __( 'offers' ), __( 'repeater' ) ] )
            ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
            // Define offers and total first
            $offers = $fields['our_services'] ?? [];
            $total_offers = count($offers);
            // Get URL page from theme options
            $page_id = carbon_get_theme_option('selected_page');
            $page_url = $page_id ? get_permalink($page_id) : '#';
                ?>

            <div class="other-offering w-full">
                    <div class="container mx-auto lg:px-[100px] my-20">
                        <!-- Changed to columns-1 for mobile, columns-2 for tablet, columns-3 for desktop -->
                        <div class="columns-1 md:columns-2 lg:columns-3 gap-14 space-y-14">
                            <?php foreach ($offers as $offer) : ?>
                                <!-- Added break-inside-avoid to prevent card splitting -->
                                <div class="break-inside-avoid bg-[#dbdbd6] p-5 transition-all duration-300 hover:shadow-lg">
                                    <div class="flex flex-col">
                                        <div class="leading-7 text-[#605e5e]">
                                            <h3 class="text-xl mt-5 mb-3 border-b border-[#2f2e2e]">
                                                <?php echo esc_html($offer['heading']); ?>
                                            </h3>
                                            <div class="mt-5 mb-6">
                                                <?php 
                                                if (!empty($offer['image'])) {
                                                    echo wp_get_attachment_image($offer['image'], 'full', false, array(
                                                        'class' => 'h-auto max-w-full object-cover w-full'
                                                    ));
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mt-1 flex flex-auto flex-col p-3">
                                            <p class="flex-auto font-secondary text-base text-[#2f2e2e] ">
                                                <?php echo esc_html($offer['content']); ?>
                                            </p>
                                        </div>
                                        <div>
                                            <a href="<?php echo esc_url($page_url); ?>" class="btn-prm hover:opacity-90">
                                                <div class="inline-block align-middle font-primary">
                                                    Reserve Your Experience
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php
            } );
        }

    }
}

TULAoffersblock::get_instance()->init();