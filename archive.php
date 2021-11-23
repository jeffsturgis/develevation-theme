<?php /* Template Name: Post Archive Tempalte */

//ini_set('display_errors', 'On');
get_header();

add_filter('get_the_categories', 'showArchiveCategories');


?>
<?php $cat = get_queried_object(); ?>

<?php get_template_part('template-part', 'head'); ?>

<?php get_template_part('template-part', 'topnav'); ?>
<div class="" id="archive-div" style="display: none">
	<div class="container ">
		<div class="col-md-12">
			<div class="well">
				<header class="page-header">
						<h1 class="page-title ">

						<?php echo $cat->name ?  $cat->name . ' ' : ''?>Blog Posts </h1>
				</header>

				<div class="row">


					<?php


					if(!$paged){
						$paged = 1;
					}
					//$category = get_the_category();

					$args = array( 'post_type' => 'post', 'posts_per_page' => 9, 'paged' => $paged );
					if($cat){
						$args['cat'] = $cat->term_id;
					}
					$loop = new WP_Query( $args );

					$i = 0;
					while ( $loop->have_posts() ) : $loop->the_post();
						if($i % 3 == 0){
							echo "</div><div class='row'>";
						}
						echo "<div class='col-md-4 blog-blurb' >";

						echo "<div class=' blog-date-heading' >";
						echo "<div class='pull-left' style='margin: 5px; margin-top: 2px'>";
						the_time('F j'); echo "<sup>"; the_time('S'); echo "</sup>"; the_time(', Y');
						echo "</div>";
						$postId = get_the_ID();

						echo get_the_category_list('', '', $postId);
						echo "</div>";
						echo "<h3>";

						?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a>
						<?php
						echo "</h3>";

						echo '<div class="entry-content">';
						the_post_thumbnail();
						the_excerpt();

						?>



						<?php

						echo '</div>';

						echo '</div>';

						$i++;
					  endwhile;

					?>



				</div><!-- #primary -->
				<hr />
				<div class="row">
					<div >

						<?php if ($loop->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
						<nav class="prev-next-posts">

						  <div class="col-md-12 text-center">
						  <?php
							for($i = 1; $i < $loop->max_num_pages; $i++){
								if($i != $paged){
									echo "<a href='" . esc_url( get_pagenum_link( $i ) ) . "' class='nav-number'>$i</a>";
								}
								else{
									echo "<span class='nav-number'>$i</span>";
								}

							}
							?>
						</div>

						</nav>
					  <?php } ?>
					</div>
				</div>
			</div>
		</div>

	</div><!-- .wrap -->
</div>

<style>
.entry-content img {max-height: 150px;  width: auto;}
</style>
<script>
    jQuery(document).ready(function(){
		jQuery("#archive-div").delay(300).fadeIn(1000);
	});
</script>
<?php get_footer();
