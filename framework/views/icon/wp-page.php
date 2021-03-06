<?php

// =============================================================================
// VIEWS/ICON/WP-PAGE.PHP
// -----------------------------------------------------------------------------
// Single page output for Icon.
// =============================================================================

get_header();

?>

  <div class="x-main full" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
      <?php x_get_view( 'icon', 'content', 'page' ); ?>
      <?php x_get_view( 'global', '_comments-template' ); ?>
    <?php endwhile; ?>

  </div>

  <?php get_sidebar(); ?>
<?php get_footer(); ?>
