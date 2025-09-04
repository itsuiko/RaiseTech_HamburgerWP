<?php get_header(); ?>
        <main class="l-main">
            <div class="p-main">
            <div class="p-mainvisual">
                <div class="p-mainvisual__img"></div>
                <h2 class="p-mainvisual__heading">ダミーサイト</h2>
            </div>

            <?php
                $page = get_page_by_path('foodchoices');
                $page_id = $page ? $page->ID : null;

                $takeout_text_1 = get_field('takeout_text_1', $page_id);
                $takeout_text_2 = get_field('takeout_text_2', $page_id);
                $eatin_text_1   = get_field('eatin_text_1', $page_id);
                $eatin_text_2   = get_field('eatin_text_2', $page_id);
            ?>


            <article class="p-contents">
                <?php
                $takeout_link = get_category_link(get_category_by_slug('takeout')->term_id);
                $eatin_link = get_category_link(get_category_by_slug('eatin')->term_id);
                ?>

                <a href="<?php echo esc_url($takeout_link); ?>" class="p-content__link-wrapper">
                    <div class="p-content p-content--takeout">
                        <h2 class="p-content__heading">Take Out</h2>
                        <div class="p-content__text-block">
                            <?php
                            RaiseTech_Hamburger_render_textbox('Take OUT', $takeout_text_1);
                            RaiseTech_Hamburger_render_textbox('Take OUT', $takeout_text_2);
                            ?>
                        </div>
                    </div>
                </a>
                <a href="<?php echo esc_url($eatin_link); ?>" class="p-content__link-wrapper">
                    <div class="p-content p-content--eatin">
                        <h2 class="p-content__heading">Eat In</h2>
                        <div class="p-content__text-block">
                            <?php
                            RaiseTech_Hamburger_render_textbox('Eat In', $eatin_text_1);
                            RaiseTech_Hamburger_render_textbox('Eat In', $eatin_text_2);
                            ?>
                        </div>
                    </div>
                </a>
            </article>
            <?php
                $map_page = get_page_by_path('map');
                $map_id = $map_page ? $map_page->ID : null;
                $map_iframe = get_field('location_map', $map_id);
                $map_title  = get_field('location_title', $map_id);
                $map_text   = get_field('location_text', $map_id);
            ?>

            <section class="p-location">
                <?php if ($map_iframe): ?>
                    <div class="p-location__map">
                        <?php
                            $map_iframe = str_replace('<iframe', '<iframe class="p-location__map"', $map_iframe);
                            echo wp_kses($map_iframe, ['iframe' => [
                            'src' => true, 'width' => true, 'height' => true,
                            'frameborder' => true, 'allowfullscreen' => true, 'class' => true
                            ]]);
                        ?>
                    </div>
                <?php endif; ?>

                <div class="p-location__textbox">
                    <?php if ($map_title): ?>
                        <h2 class="p-location__textbox-title"><?php echo esc_html($map_title); ?></h2>
                    <?php endif; ?>
                    <?php if ($map_text): ?>
                        <p class="p-location__textbox-text"><?php echo esc_html($map_text); ?></p>
                    <?php endif; ?>
                </div>
            </section>
            </div>
        </main>
        <?php get_sidebar(); ?>
        <div class="p-overlay"></div>    
        <?php get_footer(); ?>