<?php
/*
template name: Contact Us
*/
?>

<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1><?php the_title();?></h1>
            <div class="row">
                <div class="col-lg-6">
                    this is where contact form goes
                </div>
                <div class="col-lg-6">
                    <?php get_template_part('includes/section', 'content'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>