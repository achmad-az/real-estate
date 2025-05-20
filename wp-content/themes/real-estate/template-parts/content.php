<!-- Tambahkan break-inside-avoid untuk mencegah elemen terpecah -->
<div class="break-inside-avoid bg-white shadow-md rounded-lg overflow-hidden p-5 transition-all duration-300 hover:shadow-lg">
    <a class="block no-underline" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
        <figure class="post-thumbnail relative bg-[--theme-img-vid-color] w-full aspect-[3/2]">
            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('medium', ['loading' => 'lazy', 'class' => 'img-fluid w-full h-full', 'alt' => esc_attr(get_the_title())]); ?>
            <?php endif; ?>
        </figure>
    </a>
    <div class="p-4">
        <h4 class="typography-h4 text-[--theme-text-fth-color] line-clamp-2 mb-4">
            <a class="block no-underline hover:underline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h4>
        <p class="text-[--theme-text-scd-color] text-sm mb-4">
            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
        </p>
        <div class="flex justify-between items-center">
            <span class="text-[--theme-text-scd-color] text-sm">
                <?php echo rela_estate_get_reading_time(get_the_content()); ?> min read
            </span>
            <a href="<?php the_permalink(); ?>" class="bg-[--theme-primary-color] px-4 py-2 rounded hover:bg-opacity-90">
                Read Now
            </a>
        </div>
    </div>
</div>