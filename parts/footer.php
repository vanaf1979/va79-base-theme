<!--
-- For generating the footer
-->


<div class="footer va-grid-full">

	<div class="pure-g va-grid-center">

		<div class="pure-u-1 pure-u-sm-1-2 pure-u-md-1-4 pure-u-lg-1-4 pure-u-xl-1-4">

			<?php
			if ( is_active_sidebar( 'footer_area_one' ) )
			{
			?>
				<section class="footer-area footer-area-one">

					<?php dynamic_sidebar( 'footer_area_one' ); ?>

				</section>
			<?php
			}
			?>

		</div>

		<div class="pure-u-1 pure-u-sm-1-2 pure-u-md-1-4 pure-u-lg-1-4 pure-u-xl-1-4">

			<?php
			if ( is_active_sidebar( 'footer_area_two' ) )
			{
			?>
				<section class="footer-area footer-area-two">

					<?php dynamic_sidebar( 'footer_area_two' ); ?>

				</section>
			<?php
			}
			?>

		</div>

		<div class="pure-u-1 pure-u-sm-1-2 pure-u-md-1-4 pure-u-lg-1-4 pure-u-xl-1-4">

			<?php
			if ( is_active_sidebar( 'footer_area_three' ) )
			{
			?>
				<section class="footer-area footer-area-three">

					<?php dynamic_sidebar( 'footer_area_three' ); ?>

				</section>
			<?php
			}
			?>

		</div>

		<div class="pure-u-1 pure-u-sm-1-2 pure-u-md-1-4 pure-u-lg-1-4 pure-u-xl-1-4">

			<?php
			if ( is_active_sidebar( 'footer_area_four' ) )
			{
			?>
				<section class="footer-area footer-area-four">

					<?php dynamic_sidebar( 'footer_area_four' ); ?>

				</section>
			<?php
			}
			?>

		</div>

	</div>

</div>