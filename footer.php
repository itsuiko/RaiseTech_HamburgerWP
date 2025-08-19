<footer class="l-footer">
            <div class="p-footer">
            <?php
            if ( has_nav_menu( 'footer_nav' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'footer_nav',
                    'container' => false,
                    'menu_class' => 'p-footer__menu',
                ) );
            } else {
            ?>    
            <div class="p-footer__menu">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="p-footer__menu-link">ショップ情報</a>
                    
                <span class="p-footer__menu-link--line" aria-hidden="true"></span>
                    
                <a href="<?php echo esc_url(home_url('/')); ?>" class="p-footer__menu-link">ヒストリー</a>
            </div>
            <?php } ?>
            
            <small class="p-footer__copy">Copyright: RaiseTech</small>
            </div>
        </footer>
    </div>

<?php wp_footer(); ?>
</body>
</html>