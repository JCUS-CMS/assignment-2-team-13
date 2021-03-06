<?php

if ( ! class_exists( 'BB_Instagram' ) ) {
	
	// INSTAGRAM	
	
	class BB_Instagram extends WP_Widget {
		
		private $error_cache_time = 15;
		private $min_cache_time = 15;
		private $default_cache_time = 30;
		private $trans_prefix = 'bt_bb_insta_';
	
		function __construct() {
			parent::__construct(
				'bt_bb_instagram', // Base ID
				esc_html__( 'BB Instagram', 'bold-builder' ), // Name
				array( 'description' => esc_html__( 'Recent Instagram images.', 'bold-builder' ) ) // Args
			);
		}
		
		public function get_trans_name( $hashtag, $username, $number ) {
			return  $this->trans_prefix . $hashtag . '_' . $number . '_' . trim( $username );
		}

		public function widget( $args, $instance ) {
			
			if ( ! class_exists( 'InstagramScraper\Instagram' ) ) {
				require_once 'instagram-php-scraper-master/src/InstagramScraper.php';
			}
			if ( ! class_exists( 'Unirest\Request' ) ) {
				require_once 'unirest-php-master/src/Unirest.php';
			}
			Unirest\Request::verifyPeer( false );
			
			$username = trim( $instance['username'] );
			if ( $username == '' ) {
				return;
			}

			$number = intval( trim( $instance['number'] ) );
			
			if ( $number < 1 ) {
				$number = 1;
			} else if ( $number > 30 ) {
				$number = 30;
			}
			
			$hashtag = trim( $instance['hashtag'] );
			
			$trans_name = $this->get_trans_name( $hashtag, $username, $number );

			$cache = $this->min_cache_time;
			
			if ( isset( $instance['cache'] ) ) { // back-compat
				$cache = intval( trim( $instance['cache'] ) );
			}
			
			if ( $cache < $this->min_cache_time ) {
				$cache = $this->min_cache_time;
			} else if ( $cache > 24*60 ) {
				$cache = 24*60;
			}
			
			// uncomment this for testing
			// $cache = 0;
					
			if ( $cache == 0 ) {
				delete_transient( $trans_name );
			}

			echo $args['before_widget'];
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			}
			
			if ( false == ( $cache_data = get_transient( $trans_name ) ) ) {
				
				$no_error = true;
			
				$output = '<div class="btInstaWrap">';
					$output .= '<div class="btInstaGrid">';
						
						try {
							$instagram = new InstagramScraper\Instagram();
							$medias = $instagram->getMedias( $username, $number );
							//var_dump($medias);
						} catch ( Exception $e ) {
							$no_error = false;
						}
						 
						if ( $no_error ) {
							
							$n = 0;
							foreach( $medias as $media ) {
								if ( $hashtag != '' && ! strpos( $media->getCaption(), $hashtag ) ) {
									continue;
								}
								$output .= '<span><a href="' . esc_url_raw( $media->getLink() ) . '"><img src="' . esc_url_raw( $media->getImageThumbnailUrl() ) . '" alt="' . esc_url_raw( $media->getLink() ) . '"></a></span>';
								$n++;
								if ( $n == $number ) {
									break;
								}
							}
							
							$no_error = true;

						} else {
							$no_error = true;
							$cache = $this->error_cache_time;
						}

					$output .= '</div>';
				$output .= '</div>';
				
				if ( $no_error && $cache > 0 ) {
					set_transient( $trans_name, $output, $cache * 60 );
				}
				
				echo $output;
				
			} else {
				
				echo $cache_data;
				
			}
			
			echo $args['after_widget'];
			
		}
	
		public function form( $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Instagram', 'bold-builder' );
			$username = ! empty( $instance['username'] ) ? $instance['username'] : '';
			$number = ! empty( $instance['number'] ) ? $instance['number'] : '4';
			$hashtag = ! empty( $instance['hashtag'] ) ? $instance['hashtag'] : '';
			$cache = ! empty( $instance['cache'] ) ? $instance['cache'] : $this->default_cache_time;
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'bold-builder' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php _e( 'Instagram username:', 'bold-builder' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of images:', 'bold-builder' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'hashtag' ) ); ?>"><?php _e( 'Hashtag:', 'bold-builder' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hashtag' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hashtag' ) ); ?>" type="text" value="<?php echo esc_attr( $hashtag ); ?>">			
			</p>			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cache' ) ); ?>"><?php _e( 'Cache (minutes):', 'bold-builder' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cache' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cache' ) ); ?>" type="text" value="<?php echo esc_attr( $cache ); ?>">			
			</p>
			<?php 
		}

		public function update( $new_instance, $old_instance ) {
			
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['username'] = ( ! empty( $new_instance['username'] ) ) ? strip_tags( $new_instance['username'] ) : '';
			$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
			$instance['hashtag'] = ( ! empty( $new_instance['hashtag'] ) ) ? strip_tags( $new_instance['hashtag'] ) : '';
			$instance['cache'] = ( ! empty( $new_instance['cache'] ) ) ? strip_tags( $new_instance['cache'] ) : $this->default_cache_time;
			
			$new_trans_name = $this->get_trans_name( $instance['hashtag'], $instance['username'], $instance['number'] );
			
			$old_trans_name = $this->get_trans_name( $old_instance['hashtag'], $old_instance['username'], $old_instance['number'] );
			
			delete_transient( $old_trans_name );
			delete_transient( $new_trans_name );	
			
			return $instance;
		}
	}

}