<?php 
	/*
	Template Name:  Media Centre Page
	*/

	get_header();
?>
	<div id="main-wrapper" class="media-centre media-centre-archive">
		<section class="media-centre-list">
			<div class="block--custom-layout block--custom-layout__media-centre">
				<div class="container-block">
					<div class="filter">
						<div class="cat">
							<a href="<?php echo get_site_url(); ?>/media-centre" class="active">View All</a>
							<?php
							$categories = get_categories(array(
								'hide_empty' => 1,
								'exclude' => 17,
							));
							foreach ($categories as $category) {
								echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . $category->name . '</a>';
							} ?>
						</div>
						<div class="dropdown">
							<div class="select-wrap">
								<div class="select-field">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="icon">
										<path d="M5 7.5L10 12.5L15 7.5" class="caret-down" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
									</svg>
									<div class="select-styled">Most recent</div>

									<ul class="select-options">
										<li class="select-option"><a href="?orderby=date&order=DESC">Most recent</a></li>
										<li class="select-option"><a href="?orderby=date&order=ASC">Oldest</a></li>
										<li class="select-option"><a href="?orderby=title&order=ASC">Alphabetical</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="blog-listing">
						<?php 

						if (have_posts()) :
							while (have_posts()) : the_post(); ?>

								<div class="list-item">
									<div class="blog-info">
										<?php $url = wp_get_attachment_url( get_post_thumbnail_id(), 'thumbnail' ); ?>
										<img class="blog-feat-img" src="<?php echo $url ?>">

										<p class="cat">
											<?php
												$terms = get_the_terms( $post->ID, 'section' ); 
												if ( $terms && ! is_wp_error( $terms ) ) { 
													foreach ( $terms as $term ) { 
														echo $term->name; 
													}
												}
											?>
										</p>
										<a class="permalink" href="<?php the_permalink(); ?>">
											<h3 class="title"><?php the_title(); ?></h3>
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M7 17L17 7M17 7H7M17 7V17" stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</a>
										<p class="excerpt"><?php the_excerpt(); ?></p>
									</div>
									<?php
									$categories = get_the_category();
									if (!empty($categories)) {
										foreach ($categories as $category) {
											if( $category->name == 'Videos' ){ ?>
												<a href="<?php the_permalink(); ?>" class="videos-btn btn btn-primary">Play Video</a>
											<?php } else { ?>
												<div class="blog-details">
													<?php
													$author_id = get_the_author_meta('ID');
													$avatar_url = get_avatar_url($author_id);
														echo '<img class="author-img" src="' . esc_url($avatar_url) . '" alt="Author Profile Image">';
													?>
													<div class="info">
														<p class="name">Evoro Author</p>
														<p class="date"><?php $post_date = get_the_date( 'j M Y' ); echo $post_date; ?></p>
													</div> 
												</div>
											<?php }
										}
									}
								?>
								</div>

							<?php endwhile;
						endif; wp_reset_postdata(); ?> 								
					</div>
					
					
				</div>
			</div>
		</section>
	</div>
<?php 
	get_footer(); 
?>

