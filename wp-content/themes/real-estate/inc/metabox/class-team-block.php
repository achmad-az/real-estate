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

if ( ! class_exists( 'ESTATEINteamblock' ) ) {
    class ESTATEINteamblock {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return ESTATEINteamblock
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
            Block::make( __( 'Real Estate Team Block' ) )
            ->add_fields( array(
                // Content Section
                Field::make('html', 'content_heading', __('Content Section'))
                ->set_html('<h2 class="heading-cf">Content Section</h2>   <hr>'),
                Field::make('text', 'heading', __('Block Heading')),
                Field::make('rich_text', 'content', __('Block Content')),
                Field::make( 'complex', 'our-team', 'Our Team' )
                    ->set_layout( 'tabbed-horizontal' )
                    ->set_max( 4 )
                    ->add_fields( array(
                        Field::make( 'image', 'image', __( 'Team Image' ) ),
                        Field::make( 'text', 'name', __( 'Name' ) ),
                        Field::make( 'text', 'title', __( 'Title' ) ),
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

            <div class="py-24 sm:py-30">
                <div class="container px-6 lg:px-8">
                <div class="our-team w-full lg:mx-0">
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
                        <h2 class="text-3xl mb-2.5 text-white lg:text-[38px] font-primary-semibold leading-[57px]"><?php echo esc_html($fields['heading']); ?></h2>
                    <?php endif; ?>
                    <?php if (!empty($fields['content'])) : ?>
                        <p class="text-[#999999] text-base font-primary-medium leading-normal"><?php echo wp_kses_post($fields['content']); ?></p>
                    <?php endif; ?>
                </div>
                <ul role="list" class="mx-auto mt-20 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:gap-x-5 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
                    <?php 
                    if (!empty($fields['our-team'])) :
                        foreach ($fields['our-team'] as $member) :
                            $image = wp_get_attachment_image_url($member['image'], 'full');
                    ?>
                    <li class="w-full relative text-center p-6">
                        <?php if ($image) : ?>
                        <img class="aspect-[1/1] w-full rounded-2xl object-cover" 
                             src="<?php echo esc_url($image); ?>" 
                             alt="<?php echo esc_attr($member['name']); ?>">
                        <?php endif; ?>
                        <a href="#" class="px-5 py-2.5 left-[40%] -mt-6 absolute bg-[#6f3bf6] rounded-[43px] text-white">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"></path>
                            </svg>
                        </a>
                        <h3 class="mt-12 mb-0 text-white text-xl font-primary-semibold leading-7"><?php echo esc_html($member['name']); ?></h3>
                        <span class="text-[#999999] text-base font-primary-medium leading-normal"><?php echo esc_html($member['title']); ?></span>
                        <div class="w-full justify-between self-stretch pl-5 pr-2.5 py-2.5 bg-[#191919] rounded-[100px] outline outline-1 outline-offset-[-1px] outline-[#141414] inline-flex items-center gap-5">
                            <div class="justify-start text-white text-base font-primary-medium leading-7">Say Hello 👋</div>
                            <div class="p-2 bg-[#6f3bf6] rounded-[100px] flex justify-start items-start gap-2.5">
                                <div class="w-5 h-5 relative bg-black/0 overflow-hidden">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.8565 2.14854C17.4398 1.72271 16.8232 1.56521 16.2482 1.73187L2.83984 5.60604C2.23318 5.77437 1.80318 6.25521 1.68734 6.86521C1.56901 7.48687 1.98234 8.27687 2.52234 8.60687L6.71484 11.1669C7.14484 11.4302 7.69984 11.3644 8.05568 11.0077L12.8565 6.20687C13.0982 5.95604 13.4982 5.95604 13.7398 6.20687C13.9815 6.44771 13.9815 6.84021 13.7398 7.09021L8.93068 11.891C8.57401 12.2477 8.50734 12.801 8.76984 13.2319L11.3315 17.4402C11.6315 17.9394 12.1482 18.2235 12.7148 18.2235C12.7815 18.2235 12.8565 18.2235 12.9232 18.2144C13.5732 18.1319 14.0898 17.6894 14.2815 17.0644L18.2565 3.75687C18.4315 3.19021 18.2732 2.57354 17.8565 2.14854Z" fill="white"/>
                                    <path opacity="0.4" d="M7.87697 15.9519C8.12031 16.196 8.12031 16.5919 7.87697 16.836L6.73864 17.9735C6.61697 18.096 6.45697 18.1569 6.29697 18.1569C6.13697 18.1569 5.97697 18.096 5.85531 17.9735C5.61114 17.7294 5.61114 17.3344 5.85531 17.0902L6.99281 15.9519C7.23697 15.7085 7.63281 15.7085 7.87697 15.9519ZM7.22389 12.7952C7.46722 13.0394 7.46722 13.4352 7.22389 13.6794L6.08556 14.8169C5.96389 14.9394 5.80389 15.0002 5.64389 15.0002C5.48389 15.0002 5.32389 14.9394 5.20222 14.8169C4.95806 14.5727 4.95806 14.1777 5.20222 13.9335L6.33972 12.7952C6.58389 12.5519 6.97972 12.5519 7.22389 12.7952ZM4.08956 11.8015C4.33289 12.0457 4.33289 12.4415 4.08956 12.6857L2.95122 13.8232C2.82956 13.9457 2.66956 14.0065 2.50956 14.0065C2.34956 14.0065 2.18956 13.9457 2.06789 13.8232C1.82372 13.579 1.82372 13.184 2.06789 12.9399L3.20539 11.8015C3.44956 11.5582 3.84539 11.5582 4.08956 11.8015Z" fill="white"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                </ul>
                </div>
            </div>
                <?php
	        } );
        }

    }
}

ESTATEINteamblock::get_instance()->init();