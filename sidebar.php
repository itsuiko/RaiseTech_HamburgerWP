<aside class="l-sidebar js-sidebar">
  <div class="p-sidebar js-sidebar">
    <button class="p-sidebar__btn c-button js-menu">
      <h2 class="p-sidebar__title">Menu</h2>
    </button>
    <nav class="p-sidebar__nav">

      <section class="p-sidebar__nav--bargur">
        <h3 class="p-sidebar__heading">バーガー</h3>
        <ul class="p-sidebar__menu">
          <?php
          wp_nav_menu([
            'theme_location' => 'sidebar_burger_menu',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'menu_class'     => '',
            'walker'         => new Sidebar_Menu_Walker(),
          ]);
          ?>
        </ul>
      </section>

      <section class="p-sidebar__nav--side">
        <h3 class="p-sidebar__heading">サイド</h3>
        <ul class="p-sidebar__menu">
          <?php
          wp_nav_menu([
            'theme_location' => 'sidebar_side_menu',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'menu_class'     => '',
            'walker'         => new Sidebar_Menu_Walker(),
          ]);
          ?>
        </ul>
      </section>

      <section class="p-sidebar__nav--drink">
        <h3 class="p-sidebar__heading">ドリンク</h3>
        <ul class="p-sidebar__menu">
          <?php
          wp_nav_menu([
            'theme_location' => 'sidebar_drink_menu',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'menu_class'     => '',
            'walker'         => new Sidebar_Menu_Walker(),
          ]);
          ?>
        </ul>
      </section>

    </nav>
  </div>
</aside>
