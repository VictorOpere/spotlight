<?php 
/**
 * Name: Spotlight.
 * Author: https://www.karavic.com/certifiedvic
 * 
 */


// The widget class
class Spotlight_PopularPosts_Widget extends WP_Widget {

	// Main constructor
	public function __construct() {
 
    /**
	 * Register widget with WordPress.
	*/
         parent::__construct(
                'spotlight_popular_post_widget', // Base ID
                esc_html__( 'Spotlight Popular Posts', 'spotlight' ), // Name
                array( 'description' => esc_html__( 'A Popular Post Widget', 'spotlight' ), ) // Args
            );
     }
	

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {		
		$title = $instance['title'];
		$postscount = $instance['posts'];
		 
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		
        //write code for determining popular posts
        
        ?>
		
        <div class="post-entry-sidebar">
		<ul>
		<?php
                $args = array( 'numberposts' => $postscount, 'order'=> 'DESC', 'orderby' => 'date' );
                $postslist = get_posts( $args );
                foreach ($postslist as $post) :  setup_postdata($post); ?> 

				   <li>
                    <a href="">
                      <img src="images/img_2.jpg" alt="Image placeholder" class="mr-4">
                      <div class="text">
                        <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                        <div class="post-meta">
                          <span class="mr-2">March 15, 2018 </span> &bullet;
                          <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                        </div>
                      </div>
                    </a>
                  </li>

        <?php endforeach; ?>

		</ul>
        </div>
		
		<?php

		echo $args['after_widget'];;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Popular Posts', 'text_domain' );
		$posts = ! empty( $instance['posts'] ) ? $instance['posts'] : esc_html__( '5', 'text_domain' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>"><?php esc_attr_e( 'Number of Posts:', 'text_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts' ) ); ?>" type="text" value="<?php echo esc_attr( $posts ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['posts'] = ( ! empty( $new_instance['posts'] ) ) ? sanitize_text_field( $new_instance['posts'] ) : '';

		return $instance;
	}
}