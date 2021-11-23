<?php

$list = getDirectoryStructure();

if(!isset($list[2])){
  include("archive-skills.php");
  die();
}

?>
<?php get_header(); ?>
<?php get_template_part('template-part', 'head'); ?>
<?php

        $image_class = ['class' => 'skill-featured-image-single'];
?>
<?php
$list = getDirectoryStructure();
?>

    <?php if(count($list) > 1)
    {
        develevation_breadcrumbs($list);
        $image_class = ['class' => 'skill-featured-image'];
    }
    else{
      $post = get_post(5);
      setup_postdata($post);
      $image_class = [];
    }
    ?>

  <div class="col-md-7">
    <div class="well">
      <?php the_post_thumbnail('full', $image_class);?>
      <h1><?php the_title();?></h1>
      <hr />
      <?php the_content();?>
      <?php
        $sections = array('what', 'who', 'where', 'why', 'likes', 'dislikes');

        foreach($sections as $section){
          $field_content = get_field($section . '_text', get_the_ID());
          if($field_content){
            echo "<h4>" . get_field($section . '_title', get_the_ID()) . "</h4>";
            echo $field_content;
            echo "<hr />";
          }
        }

      ?>
    </div>
  </div>
  <div class="col-md-5">

    <?php
      $skills = getSkills($post->post_name);
      ?>
      <div class="well">
      <?php

      if(count($skills)){
        ?>

          <h3>Areas of Expertise:</h3>
          <?php

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
          <?php
      }else{
        include("tesla-ad.php");
      }
      ?>
        </div>
      }
<?php

?>

  </div>


<?php get_footer(); ?>
