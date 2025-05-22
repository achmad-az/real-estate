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

if ( ! class_exists( 'ESTATEINpropertyvalueblock' ) ) {
    class ESTATEINpropertyvalueblock {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return ESTATEINpropertyvalueblock
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
            Block::make( __( 'Real Estate Property Value Block' ) )
            ->add_fields( array(
                // Content Section
                Field::make('html', 'content_heading', __('Content Section'))
                ->set_html('<h2 class="heading-cf">Content Section</h2>   <hr>'),
                Field::make('text', 'heading', __('Block Heading')),
                Field::make('textarea', 'content', __('Block Content')),
                Field::make( 'complex', 'property_value', 'Property Value' )
                    ->set_layout( 'tabbed-horizontal' )
                    ->set_max( 4 )
                    ->add_fields( array(
                        Field::make( 'image', 'image', __( 'Icon' ) ),
                        Field::make( 'text', 'title', __( 'Title' ) ),
                        Field::make( 'textarea', 'content', __( 'Team Content' ) ),
                    ) ),
                Field::make('text', 'cta_heading', __('Block Heading')),
                Field::make('textarea', 'cta_content', __('Block Content')),
                Field::make('select', 'cta_link', __('CTA Link', 'real-estate'))
                            ->add_options('get_pages_options'),
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

                <div class="w-full py-24 sm:py-32">
                    <div class="container px-6 lg:px-8">
                        <div class="lg:mx-0">
                            <?php if (!empty($fields['heading'])) : ?>
                            <h2 class="text-[38px] font-primary-semibold leading-[57px] sm:text-4xl">
                                <?php echo esc_html($fields['heading']); ?>
                            </h2>
                            <?php endif; ?>
                            
                            <?php if (!empty($fields['content'])) : ?>
                            <div class="mt-6 max-w-5xl text-[#999999] text-base font-primary-medium leading-normal">
                                <?php echo nl2br(esc_textarea($fields['content'])); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <dl
                            class="w-full items-center mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-base leading-7 text-gray-300 lg:mx-0 lg:max-w-none lg:gap-x-16">
                            <?php if (!empty($fields['property_value'])) : 
                                foreach ($fields['property_value'] as $value) : ?>
                                    <div class="relative flex flex-col">
                                        <dt class="w-full flex flex-row mb-5 items-center font-semibold text-white">
                                            <?php if (!empty($value['image'])) : ?>
                                                <img src="<?php echo wp_get_attachment_image_url($value['image'], 'full'); ?>" 
                                                     class="h-15 w-15" alt="<?php echo esc_attr($value['title']); ?>">
                                            <?php endif; ?>
                                            <?php if (!empty($value['title'])) : ?>
                                                <h3 class="mb-0 ml-4 text-xl font-primary-semibold leading-[30px]">
                                                    <?php echo esc_html($value['title']); ?>
                                                </h3>
                                            <?php endif; ?>
                                        </dt>
                                        <?php if (!empty($value['content'])) : ?>
                                            <dd class="text-[#999999] text-base font-primary-medium leading-normal">
                                                <?php echo esc_html($value['content']); ?>
                                            </dd>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach;
                            endif; ?>
                            <?php if (!empty($fields['cta_heading']) || !empty($fields['cta_content'])) : ?>
                            <div class="relative flex flex-col col-span-1 sm:col-span-2 lg:col-span-2">
                                <div style="background: url('<?php echo get_template_directory_uri(); ?>/assets/src/images/property-value-cta-bg.webp') no-repeat center center; background-size: cover; background-color: #191919;" class="self-stretch lg:p-10 p-6 relative rounded-[10px] outline outline-1 outline-offset-[-1px] outline-[#141414] inline-flex flex-col justify-center items-start gap-5 overflow-hidden">
                                    <div class="self-stretch flex flex-col sm:flex-row justify-start items-start sm:items-center gap-3.5">
                                        <?php if (!empty($fields['cta_heading'])) : ?>
                                            <div class="w-full sm:flex-1 justify-start text-white lg:text-2xl text-xl font-primary-bold leading-9 mb-4 sm:mb-0 order-1 sm:order-none">
                                                <?php echo esc_html($fields['cta_heading']); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fields['cta_link'])) : ?>
                                            <a href="<?php echo esc_url(get_permalink($fields['cta_link'])); ?>" class="w-full sm:w-auto px-5 py-3.5 bg-[#141414] rounded-lg outline outline-1 outline-offset-[-1px] outline-[#141414] flex justify-center sm:justify-start items-center gap-2 order-3 sm:order-none mt-4 sm:mt-0">
                                                <div class="w-full lg:w-auto lg:text-left text-center justify-start text-white text-sm font-primary-medium leading-[21px]">Learn More</div>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($fields['cta_content'])) : ?>
                                        <div class="self-stretch justify-start text-[#999999] lg:text-base text-sm font-primary-medium leading-normal mt-4 order-2 sm:order-none">
                                            <?php echo nl2br(esc_textarea($fields['cta_content'])); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                        </dl>
                    </div>
                </div>
                <?php
	        } );
        }

    }
}

ESTATEINpropertyvalueblock::get_instance()->init();