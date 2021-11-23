<?php
add_filter( 'big_image_size_threshold', '__return_false' );
function my_theme_enqueue_styles() {

    $parent_style = 'devdmboostrap3-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        2
    );
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:100,300,500,700,900');
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function getSkills($page_slug){
    $skills = [];

    if($page_slug == 'home'){
        $categories = get_categories( array(
            'parent' => 0,
            'taxonomy' => 'skill_category'
        ) );

        foreach($categories as $cat){
            if($cat->term_id > 1){
                $page = get_page_by_path( $cat->slug, OBJECT, 'skills' );

                $skills[] = [
                'Name' => $cat->name,
                'Img' => get_the_post_thumbnail($page, 'post-thumbnail'),
                'Link' => get_permalink($page)
              ];
            }
        }
    }
    else{
        $page = get_page_by_path( $page_slug, OBJECT, 'skills' );

        $category = get_the_category( $page->ID );

        $skill_page_args = array(

                    'post_type' => 'skills',
                    'order' => 'ASC',
                    'orderby' => 'post_title',
                    'posts_per_page' => 20,
                    'child_of' => $page->ID,
                    'taxonomy' => 'skill_category',
                        'field' => 'slug',
                        'term' => $page_slug
                );
        $my_query = new WP_Query();
        $skills_pages = $my_query->query($skill_page_args);

        foreach($skills_pages as $page){
            if($page->post_name != $page_slug){
                $skill = [
                'Name' => $page->post_title,
                'Img' => get_the_post_thumbnail($page, 'post-thumbnail')
              ];
              if(trim($page->post_content) != '' || pageHasContent($page->ID)){

                $skill['Link'] = get_permalink($page);

              }
              $skills[] = $skill;
            }
        }

    }



   return $skills;
}

function pageHasContent($page_id){
    $meta = get_post_meta($page_id, '', true);

    if($meta['what_text'][0] != '' || $meta['who_text'][0] != '' || $meta['where_text'][0] != '' || $meta['why_text'][0] != ''
       || $meta['likes'][0] != '' || $meta['dislikes'][0] != '' ){
        return true;
    }
    return false;
}

function getDirectoryStructure(){
    $pieces = explode('/', $_SERVER['REQUEST_URI']);
    $list = [];
    foreach($pieces as $piece){
      if($piece){
        if($piece == 'skills'){
            $name = 'Skills';
        }
        else{
            $args = array(
            'name'        => $piece,
            'post_type'   => 'skills',
            'post_status' => 'publish',
            'numberposts' => 1
            );
            $my_posts = get_posts($args);
            $name = $my_posts[0]->post_title;
        }

        //var_dump($my_posts);
        $list[] = ['slug' => $piece, 'name' => $name];
      }
    }

    return $list;
}
function develevation_breadcrumbs($list){
    echo '<div class="col-md-12"><ul class=" breadcrumb">';
    $url = '/';
    foreach($list as $skill){
      if($skill['slug'] != end($list)['slug']){
        $url .= $skill['slug'] . '/';
        echo "<li><a href='$url'>{$skill['name']}</a></li>";
      }
      else{
        echo "<li>{$skill['name']}</li>";
      }

    }
    echo '</ul></div>';
}

function my_acf_google_map_api( $api ){

	$api['key'] = 'AIzaSyAc0bh299iDGv7IwdCWTcGCyh0gudcKSbg';

	return $api;

}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


// The filter method (it hides the Editorial category, but you can change that to suit you rneeds
function showPostCategories($categories) {

    foreach($categories as $cat){
        if($cat->name == 'Uncategorised'){
            continue;
        }
        if($cat->name == 'CybertruckServices.com'){
            $cat->name = 'Cybertruck<br />Services';
        }
        $small_class = '';
        if(strlen($cat->name) > 15){
            $small_class = 'blog-category-text-small';
        }
        echo "
        <div class='blog-category bg-{$cat->slug}'>
            <a href='/category/{$cat->slug}/'>
             <div class='blog-category-icon {$cat->slug}'></div>
             <div class='blog-category-text '>{$cat->name}</div>
            </a>
        </div>
        ";
    }
    echo "<div class='clearfix'></div>";
    return $categories;
}
function showPostCategoriesSidebar($categories, $excludeCategories) {

    foreach($categories as $cat){

        if($cat->name == 'Uncategorised' || $excludeCategories[$cat->term_id]){
            continue;
        }
        $small_class = '';
        if(strlen($cat->name) > 15){
            $small_class = 'blog-category-text-small';
        }
        echo "
        <div class='blog-category-sidebar'>
            <a href='/category/{$cat->slug}/'>
             <div class='blog-category-icon {$cat->slug}'></div>
             <div class='blog-category-text $small_class'>{$cat->name}</div>
            </a>
        </div>
        ";
    }
    echo "<div class='clearfix'></div>";
    return $categories;
}
function showArchiveCategories($categories) {

    foreach($categories as $cat){
        if($cat->name == 'Uncategorised'){
            continue;
        }
        $small_class = '';
        if(strlen($cat->name) > 15){
            $small_class = 'blog-category-text-small';
        }
        echo "
        <div class='blog-category-mini'>
            <a href='/category/{$cat->slug}/'>
             <div class='blog-category-icon-mini {$cat->slug} $small_class' title='{$cat->cat_name}'></div>
            </a>

        </div>
        ";


    }
    echo "<div class='clearfix'></div>";
    return $categories;
}

function getFudArticles(){
    $posts = get_posts(['post_type' => 'fud']);
    foreach($posts as $i => $post){
        $posts[$i] = getFudArticle($post);
    }
    return $posts;
}

function getFudArticle($post){
    $meta = get_post_meta($post->ID, '', 1);

    $pieces = explode("/", $meta['url'][0]);

    $meta['parent_domain'] = str_replace('www.', '', $pieces[2]);

    $post->post_meta = $meta;
    $post->permalink = get_permalink($post->ID);

    $post->fud_points = [];
    $post->fud_points['fear'] = get_field('fear_points', $post->ID);
    $post->fud_points['uncertainty'] = get_field('uncertainty_points', $post->ID);
    $post->fud_points['doubt'] = get_field('doubt_points', $post->ID);


    $post->fear_level = count($post->fud_points['fear']) >= 10 == 10 ? 'MAX' : count($post->fud_points['fear']);
    $post->uncertainty_level = count($post->fud_points['uncertainty']) >= 10 ? 'MAX' : count($post->fud_points['uncertainty']);
    $post->doubt_level = count($post->fud_points['doubt']) >= 10 ? 'MAX': count($post->fud_points['doubt']);
    $post->total_level = count($post->fud_points['fear']) + count($post->fud_points['uncertainty']) + count($post->fud_points['doubt']);

    return $post;
}

function CryptoJSAesEncrypt($passphrase, $plain_text){

    $salt = openssl_random_pseudo_bytes(256);
    $iv = openssl_random_pseudo_bytes(16);
    //on PHP7 can use random_bytes() istead openssl_random_pseudo_bytes()
    //or PHP5x see : https://github.com/paragonie/random_compat

    $iterations = 999;
    $key = hash_pbkdf2("sha512", $passphrase, $salt, $iterations, 64);

    $encrypted_data = openssl_encrypt($plain_text, 'aes-256-cbc', hex2bin($key), OPENSSL_RAW_DATA, $iv);

    $data = array("ciphertext" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "salt" => bin2hex($salt));
    return json_encode($data);
}

function stringToBinary($string)
{
    $characters = str_split($string);

    $binary = [];
    foreach ($characters as $character) {
        $data = unpack('H*', $character);
        $binary[] = base_convert($data[1], 16, 2);
    }

    return implode(' ', $binary);
}
