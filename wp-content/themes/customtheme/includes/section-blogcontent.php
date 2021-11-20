<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<!-- Display data when post was published -->
<p><?php echo get_the_date('m/d/y g:i A'); ?></p> 
 <?php the_content(); ?> 
<?php 
// Display the post author's name
$fname = get_the_author_meta('first_name'); 
$lname = get_the_author_meta('last_name'); 
?>
<p>  Posted by: <?php echo $fname . " " . $lname; ?></p> 
<!-- Display tags with links -->
<?php 
$tags = get_the_tags(); 
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
<?php endforeach;?>

<!-- comments Template off -->
<?php // comments_template(); ?>

<?php endwhile; else: endif; ?>