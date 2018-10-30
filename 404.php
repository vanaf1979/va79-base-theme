<?php
/* Exit on direct file access. */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );
?>

<!--
-- The 404 template is used when WordPress cannot find a post,
-- page, or other content that matches the visitor’s request.
-->

<?php get_template_part('parts/header'); ?>

<body <?php body_class(); ?>>

  <div id="app">

    <?php get_template_part('parts/nav'); ?>

    <h1>404</h1>

    <?php get_template_part('parts/footer'); ?>

  </div>

  <?php wp_footer(); ?>

</body>

</html>