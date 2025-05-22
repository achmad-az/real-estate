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

if ( ! class_exists( 'ESTATEINctablock' ) ) {
    class ESTATEINctablock {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return ESTATEINctablock
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
            Block::make( __( 'Real Estate CTA Block' ) )
            ->add_fields( array(
                // Content Section
                Field::make('html', 'cta_heading', __('Call to Action Section'))
                ->set_html('<h2 class="heading-cf">Call to Action Content</h2>   <hr>'),
                Field::make('text', 'heading', __('Block Heading')),
                Field::make('rich_text', 'content', __('Block Content')),
                Field::make('image', 'bg_image', __('Background Image Desktop')),
                Field::make('image', 'bg_image_m', __('Background Image Mobile')),

                // Button Links Section
                Field::make('html', 'buttons_heading', __('Button Links'))
                ->set_html('<h2 class="heading-cf">Button Section</h2>   <hr>'),
                Field::make('text', 'button_text', __('Button text')),
                Field::make('select', 'button_link', __('Button Link', 'real-estate'))
                    ->add_options('get_pages_options')
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

                <div class="cta flex bg-[--color-grey-08] w-full border-t border-b border-neutral-800 bg-cover bg-center bg-no-repeat <?php echo !empty($fields['bg_image_m']) ? 'mobile-bg' : ''; ?> <?php echo !empty($fields['bg_image']) ? 'desktop-bg' : ''; ?>"
                    <?php if (!empty($fields['bg_image_m'])) : ?>
                        style="--mobile-bg: url('<?php echo esc_url(wp_get_attachment_url($fields['bg_image_m'])); ?>');
                            <?php if (!empty($fields['bg_image'])) : ?>
                            --desktop-bg: url('<?php echo esc_url(wp_get_attachment_url($fields['bg_image'])); ?>');
                            <?php endif; ?>"
                    <?php endif; ?>
                >
                    <div class="container mx-auto w-full cta-content px-4 sm:px-6 md:px-20 py-8 md:py-[60px] flex flex-col lg:flex-row lg:inline-flex justify-start items-center gap-6 lg:gap-[150px] overflow-hidden">
                        <div class="flex-1 inline-flex flex-col justify-start items-start gap-2 relative z-10">
                            <?php if (!empty($fields['heading'])) : ?>
                            <h2 class="self-stretch mb-0 justify-start text-white text-[28px] md:text-[38px] font-primary-semibold leading-tight md:leading-[57px]">
                                <?php echo esc_html($fields['heading']); ?>
                            </h2>
                            <?php endif; ?>
                            
                            <?php if (!empty($fields['content'])) : ?>
                            <div class="self-stretch justify-start text-[#999999] text-sm lg:text-base font-primary-medium lg:leading-normal leading-[21px]">
                                <?php echo wp_kses_post($fields['content']); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <?php if (!empty($fields['button_text']) && !empty($fields['button_link'])) : 
                            $button_url = get_permalink($fields['button_link']);
                        ?>
                        <a href="<?php echo esc_url($button_url); ?>" class="w-full lg:w-auto -mt-4 md:mt-0 px-5 py-3.5 bg-[--color-purple-60] rounded-lg flex justify-center items-center gap-2 relative z-10" aria-label="<?php echo esc_attr($fields['button_text']); ?>">
                            <span class="justify-start text-white text-sm font-primary-medium leading-[21px]">
                                <?php echo esc_html($fields['button_text']); ?>
                            </span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
	        } );
        }

    }
}

ESTATEINctablock::get_instance()->init();