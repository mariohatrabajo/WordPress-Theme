<nav id="navbar" class="navbar order-last order-lg-0">
    <ul>
        <li><a class="nav-link scrollto <?php if(is_front_page()) echo 'active'; ?>" href="<?php echo home_url(); ?>">Home</a></li>
        <li><a class="nav-link scrollto <?php if(is_home() && !is_front_page()) echo 'active'; ?>" href="<?php echo get_page_link(get_page_object('BLOG')->ID); ?>">Blog</a></li>
        <li><a class="nav-link scrollto <?php if(is_page('COVERAGE')) echo 'active'; ?>" href="<?php echo get_page_link(get_page_object('COVERAGE')->ID); ?>">Coverage</a></li>
        <li><a class="nav-link scrollto <?php if(is_page('ARCHIVES')) echo 'active'; ?>" href="<?php echo get_page_link(get_page_object('ARCHIVES')->ID); ?>">Archives</a></li>
        <li><a class="nav-link scrollto <?php if(is_page('PRIVATE')) echo 'active'; ?>" href="<?php echo get_page_link(get_page_object('PRIVATE')->ID); ?>">Private</a></li>
        <li><a class="nav-link scrollto <?php if(is_page('CONTACT')) echo 'active'; ?>" href="<?php echo get_page_link(get_page_object('CONTACT')->ID); ?>">Contact</a></li>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
 </nav><!-- .navbar -->
<?php
if(!is_user_logged_in()){
?>
 <a href="<?php echo get_page_link(get_page_object('PRIVATE')->ID); ?>" class="get-started-btn scrollto">Log In</a>
<?php
}else{
    // Display log out button
    echo '<span class="get-started-btn scrollto">';
    wp_loginout(get_permalink());
    echo '</span>';
}
?>

