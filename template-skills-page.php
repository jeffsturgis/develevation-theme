<?php /* Template Name: Skills Tempalte */ ?>
<?php get_header(); ?>

<?php get_template_part('template-part', 'head'); ?>

<?php get_template_part('template-part', 'topnav'); ?>


    <?php if(function_exists('bcn_display') && $post->post_name != 'home')
    {
      echo '<div class="col-md-12"><ul class=" breadcrumb">';
        bcn_display();
        echo '</ul></div>';
    }?>


  <div class="col-md-6">
    <div class="well">
      <?php the_post_thumbnail('full', ['class' => 'skill-featured-image']);?>
      <h1><?php the_title();?></h1>
      <?php the_content();?>
    </div>
  </div>
  <div class="col-md-6">
      <?php  $skills = getSkills($post->post_name);
      var_dump($skills);
      if(count($skills) > 0){
      ?>

        <div class="well">
        <h3>Areas of Expertise:</h3>
        <?php
          $skills = getSkills($post->post_name);
          foreach($skills as $skill){
            if(isset($skill['Link'])){
              echo '<a href="' . $skill['Link'] . '">';
            }
            ?>


              <div class="area-of-expertise">
                <div class="img-wrapper">
                  <?php echo $skill['Img'];?>
                </div>
                <div class="skill"><?php echo $skill['Name'];?></div>
              </div>
            <?php
             if(isset($skill['Link'])){
                echo "</a>";
            }
          }
    ?>
          <div class="clearfix"></div>
        </div>
<?php } ?>
  </div>


<?php get_footer(); ?>
