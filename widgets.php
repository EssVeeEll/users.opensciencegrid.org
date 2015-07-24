<aside id="footer-widgets">
    <div class="container">
        <div class="row"> 
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_sidebar') ) : ?>

                <div class="col-md-4">
			<h3 class = "footer-widget-title">Our Sponsors</h3>
			<a href = "http://www.nsf.gov" target = "_blank"><img src = "http://nsf.gov/images/nsf_logo.png" width = "350"></a>
			<p>&nbsp;</p>
			<a href = "http://www.science.energy.gov" target = "_blank"><img src = "http://science.energy.gov/~/media/_/images/about/resources/logos/png/high-res/RGB_Color-Seal_Green-Mark_SC_Horizontal.png" width = "350"></a>
                    </div>
                <div class="col-md-4">
                    <div class="footer-widget">
                        <h3 class="footer-widget-title">Recent Posts</h3>
                        <?php $portfolio_id = get_cat_ID(of_get_option('portfolio_category','')); ?>
                        <ul class = "media-list">
			<?php $args = array('posts_per_page' => '3',
			'orderby' => 'post_date');	
			$posts = get_posts($args);
			global $post;
			foreach($posts as $post): 
				setup_postdata($post);?>
				<li class = "media">
				<a href = "<?php the_permalink(); ?>" class = "pull-left media-object">
				
				<?php if (has_post_thumbnail($post->ID)) :
					$info = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
					<img src = "<?php  echo $info; ?>" class = "attachment-post_list " width = "80" height = "80">
				<?php else: 
					$url = get_stock_feature_url('thumbnail'); ?>
					<img src="<?php echo $url; ?>" class="img-responsive" alt="No image" width = "80" height = "80">
				<?php endif; ?>
				</a>
				<div class = "media-body">
				<pclass = "media-heading">
				<a href = "<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</p>
				<small><?php the_date(); ?></small>
				</div>
				</li>
				<span class = "clearfix">
				</span>
				
			<?php endforeach; ?> 
                
                </ul>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-widget">
                        
                        <h3 class="footer-widget-title">Research Highlights</h3>
			
                            <?php
                                $args = array (
                                    'post_type'              => 'post',
                                    'pagination'             => false,
                                    'posts_per_page'         => '1',
				    'cat' 		     => '64',
				    'orderby'		     => 'rand',
                                );
                            ?>

                            
                            <?php $the_query = new WP_Query($args); ?>
                            <?php if ($the_query -> have_posts()) : ?>
                                <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

					<div class = "row">
					<div class = "col-md-6">
					<?php if (has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>">
                                        	<?php the_post_thumbnail('medium', array('class' => "img-responsive imageborder link")); ?>
						</a>
						<br>
                                     <?php else: ?>
					<a href="<?php the_permalink(); ?>">
					<img src="<?php echo get_stock_feature_url('medium'); ?>" class="img-responsive imageborder link" alt="No image">
					</a>
                                     <?php endif; ?>		
					</div>	
					
					<?php endwhile;?>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>


			<?php $the_query = new WP_Query($args); ?>
                            <?php if ($the_query -> have_posts()) : ?>
                                <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
					<div class = "col-md-6">
					<?php if (has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>">
                                        	<?php the_post_thumbnail('medium', array('class' => "img-responsive imageborder link")); ?>
						</a>
						<br>
                                     <?php else: ?>
					<a href="<?php the_permalink(); ?>">
					<img src="<?php echo get_stock_feature_url('medium'); ?>" class="img-responsive imageborder link" alt="No image">
					</a>
                                     <?php endif; ?>		
					</div>	
					</div>
					
                                <?php endwhile;?>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>

				<?php $the_query = new WP_Query($args); ?>
                            <?php if ($the_query -> have_posts()) : ?>
                                <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

					<div class = "row">
					<div class = "col-md-6">
					<?php if (has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>">
                                        	<?php the_post_thumbnail('medium', array('class' => "img-responsive imageborder link")); ?>
						</a>
						<br>
                                     <?php else: ?>
					<a href="<?php the_permalink(); ?>">
					<img src="<?php echo get_stock_feature_url('medium'); ?>" class="img-responsive imageborder link" alt="No image">
					</a>
                                     <?php endif; ?>		
					</div>	
					
					<?php endwhile;?>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>


			<?php $the_query = new WP_Query($args); ?>
                            <?php if ($the_query -> have_posts()) : ?>
                                <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
					<div class = "col-md-6">
					<?php if (has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>">
                                        	<?php the_post_thumbnail('medium', array('class' => "img-responsive imageborder link")); ?>
						</a>
						<br>
                                     <?php else: ?>
					<a href="<?php the_permalink(); ?>">
					<img src="<?php echo get_stock_feature_url('medium'); ?>" class="img-responsive imageborder link" alt="No image">
					</a>
                                     <?php endif; ?>		
					</div>	
					</div>
					
                                <?php endwhile;?>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>

                        </div>
                    </div>
                </div>

            <?php endif; ?>
        </div> <!-- row -->
    </div> <!-- container -->
</aside> <!-- footer-widgets -->