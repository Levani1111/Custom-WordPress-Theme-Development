<?php get_header();?>
<section class="container py-5 px-5">
    <div class="container py-5 px-5">
        <h1 class="py-3 px-5"><?php the_title();?></h1>
        <?php if(has_post_thumbnail()):?>
        <div class="gallery px-5">
            <a href="<?php the_post_thumbnail_url('blog-large');?>">
                <img src="<?php the_post_thumbnail_url('blog-large');?>" alt="<?php the_title();?>"
                    class="img-fluid mb-3 img-thumbnail">
            </a>
        </div>
        <?php endif;?>
        <?php
			$gallery = get_field('gallery');
				if($gallery):?>
        <div class="gallery ">
            <?php foreach($gallery as $image):?>
            <a href="<?php echo $image['sizes']['blog-large'];?>">
                <img src="<?php echo $image['sizes']['blog-small'];?>" class="img-fluid img-thumbnail">
            </a>
            <?php endforeach;?>
        </div>
        <?php endif;?>
        <div class="row px-5">
            <div class="col-lg-6">
                <?php get_template_part('includes/section','cars');?>
                <?php wp_link_pages();?>
            </div>
            <div class="col-lg-6">
                <?php get_template_part('includes/form','enquiry');?>
                <ul>
                    <li>
                        Colour: <?php the_field('colour');?>
                    </li>
                    <li>
                        Registration: <?php the_field('registration');?>
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>