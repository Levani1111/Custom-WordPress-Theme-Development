<?php get_header(); ?>

<section class="page-wrap py-5">
    <div class="container py-5 px-5">
        <h1 class="Honepage-h1 py-4"><?php the_title();?></h1>
        <?php get_template_part('includes/section', 'content'); ?>
    </div>
</section>
<?php get_footer(); ?>