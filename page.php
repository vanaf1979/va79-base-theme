<?php
/* Exit on direct file access. */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );
?>

<!--
-- The page template is used when visitors request individual pages,
-- which are a built-in template.
-->

<?php get_template_part('parts/header'); ?>

<body <?php body_class(); ?>>

  <div id="app">

    <?php get_template_part('parts/nav'); ?>

    <h1>Page</h1>

    <?php get_template_part('parts/footer'); ?>

  </div>

  <?php wp_footer(); ?>

</body>

</html>