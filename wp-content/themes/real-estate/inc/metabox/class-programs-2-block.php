<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// use carbon fields
use Carbon_Fields\Block;
use Carbon_Fields\Field;

/**
 * This class intended to metabox in the goblin mode template.
 *
 * @package real-estate
 */

if ( ! class_exists( 'TULAprograms2block' ) ) {
    class TULAprograms2block {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return TULAprograms2block
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
            add_action( 'carbon_fields_register_fields', [$this, 'metabox'] );
        }
        public function metabox() {
            $nonce = wp_create_nonce('rela_estate_ajax_nonce');
            Block::make( __( 'Real Estate Programs 2 Block' ) )
            ->add_fields( array(
            Field::make( 'text', 'heading-desc', __( 'Block Heading' ) ),
            Field::make( 'rich_text', 'content-desc', __( 'Block Content Description' ) ),
            Field::make( 'complex', 'choice_programs', 'Choice of Programs' )
                ->set_layout( 'tabbed-horizontal' )
                ->add_fields( array(
                    Field::make( 'text', 'heading', __( 'Programs Heading' ) ),
                    Field::make( 'textarea', 'content', __( 'Programs description' ) ),
                ) ),
            ) )
            ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
            ->set_category( 'layout' )
            ->set_icon( 'cover-image' )
            ->set_keywords( [ __( 'block' ), __( 'image' ), __( 'programs' ) ] )
            ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
            // Get URL page from theme options
            $page_id = carbon_get_theme_option('selected_page');
            $page_url = $page_id ? get_permalink($page_id) : '#';
                ?>

            <div class="choice-of-programs-2 w-full bg-[var(--bg-overlay-color)] flex flex-row lg:flex-nowrap flex-wrap px:10 py-16 lg:px-16 gap-10 lg:gap-16 justify-between">
                <div class="w-full lg:w-2/5">
                    <div class="mx-auto px-8 md:px-6 lg:px-8 lg:max-w-lg">
                        <h1 class=""><?php echo esc_html($fields['heading-desc']); ?></h1>
                        <div class="content-desc">
                            <?php echo wp_kses_post($fields['content-desc']); ?>
                        </div>
                        <div>
                            <a href="<?php echo esc_url($page_url); ?>" id="reserver" class="btn-prm hover:opacity-90">
                                <div class="inline-block align-middle font-primary">
                                    Reserve Your Experience
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="w-full lg:w-3/5">
                    <div class="flex flex-row flex-wrap lg:gap-8 gap-6 px-8 lg:px-0 lg:max-w-2xl">
                    <?php 
                        if (!empty($fields['choice_programs'])) {
                            //error_log(print_r($fields['choice_programs'], true));
                            foreach ($fields['choice_programs'] as $index => $program) {
                                ?>
                                <div class="flex flex-col w-full lg:p-6 p-4">
                                    <h3 class="text-xl font-semibold mb-20 "><?php echo esc_html($program['heading']); ?></h3>
                                    <p class="text-base font-secondary"><?php echo esc_html($program['content']); ?></p>
                                </div>
                                <?php
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>

                <?php
	        } );
        }

    }
}

TULAprograms2block::get_instance()->init();