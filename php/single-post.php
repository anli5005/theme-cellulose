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
			<h3 class="entry-title"><a href="<?php echo( esc_url( get_permalink() ) ); ?>"><?php the_title(); ?></a></h3>
			<div class="entry-details">
				<div class="entry-author">
					<i class="material-icons" aria-hidden="true">&#xE853; </i>
					<span class="screen-reader-only">Author: </span>
					<?php the_author(); ?>
				</div>
				<div class="entry-date">
					<i class="material-icons" aria-hidden="true">event </i>
					<span class="screen-reader-only">Date Published: </span>
					<?php echo( get_the_date() ); ?>
				</div>
			</div>
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