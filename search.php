<?php
/* Exit on direct file access. */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );
?>

<!--
-- The search results template is used to display a visitor’s search results.
-->

<?php get_template_part('parts/header'); ?>

<body <?php body_class(); ?>>

  <div id="app">

    <?php get_template_part('parts/nav'); ?>

    <h1>Search</h1>

    <?php get_template_part('parts/footer'); ?>

  </div>

  <?php wp_footer(); ?>

</body>

</html>