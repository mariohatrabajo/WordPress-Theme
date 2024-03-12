<?php
    get_header();
    
    the_post();
    $post_id = $post->ID;
    // Get an array with the categories
    $cats = wp_get_post_categories($post_id);
    
    add_num_visits($post_id);
    
    $author_id = $post->post_author;
?>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="<?php echo home_url(); ?>">MH<span>.</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
       <!--<a href="index.html" class="logo me-auto me-lg-0"><img src="<?php echo bloginfo('template_directory'); ?>/assets/img/pulpo.png" alt="" class="img-fluid"></a>-->

      <?php
        get_template_part('nav');
      ?>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h1><?php the_title(); ?></h1>
            <h4><?php comments_number('No comments','1 comment', '% comments'); ?> · <?php echo get_num_visits($post_id); ?></h4>
          </div>
          <!--<ol>-->
          <!--  <li><a href="<?php echo get_page_link(get_page_object('BLOG')->ID); ?>">Blog</a></li>-->
          <!--  <li><?php the_title(); ?></li>-->
          <!--</ol>-->
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">
          <!-- El resto de posts -->
          <div class="col-lg-8">
            <div class="blog">
            
            <?php
              do_shortcode('[mha_show_all_fields id="'.$post->ID.'"]');
            ?>
            
            <?php the_content(); ?>
            
            </div>
          </div>

          <!-- Sidebar -->
          <div class="col-lg-4">
            <?php get_sidebar('single'); ?>
          </div>

        </div>

      </div>
    </section>
    
    
    <!-- ======= Related posts ======= -->
    <section id="related" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Related Posts</h2>
        </div>

        <div class="row">
          
          <?php
            $args = array(
              'posts_per_page' => 3,
              // Only the posts that share category
              'category__in' => $cats,
              // Not the post we are seeing
              'post__not_in' => array($post_id),
            );
            $related_posts = new WP_Query($args);
            
            
            if($related_posts->have_posts()):
                while($related_posts->have_posts()):
                    $related_posts->the_post();
                    
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
                    <img src="<?php echo $thumb_url; ?>" class="img-fluid img-post" alt="">
                  </div>
                  <div class="member-info post-info">
                    <span><?php the_time('F j, Y'); ?> · <?php the_author_posts_link(); ?></span>
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
            echo '<h2 class="noposts">No posts related yet...</h2>';
          endif;
          
          // Reset query
          wp_reset_query();
          ?>

        </div>

      </div>
    </section><!-- End DB Section -->

    <!-- Author Bio -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-8">
            <div class="blog">
              
              <?php 
                $args = Array(
                  'class' => 'avatar', // Add CSS classes to the img
                );
                echo get_avatar($author_id); 
              ?>              
              <h3><?php the_author_posts_link() ?></h3>
              <p><?php echo get_the_author_meta('description', $author_id); ?></p>
            
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Author Bio -->

    <!-- Comments -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-8">
            <div class="blog">
              <h3>
              <?php comments_number('No comments', '1 comment', '% comments'); ?>
              </h3>
              
              <?php comments_template(); ?>
            
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Comments -->

  </main><!-- End #main -->

<?php
    get_footer();
?>