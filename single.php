<?php

    add_filter('get_the_categories', 'showPostCategories');
?>
<?php get_header(); ?>

<?php get_template_part('template-part', 'head'); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>


<!-- start content container -->
<div class="row dmbs-content blog-content">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>

    <div class="col-md-8 dmbs-main">

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

                    // single post
                    if ( is_single() ) : ?>

                        <div <?php post_class(); ?>>

                            <h2 class="page-header"><?php the_title() ;?></h2>
                            <?php the_time('F jS, Y'); ?>
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

                            <?php

                            $plainText  = get_the_content();
                            $passPhrase = get_field('post_private_key');
                            if($passPhrase){
                                $encryptedString = CryptoJSAesEncrypt($passPhrase, $plainText);
                                $encryptedBinary = stringToBinary($encryptedString);
                            ?>
                            <form id="decryption-form" class="form-inline">

                              <div class="form-group">
                                <label for="exampleInputEmail2">Decode Key</label>
                                <input type="text" class="form-control" id="passPhrase" placeholder="<?php echo $passPhrase; ?>">
                              </div>
                              <button id="decrypt-btn" type="submit" class="btn btn-default">Decrypt Blog</button>
                            </form>
                            <?php

                                echo '<div id="encrypted-section">' . $encryptedBinary . '</div>';
                            }
                            else{

                                echo  $plainText ;
                            }
                            if(get_field('mp3_file')){
                            ?>

                                <audio controls>

                                  <source src="<?= the_field('mp3_file'); ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                                </audio>
                            <?php
                            }
                            ?>

                            <?php wp_link_pages(); ?>
                            <?php get_template_part('template-part', 'postmeta');
                            echo "<strong>ABOUT THE AUTHOR:</strong><br />";
                            the_author_description();


                            ?>
                            <hr />
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
                    var $ = jQuery;
                    <?php the_field('code'); ?>
                </script>
                <script>
                function binaryAgent(str) {
                      let array = str.split(" ");
                      return array.map(code => String.fromCharCode(parseInt(code, 2))).join("");
                }
                function CryptoJSAesDecrypt(passphrase,encrypted_json_string){
                    var obj_json = JSON.parse(encrypted_json_string);
                    var encrypted = obj_json.ciphertext;
                    var salt = CryptoJS.enc.Hex.parse(obj_json.salt);
                    var iv = CryptoJS.enc.Hex.parse(obj_json.iv);
                    var key = CryptoJS.PBKDF2(passphrase, salt, { hasher: CryptoJS.algo.SHA512, keySize: 64/8, iterations: 999});
                    var decrypted = CryptoJS.AES.decrypt(encrypted, key, { iv: iv});
                    return decrypted.toString(CryptoJS.enc.Utf8);
                }

                var encryptedJson = '<?php echo $encryptedString;?>';


                jQuery(document).ready(function(){
                    jQuery("#decrypt-btn").on("click", function(e){
                        e.preventDefault();
                        e.stopPropagation();
                        var decrypted;
                        try{
                            decrypted = CryptoJSAesDecrypt($("#passPhrase").val(),encryptedJson);

                        }
                        catch(ex){
                            console.log(ex);

                            //jQuery("#encrypted-section").prepend(decrypted);
                        }
                        if(!decrypted){
                            decrypted = "<div class='alert alert-danger'>Sorry, you done fucked up the decrypt.  I'm beginning to think you don't belong here.</div>" + jQuery("#encrypted-section").html();
                        }
                        jQuery("#encrypted-section").html(decrypted);


                    });
                    jQuery("#decryption-form").on("submit", function(e){
                        e.preventDefault();
                        e.stopPropagation();
                    });
                });


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
