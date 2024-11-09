<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage FSVBASIC
 * @since FSVBASIC 1.1
 */
?>

<div id="main-footer" class="footer-copy-area" role="contentinfo">

<div class="component-inner">

<p class="footer-copy">
<?php

$options = fsvbasic_get_theme_options();

if ( !isset( $options[ 'foot_text' ] ) ) { $opFootText = 'Copyright'; }
else { $opFootText = $options[ 'foot_text' ]; }

echo nl2br( $opFootText );

?>
</p><!-- .footer-copy -->

</div><!-- .component-inner -->

</div><!-- #colophon -->

</div><!-- #page -->

</div><!-- #layout -->

<?php wp_footer(); ?>

</body>
</html>
