<?php
/*
Plugin Name: ICB Wordpress Bank
Plugin URI: http://internetcentralbank.org
Description: 
Version: 0.1
Author: Jim Maguire
Author URI: http://customrayguns.com
*/

//The bootloader launches the varies features of the plugin:
$icb_bank = new icb_bank_bootloader;

class icb_bank_bootloader {

	function __construct(){
		add_action( 'widgets_init', function(){register_widget( 'icb_bank_sidebar_bootloader' );});
	}
}

//crg_login_widget is the sidebar widget for this plugin:
class icb_bank_sidebar_bootloader extends WP_Widget {
	function __construct() {
		parent::__construct(
			'Bitcoin Bank', // Base ID
			__('Bitcoin Bank', 'icb_text_domain'), // Name
			array( 'description' => __( 'The Bitcoin Bank.', '_text_domain' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 * @see WP_Widget::widget()
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		echo $args['before_title'];
		
		echo ("<h3 class = 'widget-title'>");
		_e ("Bitcoin Bank" , "icb_text_domain");
		echo ("</h3>");


		echo $args['after_widget'];
		
		$jquery_output = 
<<<JQUERY_OUTPUT_START_STOP
<script>
jQuery('document').ready(function() {

});
</script>
JQUERY_OUTPUT_START_STOP;
		
		echo $jquery_output;
	}
	/**
	 * Back-end widget form.
	 * @see WP_Widget::form()
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		 }else {
			$title = __( 'Huh title', 'crg_text_domain' );
		}
		?>
		<p>
		<label for="crg_login_social_login">Use Social Logins?</label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 * @see WP_Widget::update()
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}

}
?>
