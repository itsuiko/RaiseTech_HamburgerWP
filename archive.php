<?php get_header(); ?>
        <main class="l-main">
            <div class="p-main">
                <div class="p-mainvisual--archivesearch">
                    <div class="p-mainvisual__img--archive"></div>
                    <h1 class="p-mainvisual__heading--archive">
                        <span class="p-mainvisual__heading--archive-title">Menu:</span>
                        <span class="p-mainvisual__heading--archive-type"><?php echo esc_html( get_the_archive_title() ); ?></span>
                    </h1>    
                </div>
                <aside class="c-textbox--brown p-textbox--archive">
                    <?php
                    $desc = function_exists('get_the_archive_description') ? get_the_archive_description() : '';
                    if ( $desc ) {
                        echo '<h2 class="p-textbox__title--archive">' . wp_kses_post( $desc ) . '</h2>';
                    } else {
                        // サイトのキャッチや固定テキストを代わりに表示
                        echo '<h2 class="p-textbox__title--archive">' . esc_html( get_bloginfo('description') ) . '</h2>';
                        echo '<p class="p-textbox__text">このアーカイブに関する補足説明が入ります。</p>';
                    }
                    ?>
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

                <div class="p-pagination--mobile">
                            <div class="p-pagination__previous"><?php previous_posts_link('« 前へ'); ?></div>
                            <div class="p-pagination__next"><?php next_posts_link('次へ »'); ?> </div>
                        </div>
    

                        <?php if (function_exists('wp_pagenavi')) : ?>
                            <?php wp_pagenavi(); ?>

                <?php else : ?>
                    <div class="p-no-results">
                        <p>該当する投稿はありません。</p>
                    </div>
                <?php endif; ?>

            </div>
        </main>
        <?php get_sidebar(); ?>
        <div class="p-overlay"></div>    
        <?php get_footer(); ?>