<?php


/*******************************************
* bbp profile Information Display Functions
*******************************************/

add_action ('bbp_theme_after_reply_author_details', 'bbp_profile_information') ;
add_action ('bbp_template_after_user_profile', 'user_profile_bbp_profile_information') ;
add_action ('bbp_user_edit_after_name', 'edit_bbp_profile_information') ;
add_action( 'personal_options_update',         'bbp_edit_user_bbp_profile_information' );
add_action( 'edit_user_profile_update',        'bbp_edit_user_bbp_profile_information' );
add_action( 'edit_user_profile', 'rpi_user_profile_field', 50,2 )  ;
add_action( 'edit_user_profile_update', 'user_profile_bbp_profile_information' );

 
function bbp_profile_information () 
//This function adds the item and label if required to the author section of topics/replies

{
		global $rpi_options;
		
		echo '<ul>';
		$user_id = bbp_get_reply_author_id();
		
		//show item1 if activated & show on topics
		if (!empty ($rpi_options['Activate_item1']) && (!empty ($rpi_options['itemshow_item1']) ) ){
			echo '<li>' ; 
			//show label if required
				if(!empty ($rpi_options['labelshow_item1'] )) {
					echo $label1 =  $rpi_options['item1_label'].": " ;
				}
			$usermeta = get_userdata( $user_id, 'rpi_label1' );
			echo $usermeta->rpi_label1;
			echo '</li>' ;
		}
		
		//show item2 if activated & show on topics
		if (!empty ($rpi_options['Activate_item2']) && (!empty ($rpi_options['itemshow_item2']) ) ){
			echo '<li>' ; 
			//show label if required
				if(!empty ($rpi_options['labelshow_item2'] )) {
					echo $label2 =  $rpi_options['item2_label'].": " ;
				}
			$usermeta = get_userdata( $user_id, 'rpi_label2' );
			echo $usermeta->rpi_label2;
			echo '</li>' ;
		}
		
		//show item3 if activated & show on topics
		if (!empty ($rpi_options['Activate_item3']) && (!empty ($rpi_options['itemshow_item3']) ) ){
			echo '<li>' ; 
			//show label if required
				if(!empty ($rpi_options['labelshow_item3'] )) {
					echo $label3 =  $rpi_options['item3_label'].": " ;
				}
			$usermeta = get_userdata( $user_id, 'rpi_label3' );
			echo $usermeta->rpi_label3;
			echo '</li>' ;
		}
		
		//show item4 if activated on topics/replies
		if (!empty ($rpi_options['Activate_item4']) && (!empty ($rpi_options['itemshow_item4']) ) ){
			echo '<li>' ; 
			//show label if required
				if(!empty ($rpi_options['labelshow_item4'] )) {
					echo $label4 =  $rpi_options['item4_label'].": " ;
				}
			$usermeta = get_userdata( $user_id, 'rpi_label4' );
			echo $usermeta->rpi_label4;
			echo '</li>' ;
		}
		
}


function user_profile_bbp_profile_information()
//this function adds the items to the profile display menu, and if the user can edit other users display first, lastname and email
			{
			global $rpi_options;
			
			//item 1
			if(!empty ($rpi_options['Activate_item1'] )) {
			//if ($rpi_options['Activate_item1']== true) {
			$label1 = (!empty($rpi_options['item1_label']) ? $rpi_options['item1_label']  : '') ;
			//$label1 =  $rpi_options['item1_label'] ;
			echo "<p>" ;
			printf ( __( $label1.': ', 'bbp-profile-informaton' ));
			echo esc_attr( bbp_get_displayed_user_field( 'rpi_label1' )); 
			echo"</p>" ;
			}
			
			//item 2
			if(!empty ($rpi_options['Activate_item2'] )) {
			$label2 = (!empty($rpi_options['item2_label']) ? $rpi_options['item2_label']  : '') ;
			echo "<p>" ;
			printf ( __( $label2.': ', 'bbp-profile-informaton' ));
			echo esc_attr( bbp_get_displayed_user_field( 'rpi_label2' )); 
			echo"</p>" ;
			}
			
			//item 3
			if(!empty ($rpi_options['Activate_item3'] )) {
			$label3 = (!empty($rpi_options['item3_label']) ? $rpi_options['item3_label']  : '') ;
			echo "<p>" ;
			printf ( __( $label3.': ', 'bbp-profile-informaton' ));
			echo esc_attr( bbp_get_displayed_user_field( 'rpi_label3' )); 
			echo"</p>" ;
			}
			
			//item 4
			if(!empty ($rpi_options['Activate_item4'] )) {
			$label4 = (!empty($rpi_options['item4_label']) ? $rpi_options['item4_label']  : '') ;
			echo "<p>" ;
			printf ( __( $label4.': ', 'bbp-profile-informaton' ));
			echo esc_attr( bbp_get_displayed_user_field( 'rpi_label4' )); 
			echo"</p>" ;
			}
			
			
			if ( current_user_can( 'edit_users' ) ) {
			//echo "<p class="bbp-user-first-name">" ;
			printf ( __( 'First name: %s', 'bbp-profile-informaton' ), bbp_get_displayed_user_field( 'first_name'));
			echo "</p>" ;
			//echo "<p class="bbp-user-last-name">" ;
			printf ( __( 'Last name: %s', 'bbp-profile-informaton' ), bbp_get_displayed_user_field( 'last_name'));
			echo "</p>" ;
			echo "<p>" ;
			printf ( __( 'Email: ', 'bbp-profile-informaton' ));
			echo esc_attr( bbp_get_displayed_user_field( 'user_email' ));
			echo "</p>" ;
			}
			
			}
			




function edit_bbp_profile_information()
//This function hooks to form-user-edit to add user ability to edit items
			{
			global $rpi_options;
			$user_id = esc_attr( bbp_get_displayed_user_field( 'ID' )) ;
			
			//item 1
			if(!empty ($rpi_options['Activate_item1'] )) {
			//if ($rpi_options['Activate_item1']== true) {
			$label1 =  $rpi_options['item1_label'] ;
			echo '<div id= "rpi-profile-item1">' ;			
			echo "<label for=\"rpi_label1\">".$label1 ;
			echo "</label>" ;
			$rpi_label1 = esc_attr(bbp_get_displayed_user_field( 'rpi_label1'));
			$quote= "<input type=\"text\" name=\"rpi_label1\" id=\"rpi_label1\" value=\"".$rpi_label1."\" />" ;
			echo $quote ;
			echo '</div>' ;
			}
			
			//item 2
			if(!empty ($rpi_options['Activate_item2'] )) {
			$label2 =  $rpi_options['item2_label'] ;
			echo '<div id= "rpi-profile-item2">' ;		
			$user_id = esc_attr( bbp_get_displayed_user_field( 'ID' )) ;
			echo "<label for=\"rpi_label2\">".$label2 ;
			echo "</label>" ;
			$rpi_label2 = esc_attr(bbp_get_displayed_user_field( 'rpi_label2'));
			$quote= "<input type=\"text\" name=\"rpi_label2\" id=\"rpi_label2\" value=\"".$rpi_label2."\" />" ;
			echo $quote ;
			echo '</div>' ;
			}
			
			//item 3
			if(!empty ($rpi_options['Activate_item3'] )) {
			$label3 =  $rpi_options['item3_label'] ;
			echo '<div id= "rpi-profile-item3">' ;	
			echo "<label for=\"rpi_label3\">".$label3 ;
			echo "</label>" ;
			$rpi_label3 = esc_attr(bbp_get_displayed_user_field( 'rpi_label3'));
			$quote= "<input type=\"text\" name=\"rpi_label3\" id=\"rpi_label3\" value=\"".$rpi_label3."\" />" ;
			echo $quote ;
			echo '</div>' ;
			}
			
			//item 4
			if(!empty ($rpi_options['Activate_item4'] )) {
			$label4 =  $rpi_options['item4_label'] ;
			echo '<div id= "rpi-profile-item4">' ;	
			echo "<label for=\"rpi_label4\">".$label4 ;
			echo "</label>" ;
			$rpi_label4 = esc_attr(bbp_get_displayed_user_field( 'rpi_label4'));
			$quote= "<input type=\"text\" name=\"rpi_label4\" id=\"rpi_label4\" value=\"".$rpi_label4."\" />" ;
			echo $quote ;
			echo '</div>' ;
			}
			
			
			
			
			}

			
			
		
//this function adds the updated items info to the usermeta database
function bbp_edit_user_bbp_profile_information( $user_id ) {
	$rpi_label1 = ( $_POST['rpi_label1'] ) ;
	$rpi_label2 = ($_POST['rpi_label2'] ) ;
	$rpi_label3 = ($_POST['rpi_label3'] ) ;
	$rpi_label4 = ($_POST['rpi_label4'] ) ;

	// Update rpi_label1 user meta
	if ( !empty( $rpi_label1 ) )
		update_user_meta( $user_id, 'rpi_label1', $rpi_label1);

	// Delete rpi_label1 user meta
	else
		delete_user_meta( $user_id, 'rpi_label1' );
		
	//Update rpi_label2 user meta
	if ( !empty( $rpi_label2 ) )
		update_user_meta( $user_id, 'rpi_label2', $rpi_label2);

	// Delete rpi_label2 user meta
	else
		delete_user_meta( $user_id, 'rpi_label2' );
		
		//Update rpi_label3 user meta
	if ( !empty( $rpi_label3 ) )
		update_user_meta( $user_id, 'rpi_label3', $rpi_label3);

	// Delete rpi_label2 user meta
	else
		delete_user_meta( $user_id, 'rpi_label3' );
		
		//Update rpi_label4 user meta
	if ( !empty( $rpi_label4 ) )
		update_user_meta( $user_id, 'rpi_label4', $rpi_label4);

	// Delete rpi_label4 user meta
	else
		delete_user_meta( $user_id, 'rpi_label4' );
		
		
}

function rpi_user_profile_field() {
	 global $current_user;
	global $rpi_options;
	 
		
		
	 if (isset($_REQUEST['user_id'])) {
		$user_id = $_REQUEST['user_id'];
	 } else {
		$user_id = $current_user->ID;
	 }
		?>
	 <table class="form-table">
			<tbody>
				<tr>
					<th><label for="bbp-profile-information"><?php esc_html_e( 'Profile Information', 'bbp-profile-information' ); ?></label></th></tr>
					
					
					
			<tr><th>
			<?php
			//item 1
			if(!empty ($rpi_options['Activate_item1'] )) {
			$label1 =  $rpi_options['item1_label'] ;
			echo '<div id= "rpi-profile-item1">' ;			
			echo "<label for=\"rpi_label1\">".$label1 ;
			echo "</label>" ;
			?>
			</th><td>
			<?php
			$rpi_label1 = (!empty (get_user_meta($user_id, 'rpi_label1', false)) ? get_user_meta($user_id, 'rpi_label1', true) : '' ) ;
			$quote= "<input type=\"text\" name=\"rpi_label1\" id=\"rpi_label1\" value=\"".$rpi_label1."\" />" ;
			echo $quote ;
			echo '</div>' ;
			}	
			?>
			</td>
			</tr>
			
			
			
			<tr><th>
			<?php
			//item 2
			if(!empty ($rpi_options['Activate_item2'] )) {
			$label2 =  $rpi_options['item2_label'] ;
			echo '<div id= "rpi-profile-item2">' ;			
			echo "<label for=\"rpi_label2\">".$label2 ;
			echo "</label>" ;
			?>
			</th><td>
			<?php
			$rpi_label2 = (!empty (get_user_meta($user_id, 'rpi_label2', false)) ? get_user_meta($user_id, 'rpi_label2', true) : '' ) ;
			$quote= "<input type=\"text\" name=\"rpi_label2\" id=\"rpi_label2\" value=\"".$rpi_label2."\" />" ;
			echo $quote ;
			echo '</div>' ;
			}	
			?>
			</td>
			</tr>
			
			
			
			<tr><th>
			<?php
			//item 3
			if(!empty ($rpi_options['Activate_item3'] )) {
			$label3 =  $rpi_options['item3_label'] ;
			echo '<div id= "rpi-profile-item3">' ;			
			echo "<label for=\"rpi_label3\">".$label3 ;
			echo "</label>" ;
			?>
			</th><td>
			<?php
			$rpi_label3 = (!empty (get_user_meta($user_id, 'rpi_label3', false)) ? get_user_meta($user_id, 'rpi_label3', true) : '' ) ;
			$quote= "<input type=\"text\" name=\"rpi_label3\" id=\"rpi_label3\" value=\"".$rpi_label3."\" />" ;
			echo $quote ;
			echo '</div>' ;
			}	
			?>
			</td>
			</tr>
			
			
			
			<tr><th>
			<?php
			//item 4
			if(!empty ($rpi_options['Activate_item4'] )) {
			$label4 =  $rpi_options['item4_label'] ;
			echo '<div id= "rpi-profile-item4">' ;			
			echo "<label for=\"rpi_label4\">".$label4 ;
			echo "</label>" ;
			?>
			</th><td>
			<?php
			$rpi_label4 = (!empty (get_user_meta($user_id, 'rpi_label4', false)) ? get_user_meta($user_id, 'rpi_label4', true) : '' ) ;
			$quote= "<input type=\"text\" name=\"rpi_label4\" id=\"rpi_label4\" value=\"".$rpi_label4."\" />" ;
			echo $quote ;
			echo '</div>' ;
			}	
			?>
			</td>
			</tr>
			</tbody>
			</table>
			<?php
		
		
		}

?>
