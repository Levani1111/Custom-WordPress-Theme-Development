<?php get_header(); ?>



<section class="page-wrap py-5">
    <div class="container-sm py-5 px-5">
        <div class="col-sm-9 mx-auto">
        <div id="carouselExampleInterval" class="carousel slide py-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $slider = get_posts(array('post_type' => 'slider', 'posts_per_page' => 4)); ?>
            <?php $count = 0; ?>
            <?php foreach($slider as $slide): ?>
            <div class="carousel-item  <?php echo ($count == 0) ? 'active' : ''; ?>" data-bs-interval="10000">
                <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($slide->ID, 'blog-large')) ?>"
                    class="img-responsive" />
            </div>
            <?php $count++; ?>
            <?php endforeach; ?>


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
            <?php get_search_form(); ?>
            <!--  // This is the search form -->
            <?php get_template_part('includes/section', 'content'); ?>
        </div>
    </div>
</section>



<?php get_footer(); ?>