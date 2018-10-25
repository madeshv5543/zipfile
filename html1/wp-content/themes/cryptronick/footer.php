        </div>
	</div>
	<?php
		get_template_part('templates/section', 'footer');
		
		if(Cryptronick_Theme_Helper::get_option('back_to_top') == '1'){
			echo "<a href='#' id='back_to_top'></a>";
		}
		?>
    <?php 		
		wp_footer();
    ?>    
</body>
</html>