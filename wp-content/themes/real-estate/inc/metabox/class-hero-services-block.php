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

if ( ! class_exists( 'ESTATEINheroservicesblock' ) ) {
    class ESTATEINheroservicesblock {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return ESTATEINheroservicesblock
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
            Block::make( __( 'Real Estate Hero Services Block' ) )
            ->add_fields( array(
                // Content Section
                Field::make('html', 'content_heading', __('Content Section'))
                ->set_html('<h2 class="heading-cf">Content Section</h2>   <hr>'),
                Field::make('text', 'heading', __('Block Heading')),
                Field::make('rich_text', 'content', __('Block Content')),
                Field::make( 'complex', 'our-services', 'Our Services' )
                    ->set_layout( 'tabbed-horizontal' )
                    ->set_max( 4 )
                    ->add_fields( array(
                        Field::make( 'image', 'image', __( 'Service Icon' ) ),
                        Field::make( 'text', 'title', __( 'Title' ) ),
                        Field::make('text', 'service_link', __('Service Link', 'real-estate')),
                    ) ),
            ) )
            ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
            ->set_category( 'layout' )
            ->set_icon( 'cover-image' )
            ->set_keywords( [ __( 'block' ), __( 'image' ), __( 'cta' ) ] )
            ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
            // Get URL page from theme options
            $page_id = carbon_get_theme_option('selected_page');
            $page_url = $page_id ? get_permalink($page_id) : '#';
                ?>

                <div class="w-full">
                    <div class="py-[100px] bg-gradient-to-br from-neutral-800 to-neutral-800/0 border-b border-[#141414] flex flex-col justify-start items-start gap-2.5">
                        <div class="container">
                            <div class="hero-services-heading lg:ml-20 max-w-6xl">
                                <?php if (!empty($fields['heading'])) : ?>
                                    <h1 class="text-white text-[38px] font-primary-semibold leading-[57px]"><?php echo esc_html($fields['heading']); ?></h1>
                                <?php endif; ?>
                                <?php if (!empty($fields['content'])) : ?>
                                    <div class="text-[#999999] text-base font-primary-medium leading-normal"><?php echo wp_kses_post($fields['content']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 p-2.5 bg-[#141414] shadow-[0px_0px_0px_6px_rgba(25,25,25,1.00)] outline outline-1 outline-[#141414] items-center overflow-hidden">
                            <?php
                            if (!empty($fields['our-services'])) :
                                foreach ($fields['our-services'] as $service) :
                                    $image = wp_get_attachment_image_url($service['image'], 'full');
                                    $title = $service['title'];
                            ?>
                                <div class="flex-1 px-4 py-[30px] relative bg-[#191919] rounded-[10px] outline outline-1 outline-offset-[-1px] outline-[#141414] inline-flex flex-col justify-start items-center gap-4">
                                    <?php if ($image) : ?>
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" width="61" height="60">
                                    <?php endif; ?>
                                    
                                    <?php if ($title) : ?>
                                        <div class="self-stretch text-center justify-start text-white text-base font-primary-semibold leading-normal">
                                            <?php echo esc_html($title); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($service['service_link']) : ?>
                                        <div class="absolute top-5 right-5">
                                            <a href="<?php echo esc_url($service['service_link']); ?>">
                                                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.875 21.125L21.125 4.875M21.125 4.875L8.9375 4.875M21.125 4.875V17.0625" stroke="#4D4D4D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                    
                </div>
                <?php
	        } );
        }

    }
}

ESTATEINheroservicesblock::get_instance()->init();