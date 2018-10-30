<?php
/*!
Theme Name:         Va79 Base theme
Theme URI:          https://npo.vanaf1979.nl/
Description:        A base WordPress theme.
Version:            1.0.0
Author:             Vanaf1979
Author URI:         https://vanaf1979.nl
Text Domain:        va79-base-theme
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

/*
* Setting up required plugins installation.
*/
// require_once get_template_directory() . '/functions/tgmpa/class-tgm-plugin-activation.php';


/*
* Setting up teh base theme funtions.
*/
$theme;

require_once get_template_directory() . '/functions/va79/va79-theme-class.php';

function run_theme()
{
	$theme_class = new Theme();
}

run_theme();

?>
