<?php get_header(); ?>

<?php get_template_part('template-part', 'head'); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<div id="main-body" class="container" style="display: block;">
<div class="">
  <div class="col-md-6">
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
  <div class="col-md-6">
    <div class="well">
    <h3>Areas of Expertise:</h3>
        <a href="/php.php">
            <div class="area-of-expertise">
        <div class="img-wrapper">
          <img src="/assets/img/php.svg">
        </div>
        <div class="skill">PHP</div>
      </div>
        </a>
        <a href="/js.php">
            <div class="area-of-expertise">
        <div class="img-wrapper">
          <img src="/assets/img/javascript.svg">
        </div>
        <div class="skill">Javascript</div>
      </div>
        </a>
        <a href="/linux.php">
            <div class="area-of-expertise">
        <div class="img-wrapper">
          <img src="/assets/img/linux.svg">
        </div>
        <div class="skill">Linux System Administration</div>
      </div>
        </a>
        <a href="/db.php">
            <div class="area-of-expertise">
        <div class="img-wrapper">
          <img src="/assets/img/db.svg">
        </div>
        <div class="skill">Database Administration</div>
      </div>
        </a>
        <a href="/aggregation.php">
            <div class="area-of-expertise">
        <div class="img-wrapper">
          <img src="/assets/img/aggregation.svg">
        </div>
        <div class="skill">Data Aggregation</div>
      </div>
        </a>
        <a href="/api.php">
            <div class="area-of-expertise">
        <div class="img-wrapper">
          <img src="/assets/img/api.svg">
        </div>
        <div class="skill">API Implementation</div>
      </div>
        </a>
        <div class="clearfix"></div>
</div>  </div>
</div>


</div>

<?php get_footer(); ?>
