        <?php do_action( 'rela_estate_content_end' ); ?>

        </main>

        <?php do_action( 'rela_estate_content_after' );
        
            $footer_logo_image = carbon_get_theme_option('footer_logo_image');
            $footer_text = carbon_get_theme_option('footer_text');
            $copy_text = carbon_get_theme_option('copy_text');
        ?>

        <footer class="p-8 gap-y-8 flex flex-col justify-center items-center" aria-labelledby="footer-heading">
            <?php if ($footer_logo_image) : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="-m-1.5 p-1.5">
                    <img class="h-auto w-[146px]" src="<?php echo esc_url(wp_get_attachment_url($footer_logo_image)); ?>" alt="<?php bloginfo('name'); ?>">
                </a>
            <?php endif; ?>
            <div class="mx-auto max-w-6xl -mb-8">
                    <div id="footer-heading" class="">
                        <?php echo apply_filters('the_content', $footer_text); ?>
                    </div>
            </div>
            <div class="w-full justify-center items-center gap-3.5 inline-flex text-center">
                <a href="#" class="text-center font-secondary">Terms & Conditions</a>
                <div class="text-center font-secondary">•</div>
                <a href="#" class="text-center font-secondary">Disclaimer</a>
            </div>
            <div class="w-full justify-center items-center gap-3.5 inline-flex text-center">
                <div class="text-center text-black text-base font-secondary "><?php echo esc_html($copy_text); ?></div>
            </div>
        </footer>
        
        <?php do_action('rela_estate_footer'); ?>
         <!-- #page -->
        <?php wp_footer(); ?>
        <?php do_action('rela_estate_site_after'); ?>
</body>
</html>