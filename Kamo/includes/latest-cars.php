<?php 

    $args = [
    'post_type' => 'cars',
    // 'meta_key' => 'colour',
    // 'meta_value' => 'Black',
    ];

    $query = new WP_Query($args);
?>

<?php if($query->have_posts() ):?>

    <?php while( $query->have_posts()) : $query->the_post();?>
    <div class="card">
        <div class="card-body">
        <div class="gallery">
            <a href="<?php the_post_thumbnail_url('blog-large');?>">
                <img src="<?php the_post_thumbnail_url('blog-large');?>" alt="<?php the_title();?>"
                    class="img-fluid mb-3 img-thumbnail">
            </a>
        </div>
        <h4><?php the_title();?></h4>
         <?php the_field('registration');?>
        </div>
    </div>

    <?php endwhile;?>

<?php endif;?>