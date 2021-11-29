<?php get_header(); ?>

<section class="page-wrap py-5 px-5">
    <div class="container py-5">
        <section class="row py-5">
            <div class="col-lg-3 py-4">
                <?php if(is_active_sidebar('blog-sidebar')): ?>                      
                    <?php dynamic_sidebar('blog-sidebar'); ?>                        
                <?php endif; ?>                                                      
            </div>
            <div class="col-lg-9">
                <h1><?php echo single_cat_title(); ?></h1>                        
                  <?php get_template_part('includes/section', 'archive'); ?>     
                  <?php previous_posts_link(); ?>                                
                  <?php next_posts_link(); ?>                                    
            </div>
        </section>
    </div>
</section>


<?php get_footer(); ?> 