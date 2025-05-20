<!DOCTYPE html>
<html <?php language_attributes(); ?> class="!scroll-smooth">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/dist/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/dist/images/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/dist/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/dist/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/dist/images/favicon/site.webmanifest">
    <!-- end favicon -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(''); ?>>
        
        <?php do_action('rela_estate_site_before');
            // Retrieve theme options
            $hero_logo_image = carbon_get_theme_option('hero_logo_image');
            $menu_logo_image = carbon_get_theme_option('menu_logo_image');
            $video_bg = carbon_get_theme_option('video_bg');
            $selected_page = carbon_get_theme_option('selected_page');
            $page_url = $selected_page ? get_permalink($selected_page) : '#';
        ?>
        <div id="page" class="">
            <?php do_action('rela_estate_header'); ?>
                <header class="w-full" x-data="{ open: false }">
                    <div class="w-full bg-[#191919] bg-cover bg-center bg-no-repeat border-b border-neutral-800 inline-flex justify-center items-center gap-2.5 overflow-hidden py-[18px]" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/src/images/abstract-banner.png');">
                        <div class="text-center justify-start text-white text-lg font-medium font-primary-regular leading-[27px]">✨Discover Your Dream Property with Estatein</div>
                        <div class="text-center justify-start text-white text-lg font-medium font-primary-regular underline leading-[27px]">Learn More</div>
                    </div>
                    <!-- Mobile menu, show/hide based on menu open state. -->
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-x-full" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform -translate-x-full" class="h-screen" role="dialog" aria-modal="true">
                        <!-- Background backdrop, show/hide based on slide-over state. -->
                        <div class="backdrop-blur-sm fixed inset-0 z-50"></div>
                        <div class="fixed shadow-2xl inset-y-0 z-50 w-full overflow-y-auto bg-[#f0f0f0] px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-white/10">
                            <div class="flex items-center justify-between">
                                <?php if (has_custom_logo()) : ?>
                                    <?php the_custom_logo(); ?>
                                <?php elseif ($menu_logo_image) : ?>
                                    <a href="<?php echo esc_url(home_url('/')); ?>" class="-m-1.5 p-1.5">
                                        <img class="menu-logo h-8 w-auto" src="<?php echo esc_url(wp_get_attachment_url($menu_logo_image)); ?>" alt="<?php bloginfo('name'); ?>">
                                    </a>
                                <?php else : ?>
                                    <a href="<?php echo esc_url(home_url('/')); ?>" class="-m-1.5 p-1.5">
                                        <img class="menu-logo h-8 w-auto" src="<?php echo get_template_directory_uri(); ?>/assets/dist/images/logo.svg" alt="<?php bloginfo('name'); ?>">
                                    </a>
                                <?php endif; ?>
                                <button type="button" @click="open = false" class="-m-2.5 rounded-md p-2.5 text-gray-400">
                                    <span class="sr-only">Close menu</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-6 flow-root">
                                <div class="-my-6 divide-y divide-gray-500/25">
                                    <?php
                                        wp_nav_menu(array(
                                            'theme_location' => 'primary',
                                            'menu_id'        => 'primary-menu',
                                            'container'      => false,
                                            'menu_class'     => 'space-y-2 py-6',
                                            'link_before'    => '<span class="block text-base font-semibold leading-7 text-black hover:text-black hover:bg-black">',
                                            'link_after'     => '</span>',
                                            'walker'         => new Walker_Nav_Menu_Custom(),
                                        ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Mobile menu, show/hide based on menu open state. -->
                    <div class="m-5 absolute top-0 left-0 right-0 ">
                        <nav class="flex items-center justify-between" aria-label="Global">
                            
                            <div class="flex">
                                <button type="button" @click="open = !open" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 max-h-12 max-w-12 text-gray-400">
                                    <span class="sr-only">Open main menu</span>
                                    <svg width="256px" height="256px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill="text-gray-400" fill-rule="evenodd" d="M18 5a1 1 0 100-2H2a1 1 0 000 2h16zm-8 4a1 1 0 100-2H2a1 1 0 100 2h8zm9 3a1 1 0 01-1 1H2a1 1 0 110-2h16a1 1 0 011 1zm-9 5a1 1 0 100-2H2a1 1 0 100 2h8z"></path>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            <div class="justify-end">
                                <a href="<?php echo esc_url($page_url); ?>" class="btn-prm hover:opacity-90">
                                    <div class="inline-block align-middle text-center font-primary text-xl">Book Now</div>
                                </a>
                            </div>
                        </nav>
                    </div>
                    
                </header>
                <div class="w-full min-h-[340px] flex items-center justify-center">
                    <!-- Hero Logo -->
                    <?php if (is_front_page()) : ?>
                        <div class="hero-logo-wrap h-[80vh]">
                            <?php if ($hero_logo_image) : ?>
                                <div class="hero-logo flex items-center justify-center m-auto lg:w-[397px] h-full w-[200px]">
                                    <?php echo wp_get_attachment_image($hero_logo_image, 'full', false, array('class' => 'w-full h-auto')); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>