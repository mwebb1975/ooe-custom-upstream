<?php
/**
 * Description:   Add Outreach contact information for the footer
 */

class wp_outreach_contact_info_widget extends WP_Widget {


  // Set up the widget name and description.
  public function __construct() {
    $widget_options = array( 'classname' => 'outreach_contact_info_widget', 'description' => 'Add address, phone, email, social' );
    parent::__construct( 'outreach_contact_info_widget', 'Outreach Contact Information', $widget_options );
  }


  // Create the widget output.
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $address = isset( $instance['address'] ) ? $instance['address'] : '';
    $phone = isset( $instance['phone'] ) ? $instance['phone'] : '';
    $email = isset( $instance['email'] ) ? $instance['email'] : '';
    $facebook = isset( $instance['facebook'] ) ? $instance['facebook'] : '';
    $twitter = isset( $instance['twitter'] ) ? $instance['twitter'] : '';
    $linkedin = isset( $instance['linkedin'] ) ? $instance['linkedin'] : '';
    $instagram = isset( $instance['instagram'] ) ? $instance['instagram'] : '';  
    $googleplus = isset( $instance['googleplus'] ) ? $instance['googleplus'] : '';
    $youtube = isset( $instance['youtube'] ) ? $instance['youtube'] : '';
    $pinterest = isset( $instance['pinterest'] ) ? $instance['pinterest'] : '';
    $flickr = isset( $instance['flickr'] ) ? $instance['flickr'] : '';
    $template_directory = get_template_directory_uri();

    echo $args['before_widget'];
    if($title) {
      echo $args['before_title'] . $title . $args['after_title']; 
    }
    if($address) {
      echo '<div class="address dots-above">';
      echo wpautop($address);
      echo '</div>';
    }
    if($phone or $email) {
      echo '<div class="phone-email dots-above">';
      echo '<p>';
      if($phone) {
        echo 'Phone: ' . $phone;
        if($email) { echo '<br />'; }
      }
      if($email) {
        echo 'Email: <a href="mailto:' . $email . '">' . $email . '</a>';
      }
      echo '</p>';
      echo '</div>';
    }
    if($facebook or $twitter or $linkedin or $instagram or $googleplus or $youtube or $pinterest or $flickr) {
      echo '<div class="footer-social">';
      if($facebook) { 
        echo '<a title="Facebook" href="' . $facebook . '"><img src="' . $template_directory . '/images/social-icon-facebook.svg" alt="Facebook" /></a>'; 
      }
      if($twitter) { 
        echo '<a title="Twitter" href="' . $twitter . '"><img src="' . $template_directory . '/images/social-icon-twitter.svg" alt="Twitter" /></a>'; 
      }
      if($linkedin) { 
        echo '<a title="LinkedIn" href="' . $linkedin . '"><img src="' . $template_directory . '/images/social-icon-linkedin.svg" alt="LinkedIn" /></a>'; 
      }
      if($instagram) { 
        echo '<a title="Instagram" href="' . $instagram . '"><img src="' . $template_directory . '/images/social-icon-instagram.svg" alt="Instagram" /></a>'; 
      }
      if($googleplus) { 
        echo '<a title="Google+" href="' . $googleplus . '"><img src="' . $template_directory . '/images/social-icon-googleplus.svg" alt="Google+" /></a>'; 
      }
      if($youtube) { 
        echo '<a title="YouTube" href="' . $youtube . '"><img src="' . $template_directory . '/images/social-icon-youtube.svg" alt="YouTube" /></a>'; 
      }
      if($pinterest) { 
        echo '<a title="Pinterest" href="' . $pinterest . '"><img src="' . $template_directory . '/images/social-icon-pinterest.svg" alt="Pinterest" /></a>'; 
      }
      if($flickr) { 
        echo '<a title="Flickr" href="' . $flickr . '"><img src="' . $template_directory . '/images/social-icon-flickr.svg" alt="Flickr" /></a>'; 
      }
      echo '</div>';
    }
    echo $args['after_widget'];
  }

  
  // Create the admin area widget settings form.
  public function form( $instance ) {
    $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
    $address = isset( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';
    $phone = isset( $instance['phone'] ) ? esc_attr( $instance['phone'] ) : '';
    $email = isset( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
    $facebook = isset( $instance['facebook'] ) ? esc_attr( $instance['facebook'] ) : '';
    $twitter = isset( $instance['twitter'] ) ? esc_attr( $instance['twitter'] ) : '';
    $linkedin = isset( $instance['linkedin'] ) ? esc_attr( $instance['linkedin'] ) : '';
    $instagram = isset( $instance['instagram'] ) ? esc_attr( $instance['instagram'] ) : '';
    $googleplus = isset( $instance['googleplus'] ) ? esc_attr( $instance['googleplus'] ) : '';
    $youtube = isset( $instance['youtube'] ) ? esc_attr( $instance['youtube'] ) : '';
    $pinterest = isset( $instance['pinterest'] ) ? esc_attr( $instance['pinterest'] ) : '';
    $flickr = isset( $instance['flickr'] ) ? esc_attr( $instance['flickr'] ) : '';
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Organization Name:</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'address' ); ?>">Address:</label>
      <textarea rows="4" class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>"><?php echo esc_attr( $address ); ?></textarea>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'phone' ); ?>">Phone (xxx-xxx-xxxx):</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo esc_attr( $phone ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'email' ); ?>">Email Address:</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo esc_attr( $email ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook URL:</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo esc_attr( $facebook ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Twitter URL:</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo esc_attr( $twitter ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'linkedin' ); ?>">LinkedIn URL:</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo esc_attr( $linkedin ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'instagram' ); ?>">Instagram URL:</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo esc_attr( $instagram ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'googleplus' ); ?>">Google+ URL:</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" value="<?php echo esc_attr( $googleplus ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'youtube' ); ?>">YouTube URL:</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo esc_attr( $youtube ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'pinterest' ); ?>">Pinterest URL:</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo esc_attr( $pinterest ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'flickr' ); ?>">Flickr URL:</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo esc_attr( $flickr ); ?>" />
    </p><?php
  }


  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    $instance[ 'address' ] = strip_tags( $new_instance[ 'address' ] );
    $instance[ 'phone' ] = strip_tags( $new_instance[ 'phone' ] );
    $instance[ 'email' ] = strip_tags( $new_instance[ 'email' ] );
    $instance[ 'facebook' ] = strip_tags( $new_instance[ 'facebook' ] );
    $instance[ 'twitter' ] = strip_tags( $new_instance[ 'twitter' ] );
    $instance[ 'linkedin' ] = strip_tags( $new_instance[ 'linkedin' ] );
    $instance[ 'instagram' ] = strip_tags( $new_instance[ 'instagram' ] );
    $instance[ 'googleplus' ] = strip_tags( $new_instance[ 'googleplus' ] );
    $instance[ 'youtube' ] = strip_tags( $new_instance[ 'youtube' ] );
    $instance[ 'pinterest' ] = strip_tags( $new_instance[ 'pinterest' ] );
    $instance[ 'flickr' ] = strip_tags( $new_instance[ 'flickr' ] );
    return $instance;
  }

}

// Register the widget.
function wp_register_outreach_contact_info_widget() { 
  register_widget( 'wp_outreach_contact_info_widget' );
}
add_action( 'widgets_init', 'wp_register_outreach_contact_info_widget' );
