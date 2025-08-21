<?php get_header(); ?>
<main class="l-main">
    <div class="p-main">
        <div class="p-mainvisual--archivesearch">
            <div class="p-mainvisual__img--archive"></div>
            <h1 class="p-mainvisual__heading--archive">
                <span class="p-mainvisual__heading--archive-title">Search:</span>
                <span class="p-mainvisual__heading--archive-type"><?php echo esc_html( get_search_query() ); ?></span>
            </h1>
        </div>

        <aside class="c-textbox--brown p-textbox--archive">
            <h2 class="p-textbox__title--archive">
                <?php
                global $wp_query;
                $count = isset( $wp_query ) ? (int) $wp_query->found_posts : 0;
                echo esc_html( sprintf( '%d 件の結果', $count ) );
                ?>
            </h2>
            <p class="p-textbox__text">検索結果を表示します。</p>
        </aside>

        <?php if ( have_posts() ) : ?>
            <div class="p-archive-list">
                <?php while ( have_posts() ) : the_post(); ?>
                    <figure class="p-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'medium', array( 'class' => 'p-card__img', 'alt' => get_the_title() ) ); ?>
                        <?php else : ?>
                            <img src="<?php echo esc_url( get_theme_file_uri( 'images/archive.jpg' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="p-card__img">
                        <?php endif; ?>

                        <figcaption class="p-card__textbox">
                            <h2 class="p-card__type">
                                <?php
                                $cats = get_the_category();
                                if ( ! empty( $cats ) ) {
                                    echo esc_html( $cats[0]->name );
                                }
                                ?>
                            </h2>

                            <h3 class="p-card__heading">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <p class="p-card__text">
                                <?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 25 ) ); ?>
                            </p>

                            <a class="p-card__link" href="<?php the_permalink(); ?>">詳しく見る</a>
                        </figcaption>
                    </figure>
                <?php endwhile; ?>
            </div>

            <div class="p-pagination">
                <?php the_posts_pagination( array(
                    'mid_size'  => 1,
                    'prev_text' => '≪',
                    'next_text' => '≫',
                    'screen_reader_text' => '検索結果ナビゲーション',
                ) ); ?>
            </div>

        <?php else : ?>
            <div class="p-no-results">
                <p>検索結果は見つかりませんでした。</p>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php get_sidebar(); ?>
<div class="p-overlay"></div>
<?php get_footer(); ?>
