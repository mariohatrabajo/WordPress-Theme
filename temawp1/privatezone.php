<?php

/*
    Template Name: Private
*/
    get_header();

?>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">
    
      <h1 class="logo me-auto me-lg-0"><a href="<?php echo home_url(); ?>">Mh<span>.</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
       <!--<a href="index.html" class="logo me-auto me-lg-0"><img src="<?php echo bloginfo('template_directory'); ?>/assets/img/pulpo.png" alt="" class="img-fluid"></a>-->
    
      <?php
        // Es una plantilla terciaria
        get_template_part('nav');
      ?>
    
    </div>
</header><!-- End Header -->


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center justify-content-center" style="min-height: 40vh">
    <div class="container" data-aos="fade-up">

      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-6 col-lg-8">
            
            <?php
            if(!is_user_logged_in()){
                // user is not logged in, show login form
            ?>
                  <h1>Log In</h1>
            <?php
            }else{
            ?>
                  <h1>Private Zone</h1>
            <?php
            }
            ?>
        </div>
      </div>

    </div>
  </section><!-- End Hero -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

          <div class="col-lg-12 mt-5 mt-lg-0">

            <?php
            if(!is_user_logged_in()){
                // user is not logged in, show login form
            ?>
            
            <!-- TODO deberia pedirle la url base a wp -->
            <form name="loginform" id="loginform" action="https://mhidari0108.ieszaidinvergeles.es/wp2023/wp-login.php" method="post" class="php-email-form">
              <div class="row">
                  
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 form-group">
                      <input type="text" name="log" class="form-control" id="user_login" autocomplete="username" placeholder="Username" required>
                    </div>
                </div>
              
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 form-group">
                        <input type="password" class="form-control" name="pwd" id="user_pass" autocomplete="current-password" spellcheck="false" placeholder="Password" required>
                    </div>
                </div>
                
                <p class="login-remember text-center">
                    <label><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label>
                </p>
                <p class="login-submit">
    				<input type="hidden" name="redirect_to" value="https://mhidari0108.ieszaidinvergeles.es/wp2023/?page_id=63">
    			</p>
              
              <div class="text-center"><button type="submit">Log In</button></div>
            </form>
            
            <?php
            }else {
                // User is logged in, show de admin-area button and the logout button
                $user = wp_get_current_user(); // Retrieve an user object
                $user_name = $user->display_name;
                $role = get_author_role($user->ID);
            ?>    
                <h3>Hello <span><?php echo $user_name ?></span>!</h3>
                <h5 style="text-transform: uppercase"><?php echo $role; ?></h5>
            <?php
                do_shortcode('[mmm_show_message id="'.$user->ID.'"]');
                
                // Display admin-area button
                wp_register('','');
                echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                // Display log out button
                wp_loginout(get_permalink());
            }
            ?>
            
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

<?php
    get_footer();
?>