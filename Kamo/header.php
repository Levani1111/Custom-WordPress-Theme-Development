<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customtheme</title>

    <?php wp_head(); ?>
</head>

<body>

    <header class="header-top-1">
        <section class="container header-top-1">
            <div class="container-fluid">
                <nav class="navbar col-sm-9 mx-auto">
                    <div class="navbar-brand px-4"><span class="call-now">CALLUSNOW!</span>&nbsp;&nbsp;<span
                            class="phone-number">385.154.11.28.35</span></div>
                    <sapn class="log-in">LOGIN</span>&nbsp;&nbsp;<span class="sign-up">SIGNUP</span>
                </nav>
            </div>
        </section>

        <section class="header-top-2 py-2">
            <div class="container py-2">
                <div class="container-fluid col-sm-9 mx-auto">
                    <nav class="navbar navbar-light">
                        <div class="container-fluid">
                            <div class="navbar-brand">
                                <!-- Display custom site-title -->
                                <?php 
                           $site_title = get_bloginfo( 'title', 'display' );
                            if ( $site_title || is_customize_preview() ) :?>
                                <h3 class="custom-site-title px-2"><?php echo $site_title; ?></h3>
                                <?php endif; ?>
                                <!-- Displaying the custom logo -->
                                <?php if ( function_exists( 'the_custom_logo' ) ) {
                            the_custom_logo();
                            } ?>
                                <!-- <span class="your">YOUR</span>
							<span class="your-logo">LOGO</span> -->
                            </div>
                            <!-- bootstrap 5 Nav Menu -->
                            <nav class="navbar navbar-expand-md ">
                                <div class="container-fluid">
                                    <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#top-menu" aria-controls="top-menu" aria-expanded="false"
                                        aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>

                                    <div class="collapse navbar-collapse" id="top-menu">
                                        <?php
                                            wp_nav_menu(array(
                                                'theme_location' => 'top-menu',
                                                'container' => false,
                                                'menu_class' => 'top-bar',
                                                'fallback_cb' => '__return_false',
                                                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                                                'depth' => 2,
                                                'walker' => new bootstrap_5_wp_nav_menu_walker()
                                            ));
                                            ?>
                                    </div>
                                </div>
                            </nav>

                        </div>
                    </nav>
                </div>
            </div>
        </section>
    </header>