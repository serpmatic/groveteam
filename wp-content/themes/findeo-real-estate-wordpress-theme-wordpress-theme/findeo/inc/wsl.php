<?php 
// WSL integration

function wsl_findeo_use_fontawesome_icons( $provider_id, $provider_name, $authenticate_url )
{
   ?>
   <a 
      rel           = "nofollow"
      href          = "<?php echo $authenticate_url; ?>"
      data-provider = "<?php echo $provider_id ?>"
      class         = "wp-social-login-provider wp-social-login-provider-<?php echo strtolower( $provider_id ); ?>" 
    >
      <span>
         <?php if($provider_id == 'Facebook') : ?>
            <i class="fa fa-facebook-official"></i>
         <?php else : ?>
            <i class="fa fa-<?php echo strtolower( $provider_id ); ?>"></i>
         <?php endif; ?>
         <?php esc_html_e('Sign in with','findeo') ?> <?php echo $provider_name; ?>
      </span>
   </a>
<?php
}
 
add_filter( 'wsl_render_auth_widget_alter_provider_icon_markup', 'wsl_findeo_use_fontawesome_icons', 10, 3 );
?>