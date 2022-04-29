<?php 
/*
 
 Plugin Name: Axtrax
  
 Plugin URI: https://axtrax.com/
  
 Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. It keeps your site protected even while you sleep. To get started: activate the Akismet plugin and then go to your Akismet Settings page to set up your API key.
  
 Version: 4.1.7
  
 Author: Amhih
  
 Author URI: https://automattic.com/wordpress-plugins/
  
 License: GPLv2 or later
  
 Text Domain: akismet
  
 **/
add_action('wp_body_open', 'tb_head');

function get_user_or_websitename()
{
    if( !is_user_logged_in() )
    {
		if(get_option('topbar_field')){
			return get_option('topbar_field');
		} else {
			return 'Welcome to ' . get_bloginfo('name');
		}
		
    }
    else
    {
        $current_user = wp_get_current_user();
        return 'Welcome back ' . $current_user -> user_login;
    }
}

function tb_head()
{
    echo '<h3 class="tb">' . get_user_or_websitename() . '</h3>';
}

//Add CSS to the top bar
add_action('wp_print_styles', 'tb_css');

function tb_css()
{
    echo '
        <style>
		h3.tb {color: #fff; margin: 0; padding: 30px; text-align: center; background: orange}
        </style>
    ';
}






function topbar_plugin_page() {
	$page_title = 'Top Bar Options';
	$menu_title = 'Top Bar';
	$capatibily = 'manage_options';
	$slug = 'topbar-plugin';
	$callback = 'topbar_page_html';
	$icon = 'dashicons-schedule';
	$position = 60;

	add_menu_page($page_title, $menu_title, $capatibily, $slug, $callback, $icon, $position);
}

add_action('admin_menu', 'topbar_plugin_page');


function topbar_register_settings() {
	register_setting('topbar_option_group', 'topbar_field');
}

add_action('admin_init', 'topbar_register_settings');

function topbar_page_html() { ?>
    <div class="wrap top-bar-wrapper">
        <form method="post">
            <?php settings_errors() ?>
            <?php settings_fields('topbar_option_group'); ?>
            <label for="topbar_field_eat">Nome </label>
            <input name="topbar_name" id="topbar_field_eat" type="checkbox" value="true" <?php if (get_option("wp_contact_name") == "true") { echo"checked"; } ?>> <br>
            <label for="topbar_field_eat">Prénom</label>
            <input name="topbar_prenom" id="topbar_field_eat" type="checkbox" value="true" <?php if (get_option("wp_contact_prenom") == "true") { echo"checked"; } ?> > <br>
            <label for="topbar_field_eat">Tél</label>
            <input name="topbar_tel" id="topbar_field_eat" type="checkbox" value="true" <?php if (get_option("wp_contact_tel") == "true") { echo"checked"; } ?>> <br>
            <label for="topbar_field_eat">Email</label>
            <input name="topbar_email" id="topbar_field_eat" type="checkbox" value="true" <?php if (get_option("wp_contact_email") == "true") { echo"checked"; } ?>> <br>
            <label for="topbar_field_eat">Adress</label>
            <input name="topbar_adress" id="topbar_field_eat" type="checkbox" value="true" <?php if (get_option("wp_contact_adress") == "true") { echo"checked"; } ?>> <br>
            <label for="topbar_field_eat">Message</label>
            <input name="topbar_message" id="topbar_field_eat" type="checkbox" value="true" <?php if (get_option("wp_contact_message") == "true") { echo"checked"; } ?>> <br>
            <input name="submit"  type="submit" value="submit"> <br>
        </form>
    </div>
    
    <?php 
$nome =  "false";
$prenome =  "false";
$tele =  "false";
$email =  "false";
$adress =  "false";
$message =  "false";

if (isset($_POST['submit']) ){

    
    
    if (isset($_POST['topbar_name']) ){
        $nome = $_POST['topbar_name'];
       
    }
    if (isset($_POST['topbar_prenom']) ){
        $prenome = $_POST['topbar_prenom'];
       
    }
    if (isset($_POST['topbar_tel']) ){
        $tele = $_POST['topbar_tel'];
       
    }
    if (isset($_POST['topbar_email']) ){
        $email = $_POST['topbar_email'];
       
    }
    if (isset($_POST['topbar_adress']) ){
        $adress = $_POST['topbar_adress'];
       
    }
    if (isset($_POST['topbar_message']) ){
        $message = $_POST['topbar_message'];
       
    }
    
    update_option("wp_contact_name",$nome);
    update_option("wp_contact_prenom",$prenome);
    update_option("wp_contact_tel",$tele);
    update_option("wp_contact_email",$email);
    update_option("wp_contact_adress",$adress);
    update_option("wp_contact_message",$message);

    echo"done";

    }
    





    
 }

 function tyet($test,$lables){

    if (get_option($test) == "true") {
        echo "<label>$lables</label>
        <input type='text' >";
      
    }
}

 function gta(){

    tyet("wp_contact_name","Nome");
    tyet("wp_contact_prenom","Prénome");
    tyet("wp_contact_tel","Tél");
    tyet("wp_contact_email","Email");
    tyet("wp_contact_adress","Adress");
    tyet("wp_contact_message","Message");
    echo "<input type='button' value='done' >";

}

 add_shortcode( "fourmulaire", "gta");

?>