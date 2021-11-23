<h3>Other Categories</h3>
<?php
$categories = get_categories('');

$excludeCategoriesTmp = wp_get_post_categories(get_the_ID());
$excludeCategories = [];
foreach($excludeCategoriesTmp as $cat){
    $excludeCategories[$cat] = 1;
}

showPostCategoriesSidebar($categories, $excludeCategories);
