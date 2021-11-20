<?php get_header(); ?>

<section class="page-wrap">
    <div class="container">
        <h1><?php echo single_cat_title(); ?></h1>                     <!-- This is the category title -->
        <?php get_template_part('includes/section', 'archive'); ?>     <!-- This is the category archive template file -->
        <?php previous_posts_link(); ?>                                <!-- This is the previous posts link -->
        <?php next_posts_link(); ?>                                    <!-- This is the next posts link -->
    </div>
</section>

<?php get_footer(); ?> 