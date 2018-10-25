

	 <?php cryptoking_pagination(); ?> 
        <?php $args = array(
                    'base'         => '%_%',
                    'format'       => '?page=%#%',
                    'total'        => 1,
                    'current'      => 0,
                  );
        ?>

     <?php echo paginate_links( $args ) ?> 