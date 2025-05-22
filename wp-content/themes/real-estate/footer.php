<?php do_action( 'rela_estate_content_end' ); ?>

        </main>

        <?php do_action( 'rela_estate_content_after' );
        
            $main_logo_image = carbon_get_theme_option('main_logo_image');
            $footer_logo_image = carbon_get_theme_option('footer_logo_image');
            $footer_text = carbon_get_theme_option('footer_text');
            $copy_text = carbon_get_theme_option('copy_text');
        ?>

        <footer class="bg-[--color-grey-08]" aria-labelledby="footer-heading">
            <h2 id="footer-heading" class="sr-only">Footer</h2>
            <div class="mx-auto max-w-7xl px-6 pb-8 pt-20 sm:pt-24 lg:px-8 lg:pt-32">
                <div class="xl:grid xl:grid-cols-3 xl:gap-16">
                    <div class="footer-newsletter space-y-4">
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
                        <form class="mt-6 max-w-md">
                            <?php wp_nonce_field('newsletter_signup_nonce', 'newsletter_nonce'); ?>
                            
                            <div class="relative w-[305px] border border-[#999999] rounded-lg">
                                <div class="w-[full] px-5 py-3.5 bg-[--color-grey-08] rounded-lg outline outline-1 outline-offset-[-1px] outline-[--color-grey-08] flex justify-start items-center gap-1.5">
                                    <div class="w-5 h-5 relative overflow-hidden">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.1665 5.83333H14.9998V6.66667C14.9998 6.88768 15.0876 7.09964 15.2439 7.25592C15.4002 7.4122 15.6122 7.5 15.8332 7.5C16.0542 7.5 16.2661 7.4122 16.4224 7.25592C16.5787 7.09964 16.6665 6.88768 16.6665 6.66667V5.83333H17.4998C17.7208 5.83333 17.9328 5.74554 18.0891 5.58926C18.2454 5.43298 18.3332 5.22101 18.3332 5C18.3332 4.77899 18.2454 4.56702 18.0891 4.41074C17.9328 4.25446 17.7208 4.16667 17.4998 4.16667H16.6665V3.33333C16.6665 3.11232 16.5787 2.90036 16.4224 2.74408C16.2661 2.5878 16.0542 2.5 15.8332 2.5C15.6122 2.5 15.4002 2.5878 15.2439 2.74408C15.0876 2.90036 14.9998 3.11232 14.9998 3.33333V4.16667H14.1665C13.9455 4.16667 13.7335 4.25446 13.5772 4.41074C13.421 4.56702 13.3332 4.77899 13.3332 5C13.3332 5.22101 13.421 5.43298 13.5772 5.58926C13.7335 5.74554 13.9455 5.83333 14.1665 5.83333ZM17.4998 9.16667C17.2788 9.16667 17.0669 9.25446 16.9106 9.41074C16.7543 9.56702 16.6665 9.77899 16.6665 10V15C16.6665 15.221 16.5787 15.433 16.4224 15.5893C16.2661 15.7455 16.0542 15.8333 15.8332 15.8333H4.1665C3.94549 15.8333 3.73353 15.7455 3.57725 15.5893C3.42097 15.433 3.33317 15.221 3.33317 15V7.00833L8.23317 11.9167C8.70192 12.3848 9.33733 12.6478 9.99984 12.6478C10.6623 12.6478 11.2978 12.3848 11.7665 11.9167L13.8248 9.85833C13.9818 9.70141 14.0699 9.48858 14.0699 9.26667C14.0699 9.04475 13.9818 8.83192 13.8248 8.675C13.6679 8.51808 13.4551 8.42992 13.2332 8.42992C13.0113 8.42992 12.7984 8.51808 12.6415 8.675L10.5832 10.7333C10.4274 10.886 10.218 10.9715 9.99984 10.9715C9.78171 10.9715 9.57228 10.886 9.4165 10.7333L4.50817 5.83333H10.8332C11.0542 5.83333 11.2661 5.74554 11.4224 5.58926C11.5787 5.43298 11.6665 5.22101 11.6665 5C11.6665 4.77899 11.5787 4.56702 11.4224 4.41074C11.2661 4.25446 11.0542 4.16667 10.8332 4.16667H4.1665C3.50346 4.16667 2.86758 4.43006 2.39874 4.8989C1.9299 5.36774 1.6665 6.00363 1.6665 6.66667V15C1.6665 15.663 1.9299 16.2989 2.39874 16.7678C2.86758 17.2366 3.50346 17.5 4.1665 17.5H15.8332C16.4962 17.5 17.1321 17.2366 17.6009 16.7678C18.0698 16.2989 18.3332 15.663 18.3332 15V10C18.3332 9.77899 18.2454 9.56702 18.0891 9.41074C17.9328 9.25446 17.7208 9.16667 17.4998 9.16667Z" fill="#999999"/>
                                    </svg>
                                    </div>
                                    <input type="email" name="email" id="email-address" autocomplete="email" required
                                        class="flex-1 bg-transparent outline-none border-none text-[#999999] text-sm font-medium font-primary-medium leading-normal placeholder:text-[#999999] mb-0"
                                        placeholder="Enter Your Email">
                                    <button type="submit" class="w-6 h-6 relative bg-transparent overflow-hidden flex items-center justify-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21.4274 2.5783C20.9274 2.0673 20.1874 1.8783 19.4974 2.0783L3.40742 6.7273C2.67942 6.9293 2.16342 7.5063 2.02442 8.2383C1.88242 8.9843 2.37842 9.9323 3.02642 10.3283L8.05742 13.4003C8.57342 13.7163 9.23942 13.6373 9.66642 13.2093L15.4274 7.4483C15.7174 7.1473 16.1974 7.1473 16.4874 7.4483C16.7774 7.7373 16.7774 8.2083 16.4874 8.5083L10.7164 14.2693C10.2884 14.6973 10.2084 15.3613 10.5234 15.8783L13.5974 20.9283C13.9574 21.5273 14.5774 21.8683 15.2574 21.8683C15.3374 21.8683 15.4274 21.8683 15.5074 21.8573C16.2874 21.7583 16.9074 21.2273 17.1374 20.4773L21.9074 4.5083C22.1174 3.8283 21.9274 3.0883 21.4274 2.5783Z" fill="white"/>
                                        <path opacity="0.4" d="M9.45139 19.1423C9.74339 19.4353 9.74339 19.9103 9.45139 20.2033L8.08539 21.5683C7.93939 21.7153 7.74739 21.7883 7.55539 21.7883C7.36339 21.7883 7.17139 21.7153 7.02539 21.5683C6.73239 21.2753 6.73239 20.8013 7.02539 20.5083L8.39039 19.1423C8.68339 18.8503 9.15839 18.8503 9.45139 19.1423ZM8.66769 15.3543C8.95969 15.6473 8.95969 16.1223 8.66769 16.4153L7.30169 17.7803C7.15569 17.9273 6.96369 18.0003 6.77169 18.0003C6.57969 18.0003 6.38769 17.9273 6.24169 17.7803C5.94869 17.4873 5.94869 17.0133 6.24169 16.7203L7.60669 15.3543C7.89969 15.0623 8.37469 15.0623 8.66769 15.3543ZM4.90649 14.1619C5.19849 14.4549 5.19849 14.9299 4.90649 15.2229L3.54049 16.5879C3.39449 16.7349 3.20249 16.8079 3.01049 16.8079C2.81849 16.8079 2.62649 16.7349 2.48049 16.5879C2.18749 16.2949 2.18749 15.8209 2.48049 15.5279L3.84549 14.1619C4.13849 13.8699 4.61349 13.8699 4.90649 14.1619Z" fill="white"/>
                                    </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- Notification will appear here -->
                        <div class="newsletter-notification mt-4"></div>
                    </div>
                    <div class="footer-menu xl:col-span-2 mt-12 xl:mt-0">
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                            <!-- First column -->
                            <div class="lg:col-span-1">
                                <h3 class="text-sm font-semibold leading-6 text-white">Solutions</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">Marketing</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">Analytics</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">Commerce</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">Insights</a>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Second column -->
                            <div class="lg:col-span-1">
                                <h3 class="text-sm font-semibold leading-6 text-white">Support</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Pricing</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">Documentation</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Guides</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">API
                                            Status</a>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Third column -->
                            <div class="lg:col-span-1">
                                <h3 class="text-sm font-semibold leading-6 text-white">Resources</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Help Center</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">Knowledge Base</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Tutorials</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">
                                            Community</a>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Fourth column -->
                            <div class="lg:col-span-1">
                                <h3 class="text-sm font-semibold leading-6 text-white">Company</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">About</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Blog</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Jobs</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Press</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="text-sm leading-6 text-gray-300 hover:text-white">Partners</a>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Fifth column -->
                            <div class="lg:col-span-1">
                                <h3 class="text-sm font-semibold leading-6 text-white">Legal</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Claim</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Privacy</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Terms</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="mt-16 border-t border-white/10 pt-8 sm:mt-20 md:flex md:items-center md:justify-between lg:mt-24">
                    <div class="flex space-x-6 md:order-2">
                        <a href="#" class="text-gray-500 hover:text-gray-400">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-400">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-400">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                </path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-400">
                            <span class="sr-only">GitHub</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-400">
                            <span class="sr-only">YouTube</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>

                    </div>
                    <p class="mt-8 text-xs leading-5 text-gray-400 md:order-1 md:mt-0">© 2020 Your Company, Inc. All
                        rights reserved.</p>
                </div>
            </div>
        </footer>
        
        <?php do_action('rela_estate_footer'); ?>
         <!-- #page -->
        <?php wp_footer(); ?>
        <?php do_action('rela_estate_site_after'); ?>
</body>
</html>