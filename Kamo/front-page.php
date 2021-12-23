<?php get_header(); ?>

<section class="page-wrap py-5">
    <div class="container-sm py-5 px-5">
    <div class="col-sm-9 mx-auto">
        <?php get_search_form(); ?>     <!--  // This is the search form -->
        <?php get_template_part('includes/section', 'content'); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>