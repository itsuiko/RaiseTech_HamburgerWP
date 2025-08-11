<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DummyHambugerSite</title>
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link href="./css/style.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@400;700&family=Roboto:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
        <script src="js/main.js" defer></script>
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