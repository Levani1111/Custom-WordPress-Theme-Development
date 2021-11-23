<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php wp_head(); ?>
</head>
<body>

<header class="header-top-1">
<section class="container header-top-1">
			<div class="container-fluid">
				<nav class="navbar">
					<div class="navbar-brand px-4"><span class="call-now">CALLUSNOW!</span>&nbsp;&nbsp;<span class="phone-number">385.154.11.28.35</span></div>
					<sapn class="log-in">LOGIN</span>&nbsp;&nbsp;<span class="sign-up">SIGNUP</span>
			    </nav>
			</div>
	</section>

	<section class="header-top-2 py-2">
		<div class="container py-2">
			<div class="container-fluid">
				<nav class="navbar navbar-light">
					<div class="container-fluid">
						<div class="navbar-brand">
							<!-- Displaying the custom logo -->
							<?php if ( function_exists( 'the_custom_logo' ) ) {
                            the_custom_logo();
                            } ?>
							<!-- <span class="your">YOUR</span>
							<span class="your-logo">LOGO</span> -->
						</div>
						<?php 
							wp_nav_menu(
								array(
								'theme_location' => 'top-menu',
								'menu_class' => 'top-bar'
							));
						?>
					</div>
			    </nav>
			</div>
		</div>
	</section>
</header>