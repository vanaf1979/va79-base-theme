<?php
/* Exit on direct file access. */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );
?>

<!--
-- The home page template is the front page by default.
-- If you do not set WordPress to use a static front page,
-- this template is used to show latest posts.
-->

<?php get_template_part('parts/header'); ?>

<body <?php body_class(); ?>>

  <div id="app">

    <?php get_template_part('parts/nav'); ?>

    <h1>Home</h1>

    <?php get_template_part('parts/footer'); ?>

  </div>

  <?php wp_footer(); ?>

</body>

</html>