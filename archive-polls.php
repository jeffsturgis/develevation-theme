<?php /* Template Name: Post Archive Tempalte */ 

get_header();  ?>

<?php get_template_part('template-part', 'head'); ?>

<?php get_template_part('template-part', 'topnav'); ?>
<div class="container">
	<div class="col-md-12">
		<div class="well">
			<header class="page-header">
					<h1 class="page-title">Polls</h1>
			</header>
		
			<div class="row">
				
		
				<?php
				$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
  
				$args = array( 'post_type' => 'polls', 'posts_per_page' => 9, 'paged' => $paged );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					echo "<div class='col-md-4'>";
					echo "<h3>";
					?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a>
					<?php
					echo "</h3>";
					echo '<div class="entry-content">';
					the_excerpt();
					?>
					
					<?php
					echo '</div>';
					echo '</div>';
				  endwhile;
				?>
				
		
				
			</div><!-- #primary -->
			<div class="row">
				<div class="col-md-12">
					<?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
					<nav class="prev-next-posts">
					  <div class="prev-posts-link">
						<?php echo get_next_posts_link( 'Older Entries', $the_query->max_num_pages ); // display older posts link ?>
					  </div>
					  <div class="next-posts-link">
						<?php echo get_previous_posts_link( 'Newer Entries' ); // display newer posts link ?>
					  </div>
					</nav>
				  <?php } ?>
				</div>
			</div>
		</div>
	</div>
	
</div><!-- .wrap -->

<?php get_footer();
