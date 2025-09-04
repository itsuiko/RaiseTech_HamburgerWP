<?php get_header(); ?>

<main class="l-main">

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <h2 >
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <?php echo esc_html(get_the_title()); ?>
                    </a>
                </h2>

                <div class="p-post__excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </article>
        <?php endwhile; ?>

        <nav class="p-pagination">
            <?php the_posts_pagination([
                'mid_size' => 2,
                'prev_text' => '« 前へ',
                'next_text' => '次へ »',
            ]); ?>
        </nav>

    <?php else : ?>
        <p class="p-404__message">投稿が見つかりませんでした。</p>
    <?php endif; ?>

</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>