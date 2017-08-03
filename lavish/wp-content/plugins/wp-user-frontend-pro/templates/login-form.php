<?php

/*

  If you would like to edit this file, copy it to your current theme's directory and edit it there.

  WPUF will always look in your theme's directory first, before using this default template.

 */

?>

<div class="login" id="wpuf-login-form">
  <div class="container">
    <div class="login-form-box">

    <?php

    $message = apply_filters( 'login_message', '' );

    if ( ! empty( $message ) ) {

        echo $message . "\n";

    }

    ?>



    <?php WPUF_Login::init()->show_errors(); ?>

    <?php WPUF_Login::init()->show_messages(); ?>



    <form name="loginform" class="wpuf-login-form" id="loginform" action="<?php echo $action_url; ?>" method="post">

       <ul>
        <li>

            <label for="wpuf-user_login"><?php _e( 'Username' ); ?></label>

            <input type="text" name="log" id="wpuf-user_login" class="input" value="" size="20" />

        </li>

        <li>

            <label for="wpuf-user_pass"><?php _e( 'Password' ); ?></label>

            <input type="password" name="pwd" id="wpuf-user_pass" class="input" value="" size="20" />

        </li>



        <?php do_action( 'login_form' ); ?>



        <li class="forgetmenot">

            <input name="rememberme" type="checkbox" id="wpuf-rememberme" value="forever" />

            <label for="wpuf-rememberme"><?php esc_attr_e( 'Remember Me' ); ?></label>

        </li>



        <li class="submit">

            <input type="submit" name="wp-submit" id="wp-submit" value="<?php esc_attr_e( 'Log In' ); ?>" />

            <input type="hidden" name="redirect_to" value="http://onlinedevserver.biz/dev/lavish/dashboard/" />

            <input type="hidden" name="wpuf_login" value="true" />

            <input type="hidden" name="action" value="login" />

            <?php wp_nonce_field( 'wpuf_login_action' ); ?>

        </li>
      </ul>
    </form>



    <?php echo WPUF_Login::init()->get_action_links( array( 'login' => false ) ); ?>
   </div>
 </div>
</div>

