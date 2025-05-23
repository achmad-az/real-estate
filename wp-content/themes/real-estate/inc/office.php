<?php
/**
 * Register Office Locations Shortcode
 *
 * @return void
 */
function real_estate_register_office_locations_shortcode() {
    add_shortcode('office_locations', 'real_estate_office_locations_shortcode');
}
add_action('init', 'real_estate_register_office_locations_shortcode');

/**
 * Office Locations Shortcode Callback
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML content.
 */
function real_estate_office_locations_shortcode($atts) {
    // Get office locations from theme options
    $office_locations = carbon_get_theme_option('office_locations');
    $office_heading = carbon_get_theme_option('office_heading');
    $office_content = carbon_get_theme_option('office_content');
    
    if (empty($office_locations)) {
        return '<div class="no-offices">No office locations found.</div>';
    }
    
    ob_start();
    ?>
    <div class="container">
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
            <?php if (!empty($office_heading)) : ?>
            <h2 class="text-[38px] font-primary-semibold leading-[57px] sm:text-4xl">
                <?php echo esc_html($office_heading); ?>
            </h2>
            <?php endif; ?>
            
            <?php if (!empty($office_content)) : ?>
            <div class="mt-6 max-w-5xl text-[#999999] text-base font-primary-medium leading-normal">
                <?php echo nl2br(esc_textarea($office_content)); ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="lg:mt-10 office-locations-grid grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php foreach ($office_locations as $office) : ?>
                <div class="office-card rounded-xl outline outline-1 outline-offset-[-1px] outline-[#141414] bg-[#191919] p-8">
                    <?php if (!empty($office['office_title'])) : ?>
                        <h3 class="office-title mb-2.5 text-white text-sm font-primary-medium leading-[27px]"><?php echo esc_html($office['office_title']); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($office['office_address'])) : ?>
                        <div class="office-address mb-4 text-white text-2xl font-primary-semibold leading-[45px]"><?php echo wp_kses_post($office['office_address']); ?></div>
                    <?php endif; ?>
                    
                    <?php if (!empty($office['office_desc'])) : ?>
                        <div class="office-desc mb-10 text-[#999999] text-base font-primary-medium leading-[27px]"><?php echo wp_kses_post($office['office_desc']); ?></div>
                    <?php endif; ?>
                    
                    <div class="office-info flex flex-row flex-wrap gap-4 lg:justify-center justify-start items-center">
                        
                        <?php if (!empty($office['office_email'])) : ?>
                            <div class="office-email flex items-center">
                                <span class="icon mr-3 text-[#ffffff]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </span>
                                <a href="mailto:<?php echo esc_attr($office['office_email']); ?>" class="text-white text-sm font-primary-medium leading-[27px] transition-colors"><?php echo esc_html($office['office_email']); ?></a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($office['office_phone'])) : ?>
                            <div class="office-phone flex items-center">
                                <span class="icon mr-3 text-[#ffffff]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                </span>
                                <a href="tel:<?php echo esc_attr($office['office_phone']); ?>" class="text-white text-sm font-primary-medium leading-[27px] transition-colors"><?php echo esc_html($office['office_phone']); ?></a>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($office['office_location'])) : ?>
                            <div class="office-address flex items-center">
                                <span class="icon mr-3 text-[#ffffff]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </span>
                                <span class="text-white text-sm font-primary-medium leading-[27px]"><?php echo esc_html($office['office_location']); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($office['office_location']) && !empty($office['office_link_location'])) : ?>
                        <div class="office-location mt-8">
                            <a href="<?php echo esc_url($office['office_link_location']); ?>" target="_blank" class="w-full px-5 py-3.5 bg-[#6f3bf6] rounded-lg inline-flex justify-center items-center  transition-colors">
                                <span class="text-white">Get Direction</span>
                                <svg class="ml-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.16602 15.8333L15.8327 4.16668M15.8327 4.16668L7.49935 4.16668M15.8327 4.16668V12.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}