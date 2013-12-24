<?php
/*
Plugin Name: Website Rating
Plugin URI: http://buffercode.com/wordpress-website-rating-plugin/
Description: Easy way to display the number of post in that particular category by selecting from admin dashboard widget.
Version: 1.2
Author: vinoth06
Author URI: http://buffercode.com/
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Additing Action hook widgets_init
add_action( 'widgets_init', 'buffercode_website_rating'); 

function buffercode_website_rating() {
register_widget( 'buffercode_website_rating_info' );
}

class buffercode_website_rating_info extends WP_Widget {
function buffercode_website_rating_info () {
		$this->WP_Widget('buffercode_website_rating_info', 'Website Rating','Select the category to display');	}

public function form( $instance ) { 
if ( isset( $instance[ 'buffercode_website_rating_cutom_title' ])) {
			$buffercode_website_rating_cutom_title = $instance[ 'buffercode_website_rating_cutom_title' ];
}
		else {//Setting Default Values
		$buffercode_website_rating_cutom_title = 'Rate Our Website';
		} ?>
		<!-- Buffercode.com Category Widget Options -->
		<p>Custom Name: <input class="widefat" name="<?php echo $this->get_field_name( 'buffercode_website_rating_cutom_title' ); ?>" type="text" value="<?php echo esc_attr( $buffercode_website_rating_cutom_title );?>" /></p>

<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['buffercode_website_rating_cutom_title'] = ( ! empty( $new_instance['buffercode_website_rating_cutom_title'] ) ) ? strip_tags( $new_instance['buffercode_website_rating_cutom_title'] ) : '';
return $instance;
}

function widget($args, $instance) {
extract($args);
echo $before_widget;
$bc_name_value = apply_filters( 'widget_title', $instance['buffercode_website_rating_cutom_title'] );

if ( !empty( $name ) ) { echo $before_title . $bc_name_value . $after_title; }

?>
<?php if(!isset($_COOKIE['buffercode_website_rating'])){ ?>
<form method="post" action="" onsubmit="setCookie();" name="buffercode_website_rating_post">
<select name="buffercode_website_rating_options">
<option value="0" selected >Please Rate Me!</option>
<option value="1">&#9733;</option>
<option value="2">&#9733;&#9733;</option>
<option value="3">&#9733;&#9733;&#9733;</option>
<option value="4">&#9733;&#9733;&#9733;&#9733;</option>
<option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
</select>
<input type="submit" name="buffercode_website_rating_submit" value="submit" />
</form>

<?php
}
if(isset($_COOKIE['buffercode_website_rating']) || isset($_POST['buffercode_website_rating_post']))
{ 
if((isset($_POST['buffercode_website_rating_options']))){
$value=$_POST['buffercode_website_rating_options'];
if($value==1){
$value1 = get_option('buffercode_website_rating_rating1') + 1;
update_option('buffercode_website_rating_rating1',$value1);
}
elseif($value==2){
$value2 = get_option('buffercode_website_rating_rating2') + 1;
update_option('buffercode_website_rating_rating2',$value2);
}
elseif($value==3){
$value3 = get_option('buffercode_website_rating_rating3') + 1;
update_option('buffercode_website_rating_rating3',$value3);
}
elseif($value==4){
$value4 = get_option('buffercode_website_rating_rating4') + 1;
update_option('buffercode_website_rating_rating4',$value4);
}
elseif($value==5){
$value5 = get_option('buffercode_website_rating_rating5') + 1;
update_option('buffercode_website_rating_rating5',$value5);
}
$buffercode_website_rating_rating1=get_option('buffercode_website_rating_rating1');
$buffercode_website_rating_rating2=get_option('buffercode_website_rating_rating2');
$buffercode_website_rating_rating3=get_option('buffercode_website_rating_rating3');$buffercode_website_rating_rating4=get_option('buffercode_website_rating_rating4');$buffercode_website_rating_rating5=get_option('buffercode_website_rating_rating5');

$buffercode_website_rating_array = array( $buffercode_website_rating_rating1, $buffercode_website_rating_rating2, $buffercode_website_rating_rating3, $buffercode_website_rating_rating4, $buffercode_website_rating_rating5);

$buffercode_website_rating_max = max($buffercode_website_rating_array);

$buffercode_website_rating_100 = 100 / $buffercode_website_rating_max;

$buffercode_website_rating_rating_result_1 = $buffercode_website_rating_rating1 *  $buffercode_website_rating_100;
$buffercode_website_rating_rating_result_2 = $buffercode_website_rating_rating2 *  $buffercode_website_rating_100;
$buffercode_website_rating_rating_result_3 = $buffercode_website_rating_rating3 *  $buffercode_website_rating_100;
$buffercode_website_rating_rating_result_4 = $buffercode_website_rating_rating4 *  $buffercode_website_rating_100;
$buffercode_website_rating_rating_result_5 = $buffercode_website_rating_rating5 *  $buffercode_website_rating_100;
update_option('buffercode_website_rating_rating_result_1',$buffercode_website_rating_rating_result_1);
update_option('buffercode_website_rating_rating_result_2',$buffercode_website_rating_rating_result_2);
update_option('buffercode_website_rating_rating_result_3',$buffercode_website_rating_rating_result_3);
update_option('buffercode_website_rating_rating_result_4',$buffercode_website_rating_rating_result_4);
update_option('buffercode_website_rating_rating_result_5',$buffercode_website_rating_rating_result_5);
}
?>
<div class="wrap">
<b><i>Thanks for Rating</i></b><br>
<b>Website Rating Statistics</b>
<table width="100%">
<!-- Buffercode.com website rating Statistics -->
<tr valign="top">
	<td width="20%">&#9733; 5</td>
	<td width="10%"><?php echo get_option('buffercode_website_rating_rating5'); ?></td>
         <td width="70%" align="center" valign="middle"><hr align="left"  width="<?php echo get_option('buffercode_website_rating_rating_result_5'); ?>%" style="border-top: 15px solid #00FF00"></td>
</tr>
<!-- Buffercode.com website rating Statistics -->
<tr valign="top">
<td width="20%">&#9733; 4</td>
        <td width="10%"><?php echo get_option('buffercode_website_rating_rating4'); ?> </td>
         <td width="70%" align="center" valign="middle"><hr align="left" width="<?php echo get_option('buffercode_website_rating_rating_result_4'); ?>%" style="border-top: 15px solid #D4FF00"></td>
</tr>
<!-- Buffercode.com website rating Statistics -->
<tr valign="top">
<td width="20%">&#9733; 3</td>
<td width="10%"><?php echo get_option('buffercode_website_rating_rating3'); ?></td>
              <td width="70%" align="center" valign="middle"><hr align="left" width="<?php echo get_option('buffercode_website_rating_rating_result_3'); ?>%" style="border-top: 15px solid #2A00FF"></td>
</tr>
<!-- Buffercode.com website rating Statistics -->
<tr valign="top">
<td width="20%">&#9733; 2</td>
<td width="10%"><?php echo get_option('buffercode_website_rating_rating2'); ?></td>
        <td width="70%" valign="middle"><hr align="left" width="<?php echo get_option('buffercode_website_rating_rating_result_2'); ?>%" style="border-top: 15px solid #FF2AAA"></td>

</tr>
<!-- Buffercode.com website rating Statistics -->
<tr valign="top">
<td width="20%">&#9733; 1</td>
<td width="10%"><?php echo get_option('buffercode_website_rating_rating1'); ?></td>
   <td width="70%" valign="middle"><hr valign="left" width="<?php echo get_option('buffercode_website_rating_rating_result_1'); ?>%" style="border-top: 15px solid #EF2349"></td>

</tr>
<!-- Buffercode.com website rating Statistics -->
</table>

</div>

<?php
 }
echo $after_widget;
}
}
add_action('admin_menu', 'buffercode_website_rating_menu');

function buffercode_website_rating_menu() {

	add_options_page( 'Website Rating ID', 'Website Rating', 'manage_options', __FILE__, 'buffercode_website_rating_options' );
add_action( 'admin_init', 'buffercode_website_rating_regsiter_setting' );
}

function buffercode_website_rating_options(){ 
?>

<div class="wrap">
<!-- Buffercode.com website rating Statistics -->
<h2>Website Rating Statistics</h2><br><br>
<table width="100%">

<tr valign="top">
       <th scope="row" width="10%">&#9733; 5:</th>
	   <td width="5%"><?php echo get_option('buffercode_website_rating_rating5'); ?></td>
        <td width="40%"><hr align="left"  width="<?php echo get_option('buffercode_website_rating_rating_result_5'); ?>%" style="border-top: 15px solid #00FF00"></td>

			<td width="45%"></td>
</tr>

<tr valign="top">
       <th scope="row" width="10%">&#9733; 4:</th>
	   <td width="5%"><?php echo get_option('buffercode_website_rating_rating4'); ?></td>
        <td width="40%"><hr align="left" width="<?php echo get_option('buffercode_website_rating_rating_result_4'); ?>%" style="border-top: 15px solid #D4FF00"></td>

			<td width="45%"></td>
</tr>

<tr valign="top">
        <th scope="row" width="10%">&#9733; 3:</th>
		<td width="5%"><?php echo get_option('buffercode_website_rating_rating3'); ?></td>
        <td width="40%"><hr align="left" width="<?php echo get_option('buffercode_website_rating_rating_result_3'); ?>%" style="border-top: 15px solid #2A00FF"></td>

			<td width="45%"></td>
</tr>

<tr valign="top">
      <th scope="row" width="10%">&#9733; 2:</th>
	  <td width="5%" ><?php echo get_option('buffercode_website_rating_rating2'); ?></td>
        <td width="40%"><hr align="left" width="<?php echo get_option('buffercode_website_rating_rating_result_2'); ?>%" style="border-top: 15px solid #FF2AAA"></td>

			<td width="45%"></td>

		</tr>

<tr valign="top">
        <th scope="row" width="10%">&#9733; 1:</th>
		<td width="5%"><?php echo get_option('buffercode_website_rating_rating1'); ?></td>
        <td width="40%"><hr align="left" width="<?php echo get_option('buffercode_website_rating_rating_result_1'); ?>%" style="border-top: 15px solid #EF2349"></td>

			<td width="45%"></td>
</tr>
For More information - <a href="http://buffercode.com/wordpress-website-rating-plugin/">Wordpress Website Rating Plugin</a>
<!-- Buffercode.com website rating Statistics -->
</table>

</div>
<?php }

function buffercode_website_rating_regsiter_setting(){
register_setting( 'buffercode_website_rating_regsiter_setting_group', 'buffercode_website_rating_options' );
}

add_action( 'wp_head', 'buffercode_cookie_script' );

function buffercode_cookie_script() {

  echo "<script>function setCookie(){ document.cookie = 'buffercode_website_rating=ok; expires=Fri, 14 Oct 2040 20:47:11 UTC; path=/' }</script>\n";

}
?>