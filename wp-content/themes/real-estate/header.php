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
            $main_logo_image = carbon_get_theme_option('main_logo_image');
            $menu_logo_image = carbon_get_theme_option('menu_logo_image');
            $banner_text = carbon_get_theme_option('banner_text');
            $banner_link = carbon_get_theme_option('banner_link');
            $header_button_text = carbon_get_theme_option('header_button_text');
            $header_button_link = carbon_get_theme_option('header_button_link');
        ?>
        <div id="page" class="">
            <?php do_action('rela_estate_header'); ?>
                    <header x-data="{ open: false }" @keydown.window.escape="open = false"
                        class=" inset-x-0 top-0 z-50 bg-[#191919]">
                        <!-- Mobile menu, show/hide based on menu open state. -->
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-full" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform translate-x-full" class="h-screen" role="dialog" aria-modal="true">
                            <!-- Background backdrop, show/hide based on slide-over state. -->
                            <div class="backdrop-blur-sm fixed inset-0 z-50"></div>
                            <div class="fixed right-0 shadow-2xl inset-y-0 z-50 w-full overflow-y-auto bg-[#191919] px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-white/10">
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
                                <div class="my-6 flow-root">
                                    <div class="-my-6 divide-y divide-gray-500/10">
                                        <?php
                                            wp_nav_menu(array(
                                                'theme_location' => 'primary',
                                                'menu_id'        => 'primary-menu-mobile',
                                                'container'      => false,
                                                'menu_class'     => 'space-y-2 py-6',
                                                'link_before'    => '<span class="block text-base font-semibold leading-7 text-white hover:bg-gray-50">',
                                                'link_after'     => '</span>',
                                                'walker'         => new Walker_Nav_Menu_Custom(),
                                            ));
                                        ?>
                                    </div>
                                </div>
                                <div class="py-6 border-t border-gray-500/10">
                                    <?php if ($header_button_text): ?>
                                        <?php
                                            $button_url = $header_button_link ? get_permalink($header_button_link) : '#';
                                        ?>
                                        <a href="<?php echo esc_url($button_url); ?>" class="text-sm font-semibold leading-6 py-3 px-5 bg-[--color-grey-08] rounded-lg outline outline-1 outline-offset-[-1px] outline-neutral-800">
                                            <?php echo esc_html($header_button_text); ?>
                                        </a>
                                    <?php else: ?>
                                        <a href="#" class="text-sm font-semibold leading-6 py-3 px-5 bg-[--color-grey-08] rounded-lg outline outline-1 outline-offset-[-1px] outline-neutral-800">Contact Us</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- End Mobile menu, show/hide based on menu open state. -->
                        <!-- Banner -->
                        <div x-data="{ open: true }" 
                            x-show="open" 
                            x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100 transform"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-4"
                            class="banner w-full flex bg-[#191919] bg-cover bg-center bg-no-repeat border-b border-neutral-800 md:flex-row flex-col justify-center items-center gap-2.5 overflow-hidden py-[18px] px-4 sm:px-6 md:px-8"
                            style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/src/images/abstract-banner.png');">
                            <div class="text-center justify-start text-white text-sm md:text-lg font-medium font-primary-regular leading-[20px] sm:leading-[24px] md:leading-[27px]">
                                <?php echo esc_html($banner_text); ?>
                            </div>
                            <div class="text-center justify-start text-white text-sm sm:text-base md:text-lg font-medium font-primary-regular underline leading-[20px] sm:leading-[24px] md:leading-[27px]">
                                <?php if ($banner_link): ?>
                                    <a href="<?php echo esc_url(get_permalink($banner_link)); ?>" class="text-white underline">Learn More</a>
                                <?php else: ?>
                                    <a href="#" class="text-white underline">Learn More</a>
                                <?php endif; ?>
                            </div>
                            <div class="banner-close p-1 md:top-[15px] top-[30px] lg:right-9 right-2 absolute bg-white/10 rounded-[75px] flex justify-center items-center gap-2.5 hover:cursor-pointer" @click="open = !open">
                                <div class="w-6 h-6 relative overflow-hidden">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 18L18 6M6 6L18 18" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- End Banner -->
                        <nav class="container mx-auto flex items-center justify-between py-4 lg:px-[80px] md:px-8 lg:py-6" aria-label="Global">
                            <div class="flex lg:flex-1">
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="-m-1.5 p-1.5">
                                    <span class="sr-only"><?php bloginfo('name'); ?></span>
                                    <?php if ($main_logo_image) : ?>
                                        <img class="h-auto w-[113px]" 
                                            src="<?php echo esc_url(wp_get_attachment_image_url($main_logo_image, 'full')); ?>" 
                                            loading="lazy" 
                                            alt="<?php echo esc_attr(get_bloginfo('name') . ' - ' . get_bloginfo('description')); ?>">
                                    <?php else : ?>
                                        <img class="h-auto w-[113px]" 
                                            src="<?php echo get_template_directory_uri(); ?>/assets/dist/images/logo-placeholder.png" 
                                            loading="lazy" 
                                            alt="<?php echo esc_attr(get_bloginfo('name') . ' - ' . get_bloginfo('description')); ?>">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="flex lg:hidden" >
                                <button type="button" @click="open = !open" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 max-h-12 max-w-12 text-gray-400">
                                    <span class="sr-only">Open main menu</span>
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 7.875C3.5 7.39175 3.89175 7 4.375 7H23.625C24.1082 7 24.5 7.39175 24.5 7.875C24.5 8.35825 24.1082 8.75 23.625 8.75H4.375C3.89175 8.75 3.5 8.35825 3.5 7.875ZM3.5 14C3.5 13.5168 3.89175 13.125 4.375 13.125H23.625C24.1082 13.125 24.5 13.5168 24.5 14C24.5 14.4832 24.1082 14.875 23.625 14.875H4.375C3.89175 14.875 3.5 14.4832 3.5 14ZM13.125 20.125C13.125 19.6418 13.5168 19.25 14 19.25H23.625C24.1082 19.25 24.5 19.6418 24.5 20.125C24.5 20.6082 24.1082 21 23.625 21H14C13.5168 21 13.125 20.6082 13.125 20.125Z" fill="white"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="hidden lg:flex lg:gap-x-12">
                                <?php
                                    wp_nav_menu(array(
                                        'theme_location' => 'primary',
                                        'menu_id'        => 'primary-menu-desktop',
                                        'container'      => false,
                                        'menu_class'     => 'flex gap-x-1',
                                        'link_before'    => '<span class="text-sm font-semibold leading-6">',
                                        'link_after'     => '</span>',
                                        'walker'         => new Walker_Nav_Menu_Custom(),
                                    ));
                                ?>
                            </div>
                            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                                <?php if ($header_button_text): ?>
                                    <?php
                                        $button_url = $header_button_link ? get_permalink($header_button_link) : '#';
                                    ?>
                                    <a href="<?php echo esc_url($button_url); ?>" class="text-sm font-semibold leading-6 py-3 px-5 bg-[--color-grey-08] rounded-lg outline outline-1 outline-offset-[-1px] outline-neutral-800">
                                        <?php echo esc_html($header_button_text); ?>
                                    </a>
                                <?php else: ?>
                                    <a href="#" class="text-sm font-semibold leading-6 py-3 px-5 bg-[--color-grey-08] rounded-lg outline outline-1 outline-offset-[-1px] outline-neutral-800">Contact Us</a>
                                <?php endif; ?>
                            </div>
                        </nav>
                    </header>