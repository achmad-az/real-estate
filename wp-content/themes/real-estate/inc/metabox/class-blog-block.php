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

if ( ! class_exists( 'TULAblogblock' ) ) {
    class TULAblogblock {

        /**
         * Instance of the object.
         * @static
         * @access public
         * @var null|object
         */
        public static $instance = null;

        /**
         * Access the single instance of this class.
         * @return TULAblogblock
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
            Block::make( __( 'Real Estate Blog Block' ) )
            ->add_fields( array(
                Field::make( 'text', 'heading_section', __( 'Heading Section' ) )
                    ->set_required( true ),
                Field::make( 'textarea', 'description_section', __( 'Description Section' ) ),
                Field::make( 'association', 'selected_posts', __( 'Select Posts' ) )
                    ->set_types( array(
                        array(
                            'type'      => 'post',
                            'post_type' => 'post', // Hanya untuk post type "post"
                        ),
                    ) )
                    ->set_max( 6 ) // Maksimal 6 postingan
                    ->set_required( true ),
            ) )
            ->set_description( __( 'A block to display selected blog posts in a carousel.' ) )
            ->set_category( 'layout' )
            ->set_icon( 'cover-image' )
            ->set_keywords( [ __( 'Real Estate' ), __( 'blog' ), __( 'carousel' ) ] )
            ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
                ?>

            <section class="mx-auto flex flex-col w-full">
                <div class="w-full">
                    <div class="flex mx-auto w-full lg:max-w-4xl pb-8 flex-col justify-center items-center text-center">
                        <h2 class="font-primary uppercase"><?php echo esc_html( $fields['heading_section'] ); ?></h2>
                        <div class="w-[30px] h-[0px] border-2 border-[#605e5e]"></div>
                        <div class="max-w-2xl text-black text-lg font-normal font-['Verdana']"><?php echo esc_html( $fields['description_section'] ); ?></div>
                    </div>
                </div>

                <div class="container mx-auto w-full justify-center content-center items-center inline-flex overflow-hidden relative" 
                    x-data="{ 
                        currentSlide: 0, 
                        slides: Math.ceil(<?php echo count( $fields['selected_posts'] ); ?> / (window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1))), 
                        itemsPerSlide: window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1), 
                        showNav: false 
                    }" 
                    x-init="
                        showNav = slides > 1;
                        window.addEventListener('resize', () => { 
                            itemsPerSlide = window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1); 
                            slides = Math.ceil(<?php echo count( $fields['selected_posts'] ); ?> / itemsPerSlide); 
                            showNav = slides > 1;
                        });
                    "
                >
                    <div class="flex w-full transition-transform duration-500 lg:gap-8 lg:px-8 md:gap-4 md:px-4 lg:-ml-10" 
                        :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
                        <?php 
                        $chunks = array_chunk( $fields['selected_posts'], 3 ); // Default chunk size for desktop
                        foreach ( $chunks as $chunk ) : ?>
                        <?php foreach ( $chunk as $post_id ) : 
                            $post = get_post( $post_id['id'] ); // Ambil data postingan
                            ?>
                            <div class="flex w-full flex-shrink-0"
                                :style="{ width: `${100 / itemsPerSlide}%` }"
                                x-bind:class="{
                                            'lg:w-1/3': itemsPerSlide === 3,
                                            'md:w-1/2': itemsPerSlide === 2,
                                            'sm:w-full': itemsPerSlide === 1
                                        }">
                                
                                    <div class="blog-item-wrap flex flex-col w-full">
                                        <!-- Add Featured Image -->
                                        <?php if ( has_post_thumbnail( $post->ID ) ) : ?>
                                            <img src="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID, 'full' ) ); ?>" 
                                                alt="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>" 
                                                class="w-full h-auto aspect-[3/2] img-fluid">
                                        <?php endif; ?>
                                        <figure class="flex flex-col mx-auto justify-center items-start w-full flex-shrink-0 bg-[#e2e6e3]">
                                            <!-- Add Title -->
                                            <h2 class="text-2xl px-6 pt-6 mb-8"><?php echo esc_html( get_the_title( $post->ID ) ); ?></h2>
                                            <blockquote class="px-6 pb-6 text-base leading-8 tracking-tight text-gray-900 sm:text-2xl sm:leading-9">
                                                <div class="text-black text-lg font-normal font-secondary"><?php echo wp_trim_words( get_the_excerpt( $post->ID ), 18, '...' ); ?></div>
                                            </blockquote>
                                            <div class="w-full flex flex-row justify-between items-center pb-4">
                                                <!-- Add Reading Time -->
                                                <div class="px-6 pb-6 text-sm text-gray-600">
                                                    <?php 
                                                    // Assuming you have a function `rela_estate_get_reading_time` to calculate reading time
                                                    echo esc_html( rela_estate_get_reading_time( get_post_field( 'post_content', $post->ID ) ) ) . ' min read'; 
                                                    ?>
                                                </div>
                                                <!-- Add Read More Button -->
                                                <div class="px-6 pb-6">
                                                    <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="bg-[--theme-primary-color] px-4 py-2 rounded hover:bg-opacity-90">
                                                        Read More
                                                    </a>
                                                </div>
                                            </div>
                                            
                                        </figure>
                                    </div>
                                
                            </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>

                    <!-- Navigation buttons -->
                    <template x-if="showNav">
                        <button @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : slides - 1" 
                            class="absolute left-0 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-gray-50">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 18L9 12L15 6" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </template>
                    <template x-if="showNav">
                        <button @click="currentSlide = (currentSlide < slides - 1) ? currentSlide + 1 : 0" 
                            class="absolute right-0 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-gray-50">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 6L15 12L9 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </template>
                </div>
            </section>
                <?php
            } );
        }

    }
}

TULAblogblock::get_instance()->init();