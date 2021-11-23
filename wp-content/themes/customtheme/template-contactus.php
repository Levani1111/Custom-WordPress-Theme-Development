<?php
/*
template name: Contact Us
*/
?>

<?php get_header(); ?>

<section class="page-wrap my-5 py-5">
    <div class="container my-3 py-5">
        <div class="row py-3 ml-5 px-5">
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
</section>
<?php get_footer(); ?>