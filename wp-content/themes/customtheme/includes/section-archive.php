<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div class="card mb-3">
    <div class="card-body d-flex justify-content-center align-items-center">
            <?php if (has_post_thumbnail()) : ?>  <!-- if there is a thumbnail show a featured imag -->
        <div class="col-md-4 img-fluid mb-3 img-thumbnails mr-4"><?php the_post_thumbnail('blog-image-small'); ?></div> <!--  show a featured imag -->
            <?php endif; ?>
        <div class="blog-content">
           <h3><?php the_title(); ?></h3> 
            <!-- Cut of text of posts on blig page -->
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary">Read More</a>  <!-- show a link to the post -->
        </div>
    </div>
</div>
 

<?php endwhile; else: endif; ?>