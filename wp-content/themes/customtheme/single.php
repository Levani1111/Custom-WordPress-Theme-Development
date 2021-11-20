<?php get_header(); ?>

<section class="page-wrap">
    <div class="container">
        <!-- Show a featured imag posts -->
        <?php if (has_post_thumbnail()) : ?>                              <!-- Show a featured imag posts -->
            <div class="img-fluid mb-3 img-thumbnails">                   <!-- Show a featured imag posts -->
                <?php the_post_thumbnail('banner-image'); ?>              <!-- Show a featured imag posts -->
            </div>
        <?php endif; ?>
        <h1><?php the_title();?></h1>                                      <!-- Show a title posts -->
        <?php get_template_part('includes/section', 'blogcontent'); ?>     <!-- Show a content posts -->
    </div>
</section>

<?php get_footer(); ?>