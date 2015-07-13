<?php

get_header();

?>

<div class="main" id="#content">
	
<?php

if ( have_posts() ):
	
	while ( have_posts() ): 
	the_post(); ?>
	<article <?php post_class(); ?>>
		<header class="entry-header">
			<h2 class="entry-title"><?php the_title(); ?></h3>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article>
	<?php endwhile;
	
endif;

?>

</div>

<?php

get_footer();

?>