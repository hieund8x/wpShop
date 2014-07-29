<?php
add_action( 'register_form', 'hieund_show_extra_register_fields' ); //thêm các trường cần thiết vào form đăng ký
 
function hieund_show_extra_register_fields(){
	$first_name = ( isset( $_POST['first_name'] ) ) ? $_POST['first_name']: '';
	$last_name = ( isset( $_POST['last_name'] ) ) ? $_POST['last_name']: '';
?>
<p>
	<label for="password">Password<br/>
		<input id="password" type="password" tabindex="30" class="input" size="25" value="" name="password" />
	</label>
</p>
<p>
	<label for="repeat_password">Repeat password<br/>
		<input id="repeat_password" type="password" tabindex="40" class="input" size="25" value="" name="repeat_password" />
	</label>
</p>
<p>
	<label for="first_name">First Name<br/>
	<input id="first_name" type="text" tabindex="40" size="25" value="<?php echo esc_attr(stripslashes($first_name)); ?>" name="first_name" />
	</label>
</p>
<p>
	<label for="last_name">Last Name<br/>
	<input id="last_name" type="text" tabindex="40" size="25" value="<?php echo esc_attr(stripslashes($last_name)); ?>" name="last_name" />
	</label>
</p>

<?php
}


add_filter( 'gettext', 'hieund_edit_password_email_text' ); //thay đổi text hiển thị "A password will be e-mailed to you."
 
function hieund_edit_password_email_text ( $text ) {
	if ( $text == 'A password will be e-mailed to you.' ) {
	 
	$text = '';
	}
	return $text;
}

add_action( 'register_post', 'hieund_validate_extra_register_fields', 10, 3 ); //kiểm tra thông tin hợp lệ
function hieund_validate_extra_register_fields($login, $email, $errors) {
	if ( $_POST['password'] == "" ) { //password không được trống
	$errors->add( 'passwords_empty', "<strong>ERROR</strong>: Vui lòng nhập mật khẩu" );
	}
	if ( $_POST['password'] != $_POST['repeat_password'] ) { //pas1 và pas2 phải trùng nhau
	$errors->add( 'passwords_not_matched', "<strong>ERROR</strong>: Nhập lại mật khẩu không chính xác" );
	}
	if ( strlen( $_POST['password'] ) < 8 ) { //password phải có ít nhất 8 ký tự
	$errors->add( 'password_too_short', "<strong>ERROR</strong>: Mật khẩu phải chứa ít nhất 8 ký tự" );
	}

}

add_action( 'user_register', 'hieund_register_extra_fields', 100 ); //cập nhật một số trường mới cho user, trong trường hợp này có password, first name và last name
function hieund_register_extra_fields( $user_id ){
	$userdata = array();
	$userdata['ID'] = $user_id;
	$userdata['first_name'] = $_POST['fist_name'];
	$userdata['last_name'] = $_POST['last_name'];
	$userdata['user_pass'] = $_POST['password'];
	wp_update_user( $userdata );
}


if ( !function_exists('wp_new_user_notification') ) :
	function wp_new_user_notification($user_id, $plaintext_pass = '') { //thiết lập gửi email đến admin và user đăng ký
		$user = get_userdata( $user_id );
		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
		$message = sprintf(__('New user registration on your site %s:'), $blogname) . "\r\n\r\n";
		$message .= sprintf(__('Username: %s'), $user->user_login) . "\r\n\r\n";
		$message .= sprintf(__('E-mail: %s'), $user->user_email) . "\r\n";
		@wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), $blogname), $message); //gửi email thông báo đến admin
		$message = sprintf(__('Username: %s'), $user->user_login) . "\r\n";
		if(isset($_POST['password']))
		$message .= sprintf(__('Password: %s'), $_POST['password']) . "\r\n";
		$message .= wp_login_url() . "\r\n";
		@wp_mail($user->user_email, sprintf(__('[%s] Tài khoản và mật khẩu của bạn: '), $blogname), $message); //gửi email thông tin tài khoản cho user
	}
endif;


add_filter('wp_mail_from_name','hieund_custom_email_from_name'); //thiết lập tên email khi gửi email thông báo
function hieund_custom_email_from_name($name) {
	$name = get_bloginfo('name');
	return $name;
}





?>