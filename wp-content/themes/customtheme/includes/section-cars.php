<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

 <?php the_content(); ?> 
<!-- Display tags with links -->
<?php 
$tags = get_the_tags(); 
if($tags):
foreach($tags as $tag):?> 
    <a href="<?php echo get_tag_link($tag->term_id); ?>" class="badge badge-primary">
      <?php echo $tag->name;?>
    </a>
<?php endforeach;?> 
<!-- Show all the categories for a blog post -->
<?php 
$categories = get_the_category();
foreach($categories as $category):?>
    <a href="<?php echo get_category_link($category->term_id); ?>" class="badge badge-primary"> 
      <?php echo $category->name;?>
    </a>
<?php endforeach; endif;?>

<!-- comments Template off -->
<?php // comments_template(); ?>

<?php endwhile; else: endif; ?>