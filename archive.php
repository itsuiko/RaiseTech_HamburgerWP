<?php get_header(); ?>
        <main class="l-main">
            <div class="p-main">
                <div class="p-mainvisual--archivesearch">
                    <div class="p-mainvisual__img--archive"></div>
                    <h1 class="p-mainvisual__heading--archive">
                        <span class="p-mainvisual__heading--archive-title">Menu:</span>
                        <span class="p-mainvisual__heading--archive-type"><?php echo esc_html( single_cat_title( '', false ) ); ?></span>
                    </h1>    
                </div>
                
                <?php
                $acf_source = get_archive_acf_source();
                $about_title = get_field('about_title', $acf_source);
                $about_text  = get_field('about_text', $acf_source);
                ?>

                <?php if ($about_title || $about_text): ?>
                    <aside class="c-textbox--brown p-textbox--archive">
                        <?php if ($about_title): ?>
                            <h2 class="p-textbox__title p-textbox__title--archive"><?php echo esc_html($about_title); ?></h2>
                        <?php endif; ?>
                        <?php if ($about_text): ?>
                            <p class="p-textbox__text"><?php echo nl2br(esc_html($about_text)); ?></p>
                        <?php endif; ?>
                    </aside>
                <?php endif; ?>



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
                                    <?php the_title(); ?>
                                </h2>

                                <h3 class="p-card__heading">
                                    <?php
                                    $content = get_the_content();
                                    if ( preg_match( '/<h[1-6][^>]*>(.*?)<\/h[1-6]>/', $content, $matches ) ) {
                                        echo esc_html( $matches[1] ); // 最初の見出しのテキストだけ
                                    } else {
                                        echo esc_html( get_the_title() ); // 見出しがなければタイトルを代用
                                    }
                                    ?>

                                </h3>

                                <p class="p-card__text">
                                    <?php
                                    $content = get_the_content();
                                    // 見出しタグを除去
                                    $content = preg_replace( '/<h[1-6][^>]*>.*?<\/h[1-6]>/', '', $content );
                                    // 残りの本文を整形
                                    $text = wp_strip_all_tags( $content );
                                    echo esc_html( wp_trim_words( $text, 60 ) );
                                    ?>

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
                        <?php endif; ?>
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