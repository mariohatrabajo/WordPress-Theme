<?php
    get_header();
    
    // Recogemos el criterio de busqueda
    if(isset($_GET['s'])){ // Si existe una vble de busqueda en la url
        if(empty($_GET['s'])){ // Si has buscado vacio
            $words = 'All posts';
        }else {
          $words = get_search_query(); // Lo mismo que $_GET['s'], devuelve la palabra de busqueda
        }
    }
    
    // Hallar el numero de posts que ha encontrado
    if(have_posts()){
      // Almacenamos el numero de posts encontrado
      $total = $wp_the_query->found_posts; // $wp_the_query es una de las formas de referenciar la consulta principal de WP
      // Si es 1 la palabra que sigue es en singular, sino es en plural
      if($total != 1){
        $whatever = 'posts';
      }else {
        $whatever = 'post';
      }
    }else {
      $total = 'No';
      $whatever = 'posts';
    }
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
            <h1>Search for: <?php echo $words; ?></h1>
            <h4><?php echo $total; ?> <?php echo $whatever; ?> found</h4>
          </div>
          <ol>
            <li><a href="<?php echo get_page_link(get_page_object('BLOG')->ID); ?>">Blog</a></li>
            <li>Search</li>
          </ol>
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
              if(have_posts()):
                while(have_posts()):
                  the_post();
                  
                  // Thumbnail img
                  if(has_post_thumbnail()){
                    $thumb_url = get_the_post_thumbnail_url();
                  } else { // Imagen por defecto
                    if(get_post_type() == 'page'){ // El resultado es una pagina, no un post normal
                      switch($post->post_title){
                        case 'HOME':
                          $thumb_url = get_template_directory_uri().'/assets/img/home_thumb.jpg';
                          break;
                        case 'BLOG':
                          $thumb_url = get_template_directory_uri().'/assets/img/blog_thumb.jpg';
                          break;
                        case 'PROJECTS':
                          $thumb_url = get_template_directory_uri().'/assets/img/home_thumb.jpg';
                          break;
                        case 'ARCHIVES':
                          $thumb_url = get_template_directory_uri().'/assets/img/home_thumb.jpg';
                          break;
                        case 'CONTACT':
                          $thumb_url = get_template_directory_uri().'/assets/img/contact_thumb.jpg';
                          break;
                        case 'PRIVATE':
                          $thumb_url = get_template_directory_uri().'/assets/img/home_thumb.jpg';
                          break;
                        case 'COVERAGE':
                          $thumb_url = get_template_directory_uri().'/assets/img/home_thumb.jpg';
                          break;
                        case 'Privacy Policy':
                          $thumb_url = get_template_directory_uri().'/assets/img/home_thumb.jpg';
                          break;
                      }
                    }else {
                      $thumb_url = get_template_directory_uri().'/assets/img/default.png';
                    }
                  }
            ?>
            
            <div class="search-item row" data-aos="zoom-in" data-aos-delay="0">
              <img src="<?php echo $thumb_url; ?>" class="blog-thumbnail col-md-2" alt="<?php the_title(); ?>">
              <div class="blog-thumbnail col-md-8">
                <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                <p><?php 
                  if(get_post_type() == 'post' || get_post_type() == 'coverage')
                    the_time('F j, Y');
                  else
                    echo 'PAGE';
                ?></p>
              </div>
              <?php
                if(get_post_type() == 'coverage'){
              ?>
                  <div class="col-md-2 CPT">
                    <span class="CPT_title">Coverage</span>
                  </div>
              <?php
                }
              ?>
            </div>               
                
            <?php
                endwhile;
              endif;
              
              
              // Paginacion
              echo '<ul class"blabla">'; // Lo que necesites para las clases de tu tema
              $args = Array(
                'type' => 'list', // Para que devuelva <li> en vez de <a>
              ); // Para meterle clases al li hay que usar js :)
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
    </section>

  </main><!-- End #main -->

<?php
    get_footer();
?>