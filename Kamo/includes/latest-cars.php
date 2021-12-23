<?php 

    $args = [
    'post_type' => 'cars',
    // 'meta_key' => 'colour',
    // 'meta_value' => 'Black',
    ];

    $query = new WP_Query($args);
?>



<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php if($query->have_posts() ):?>
    <?php while( $query->have_posts()) : $query->the_post();?>
    <div class="col">
        <div class="card h-100 border-primary mb-3 gallery" style="max-width: 18rem;">
            <a href="<?php the_post_thumbnail_url('blog-large');?>">
                <img src="<?php the_post_thumbnail_url('blog-large');?>" alt="<?php the_title();?>"
                    class="card-img-top">
            </a>
            <div class="card-body text-primary">
                <h5 class="card-title mb-2"><?php the_title();?></h5>
                <ul class="text-black">
                    <li>
                        Colour: <?php the_field('colour');?>
                    </li>
                    <li>
                        Registration: <?php the_field('registration');?>
                    </li>
                </ul>
            </div>
            <div class="card-footer bg-primary">
                <small class="muted text-white"><?php the_field('registration');?></small>
            </div>
        </div>
    </div>
    <?php endwhile;?>
</div>
<?php endif;?>