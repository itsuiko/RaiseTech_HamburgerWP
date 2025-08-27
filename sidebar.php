<aside class="l-sidebar js-sidebar">
  <div class="p-sidebar js-sidebar">
    <button class="p-sidebar__btn c-button js-menu">
      <h2 class="p-sidebar__title">Menu</h2>
    </button>
    <nav class="p-sidebar__nav">

      
        <?php
        if (has_nav_menu('sidebar_menu')) {
          wp_nav_menu(array(
            'theme_location' => 'sidebar_menu',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'walker'         => new Sidebar_Menu_Walker(),
          ));
        }
        ?>
      

    </nav>
  </div>
</aside>
