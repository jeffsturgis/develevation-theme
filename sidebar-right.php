<?php
    global $dm_settings;
    if ($dm_settings['right_sidebar'] != 0) : ?>
    <div class="col-md-<?php echo $dm_settings['right_sidebar_width']; ?> dmbs-right">
        <?php include("patreon-support.php"); ?>

        <?php include("tesla-ad.php"); ?>
        <?php include("model-3-songs.php"); ?>
        <?php //get the right sidebar
        //include("tesla-ad.php");
        //dynamic_sidebar( 'Right Sidebar' );

        ?>
    </div>
<?php endif; ?>
<div class="col-md-12"><?php include("sidebar-categories.php"); ?></div>
