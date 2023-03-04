<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/CylasKiganda/previous-next-edit-order-links-for-woocommerce
 * @since      1.0.1
 *
 * @package    Previous_Next_Edit_Order_Links_For_Woocommerce
 * @subpackage Previous_Next_Edit_Order_Links_For_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Previous_Next_Edit_Order_Links_For_Woocommerce
 * @subpackage Previous_Next_Edit_Order_Links_For_Woocommerce/admin
 * @author     Belo <belocodes@gmail.com>
 */
class Previous_Next_Edit_Order_Links_For_Woocommerce_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Previous_Next_Edit_Order_Links_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Previous_Next_Edit_Order_Links_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/previous-next-edit-order-links-for-woocommerce-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Previous_Next_Edit_Order_Links_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Previous_Next_Edit_Order_Links_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

  //Data initialization---------
  $screen_id = false;
  $final_prev_next_output = array("prev"=>0,"next"=>0);
  global $post;

 if ( function_exists( 'get_current_screen' ) ) {
     
     $screen    = get_current_screen();
     $screen_id = isset( $screen, $screen->id ) ? $screen->id : '';
     if ( $screen_id == 'shop_order' ) {
     //Import the orders' data---------
     $query = new WC_Order_Query( array( 
         'limit' => -1,
         'orderby' => 'date',
         'order' => 'DESC',
         'return' => 'ids',
     ) );
     $orders_belo = $query->get_orders();
     $cur = 0;
     $prev = 0;
     $next = 0;
     for($i=0;$i<=count($orders_belo);$i++){
		if($post){
			if($orders_belo[$i] == $post->ID){
				$cur = $i;
				$prev = $cur - 1;
				$next = $cur + 1;
				break;
			}
		}
         
     }

    //Filling the Output array---------     
     if($prev >= 0 ){
        if(!empty($orders_belo[$prev])){
            $final_prev_next_output["prev"] = admin_url( 'post.php?post='.$orders_belo[$prev].'&action=edit' ); 
        }
     }
     if($next > 0 ){
        if(!empty($orders_belo[$next])){
            $final_prev_next_output["next"] = admin_url( 'post.php?post='.$orders_belo[$next].'&action=edit' ); 
        }
     }
     
     //Enqueuing the Output JS scripts---------
    
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/previous-next-edit-order-links-for-woocommerce-admin.js', array( 'jquery' ), $this->version, false );
 	    wp_localize_script($this->plugin_name, 'prev_next_script_vars', array(
			"prev" => $final_prev_next_output["prev"],
            "prev_text" => __('Previous Order','belo_prev_next_domain'),
            "next" => $final_prev_next_output["next"],
            "next_text" => __('Next Order','belo_prev_next_domain')
			)
		);
	}
}

}}