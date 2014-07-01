<?php
/* 
Plugin Name: Paka3 mobile theme
Plugin URI: http://www.paka3.com/wpplugin
Description: スマホ・モバイル用にテーマを別設定するプラグイン。
Author: Shoji ENDO
Version: 0.1
Author URI:http://www.paka3.com/
*/


$paka3_mobile_theme = new Paka3_mobile_theme;
if( wp_is_mobile() ){
	$paka3_mobile_theme->mobile_func();
}

class Paka3_mobile_theme{
	function __construct(){
		//プラグインをストップしたとき
		if ( function_exists( 'register_deactivation_hook') ) {
			register_deactivation_hook (__FILE__ , array( $this , 'paka3_plugin_stop' ) ) ;
		}
		//プラグインを削除したとき
		if ( function_exists( 'register_uninstall_hook') ) {
			register_uninstall_hook(__FILE__, 'paka3_plugin_uninstall');
		}
		if ( is_admin() ){
			require_once('paka3_mobile_theme_admin.php');
			$a = new Paka3_mobile_theme_admin;
		}
	}

	function mobile_func(){
			$mobile_theme= get_option('paka3_mobile_theme') ; 
			if( $mobile_theme[ 'template' ] != '' ){
				//クラス定義の有無の確認
				if ( !method_exists( 'Paka3_theme_switch' , 'template' ) ) {
					require_once('paka3_theme_switch.php');
				}

				$theme_switch = new Paka3_theme_switch(
						$mobile_theme['template']
				);
			}
	}

	//プラグインを削除したときによばれる
	function paka3_plugin_uninstall(){
		delete_option('paka3_mobile_theme');
	}
}




