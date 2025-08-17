<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="icon" type="image/png" href="images/favicon.png">

        <?php wp_head(); ?>

</head>
<body>
    <div class="c-grid">
        <header class="l-header">
            <div class="p-header">
            <h1 class="p-logo">
                <a href="<?php echo esc_url(home_url('/'));?>"><?php bloginfo('name'); ?></a>
            </h1>
            <?php get_search_form(); ?>
            <button class="p-menubutton c-button js-menu">
                <span>Menu</span>
            </button>
            </div>    
        </header>