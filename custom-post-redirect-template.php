<?php
/*
Template Name: Custom Post Redirect Template
*/

get_header(); 

$url = esc_url(get_permalink(get_posts(array('post_type' => 'listings', 'posts_per_page' => 1))[0]->ID));

?>


<script>
  // Redirect to the specified URL when the page loads
  jQuery(document).ready(function($) {
    window.location.href = "<?php echo $url; ?>";
  });
</script>

<!-- <a href="<?php //echo esc_url(get_permalink(get_posts(array('post_type' => 'listings', 'posts_per_page' => 1))[0]->ID)); ?>" class="custom-post-type-button">
Go to First Post</a> -->

<?php 

get_footer();
?>