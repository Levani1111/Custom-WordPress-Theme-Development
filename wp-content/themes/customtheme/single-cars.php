<?php get_header(); ?>
<!-- display cars -->
<section class="page-wrap my-3 py-5">
    <div class="container my-2 py-5">
        <div class="row col-sm-9 mx-auto">
        <h1 class="px-4"><?php the_title();?></h1> 
            <div class="col-sm-9 mx-auto px-4">
                <?php if (has_post_thumbnail()) : ?>                              
                <div class="img-fluid img-thumbnails">              
                    <?php the_post_thumbnail(''); ?>              
                </div>
                <?php endif; ?>
            </div>
            <div class="col-sm-11 mx-auto">                                    
            <?php get_template_part('includes/section', 'cars'); ?> 
            <?php wp_link_pages(); ?>
            </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>