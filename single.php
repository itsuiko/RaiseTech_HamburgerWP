<?php get_header(); ?>

<main class="l-main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class(); ?>>
            <div class="p-mainvisual--singlepage">
                <?php
                $image_url = has_post_thumbnail()
                    ? get_the_post_thumbnail_url(get_the_ID(), 'full')
                    : get_template_directory_uri() . '/images/single-top.jpg';
                ?>
                <div class="p-mainvisual__img--single" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
                <h1 class="p-mainvisual__heading--singlepage"><?php echo esc_html(get_the_title()); ?></h1>
            </div>

            <div class="c-contents p-contents--singlepage">
                <div class="p-textbox--singlepage">
                    <?php the_content(); ?>

                    <?php
                    wp_link_pages( array(
                        'before' => '<div class="page-links"><span>ページ:</span>',
                        'after'  => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ) );
                    ?>


                </div>

            </div>
        </article>

    <?php endwhile; endif; ?>
</main>

<?php get_sidebar(); ?>
<div class="p-overlay"></div>
<?php get_footer(); ?>