<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dustin_Leer
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info wrapper">
			<div class="copyright">
				Copyright &copy; <?php echo date("Y"); ?><span class="sep"> | </span> <a href="/">dustinleer.com</a> <span class="sep"> | </span>All manner of riff raff will be tarred and feathered.
			</div>
			
			<?php dustinleer_social_icons(); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
