
<?php get_header(); ?>

<?php get_template_part('template-part', 'head'); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="row dmbs-content blog-content">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>

    <div class="col-md-<?php devdmbootstrap3_main_content_width(); ?> dmbs-main">

        <?php

            //if this was a search we display a page header with the results count. If there were no results we display the search form.
            if (is_search()) :

                 $total_results = $wp_query->found_posts;

                 echo "<h2 class='page-header'>" . sprintf( __('%s Search Results for "%s"','devdmbootstrap3'),  $total_results, get_search_query() ) . "</h2>";

                 if ($total_results == 0) :
                     get_search_form(true);
                 endif;

            endif;

        ?>

            <?php // theloop
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $fud = getFudArticle(get_post());
                    
                    // single post
                    if ( is_single() ) : ?>
                        
                        <div <?php post_class(); ?>>

                            <h2 class="page-header"><?php the_title() ;?></h2>
                            <?php the_time('F jS, Y'); ?> <?php echo $fud->post_meta['parent_domain'];?> published this <a href="<?php echo $fud->post_meta['url'][0];?>" target="_blank">#pravduh</a> 
                            <hr />
                            
                           <?php
                           if(has_post_thumbnail()){
                           echo the_post_thumbnail('full', ['class' => 'skill-featured-image-single']);
                           ?>
                            
                                
                                <div class="clear"></div>
                            
                            <hr />
                            <?php
                           }
                           ?>
                            <?php the_content(); ?>
                            <?php
                            $fud_points = ['fear', 'uncertainty', 'doubt'];
                            echo "<h4>FUD ($fud->total_level points)</h4>";
                            foreach($fud_points as $fud_type){
                                if(count($fud->fud_points[$fud_type]) > 0){
                                    $level_key = $fud_type . '_level';
                                    echo "<h5 class='fud-type'>$fud_type points ({$fud->$level_key})</h3>";
                                    echo "<ul class=''>";
                                    foreach($fud->fud_points[$fud_type] as $point){
                                        
                                        echo "<li>{$point[$fud_type . '_point']}</li>";
                                    }
                                    echo "</ul>";
                                }
                            }
                            
                            ?>
                            <?php wp_link_pages(); ?>
                            <?php get_template_part('template-part', 'postmeta');
                            echo "<strong>ABOUT THE AUTHOR:</strong><br />";
                            the_author_description();

                            
                            ?>

                            <?php comments_template(); ?>

                        </div>
                    <?php
                    // list of posts
                    else : ?>
                       <div <?php post_class(); ?>>

                            <h2 class="page-header">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'devdmbootstrap3' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h2>

                            <?php if ( has_post_thumbnail() ) : ?>
                               <?php the_post_thumbnail(); ?>
                                <div class="clear"></div>
                            <?php endif; ?>
                            <?php the_content(); ?>
                            <?php wp_link_pages(); ?>
                            <?php get_template_part('template-part', 'postmeta'); ?>
                            <?php  if ( comments_open() ) : ?>
                                   <div class="clear"></div>
                                  <p class="text-right">
                                      <a class="btn btn-success" href="<?php the_permalink(); ?>#comments"><?php comments_number(__('Leave a Comment','devdmbootstrap3'), __('One Comment','devdmbootstrap3'), '%' . __(' Comments','devdmbootstrap3') );?> <span class="glyphicon glyphicon-comment"></span></a>
                                  </p>
                            <?php endif; ?>
                       </div>

                     <?php  endif; ?>

                <?php endwhile; ?>
                <script>
                    <?php the_field('code'); ?>
                </script>
                <?php posts_nav_link(); ?>
                <?php else: ?>

                    <?php get_404_template(); ?>

            <?php endif; ?>

   </div>
    
   
   <?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>

