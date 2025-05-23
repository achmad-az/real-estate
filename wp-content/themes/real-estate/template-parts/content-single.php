<?php
/**
 * Template part for displaying single post content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    <div class="container">
        <div class="max-w-4xl mx-auto">
            <header class="entry-header">
                <?php if (has_post_thumbnail()): ?>
                    <div class="featured-image">
                        <?php the_post_thumbnail('full', ['class' => 'w-full h-auto img-fluid aspect-[3/2] ', 'loading' => 'lazy']); ?>
                    </div>
                <?php endif; ?>
                
                <h1 class="entry-title mt-8">
                    <?php the_title(); ?>
                </h1>

                <div class="entry-meta mb-4">
                    <span class="posted-on">
                        <?php echo get_the_date(); ?>
                    </span>
                    <span class="author">
                        <?php echo get_the_author(); ?>
                    </span>
                </div>
            </header>

            <div class="entry-content">
                <?php
                the_content();
                
                wp_link_pages([
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'real-estate'),
                    'after'  => '</div>',
                ]);
                ?>
            </div>

            <div class="entry-footer mb-8 pb-8">
                <?php
                $categories = get_the_category();
                if ($categories): ?>
                    <div class="category-links">
                        <?php
                        foreach ($categories as $category) {
                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="underline">' 
                                . esc_html($category->name) . ', </a>';
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <?php
                $tags = get_the_tags();
                if ($tags): ?>
                    <div class="tag-links">
                        <?php
                        foreach ($tags as $tag) {
                            echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">#' 
                                . esc_html($tag->name) . '</a>';
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>

<div class="container max-w-4xl">
    <?php
    // If comments are open or there's at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()):
        comments_template();
    endif;
    ?>
</div>