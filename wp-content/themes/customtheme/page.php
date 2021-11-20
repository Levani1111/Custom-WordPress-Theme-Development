<?php get_header(); ?>

<section class="page-wrap">
    <div class="container">
         <?php if (has_post_thumbnail()) : ?>                             <!-- Show a featured imag pages -->
            <div class="img-fluid mb-3 img-thumbnails">                   <!-- Show a featured imag pages -->
                <?php the_post_thumbnail('banner-image'); ?>              <!-- Show a featured imag pages -->
            </div>                                                        <!-- Show a featured imag pages -->
        <?php endif; ?>
        <h1><?php the_title();?></h1>                                     <!-- Show a title pages -->
        <?php get_template_part('includes/section', 'blogcontent'); ?>    <!-- Show a content pages -->
    </div>
</section>

<?php get_footer(); ?>