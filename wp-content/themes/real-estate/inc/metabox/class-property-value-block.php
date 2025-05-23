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
                            <div class="heading-icon lg:-ml-7">
                                <svg width="69" height="31" viewBox="0 0 69 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_89_6057)">
                                <path d="M15 30.5166C23.2843 30.5166 30 23.8009 30 15.5166C30 7.23237 23.2843 0.516724 15 0.516724C6.71573 0.516724 0 7.23237 0 15.5166C0 23.8009 6.71573 30.5166 15 30.5166Z" fill="#666666"/>
                                <path d="M0 45.5C8.28427 45.5 15 38.7843 15 30.5C15 22.2157 8.28427 15.5 0 15.5C-8.28427 15.5 -15 22.2157 -15 30.5C-15 38.7843 -8.28427 45.5 0 45.5Z" fill="#141414"/>
                                <path d="M30 45.5C38.2843 45.5 45 38.7843 45 30.5C45 22.2157 38.2843 15.5 30 15.5C21.7157 15.5 15 22.2157 15 30.5C15 38.7843 21.7157 45.5 30 45.5Z" fill="#141414"/>
                                <path d="M0 15.5C8.28427 15.5 15 8.78427 15 0.5C15 -7.78427 8.28427 -14.5 0 -14.5C-8.28427 -14.5 -15 -7.78427 -15 0.5C-15 8.78427 -8.28427 15.5 0 15.5Z" fill="#141414"/>
                                <path d="M30 15.5C38.2843 15.5 45 8.78427 45 0.5C45 -7.78427 38.2843 -14.5 30 -14.5C21.7157 -14.5 15 -7.78427 15 0.5C15 8.78427 21.7157 15.5 30 15.5Z" fill="#141414"/>
                                </g>
                                <g clip-path="url(#clip1_89_6057)">
                                <path d="M45 24.51C49.9706 24.51 54 20.4805 54 15.51C54 10.5394 49.9706 6.51001 45 6.51001C40.0294 6.51001 36 10.5394 36 15.51C36 20.4805 40.0294 24.51 45 24.51Z" fill="#333333"/>
                                <path d="M36 33.5C40.9706 33.5 45 29.4706 45 24.5C45 19.5294 40.9706 15.5 36 15.5C31.0294 15.5 27 19.5294 27 24.5C27 29.4706 31.0294 33.5 36 33.5Z" fill="#141414"/>
                                <path d="M54 33.5C58.9706 33.5 63 29.4706 63 24.5C63 19.5294 58.9706 15.5 54 15.5C49.0294 15.5 45 19.5294 45 24.5C45 29.4706 49.0294 33.5 54 33.5Z" fill="#141414"/>
                                <path d="M36 15.5C40.9706 15.5 45 11.4706 45 6.5C45 1.52944 40.9706 -2.5 36 -2.5C31.0294 -2.5 27 1.52944 27 6.5C27 11.4706 31.0294 15.5 36 15.5Z" fill="#141414"/>
                                <path d="M54 15.5C58.9706 15.5 63 11.4706 63 6.5C63 1.52944 58.9706 -2.5 54 -2.5C49.0294 -2.5 45 1.52944 45 6.5C45 11.4706 49.0294 15.5 54 15.5Z" fill="#141414"/>
                                </g>
                                <g clip-path="url(#clip2_89_6057)">
                                <path d="M64.2 19.7048C66.5196 19.7048 68.4 17.8244 68.4 15.5048C68.4 13.1852 66.5196 11.3048 64.2 11.3048C61.8804 11.3048 60 13.1852 60 15.5048C60 17.8244 61.8804 19.7048 64.2 19.7048Z" fill="#333333"/>
                                <path d="M59.9998 23.9001C62.3194 23.9001 64.1998 22.0197 64.1998 19.7001C64.1998 17.3805 62.3194 15.5001 59.9998 15.5001C57.6802 15.5001 55.7998 17.3805 55.7998 19.7001C55.7998 22.0197 57.6802 23.9001 59.9998 23.9001Z" fill="#141414"/>
                                <path d="M68.4002 23.9001C70.7198 23.9001 72.6002 22.0197 72.6002 19.7001C72.6002 17.3805 70.7198 15.5001 68.4002 15.5001C66.0806 15.5001 64.2002 17.3805 64.2002 19.7001C64.2002 22.0197 66.0806 23.9001 68.4002 23.9001Z" fill="#141414"/>
                                <path d="M59.9998 15.5001C62.3194 15.5001 64.1998 13.6197 64.1998 11.3001C64.1998 8.9805 62.3194 7.1001 59.9998 7.1001C57.6802 7.1001 55.7998 8.9805 55.7998 11.3001C55.7998 13.6197 57.6802 15.5001 59.9998 15.5001Z" fill="#141414"/>
                                <path d="M68.4002 15.5001C70.7198 15.5001 72.6002 13.6197 72.6002 11.3001C72.6002 8.9805 70.7198 7.1001 68.4002 7.1001C66.0806 7.1001 64.2002 8.9805 64.2002 11.3001C64.2002 13.6197 66.0806 15.5001 68.4002 15.5001Z" fill="#141414"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_89_6057">
                                <rect width="30" height="30" fill="white" transform="translate(0 0.5)"/>
                                </clipPath>
                                <clipPath id="clip1_89_6057">
                                <rect width="18" height="18" fill="white" transform="translate(36 6.5)"/>
                                </clipPath>
                                <clipPath id="clip2_89_6057">
                                <rect width="8.4" height="8.4" fill="white" transform="translate(60 11.3)"/>
                                </clipPath>
                                </defs>
                                </svg>
                            </div>
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