<?php
/* 
    Template Name: Archives
*/
    get_header();
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
            <h1>Archives</h1>
          </div>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-12">
            <div class="blog">
                
                <!-- ======= Portfolio Section ======= -->
                <section id="portfolio" class="portfolio">
                  <div class="container" data-aos="fade-up">
            
                    <div class="section-title">
                      <h2>Index Directory</h2>
                      <p>Site Index</p>
                    </div>
                
                    <div class="grid">    
                        
                        <!-- Begin m-card -->
                        <div class="grid-item sizer m-card">
                            <div class="m-card-header">
                                <h3 class="m-card-title">Last Entries</h3>
                            </div>
                            <div class="m-card-body">
                                <ul class="last-entries">
                                    <?php
                                        $args = Array(
                                            'type' => 'postbypost', // Returns the post titles
                                            'limit' => 20,          // Max 20 posts
                                        );
                                        
                                        wp_get_archives($args);
                                    ?>
                                </ul>
                            </div>
                            <div class="m-card-footer">
                                
                            </div>
                        </div>
                        <!-- End m-card -->
                        
                        <!-- Begin m-card -->
                        <div class="grid-item sizer m-card">
                            <div class="m-card-header">
                                <h3 class="m-card-title">Coverages</h3>
                            </div>
                            <div class="m-card-body">
                                <ul class="last-entries">
                                    <?php
                                        $args = Array(
                                            'posts_per_page' => 20,
                                            'post_type' => array('coverage'),
                                        );
                                        
                                        $coverage = get_posts($args);
                                        if(empty($coverage)){
                                            echo '<h5>No Coverages yet...</h5>';
                                        }else {
                                            foreach($coverage as $post){
                                                echo '<li><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></li>';
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="m-card-footer">
                                
                            </div>
                        </div>
                        <!-- End m-card -->
                        
                        <!-- Begin m-card -->
                        <div class="grid-item sizer m-card">
                            <div class="m-card-header">
                                <h3 class="m-card-title">Tag List</h3>
                            </div>
                            <div class="m-card-body">
                                <ul class="tag-list">
                                    <?php
                                        echo get_tag_list(20);
                                    ?>
                                </ul>
                            </div>
                            <div class="m-card-footer">
                                
                            </div>
                        </div>
                        <!-- End m-card -->
                        
                        <!-- Begin m-card -->
                        <div class="grid-item sizer m-card">
                            <div class="m-card-header">
                                <h3 class="m-card-title">Category List</h3>
                            </div>
                            <div class="m-card-body">
                                <ul class="m-category-list">
                                    <?php
                                        // Devuelve un elemento <li> por cada categoría
                                        $categories = wp_list_categories('title_li=&show_count=1&echo=0');
                                        $categories = preg_replace('/<\/a> \(([0-9]+)\)/', '<span class="category-count"> \\1</span></a>', $categories);
                                        echo $categories;
                                    ?>
                                </ul>
                            </div>
                            <div class="m-card-footer">
                                
                            </div>
                        </div>
                        <!-- End m-card -->
                        
                        <!-- Begin m-card -->
                        <div class="grid-item sizer m-card">
                            <div class="m-card-header">
                                <h3 class="m-card-title">Authors</h3>
                            </div>
                            <div class="m-card-body">
                                <ul class="m-card-authors">
                                    <?php 
                                    $args = Array(
                                        'optioncount' => 1,// Visualiza el num de posts del autor
                                        'echo' => false,
                                        'hide_empty' => false,
                                        'orderby' => 'post_count', // Ordena por numero de posts
                                        'order' => 'DESC', // Ordena descendentemente
                                    );
                                    $authors = wp_list_authors($args); 
                                    $authors = preg_replace('/<\/a> \(([0-9]+)\)/', '<span class="category-count"> \\1</span></a>', $authors);
                                    echo $authors;
                                    ?>
                                </ul>
                            </div>
                            <div class="m-card-footer">
                                
                            </div>
                        </div>
                        <!-- End m-card -->
                        
                        <!-- Begin m-card -->
                        <div class="grid-item sizer m-card">
                            <div class="m-card-header">
                                <h3 class="m-card-title">Daily Posts</h3>
                            </div>
                            <div class="m-card-body">
                                <ul class="m-card-daily">
                                    <?php 
                                    $args = Array(
                                        'type' => 'daily', // Dates with published posts 
                                        'show_post_count' => true, // Show number of posts published that day
                                        'limit' => 20,
                                        'echo' => false,
                                    );
                                    $daily = wp_get_archives($args); 
                                    $daily = preg_replace('/<\/a> \(([0-9]+)\)/', '<span class="category-count"> \\1</span></a>', $daily);
                                    echo $daily;
                                    ?>
                                </ul>
                            </div>
                            <div class="m-card-footer">
                                
                            </div>
                        </div>
                        <!-- End m-card -->
                        
                        <!-- Begin m-card -->
                        <div class="grid-item sizer m-card">
                            <div class="m-card-header">
                                <h3 class="m-card-title">Monthly Posts</h3>
                            </div>
                            <div class="m-card-body">
                                <ul class="m-card-monthly">
                                    <?php 
                                    $args = Array(
                                        'type' => 'monthly', // Dates with published posts 
                                        'show_post_count' => true, // Show number of posts published that day
                                        'limit' => 20,
                                        'echo' => false,
                                    );
                                    $monthly = wp_get_archives($args); 
                                    $monthly = preg_replace('/<\/a> \(([0-9]+)\)/', '<span class="category-count"> \\1</span></a>', $monthly);
                                    echo $monthly;
                                    ?>
                                </ul>
                            </div>
                            <div class="m-card-footer">
                                
                            </div>
                        </div>
                        <!-- End m-card -->
                        
                        <!-- Begin m-card -->
                        <div class="grid-item sizer m-card">
                            <div class="m-card-header">
                                <h3 class="m-card-title">Yearly Posts</h3>
                            </div>
                            <div class="m-card-body">
                                <ul class="m-card-yearly">
                                    <?php 
                                    $args = Array(
                                        'type' => 'yearly', // Dates with published posts 
                                        'show_post_count' => true, // Show number of posts published that day
                                        'limit' => 20,
                                        'echo' => false,
                                    );
                                    $yearly = wp_get_archives($args); 
                                    $yearly = preg_replace('/<\/a> \(([0-9]+)\)/', '<span class="category-count"> \\1</span></a>', $yearly);
                                    echo $yearly;
                                    ?>
                                </ul>
                            </div>
                            <div class="m-card-footer">
                                
                            </div>
                        </div>
                        <!-- End m-card -->
                        
                        <!-- Begin m-card -->
                        <div class="grid-item sizer m-card">
                            <div class="m-card-header">
                                <h3 class="m-card-title">Most Commented Posts</h3>
                            </div>
                            <div class="m-card-body">
                                <ul class="last-entries">
                                    <?php
                                        $args = Array(
                                            'posts_per_page' => 15,
                                            'order' => 'DESC',
                                            'orderby' => 'comment_count',
                                        );
                                        
                                        $posts = get_posts($args);
                                        if(empty($posts)){
                                            echo '<h5>No Posts commented yet...</h5>';
                                        }else {
                                            foreach($posts as $post){
                                                echo '<li><a href="'.get_permalink($post->ID).'">'.$post->post_title.'&nbsp;&nbsp;&nbsp;<span class="category-count">'.get_comments_number($post->ID).'</span></a></li>';
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="m-card-footer">
                                
                            </div>
                        </div>
                        <!-- End m-card -->
                        
                        <!-- Begin m-card -->
                        <div class="grid-item sizer m-card">
                            <div class="m-card-header">
                                <h3 class="m-card-title">Most Popular Posts</h3>
                            </div>
                            <div class="m-card-body">
                                <ul class="popular-posts">
                                    <?php
                                        $args = Array(
                                            'posts_per_page' => 20,
                                            'meta_key' => 'numvisits', // filter by numvisits
                                            'order_by' => 'meta_value_num',
                                            'order' => 'DESC',
                                        );
                                        
                                        $popular = get_posts($args);
                                        if(empty($popular)){
                                            echo '<h5>No posts visited yet...</h5>';
                                        }else {
                                            foreach($popular as $post){
                                                echo '<li><a href="'.get_permalink($post->ID).'">'.$post->post_title.'&nbsp;&nbsp;&nbsp;<span class="category-count">'.$post->numvisits.'</span></a></li>';
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="m-card-footer">
                                
                            </div>
                        </div>
                        <!-- End m-card -->
                        
                        
                        <?php
                            // Authors loop
                            // We need name and ID of each author
                            $args = Array('display_name', 'ID');
                            $authors = get_users($args);
                            
                            foreach($authors as $author){
                        ?>
                        <!-- Begin m-card -->
                        <div class="grid-item sizer m-card">
                            <div class="m-card-header">
                                <h3 class="m-card-title"><?php echo $author->display_name ?>'s Posts</h3>
                            </div>
                            <div class="m-card-body">
                                <ul class="author-posts">
                                    <?php
                                        $args = Array(
                                            'posts_per_page' => 20,
                                            'author' => $author->ID,
                                        );
                                        
                                        $post_by_author = get_posts($args);
                                        if(empty($post_by_author)){
                                            echo '<h5>No posts by '.$author->display_name.' yet...</h5>';
                                        }else {
                                            foreach($post_by_author as $post){
                                                echo '<li><a href="'.get_permalink($post->ID).'">'.$post->post_title.' <span class="category-count">'.$post->numvisits.'</span></a></li>';
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="m-card-footer">
                                
                            </div>
                        </div>
                        <!-- End m-card -->
                        <?php
                            }
                        ?>
                    
                    </div> 
            
                    </div>
            
                  </div>
                </section><!-- End Portfolio Section -->

                
            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

<?php
    get_footer();
?>