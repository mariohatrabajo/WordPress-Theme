<?php
    get_header();
?>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="<?php echo home_url(); ?>">Mh<span>.</span></a></h1>
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
          <h2>Blog</h2>
          <!--<ol>-->
          <!--  <li><a href="index.html">Home</a></li>-->
          <!--  <li>Portfolio Details</li>-->
          <!--</ol>-->
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">
          
          <!-- Post destacado -->
          <?php
            $args = array(
              'posts_per_page' => 1,
              'meta_key' => 'numVisits',
              'order_by' => 'meta_value_num',
              'order' => 'DESC',
            );
            $post_destacado = new WP_Query($args);
            if($post_destacado->have_posts()):
              while($post_destacado->have_posts()):
                $post_destacado->the_post();
                
                // Thumbnail img
                if(has_post_thumbnail()){
                  $thumb_url = get_the_post_thumbnail_url();
                } else { // Imagen por defecto
                  $thumb_url = get_template_directory_uri().'/assets/img/default.png';
                }
                
                // Almacenar el id del post destacado
                $post_destacado_id = $post->ID;
          ?>
                <div class="post-destacado">
                  <div class="row blog-post">
                    <div class="col-md-1"></div>
                      <img src="<?php echo $thumb_url; ?>" class="blog-thumbnail col-md-4" alt="<?php the_title(); ?>">
                      
                      <div class="member-info post-info col-md-6">
                        <span>Published on <?php the_time('F j, Y'); ?> by <?php the_author_posts_link(); ?></span>
                        <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                        <ul class="post-categories">&#128392;
                          <li><?php the_category('</li> & <li class="categoria">'); ?></li>
                        </ul>
                        <?php the_excerpt(); ?>
                        <p><?php the_tags(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="get-started-btn scrollto btn-readmore">Read more</a>
                      </div>
                  </div>
                </div>
          <?php
              endwhile;
            endif;
                
            // Reset query
            wp_reset_postdata();
          ?>
          
          <!-- El resto de posts -->
          <div class="col-lg-8">
            <div class="blog">
              <h1>BLOG</h1>
                
                <?php
                // Comienza el LOOP
                $paged = get_query_var('paged') > 1 ? get_query_var('paged') : 1;
                $args = array(
                  'paged' => $paged, // Indicates if uses pagination
                  'posts_per_page' => 4,
                  'post__not_in' => array($post_destacado_id),// Exclude the featured post ID
                  'post_status' => 'publish',
                );
                $query = new WP_Query($args);
                
                if($query->have_posts()):
                  while($query->have_posts()):
                    $query->the_post();
                    
                    // Thumbnail img
                    if(has_post_thumbnail()){
                      $thumb_url = get_the_post_thumbnail_url();
                    } else { // Imagen por defecto
                      $thumb_url = get_template_directory_uri().'/assets/img/default.png';
                    }
                ?>
      
                <div class="row blog-post">
                    <img src="<?php echo $thumb_url; ?>" class="blog-thumbnail col-md-6" alt="<?php the_title(); ?>">
                    
                    <div class="member-info post-info col-md-6">
                      <span><?php the_time('F j, Y'); ?> · <?php the_author_posts_link(); ?></span>
                      <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                      
                      <!-- Asi se hace para separar las categorias con un caracter, ademas de ponerle clases a las categorias-->
                      <ul class="post-categories">&#128392;
                        <li class="categoria"><?php the_category('</li> & <li class="categoria">'); ?></li>
                      </ul>
                      
                      <?php the_excerpt(); ?>
                      
                      <p><?php the_tags(); ?></p>
                      
                      <a href="<?php the_permalink(); ?>" class="get-started-btn scrollto btn-readmore">Read more</a>
                    </div>
                </div>
                
                <?php
                  endwhile;
                else:
                  echo '<h2 class="noposts">There are no posts yet...</h2>';
                endif;
                
                // Reset query
                wp_reset_postdata();
                ?>
                
                <?php
                  // Paginacion
                  echo '<ul class="pagination">'; // Lo que necesites para las clases de tu tema
                  $args = Array(
                    'type' => 'list', // Para que devuelva <li> en vez de <a>
                  ); // Para meterle clases al li hay que usar js 
                  the_posts_pagination($args);
                  echo '</ul>';
                ?>
            </div>
          </div>

          <!-- Sidebar -->
          <div class="col-lg-4">
            <?php get_sidebar(); ?>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

<?php
    get_footer();
?>