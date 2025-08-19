<?php

function RaiseTech_Hamburger_theme_setup() {
  // タイトルタグ
  add_theme_support( 'title-tag' );

  // メニューを有効化
  add_theme_support( 'menus' );

  // アイキャッチ画像
  add_theme_support( 'post-thumbnails' );

  // HTML5
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

  register_nav_menus(array(
    'footer_nav'   => esc_html__('フッターのナビゲーション', 'RaiseTech_Hamburger'),
    'sidebar_menu' => esc_html__('サイドバーのメニュー', 'RaiseTech_Hamburger'),
    )
  );
}
add_action('after_setup_theme','RaiseTech_Hamburger_theme_setup');

// ------------------------------
// 2. CSS・JSの読み込み
// ------------------------------
function RaiseTech_Hamburger_enqueue_assets() {
  // Google Fonts の読み込み
  wp_enqueue_style(
    'google-fonts',
    'https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@400;700&family=Roboto:ital,wght@0,700;1,700&display=swap',
    array(),
    null
  );

  // Google Fonts の preconnect（高速化）
  add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
  });

  // style.css の読み込み
  $style_path = get_template_directory() . '/css/style.css';
  wp_enqueue_style(
    'theme-style',
    get_template_directory_uri() . '/css/style.css',
    array(),
    file_exists($style_path) ? filemtime($style_path) : null
  );

  // main.js の読み込み（defer 相当）
  $js_path = get_template_directory() . '/js/main.js';
  wp_enqueue_script(
    'main-js',
    get_template_directory_uri() . '/js/main.js',
    array(),
    file_exists($js_path) ? filemtime($js_path) : null,
    true
  );

}
add_action('wp_enqueue_scripts', 'RaiseTech_Hamburger_enqueue_assets');

?>