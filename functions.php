<?php

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {

  $clean_src = remove_query_arg( 'ver', $src );
  $path      = wp_parse_url( $src, PHP_URL_PATH );

  if ( $modified_time = @filemtime( untrailingslashit( ABSPATH ) . $path ) ) {
      $src = add_query_arg( 'ver', $modified_time, $clean_src );
  } else {
      $src = add_query_arg( 'ver', time(), $clean_src );
  }
  return $src;
}
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 99999999);

remove_action('wp_head', 'wp_generator');

/*  Include Styles & Script
/* ------------------------------------ */
add_action( 'wp_enqueue_scripts', 'chicco_style_scripts' );
if ( ! function_exists( 'chicco_styles_scripts' ) ) {
	function chicco_style_scripts() {

    wp_enqueue_style( 'chicco-bootstrap-css', get_template_directory_uri().'/asset/css/bootstrap.min.css',array(),filemtime(get_template_directory() . '/asset/css/bootstrap.min.css'),'all');
	  wp_enqueue_style( 'chicco-css', get_template_directory_uri().'/style.css',array(),filemtime(get_template_directory() . '/style.css'),'all');
		wp_enqueue_script('jquery');

    wp_enqueue_script( 'chicco-bootstrap-js', get_template_directory_uri().'/asset/js/bootstrap.min.js','','',true);
		//wp_enqueue_script( 'chicco-script', get_template_directory_uri().'/assets/js/script.js','',filemtime(get_template_directory() . '/assets/js/script.js'),true);
    wp_enqueue_script( 'chicco-fontawsome-js', '//kit.fontawesome.com/befb91387f.js','','',true);
    wp_enqueue_script( 'chicco-darkMode', get_template_directory_uri() . '/asset/js/darkMode.js','','',true);
  }
}

?>
