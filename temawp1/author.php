<?php
/* 
    Template Name: Contact
*/
    get_header();
    
    // Get author object    
    $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
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
          <h1><?php echo $curauth->first_name.' '.$curauth->last_name; ?></h1>
          
          <a href="" target="_blank" class="rrss"><i class='bx bxl-instagram' ></i></a>
          <a href="" target="_blank" class="rrss"><i class='bx bxl-facebook-square' ></i></a>
          <a href="" target="_blank" class="rrss"><i class='bx bxl-twitter' ></i></a>
          <a href="" target="_blank" class="rrss"><i class='bx bxl-linkedin' ></i></a>
        </div>
      </div>

    </div>
  </section><!-- End Hero -->

    <!-- ======= Author Section ======= -->
    <section id="author" class="contact">
      <div class="container" data-aos="fade-up">

          <!-- ======= Bio Section ======= -->
          <section id="about" class="about">
            <div class="container" data-aos="fade-up">
      
              <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                  
                  <?php 
                  // We check if the user has chosen a profile pic
                  $user_pic = get_template_directory_uri().'/assets/img/default.png';
                  if(get_user_meta($curauth->ID, 'user_pic', true) != '')
                    $user_pic = get_user_meta($curauth->ID, 'user_pic', true);
                  ?>
                  <img src="<?php echo $user_pic; ?>" class="img-fluid" alt="<?php echo $curauth->nickname; ?>'s profile picture">
                  
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
                  <h3><span class="amarillo"><i class="bx bx-user"></i></span> <?php echo $curauth->nickname; ?> · <?php echo get_author_role($curauth->ID); ?></h3>
                  <p class="fst-italic"><?php echo $curauth->description; ?></p>
                </div>
              </div>
      
            </div>
          </section><!-- End Bio Section -->
          
          <?php
          // If there's no skills set we dont show the skills section
          if(get_user_meta($curauth->ID, 'skill1V', true) != '' ||
             get_user_meta($curauth->ID, 'skill2V', true) != '' ||
             get_user_meta($curauth->ID, 'skill3V', true) != '' ||
             get_user_meta($curauth->ID, 'skill4V', true) != '')
             {
          ?>
          <section id="counts" class="counts">
            <div class="container aos-init aos-animate" data-aos="fade-up">
      
              <div class="row no-gutters">
                <img class="col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start aos-init aos-animate" data-aos="fade-right" data-aos-delay="100" src="<?php echo bloginfo('template_directory'); ?>/assets/img/laptop2.jpg">
                <div class="col-xl-7 ps-4 ps-lg-5 pe-4 pe-lg-1 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-left" data-aos-delay="100">
                  <div class="content d-flex flex-column justify-content-center">
                    <h3>My skills</h3>
                    <div class="row">
                      
                      <?php 
                      if(get_user_meta($curauth->ID, 'skill1V', true) != ''){
                      ?>
                      <div class="col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                          
                          <?php
                          $top = 18 - (31 * (get_user_meta($curauth->ID, 'skill1V', true)) / 100);
                          ?>
                          <div class="filter" style="top: <?php echo $top; ?>px"></div>
                          
                          <i class='bx bxs-certification'></i>
                          <span data-purecounter-start="0" data-purecounter-end="<?php echo get_user_meta($curauth->ID, 'skill1V', true); ?>" data-purecounter-duration="2" class="purecounter skill-num"><?php echo get_user_meta($curauth->ID, 'skill1V', true); ?>%</span>
                          <p class="skill"><?php echo get_user_meta($curauth->ID, 'skill1', true); ?></p>
                        </div>
                      </div>
                      
                      <?php
                      }
                      if(get_user_meta($curauth->ID, 'skill2V', true) != ''){
                      ?>
      
                      <div class="col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                          
                          <?php
                          $top = 18 - (31 * (get_user_meta($curauth->ID, 'skill2V', true)) / 100);
                          ?>
                          <div class="filter" style="top: <?php echo $top; ?>px"></div>
                          
                          
                          <i class='bx bxs-certification'></i>
                          <span data-purecounter-start="0" data-purecounter-end="<?php echo get_user_meta($curauth->ID, 'skill2V', true); ?>" data-purecounter-duration="2" class="purecounter skill-num"><?php echo get_user_meta($curauth->ID, 'skill2V', true); ?>%</span>
                          <p class="skill"><?php echo get_user_meta($curauth->ID, 'skill2', true); ?></p>
                        </div>
                      </div>
                      
                      <?php
                      }
                      if(get_user_meta($curauth->ID, 'skill3V', true) != ''){
                      ?>
      
                      <div class="col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                          
                          <?php
                          $top = 18 - (31 * (get_user_meta($curauth->ID, 'skill3V', true)) / 100);
                          ?>
                          <div class="filter" style="top: <?php echo $top; ?>px"></div>
                          
                          
                          <i class='bx bxs-certification'></i>
                          <span data-purecounter-start="0" data-purecounter-end="<?php echo get_user_meta($curauth->ID, 'skill3V', true); ?>" data-purecounter-duration="2" class="purecounter skill-num"><?php echo get_user_meta($curauth->ID, 'skill3V', true); ?>%</span>
                          <p class="skill"><?php echo get_user_meta($curauth->ID, 'skill3', true); ?></p>
                        </div>
                      </div>
                      
                      <?php
                      }
                      if(get_user_meta($curauth->ID, 'skill4V', true) != ''){
                      ?>
      
                      <div class="col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                          
                          <?php
                          $top = 18 - (31 * (get_user_meta($curauth->ID, 'skill4V', true)) / 100);
                          ?>
                          <div class="filter" style="top: <?php echo $top; ?>px"></div>
                          
                          
                          <i class='bx bxs-certification'></i>
                          <span data-purecounter-start="0" data-purecounter-end="<?php echo get_user_meta($curauth->ID, 'skill4V', true); ?>" data-purecounter-duration="2" class="purecounter skill-num"><?php echo get_user_meta($curauth->ID, 'skill4V', true); ?>%</span>
                          <p class="skill"><?php echo get_user_meta($curauth->ID, 'skill4', true); ?></p>
                        </div>
                      </div>
                      
                      <?php
                      }
                      ?>
                      
                    </div>
                  </div><!-- End .content-->
                </div>
              </div>
      
            </div>
          </section>
          <?php } ?>
          
          
          <!-- ======= Latest Posts Section ======= -->
          <section id="news" class="team">
            <div class="container" data-aos="fade-up">
      
              <div class="section-title">
                <h2>My Latest Posts</h2>
              </div>
      
              <div class="row">
                
                <?php
                // Comienza el LOOP
                $args = array(
                  'posts_per_page' => 3,
                  'author' => $curauth->ID,
                  'post-type' => array('post', 'coverage'),
                );
                $latest_posts = new WP_Query($args);
                
                if($latest_posts->have_posts()):
                  while($latest_posts->have_posts()):
                    $latest_posts->the_post();
                    
                    // Thumbnail img
                    if(has_post_thumbnail()){
                      $thumb_url = get_the_post_thumbnail_url();
                    } else { // Imagen por defecto
                      $thumb_url = get_template_directory_uri().'/assets/img/default.png';
                    }
                ?>
      
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                      <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img featured-img">
                          <img src="<?php echo $thumb_url; ?>" class="img-fluid img-post" alt="<?php the_title(); ?>">
                        </div>
                        <div class="member-info post-info">
                          <span><?php the_time('F j, Y'); ?></span>
                          <h4><?php the_title(); ?></h4>
                          <?php the_category(); ?>
                          <p><?php the_excerpt(); ?></p>
                          <a href="<?php the_permalink(); ?>" class="get-started-btn scrollto btn-readmore">Read more</a>
                        </div>
                      </div>
                    </div>
                
                <?php
                  endwhile;
                else:
                  echo '<h2 class="noposts">There are no posts yet...</h2>';
                endif;
                
                // Reset query
                wp_reset_query();
                ?>
      
              </div>
      
            </div>
          </section><!-- End Latest Posts Section -->

      </div>
    </section><!-- End Author Section -->

<?php
    get_footer();
?>

