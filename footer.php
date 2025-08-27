<footer class="l-footer">
            <div class="p-footer">  
                <div class="p-footer__menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer_menu',
                        'container'      => false,
                        'menu_class'     => '',
                        'items_wrap'     => '%3$s',
                        'menu'           => wp_get_nav_menu_object('footer-menu'),
                        'walker'         => new Footer_Nav_Walker(),
                    ));
                    ?>
                </div>    
                <small class="p-footer__copy">Copyright: RaiseTech</small>
            </div>
        </footer>
    </div>

<?php wp_footer(); ?>
</body>
</html>