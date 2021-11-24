<?php get_header(); ?>

<section class="page-wrap py-5">
    <div class="container py-5 px-5">
        <?php get_search_form(); ?>     <!--  // This is the search form -->
        <?php get_template_part('includes/section', 'content'); ?>
    </div>
</section>
<?php get_footer(); ?>