<?php /* Template Name: Full Page */ ?>
<?php get_header(); ?>

<?php get_template_part('template-part', 'head'); ?>

<?php get_template_part('template-part', 'topnav'); ?>


    <?php if(function_exists('bcn_display') && $post->post_name != 'home')
    {
      echo '<div class="col-md-12"><ul class=" breadcrumb">';
        bcn_display();
        echo '</ul></div>';
    }?>


  <div class="col-md-12">
    <div class="well">
      <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
      ?>
      <?php the_post_thumbnail('full', ['class' => 'skill-featured-image']);?>
      <h1><?php the_title();?></h1>
      <?php the_content();?>
      <?php
      endwhile;
      endif;
      ?>
    </div>    
  </div>
   


<?php get_footer(); ?>
