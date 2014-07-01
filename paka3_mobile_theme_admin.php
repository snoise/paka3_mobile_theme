<?php
class Paka3_mobile_theme_admin{
	function __construct( ) {
		add_action( 'admin_menu' , array($this , 'adminAddMenu' ) );
	}
 
	//メニューの「paka3投稿」の設定（今回はサブメニュー）
	function adminAddMenu ( ) {
		add_submenu_page("themes.php", 'Paka3 Mobile Theme', 'Mobileテーマ',  'edit_themes', 'paka3_mobile_theme', array($this,'paka3_post_page'));
		add_action( 'admin_notices', array( $this , 'start_text' ));
	}


	function paka3_post_page () {

		if(isset($_POST['mobile_theme']) && check_admin_referer( get_bloginfo('url').'paka3MobileTheme_new','paka3MobileTheme' )){
				//更新処理処理
				$opt = $_POST['mobile_theme'];
				update_option('paka3_mobile_theme', $opt);
				 //更新メッセージ
				echo '<div class="updated fade"><p><strong>';
					_e('Options saved.');
				echo "</strong></p></div>";
		}
		
		//値の取得
		$mobile_theme= get_option('paka3_mobile_theme') ; 

		//ページに表示する内容
		$wp_n = wp_nonce_field(get_bloginfo('url').'paka3MobileTheme_new','paka3MobileTheme');
		//print_r( wp_get_themes() );
		$checked = checked( $mobile_theme['template'], '' ,0);
		echo <<<EOS
			<div class="wrap">
         <h2>Paka3 モバイルテーマ設定</h2>
         <form method="post" action="">
     {$wp_n}
     <hr>
      <h3>モバイル用のテーマ（wp_is_mobile）</h3>
				<table class="form-table">
						<tr valign="top">
						<th scope="row"><label for="now">テーマ選択</label></th>
						<td>
					<ul>
					<li><label ><input type="radio" name="mobile_theme[template]" value="" {$checked}/>
						選択しない（通常通り）</lable>
EOS;
		foreach ( wp_get_themes() as $akey => $aval ){
				$checked = checked( $mobile_theme['template'], $akey ,0);
				echo <<<EOS
					<li><label ><input type="radio" name="mobile_theme[template]" value="$akey" {$checked}/>
					{$akey}</label></li>
EOS;
		}
		echo <<<EOS
					</ul>
			
					</td>
				</tr>
			</table>
			<p class="submit"><input type="submit" name="Submit" class="button-primary" value="変更を保存" /></p>
		</form>
 		</div>
EOS;
	}
}