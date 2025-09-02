<?php get_header(); ?>

<main class="l-main">
  <section class="p-404">
    <div class="p-404__box">
      <h1 class="p-404__title">404 Not Found</h1>
      <p class="p-404__message">お探しのページは見つかりませんでした。</p>
      <a href="<?php echo esc_url(home_url()); ?>" class="p-404__link">トップページへ戻る</a>
    </div>
  </section>
</main>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>