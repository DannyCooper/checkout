<?php
/**
 * Template Name: Home Page Template
 *
 * The template for displaying a home page.
 *
 * @package checkout
 */

remove_action( 'zeus_content', 'zeus_loop', 10 );
add_action( 'zeus_content', 'checkout_home_loop', 10 );
add_action( 'zeus_site_content_before', 'checkout_output_homepage_widgets', 5 );

/**
 * @TODO
 */
function checkout_output_homepage_widgets() {

	if ( is_active_sidebar( 'featured-post' ) || is_active_sidebar( 'featured-categories' ) ) {
		echo '<div class="homepage-widget-area clear"><div class="wrap">';
			echo '<div class="widget-area-featured-post">';
				dynamic_sidebar( 'featured-post' );
			echo '</div><!-- .widget-area-featured-post -->';

			echo '<div class="widget-area-featured-categories">';
				dynamic_sidebar( 'featured-categories' );
			echo '</div><!-- .wrap -->';
			echo '</div><!-- .widget-area-featured-categories -->';
		echo '</div>';
	}
}

/**
 * @TODO
 */
function checkout_home_loop() {

	$args = array(
		'posts_per_page' => 3, // @TODO add a filter.
	);

	$loop = new WP_Query( $args );

	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();

			echo '<article ' . zeus_get_attr( 'post', '', 'class=clear' ) . '>';

    			if ( has_post_thumbnail() ) {
                    echo '<div class="home-post-thumbnail">';
                        the_post_thumbnail( 'checkout-homepage-blog-thumbnail' );
                    echo '</div>';
    			}

                echo '<div class="home-post-content">';

        			the_title( sprintf( '<h2 %s><a href="%s" rel="bookmark">', zeus_get_attr( 'entry-title' ), esc_url( get_permalink() ) ), '</a></h2>' );

                    echo '<p>'.wp_trim_words( get_the_content(), 45 ).'</p>';

                    echo '<p><a class="moretag" href="'.esc_url( get_permalink() ).'">'._e('Read More&hellip;','checkout').'</a></p>';

                echo '</div>';

			echo '</article><!-- .post-'.get_the_ID().' -->';

	endwhile;
endif;

wp_reset_postdata();

}

zeus();
