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

if ( ! class_exists( 'ESTATEINcontactformblock' ) ) {
    class ESTATEINcontactformblock {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return ESTATEINcontactformblock
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
            Block::make( __( 'Real Estate Contact Form Block' ) )
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

                <div class="w-full pt-24 sm:pt-32">
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
                        
                        <div class="w-full self-stretch py-10 lg:p-[100px] rounded-xl outline outline-1 outline-offset-[-1px] outline-[#141414] inline-flex flex-col justify-center items-center gap-[50px]">
                            <form id="contact-form" method="post" class="self-stretch flex flex-col justify-start items-start gap-[50px] w-full">
                                
                                <div class="self-stretch flex flex-col justify-start items-start gap-[50px]">
                                    <div class="self-stretch flex flex-col md:flex-row justify-start items-start gap-[50px]">
                                        <div class="flex-1 inline-flex flex-col justify-start items-start gap-4 w-full">
                                            <label for="first_name" class="self-stretch justify-start text-white text-base lg:text-xl font-primary-semibold leading-[30px]">First Name</label>
                                            <input type="text" id="first_name" name="first_name" placeholder="Enter First Name" required class="self-stretch !px-5 !py-6 !bg-[#191919] rounded-lg outline outline-1 outline-offset-[-1px] outline-[#141414] text-white text-base lg:text-xl font-primary-medium leading-tight !w-full">
                                        </div>
                                        <div class="flex-1 inline-flex flex-col justify-start items-start gap-4 w-full">
                                            <label for="last_name" class="self-stretch justify-start text-white text-xl font-primary-semibold leading-[30px]">Last Name</label>
                                            <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name" required class="self-stretch !px-5 !py-6 !bg-[#191919] rounded-lg outline outline-1 outline-offset-[-1px] outline-[#141414] text-white text-base lg:text-xl font-primary-medium leading-tight !w-full">
                                        </div>
                                        <div class="flex-1 inline-flex flex-col justify-start items-start gap-4 w-full">
                                            <label for="email" class="self-stretch justify-start text-white text-xl font-primary-semibold leading-[30px]">Email</label>
                                            <input type="email" id="email" name="email" placeholder="Enter your Email" required class="self-stretch !px-5 !py-6 !bg-[#191919] rounded-lg outline outline-1 outline-offset-[-1px] outline-[#141414] text-white text-base lg:text-xl font-primary-medium leading-tight !w-full">
                                        </div>
                                    </div>
                                    <div class="self-stretch flex flex-col md:flex-row justify-start items-start gap-[50px]">
                                        <div class="flex-1 inline-flex flex-col justify-start items-start gap-4 w-full">
                                            <label for="phone" class="self-stretch justify-start text-white text-xl font-primary-semibold leading-[30px]">Phone</label>
                                            <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" class="self-stretch !px-5 !py-6 !bg-[#191919] rounded-lg outline outline-1 outline-offset-[-1px] outline-[#141414] text-white text-base lg:text-xl font-primary-medium leading-tight !w-full">
                                        </div>
                                        <div class="flex-1 inline-flex flex-col justify-start items-start gap-4 !w-full">
                                            <label for="inquiry_type" class="self-stretch justify-start text-white text-xl font-primary-semibold leading-[30px]">Inquiry Type</label>
                                            <select id="inquiry_type" name="inquiry_type" class="self-stretch !px-5 !py-6 !bg-[#191919] rounded-lg outline outline-1 outline-offset-[-1px] outline-[#141414] text-white text-base lg:text-xl font-primary-medium leading-tight appearance-none bg-[url('data:image/svg+xml;utf8,<svg width=\"25\" height=\"24\" viewBox=\"0 0 25 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M20.1641 8.25L12.6641 15.75L5.16406 8.25\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg>')] bg-no-repeat bg-right-4 bg-center-y w-full">
                                                <option value="" disabled selected>Select Inquiry Type</option>
                                                <option value="general">General Inquiry</option>
                                                <option value="property">Property Inquiry</option>
                                                <option value="agent">Agent Inquiry</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="flex-1 inline-flex flex-col justify-start items-start gap-4 !w-full">
                                            <label for="hear_about" class="self-stretch justify-start text-white text-xl font-primary-semibold leading-[30px]">How Did You Hear About Us?</label>
                                            <select id="hear_about" name="hear_about" class="self-stretch !px-5 !py-6 !bg-[#191919] rounded-lg outline outline-1 outline-offset-[-1px] outline-[#141414] text-white text-base lg:text-xl font-primary-medium leading-tight appearance-none bg-[url('data:image/svg+xml;utf8,<svg width=\"25\" height=\"24\" viewBox=\"0 0 25 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M20.1641 8.25L12.6641 15.75L5.16406 8.25\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg>')] bg-no-repeat bg-right-4 bg-center-y w-full">
                                                <option value="" disabled selected>Select</option>
                                                <option value="search">Search Engine</option>
                                                <option value="social">Social Media</option>
                                                <option value="friend">Friend/Family</option>
                                                <option value="advertisement">Advertisement</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="self-stretch flex flex-col justify-start items-start gap-4 !w-full">
                                        <label for="message" class="self-stretch justify-start text-white text-xl font-primary-semibold leading-[30px]">Message</label>
                                        <textarea id="message" name="message" placeholder="Enter your Message here.." class="self-stretch h-[170px] px-5 py-6 bg-[#191919] rounded-lg outline outline-1 outline-offset-[-1px] outline-[#141414] text-white text-base lg:text-xl font-primary-medium leading-tight w-full"></textarea>
                                    </div>
                                </div>
                                <div class="self-stretch flex flex-col md:flex-row justify-center items-center gap-[50px]">
                                    <div class="flex-1 flex justify-start items-center gap-2.5">
                                        <input type="checkbox" id="terms" name="terms" required class="w-7 h-7 bg-[#191919] rounded border border-[#141414] cursor-pointer">
                                        <label for="terms" class="flex-1 justify-start cursor-pointer">
                                            <span class="text-[#999999] text-base lg:text-xl font-primary-medium leading-[27px]">I agree with </span>
                                            <a href="#" class="text-[#999999] text-base lg:text-xl font-primary-medium underline leading-[27px]">Terms of Use</a>
                                            <span class="text-[#999999] text-base lg:text-xl font-primary-medium leading-[27px]"> and </span>
                                            <a href="#" class="text-[#999999] text-base lg:text-xl font-primary-medium underline leading-[27px]">Privacy Policy</a>
                                        </label>
                                    </div>
                                    <button type="submit" class="px-[46px] py-[18px] bg-[#6f3bf6] rounded-lg flex justify-center items-center gap-[67px] cursor-pointer hover:bg-[#5f32d0] transition-colors">
                                        <span class="justify-start text-white text-base lg:text-xl font-primary-medium leading-normal">Send Your Message</span>
                                    </button>
                                </div>
                                <?php wp_nonce_field('contact_form_nonce', 'contact_form_nonce'); ?>
                                <input type="hidden" name="action" value="process_contact_form">
                                <!-- Notification area -->
                                <div id="notification" class="hidden w-full">
                                    <div id="success-notification" class="hidden w-full p-4 mb-6 rounded-lg bg-green-50 border border-green-200">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-green-700 font-medium">Thank you for your message! We will get back to you soon.</span>
                                        </div>
                                    </div>
                                    <div id="error-notification" class="hidden w-full p-4 mb-6 rounded-lg bg-red-50 border border-red-200">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span id="error-message" class="text-red-700 font-medium">There was an error sending your message. Please try again.</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const form = document.getElementById('contact-form');
                                const notification = document.getElementById('notification');
                                const successNotification = document.getElementById('success-notification');
                                const errorNotification = document.getElementById('error-notification');
                                const errorMessage = document.getElementById('error-message');
                                
                                function showNotification(isSuccess, message = '') {
                                    notification.classList.remove('hidden');
                                    
                                    if (isSuccess) {
                                        successNotification.classList.remove('hidden');
                                        errorNotification.classList.add('hidden');
                                    } else {
                                        errorNotification.classList.remove('hidden');
                                        successNotification.classList.add('hidden');
                                        if (message) {
                                            errorMessage.textContent = message;
                                        }
                                    }
                                    
                                    // Scroll to notification
                                    notification.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    
                                    // Hide notification after 5 seconds
                                    setTimeout(() => {
                                        notification.classList.add('hidden');
                                        successNotification.classList.add('hidden');
                                        errorNotification.classList.add('hidden');
                                    }, 5000);
                                }
                                
                                form.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    
                                    const formData = new FormData(form);
                                    
                                    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            showNotification(true);
                                            form.reset();
                                        } else {
                                            showNotification(false, data.data || 'There was an error sending your message. Please try again.');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        showNotification(false);
                                    });
                                });
                            });
                            </script>
                        </div>
                    </div>
                </div>
                <?php
	        } );
        }

    }
}

ESTATEINcontactformblock::get_instance()->init();