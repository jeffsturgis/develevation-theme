<?php global $dm_settings; ?>
<?php if ($dm_settings['show_postmeta'] != 0) : ?>

    <p> <?php _e('Posted In','devdmbootstrap3'); ?>: <?php get_the_category_list(''); ?></p>
    <?php if( has_tag() ) : ?>
        <p class="text-right"><span class="glyphicon glyphicon-tags"></span>

        </p>

    <?php endif; ?>
<?php endif; ?>
 <p>
    <span class="glyphicon glyphicon-user"></span> <?php the_author_posts_link(); ?>

</p>
