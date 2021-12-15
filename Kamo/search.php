<?php get_header(); ?>

<section class="page-wrap my-4 py-5">
    <div class="container-sm my-5">
        <div class="row">
            <h3>Search Results for '<?php echo get_search_query();?>'</h3> 
            <?php get_template_part('includes/section', 'searchresults'); ?>                                        
        </div>
    </div>
</section>

<?php get_footer(); ?> 