</div></div>
<footer id="dt_footer" class="dt_footer dt_footer--two dark clearfix">
	<?php 	
		// Footer Widget
		do_action('ploto_footer_widget');

		// Footer Copyright
		do_action('ploto_footer_bottom'); 	
	?>
</footer>
<?php 
	// Top Scroller
	do_action('ploto_top_scroller');
?>
<?php 
wp_footer(); ?>
</body>
</html>
