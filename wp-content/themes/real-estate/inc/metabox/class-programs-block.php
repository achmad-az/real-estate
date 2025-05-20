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

if ( ! class_exists( 'TULAprogramsblock' ) ) {
    class TULAprogramsblock {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return TULAprogramsblock
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
            Block::make( __( 'Real Estate Programs Block' ) )
            ->add_fields( array(
            Field::make( 'complex', 'images', __( 'Block Images' ) )
                ->add_fields( array(
                    Field::make( 'image', 'image', __( 'Image' ) )
                ))
                ->set_layout( 'tabbed-horizontal' )
                ->set_max( 2 )
            ) )
            ->add_fields( array(
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

            <div class="choice-of-programs w-full bg-[var(--bg-overlay-color)] flex flex-row lg:flex-nowrap flex-wrap px:10 py-16 lg:px-16 gap-10 lg:gap-16 justify-between">
                <div class="w-full lg:w-1/4">
                    <div class="mx-auto md:px-6 lg:px-8">
                        <h2 class="text-4xl pl-10">Choice of Programs</h2>
                        <div class="flex flex-col gap-x-16 lg:gap-y-12 gap-y-0 items-center lg:justify-around justify-center flex-wrap">
                            <?php 
                                if (!empty($fields['images'])) {
                                    foreach ($fields['images'] as $key => $image) {
                                        // Tentukan kelas berdasarkan posisi gambar
                                        $container_classes = $key === 0 ? 'lg:ml-auto' : 'lg:mr-auto';
                                        $image_classes = $key === 0 
                                            ? ' max-w-full lg:max-w-[700px]' 
                                            : 'hidden xl:block lg:max-w-[285px] lg:h-auto';
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
                    </div>
                </div>
                
                <div class="w-full lg:w-3/4">
                    <div class="flex flex-row flex-wrap lg:gap-8 gap-6 px-8 lg:px-0">
                    <?php 
                        if (!empty($fields['choice_programs'])) {
                            //error_log(print_r($fields['choice_programs'], true));
                            foreach ($fields['choice_programs'] as $index => $program) {
                                $number = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                                ?>
                                <div class="flex flex-col w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.33%-1rem)] lg:p-6 p-4">
                                    <span class="text-2xl font-bold mb-2 "><?php echo esc_html($number); ?></span>
                                    <h3 class="text-xl font-semibold mb-2 "><?php echo esc_html($program['heading']); ?></h3>
                                    <p class="text-base"><?php echo esc_html($program['content']); ?></p>
                                </div>
                                <?php
                            }
                        }
                    ?>
                    </div>
                    <div class="px-8">
                        <a href="<?php echo esc_url($page_url); ?>" id="reserver" class="btn-prm hover:opacity-90">
                            <div class="inline-block align-middle font-primary">
                                Reserve Your Experience
                            </div>
                        </a>
                    </div>
                </div>
            </div>

                <?php
	        } );
        }

    }
}

TULAprogramsblock::get_instance()->init();