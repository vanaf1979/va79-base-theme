<?php
/* Exit on direct file access. */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );
?>

<!--
-- The front page template is always used as the site front page if it exists,
-- regardless of what settings on Admin > Settings > Reading.
-->

<?php get_template_part('parts/header'); ?>

<body <?php body_class(); ?>>

  <div id="app">

    <?php get_template_part('parts/nav'); ?>

    <h1>Front page</h1>

    <?php get_template_part('parts/footer'); ?>

  </div>

  <?php get_template_part('parts/mobilemenu'); ?>

  <?php wp_footer(); ?>

</body>

</html>