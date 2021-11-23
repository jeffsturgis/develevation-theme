<?php /* Template Name: FUD Template */ ?>
<?php ini_set('display_errors', 'On'); ?>


<div id="main-body" class="container" style="display: block;">
<div class="">
  <div class="col-md-9">
    <div class="well">
      <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
      ?>
      <?php the_post_thumbnail('full');?>
      <h1><?php the_title();?></h1>
      <?php the_content();?>
      <?php
      endwhile;
      endif;
      ?>
    </div>
    
  </div>
  <div class="col-md-3">
    <div class="well">
      This is a cool spot to put something.
    </div>
  </div>
  <div class="col-md-12" id="pravduh">
    <div class="well">
      <h3>#pravduh:</h3>
      <?php
        $fud_articles = getFudArticles();
        foreach($fud_articles as $fud){
      ?>
        
            <div class="area-of-expertise">
             
             
              <div class="col-md-6">
                 <div class="fud_title">
                <a href="<?php echo $fud->permalink;?>"><?php echo $fud->post_title;?></a>
              </div>
              <hr />
                <div class="author">
                  <a href="/tesla-fud/<?php echo sanitize_title($fud->post_meta['author'][0] . "-" . $fud->post_meta['parent_domain']);?>"><?php echo $fud->post_meta['author'][0];?></a>  
                </div>
                
                <div class="date"><?php echo date("F, j Y", strtotime($fud->post_meta['date_posted'][0]));?></div>
                <div class="source"><?php echo $fud->post_meta['parent_domain'];?></div>
              </div>
              <div class="col-md-6">
                <div class="fud-meter-wrapper">
                  <div class="fud-meter">
                    <div class="blog-category-icon fear" title="Fear: <?php echo $fud->fear_level;?> Points"><span class="bar bar-<?php echo $fud->fear_level;?>"></span></div>
                    <div class="blog-category-icon uncertainty" title="Uncertainty: <?php echo $fud->uncertainty_level;?> Points"><span class="bar  bar-<?php echo $fud->uncertainty_level;?>"></span></div>
                    <div class="blog-category-icon doubt" title="Doubt: <?php echo $fud->doubt_level;?> Points"><span class="bar bar-<?php echo $fud->doubt_level;?>"></span></div>
                  </div>  
                </div>
                
              </div>
            </div>
        
        <?php
        }
        ?>
        <div class="clearfix"></div>
        
    </div>
  </div>
</div>

      
</div>

<?php get_footer(); ?>
