<?php

// ------------------------------
// テーマのセットアップ
// ------------------------------

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
    'footer_menu'   => esc_html__('フッターメニュー', 'RaiseTech_Hamburger'),
    'sidebar_menu'   => esc_html__('サイドバーメニュー', 'RaiseTech_Hamburger'),
  ));
}
add_action('after_setup_theme','RaiseTech_Hamburger_theme_setup');

// ------------------------------
// Footer Nav Walker
// ------------------------------

class Footer_Nav_Walker extends Walker_Nav_Menu {
  public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
    $output .= '<a href="' . esc_url($item->url) . '" class="p-footer__menu-link">';
    $output .= esc_html($item->title);
    $output .= '</a>';
  }

  public function end_el(&$output, $item, $depth = 0, $args = []) {
  // 最後のメニュー項目でなければ区切り線を出力
  if (isset($args->menu) && $item->menu_order < $args->menu->count) {
  $output .= '<span class="p-footer__menu-link--line"></span>';
  }
}

}
// ------------------------------
// Sidebar Menu Walker
// ------------------------------

class Sidebar_Menu_Walker extends Walker_Nav_Menu
{
  function start_lvl(&$output, $depth = 0, $args = array())
  {
    if ($depth === 0) {
      $output .= '<ul class="p-sidebar__menu">';
    }
  }
  function end_lvl(&$output, $depth = 0, $args = array())
  {
    if ($depth === 0) {
      $output .= '</ul></section>';
    }
  }
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {
    if ($depth === 0) {
      $output .= '<section class="p-sidebar__nav--box">';
      $output .= '<h3 class="p-sidebar__heading"><a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a></h3>';
    } else {
      $output .= '<li class="p-sidebar__list"><a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a></li>';
    }
  }
  function end_el(&$output, $item, $depth = 0, $args = array()) {}
}

// ------------------------------
// CSS・JSの読み込み
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
  wp_enqueue_style(
    'theme-style',
    get_template_directory_uri() . '/css/style.css',
    array(),
    '1.0.0'
  );

  // main.js の読み込み（defer 相当）
  wp_enqueue_script(
    'main-js',
    get_template_directory_uri() . '/js/main.js',
    array(),
    '1.0.0',
    true
  );

}
add_action('wp_enqueue_scripts', 'RaiseTech_Hamburger_enqueue_assets');

?>