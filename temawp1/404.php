<?php
/* 
    Template Name: Contact
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
          <h1>404</h1>
        </div>
      </div>

    </div>
  </section><!-- End Hero -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

      </div>
    </section><!-- End Contact Section -->

<?php
    get_footer();
?>