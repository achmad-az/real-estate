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

if ( ! class_exists( 'ESTATEINimagetextblock' ) ) {
    class ESTATEINimagetextblock {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return ESTATEINimagetextblock
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
                // Content Section
                Field::make('html', 'content_heading', __('Content Section'))
                ->set_html('<h2 class="heading-cf">Content Section</h2>   <hr>'),
                Field::make('checkbox', 'heading_icon', __('Heading Icon')),
                Field::make('text', 'heading', __('Block Heading')),
                Field::make('rich_text', 'content', __('Block Content')),

                // Image Section
                Field::make('html', 'image_heading', __('Image Section'))
                ->set_html('<h2 class="heading-cf">Image Section</h2>   <hr>'),
                Field::make('image', 'hero-tag', __('Block Hero Tag')),
                Field::make('image', 'images', __('Block Hero Images')),

                // Button Links Section
                Field::make('html', 'buttons_heading', __('Button Links'))
                ->set_html('<h2 class="heading-cf">Button Section</h2>   <hr>'),
                Field::make('text', 'button_text_1', __('Button text 1')),
                Field::make('select', 'button_link_1', __('Button Link 1', 'real-estate'))
                    ->add_options('get_pages_options'),
                Field::make('text', 'button_text_2', __('Button text 2')),
                Field::make('select', 'button_link_2', __('Button Link 2', 'real-estate'))
                    ->add_options('get_pages_options'),

                // Count Section
                Field::make('html', 'count_heading', __('Count Section'))
                ->set_html('<h2 class="heading-cf">Count Section</h2>   <hr>'),
                Field::make('text', 'count_1', __('Count 1')),
                Field::make('text', 'count_1_label', __('Count 1 Label')),
                Field::make('text', 'count_2', __('Count 2')),
                Field::make('text', 'count_2_label', __('Count 2 Label')),
                Field::make('text', 'count_3', __('Count 3')),
                Field::make('text', 'count_3_label', __('Count 3 Label')),
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

            <div class="bg-[#141414]">
                <div class="container lg:px-8">
                    <div class="lg:h-[622px] h-auto lg:mx-0 flex lg:flex-row flex-col lg:gap-x-14 lg:gap-y-6 gap-y-4">
                        <!-- Mobile: Image First -->
                        <div class="hero-image order-first lg:order-last lg:w-1/2 lg:max-w-2xl relative mb-10 lg:mb-0 ">
                            <?php if (!empty($fields['hero-tag'])) : 
                                $tag_id = $fields['hero-tag'];
                                $tag_alt = get_post_meta($tag_id, '_wp_attachment_image_alt', true) ?: 'Hero tag'; 
                            ?>
                                <div class="absolute lg:top-20 lg:-left-20 left-0 top-auto -bottom-10 z-10">
                                    <img src="<?php echo esc_url(wp_get_attachment_image_url($tag_id, 'full')); ?>" 
                                        alt="<?php echo esc_attr($tag_alt); ?>" 
                                        class="lg:w-auto w-[117px] h-auto"
                                        loading="lazy"
                                        width="<?php echo esc_attr(wp_get_attachment_metadata($tag_id)['width'] ?? ''); ?>"
                                        height="<?php echo esc_attr(wp_get_attachment_metadata($tag_id)['height'] ?? ''); ?>">
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($fields['images'])) : 
                                $image_id = $fields['images'];
                                $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: esc_html($fields['heading']); 
                            ?>
                                <img src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'full')); ?>" 
                                    alt="<?php echo esc_attr($image_alt); ?>" 
                                    class=" h-full object-cover lg:mt-0 lg:rounded-none rounded-lg"
                                    loading="lazy"
                                    width="<?php echo esc_attr(wp_get_attachment_metadata($image_id)['width'] ?? ''); ?>"
                                    height="<?php echo esc_attr(wp_get_attachment_metadata($image_id)['height'] ?? ''); ?>">
                            <?php endif; ?>
                        </div>
                        
                        <!-- Mobile: Text Second -->
                        <div class="hero-text order-last lg:order-first lg:w-1/2 w-full flex flex-col items-start justify-center lg:mr-15 gap-y-5">
                            <?php if (!empty($fields['heading'])) : ?>
                                <?php if (!empty($fields['heading_icon'])) : ?>
                                <div class="lg:ml-7">
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
                            <?php endif; ?>
                                <h1 class="lg:ml-14 lg:max-w-lg max-w-xs text-[28px] font-bold tracking-tight lg:text-[46px] mb-0 lg:leading-[55px] leading-[33px]">
                                    <?php echo esc_html($fields['heading']); ?>
                                </h1>
                            <?php endif; ?>

                            <div class="hero-desc lg:ml-14 mt-6 max-w-3xl lg:mt-0 ">
                                <?php if (!empty($fields['content'])) : ?>
                                    <?php echo wp_kses_post($fields['content']); ?>
                                <?php endif; ?>

                                <div class="mt-10 flex items-center gap-x-6">
                                    <?php if (!empty($fields['button_text_1']) && !empty($fields['button_link_1'])) : 
                                        $button_link_1 = get_permalink($fields['button_link_1']); 
                                    ?>
                                    <div class="rounded-lg outline outline-1 outline-offset-[-1px] outline-neutral-800 inline-flex justify-center items-center gap-2">
                                        <a href="<?php echo esc_url($button_link_1); ?>" class="px-5 py-3.5 justify-start text-white text-sm font-primary-medium leading-[21px]">
                                            <?php echo esc_html($fields['button_text_1']); ?>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($fields['button_text_2']) && !empty($fields['button_link_2'])) : 
                                        $button_link_2 = get_permalink($fields['button_link_2']); 
                                    ?>
                                    <div class="bg-[#6f3bf6] rounded-lg inline-flex justify-center items-center gap-2">
                                        <a href="<?php echo esc_url($button_link_2); ?>" class="px-5 py-3.5 justify-start text-white text-sm font-primary-medium leading-[21px]">
                                            <?php echo esc_html($fields['button_text_2']); ?>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($fields['count_1']) || !empty($fields['count_2']) || !empty($fields['count_3'])) : ?>
                                <div class="hero-count w-full self-stretch inline-flex flex-wrap justify-start items-start gap-4 mt-[50px]"
                                    x-data="{ 
                                        counts: [
                                            { current: 0, target: <?php echo !empty($fields['count_1']) ? intval($fields['count_1']) : 0; ?>, label: '<?php echo esc_js($fields['count_1_label'] ?? 'Happy Customers'); ?>' },
                                            { current: 0, target: <?php echo !empty($fields['count_2']) ? intval($fields['count_2']) : 0; ?>, label: '<?php echo esc_js($fields['count_2_label'] ?? 'Properties For Clients'); ?>' },
                                            { current: 0, target: <?php echo !empty($fields['count_3']) ? intval($fields['count_3']) : 0; ?>, label: '<?php echo esc_js($fields['count_3_label'] ?? 'Years of Experience'); ?>' }
                                        ],
                                        animateCount(index) {
                                            const item = this.counts[index];
                                            let start = 0;
                                            const duration = 2000; // 2 seconds duration
                                            const steps = 100; // More steps for smoother animation
                                            const increment = item.target / steps;
                                            const interval = duration / steps;
                                            
                                            const timer = setInterval(() => {
                                                start += increment;
                                                if (start >= item.target) {
                                                    item.current = item.target;
                                                    clearInterval(timer);
                                                } else {
                                                    item.current = Math.floor(start);
                                                }
                                            }, interval);
                                        },
                                        init() {
                                            const observer = new IntersectionObserver((entries) => {
                                                if (entries[0].isIntersecting) {
                                                    this.counts.forEach((_, index) => this.animateCount(index));
                                                    observer.disconnect();
                                                }
                                            }, { threshold: 0.1 });
                                            observer.observe($el);
                                        }
                                    }"
                                >
                                    <?php if (!empty($fields['count_1'])) : ?>
                                    <div class="w-[calc(50%-8px)] lg:w-auto lg:flex-1 px-5 py-3.5 bg-[#191919] rounded-[10px] outline outline-1 outline-offset-[-1px] outline-neutral-800 inline-flex flex-col justify-start items-start gap-0.5">
                                        <div class="self-stretch justify-start text-white text-3xl font-bold leading-[45px]">
                                            <span x-text="counts[0].current"></span>+
                                        </div>
                                        <div class="self-stretch justify-start text-[#999999] text-base font-medium leading-normal"><?php echo esc_html($fields['count_1_label'] ?? ''); ?></div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fields['count_2'])) : ?>
                                    <div class="w-[calc(50%-8px)] lg:w-auto lg:flex-1 px-5 py-3.5 bg-[#191919] rounded-[10px] outline outline-1 outline-offset-[-1px] outline-neutral-800 inline-flex flex-col justify-start items-start gap-0.5">
                                        <div class="self-stretch justify-start text-white text-3xl font-bold leading-[45px]">
                                            <span x-text="counts[1].current"></span>+
                                        </div>
                                        <div class="self-stretch justify-start text-[#999999] text-base font-medium leading-normal"><?php echo esc_html($fields['count_2_label'] ?? ''); ?></div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fields['count_3'])) : ?>
                                    <div class="w-full text-center lg:text-left lg:w-auto lg:flex-1 px-5 py-3.5 bg-[#191919] rounded-[10px] outline outline-1 outline-offset-[-1px] outline-neutral-800 inline-flex flex-col justify-start items-start gap-0.5">
                                        <div class="self-stretch justify-start text-white text-3xl font-bold leading-[45px]">
                                            <span x-text="counts[2].current"></span>+
                                        </div>
                                        <div class="self-stretch justify-start text-[#999999] text-base font-medium leading-normal"><?php echo esc_html($fields['count_3_label'] ?? ''); ?></div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <?php
	        } );
        }

    }
}

ESTATEINimagetextblock::get_instance()->init();