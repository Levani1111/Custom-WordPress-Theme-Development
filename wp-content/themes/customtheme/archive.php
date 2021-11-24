<?php get_header(); ?>

<section class="page-wrap py-5 px-5">
    <div class="container py-5">
        <section class="row py-5">
            <div class="col-lg-3 py-4">
                <?php if(is_active_sidebar('blog-sidebar')): ?>                      <!-- is_active_sidebar() checks if the sidebar is active -->
                    <?php dynamic_sidebar('blog-sidebar'); ?>                        <!-- dynamic_sidebar() displays the sidebar -->
                <?php endif; ?>                                                      <!-- if the sidebar is active, it will display the sidebar -->
            </div>
            <div class="col-lg-9">
               <h1><?php echo single_cat_title(); ?></h1>                        <!-- This is the category title -->
                  <?php get_template_part('includes/section', 'archive'); ?>     <!-- This is the category archive template file -->
                  <?php previous_posts_link(); ?>                                <!-- This is the previous posts link -->
                  <?php next_posts_link(); ?>                                    <!-- This is the next posts link -->
            </div>
        </section>
    </div>
</section>


<?php get_footer(); ?> 