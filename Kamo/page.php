<?php get_header(); ?>

<section class="page-wrap py-5">
    <div class="container py-5">
        <section class="row py-5">
            <div class="col-lg-3">
                <?php if(is_active_sidebar('page-sidebar')): ?>
                <!-- is_active_sidebar() checks if the sidebar is active -->
                <?php dynamic_sidebar('page-sidebar'); ?>
                <!-- dynamic_sidebar() displays the sidebar -->
                <?php endif; ?>
                <!-- if the sidebar is active, it will display the sidebar -->
            </div>
            <div class="col-lg-9">
                <?php if (has_post_thumbnail()) : ?>
                <!-- Show a featured imag pages -->
                <div class="img-fluid img-thumbnails mb-3">
                    <!-- Show a featured imag pages -->
                    <?php the_post_thumbnail('banner-image'); ?>
                    <!-- Show a featured imag pages -->
                </div> <!-- Show a featured imag pages -->
                <?php endif; ?>
                <h1><?php the_title();?></h1> <!-- Show a title pages -->
                <?php get_template_part('includes/section', 'content'); ?>
                <!-- Show a content pages -->
            </div>
        </section>
    </div>
</section>

<?php get_footer(); ?>