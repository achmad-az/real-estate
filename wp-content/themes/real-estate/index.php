<?php

get_header(null, ['header_style' => 'dark']);

?>
<div class="theme-dark bg-[--theme-bg-content-color] w-full">
    <div class="container-content h-full py-12">
		<section class="flex flex-col gap-y-16 sm:gap-y-6 w-full mt-8">
			<?php
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => 9,
				'paged'          => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
			);

			$query = new WP_Query( $args );
			if ( $query->have_posts() ) : ?>
				<div class="post-list">
					<h1 class="text-white font-semibold">Discover More</h1>
					<div class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-10">
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
						<?php endwhile; ?>
					</div>
				</div>
				<div class="pagination text-center text-white text-2xl text-semibold">
					<?php
					previous_posts_link( '&laquo; Previous' );
					next_posts_link( 'Next &raquo;', $query->max_num_pages );
					?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p class="text-[--theme-text-content-color] text-center"><?php esc_html_e( 'No posts found.', 'real-estate' ); ?></p>
			<?php endif; ?>
		</section>
    </div>
</div>

<?php get_footer(null, ['footer_style' => 'dark']); ?>
