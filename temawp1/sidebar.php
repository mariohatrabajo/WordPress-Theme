<div class="portfolio-info sidebar">
    
    <?php
        get_search_form();
    ?>
    
    <div class="widget-area">
        <h3>Tag Cloud & Calendar</h3>
        <!-- Área de widgets -->
        <?php
            if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Widgets')):
        ?> <!-- Preguntamos si existe un area de widgets definida en el back-end -->
        <p>Sorry, no widget installed for this theme!</p> <!-- Texto para cuando no haya widgets -->
        <?php
            endif;
        ?>
        
    </div>
    
    <div>
        <h3>Categories</h3>
        <ul class="category-list">
            <?php
                // Devuelve un elemento <li> por cada categoría
                $categories = wp_list_categories('title_li=&show_count=1&echo=0');
                $categories = preg_replace('/<\/a> \(([0-9]+)\)/', '<span class="category-count"> \\1</span></a>', $categories);
                echo $categories;
            ?>
        </ul>
    </div>
    
    <div>
        <h3>Recent Posts</h3>
        <ul>
            <?php 
                $args = Array(
                    'post_per_page' => 4,
                );
                $recentPost = new WP_Query($args);
                if($recentPost->have_posts()):
                    while($recentPost->have_posts()):
                        $recentPost->the_post();
                        
                        // Thumbnail img
                        if(has_post_thumbnail()){
                          $thumb_url = get_the_post_thumbnail_url();
                        } else { // Imagen por defecto
                          $thumb_url = get_template_directory_uri().'/assets/img/default.png';
                        }
            ?>
            <div class="recent-post row">
                <img src="<?php echo $thumb_url; ?>" class="blog-thumbnail col-md-2" alt="<?php the_title(); ?>">
                <div class="member-info post-info col-md-10">
                  <a href="<?php the_permalink(); ?>" class="a-title"><?php the_title(); ?></a>
                </div>
                <!--<span><?php the_time('F j, Y'); ?></span>-->
            </div>
            <?php 
                    endwhile;
                else:
                    echo 'No post published yet...';
                endif;
                wp_reset_postdata();
            ?>
        </ul>
    </div>
    
    <div>
        <h3>Authors</h3>
        <ul>
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
    
    <div>
        <h3>Pages</h3>
        <ul>
            <?php 
                $pages = get_pages(); // Devuelve una coleccion de objetos tipo pagina
                foreach($pages as $page){
                    if(!in_array($page->post_title, array('HOME', 'BLOG', 'PROJECTS', 'ARCHIVES', 'CONTACT'))){
                        $exclude_pages[] = $page->ID;
                    }
                }
                $args = Array(
                    'title_li'=> '',
                    'exclude' => implode(',', $exclude_pages), // String con los ids de las paginas separados por coma
                );
                wp_list_pages($args);
            ?>
        </ul>
    </div>
    
</div>