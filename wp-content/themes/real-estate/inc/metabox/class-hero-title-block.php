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

if ( ! class_exists( 'TULAimagetextblock' ) ) {
    class TULAimagetextblock {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return TULAimagetextblock
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
            Block::make( __( 'Real Estate Hero Title Block' ) )
            ->add_fields( array(
                Field::make( 'text', 'heading', __( 'Block Heading' ) ),
                Field::make( 'rich_text', 'content', __( 'Block Content' ) ),
                Field::make( 'complex', 'images', __( 'Block Images' ) )
                    ->add_fields( array(
                        Field::make( 'image', 'image', __( 'Image' ) )
                    ))
                    ->set_layout( 'tabbed-horizontal' )
                    ->set_max( 2 ),
                Field::make( 'checkbox', 'reserve', __( 'Reserve Button' ) )
            ) )
            ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
            ->set_category( 'layout' )
            ->set_icon( 'cover-image' )
            ->set_keywords( [ __( 'block' ), __( 'image' ), __( 'hero' ) ] )
            ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
            // Get URL page from theme options
            $page_id = carbon_get_theme_option('selected_page');
            $page_url = $page_id ? get_permalink($page_id) : '#';
                ?>

            <div class="">
                <div class="flex flex-col items-center mx-auto md:px-6 lg:px-8">
                    <h1 class="w-full max-w-3xl text-center uppercase"><?php echo esc_html( $fields['heading'] ); ?></h1>
                    <div class="w-full max-w-2xl text-lg font-normal"><?php echo apply_filters( 'the_content', $fields['content'] ); ?></div>
                    <div class="flex flex-row gap-x-16 lg:gap-y-12 gap-y-0 items-center lg:justify-around justify-center flex-wrap">
                        <?php 
                            if (!empty($fields['images'])) {
                                foreach ($fields['images'] as $key => $image) {
                                    // Determine classes based on image position
                                    $image_classes = $key === 0 
                                        ? 'w-[57rem] max-w-full lg:max-w-[700px]' 
                                        : 'hidden xl:block lg:max-w-[285px] lg:h-auto';
                                    
                                    $container_classes = $key === 0 ? 'lg:ml-auto' : 'lg:mr-auto';
                                    ?>
                                    <div class="px-6 lg:px-0 <?php echo esc_attr($container_classes); ?>">
                                        <div class="flex max-w-2xl pb-8 flex-col justify-center gap-8">
                                            <?php echo wp_get_attachment_image($image['image'], 'full', false, array(
                                                'class' => esc_attr($image_classes),
                                            )); ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <?php if (!empty($fields['reserve'])) : ?>
                    <div class="w-full max-w-2xl flex justify-center mr-0 lg:justify-end lg:mr-10 ">
                        <a href="<?php echo esc_url($page_url); ?>" id="reserver" class="btn-prm hover:opacity-90">
                            <div class="inline-block align-middle font-primary">
                                <span>Reserve Your Experience</span>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

                <?php
	        } );
        }

    }
}

TULAimagetextblock::get_instance()->init();