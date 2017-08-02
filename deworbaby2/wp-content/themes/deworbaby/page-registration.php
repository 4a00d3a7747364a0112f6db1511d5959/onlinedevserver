<?php
/*
* The template for inner pages
*/
get_header(); ?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<section id="general">
  <div id="sub-general">
    <div class="container">

    <section class="signIn">
    
       <div class="form_area">
           <div class="form_inner">
              <div class="actual_form_area">
                  <h2>Register with DeworBaby</h2>
                  <div class="social_Login">
                     <!-- <p>Sign In with</p>
                     <ul class="social_btn">
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Google</a></li>
                     </ul> -->
                     <p class="or">or</p>
                  </div>
  
      <h2 style="display: none;"><?php _e( 'Register', 'woocommerce' ); ?></h2>
  
      <form method="post" class="register">

      <?php do_action( 'woocommerce_register_form_start' ); ?>

      <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
          <label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
          <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" required/>
        </p>

      <?php endif; ?>

      <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
        <label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" required/>
      </p>

      <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide set-pwd">
          <label for="reg_password"><?php _e( 'Set Password', 'woocommerce' ); ?> <span class="required">*</span></label>
          <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" required/>
        </p>

      <?php endif; ?>

      <!-- Spam Trap -->
      <div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" /></div>

      <?php do_action( 'woocommerce_register_form' ); ?>
      <?php do_action( 'register_form' ); ?>

      <div class="woocomerce-FormRow1 form-row1 signin_btn">
        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
        <input type="submit" class="woocommerce-Button1 button1" name="register" value="<?php esc_attr_e( 'JOIN NOW', 'woocommerce' ); ?>" />
      </div>

      <?php do_action( 'woocommerce_register_form_end' ); ?>

    </form>


    <div class="row join">
                        <a href="<?php echo esc_url( home_url() ); ?>/my-account">Already a member?</a>
                  </div>
              </div>
           </div>
       </div>
   
  </section>


    </div>
  </div>
</section>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

<?php get_footer(); ?>