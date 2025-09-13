<?php

// ------------------------------
// テーマのセットアップ
// ------------------------------

function RaiseTech_Hamburger_theme_setup() {

  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'wp-block-styles' );
  add_theme_support( 'align-wide' );
  add_theme_support( 'responsive-embeds' );
  add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
  ) );
  add_theme_support( 'custom-background', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) );

  register_nav_menus(array(
    'footer_menu'   => esc_html__('フッターメニュー', 'raisetech-hamburger'),
    'sidebar_menu'   => esc_html__('サイドバーメニュー', 'raisetech-hamburger'),
  ));
}
add_action('after_setup_theme','RaiseTech_Hamburger_theme_setup');

// ------------------------------
// Footer Nav Walker
// ------------------------------

class Footer_Nav_Walker extends Walker_Nav_Menu {
  public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
    $title = esc_html($item->title);
    $url = esc_url($item->url);
    $output .= '<a href="' . $url . '" class="p-footer__menu-link">' . $title . '</a>';
  }

  public function end_el(&$output, $item, $depth = 0, $args = []) {
    // 安全にメニューのカウントをチェックして区切り線を出力
    if (isset($args->menu) && is_object($args->menu) && isset($args->menu->count) && $item->menu_order < $args->menu->count) {
      $output .= '<span class="p-footer__menu-link--line"></span>';
    }
  }
}

// ------------------------------
// Sidebar Menu Walker
// ------------------------------

class Sidebar_Menu_Walker extends Walker_Nav_Menu {
  public function start_lvl(&$output, $depth = 0, $args = array()) {
    if ($depth === 0) {
      $output .= '<ul class="p-sidebar__menu">';
    }
  }
  public function end_lvl(&$output, $depth = 0, $args = array()) {
    if ($depth === 0) {
      $output .= '</ul></section>';
    }
  }
  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $title = esc_html($item->title);
    $url = esc_url($item->url);
    if ($depth === 0) {
      $output .= '<section class="p-sidebar__nav--box">';
      $output .= '<h3 class="p-sidebar__heading"><a href="' . $url . '">' . $title . '</a></h3>';
    } else {
      $output .= '<li class="p-sidebar__list"><a href="' . $url . '">' . $title . '</a></li>';
    }
  }
  public function end_el(&$output, $item, $depth = 0, $args = array()) {}
}

// ------------------------------
// CSS・JSの読み込み
// ------------------------------
function RaiseTech_Hamburger_enqueue_assets() {

  wp_enqueue_style(
    'google-fonts',
    'https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@400;700&family=Roboto:ital,wght@0,700;1,700&display=swap',
    array(),
    null
  );

  // preconnect はヘッドに出す。ただし重複を避けるため条件化（簡易）
  add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
  });

  // style.css がビルド済みであればファイルタイムでバージョン付与
  $style_path = get_template_directory() . '/css/style.css';
  $style_version = file_exists($style_path) ? filemtime($style_path) : '1.0.0';

  wp_enqueue_style(
    'theme-style',
    get_template_directory_uri() . '/css/style.css',
    array(),
    $style_version
  );

  // main.js もファイルタイムでキャッシュバースト
  $script_path = get_template_directory() . '/js/main.js';
  $script_version = file_exists($script_path) ? filemtime($script_path) : '1.0.0';

  wp_enqueue_script(
    'main-js',
    get_template_directory_uri() . '/js/main.js',
    array(),
    $script_version,
    true
  );

}
add_action('wp_enqueue_scripts', 'RaiseTech_Hamburger_enqueue_assets');

// 検索リライトルールの修正（$matches を正しく使う）
function custom_search_rewrite_rule() {
    add_rewrite_rule(
        '^search/([^/]+)/?$',
        'index.php?s=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_search_rewrite_rule');

// Archive ACF source helper
function get_archive_acf_source() {
  if (is_category() || is_tax()) {
    return get_queried_object();
  } elseif (is_post_type_archive()) {
    $slug = get_post_type();
    $page = get_page_by_path($slug);
    return $page ? $page->ID : null;
  }
  return null;
}

// 共通: 本文から最初の見出しを取得（なければタイトルを返す）
function rth_get_first_heading_text($post_content = '', $fallback_title = '') {
  if (empty($post_content)) {
    return $fallback_title;
  }
  if (preg_match('/<h[1-6][^>]*>(.*?)<\/h[1-6]>/si', $post_content, $matches)) {
    return wp_strip_all_tags($matches[1]);
  }
  return $fallback_title;
}

// 共通: 本文から見出しを除去してトリムした抜粋を取得
function rth_get_trimmed_excerpt_from_content($post_content = '', $words = 60) {
  if (empty($post_content)) {
    return '';
  }
  // 見出しタグを除去
  $content = preg_replace('/<h[1-6][^>]*>.*?<\/h[1-6]>/si', '', $post_content);
  // すべてのタグを除去して単語数で切る
  $text = wp_strip_all_tags($content);
  return wp_trim_words($text, $words);
}

// テキストボックスレンダリングはそのまま（安全化）
function RaiseTech_Hamburger_render_textbox($title, $text, $modifier = '') {
    if (!$text) return;
    $class = 'c-textbox--brown p-textbox' . ($modifier ? " {$modifier}" : '');
    ?>
    <dl class="<?php echo esc_attr($class); ?>">
        <dt class="p-textbox__title"><?php echo esc_html($title); ?></dt>
        <dd class="p-textbox__text"><?php echo esc_html($text); ?></dd>
    </dl>
    <?php
}

// ACF block / block style / pattern 登録（既存ロジック）
function RaiseTech_Hamburger_register_acf_block_types() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'custom-block',
            'title'             => __('Custom Block', 'raisetech-hamburger'),
            'description'       => __('A custom block.', 'raisetech-hamburger'),
            'render_template'   => 'template-parts/blocks/custom-block.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array('custom', 'block'),
        ));
    }
}
add_action('acf/init', 'RaiseTech_Hamburger_register_acf_block_types');

function RaiseTech_Hamburger_register_block_styles() {
    register_block_style(
        'core/paragraph',
        array(
            'name'  => 'highlight',
            'label' => __('Highlight', 'raisetech-hamburger'),
        )
    );
}
add_action('init', 'RaiseTech_Hamburger_register_block_styles');

function RaiseTech_Hamburger_register_block_patterns() {
    if (function_exists('register_block_pattern')) {
        register_block_pattern(
            'raisetech-hamburger/two-column-text',
            array(
                'title'       => __('Two Column Text', 'raisetech-hamburger'),
                'description' => __('A two column text layout.', 'raisetech-hamburger'),
                'content'     => '<!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><p>Column 1 content...</p></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><p>Column 2 content...</p></div><!-- /wp:column --></div><!-- /wp:columns -->',
            )
        );
    }
}
add_action('init', 'RaiseTech_Hamburger_register_block_patterns');


?>