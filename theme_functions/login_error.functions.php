// Remove error messages from login functions.
// Ref : http://seclists.org/fulldisclosure/2013/Jul/38
function login_errors($errors) {
	global $user_login;

	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'lostpassword' || isset($_REQUEST['checkemail'])) {
	  if(
		preg_match('/There is no user registered with that email address/', $errors) ||
		preg_match('/Invalid username or e-mail/', $errors) || 
		preg_match('/Check your e-mail for the confirmation link/', $errors)
	  ) {
		$errors = 'If the account information you provided was valid, we have sent you an e-mail. Please check your e-mail for the confirmation link.';

		if(!isset($_REQUEST['checkemail'])) {
		  $redirect_to = 'wp-login.php?checkemail=confirm';
		  wp_safe_redirect( $redirect_to );
		  exit();
		}
	  }
	}
	else {
	  if(preg_match('/password you entered for the username/', $errors) ||
		 preg_match('/Invalid username/', $errors)) {

		$errors = 'Your login information was incorrect. <a href="/wp-login.php?action=lostpassword">Lost your password</a>?';
		$user_login = $_POST['log'];
		unset($_POST['log']);

		if(preg_match('/[@]/', $user_login)) {
		  $errors .= "<br><br>Hint: your email address is not your username.";
		}
	  }
	}


	return $errors;        
}
add_filter('login_errors', array($this, 'login_errors'));
add_filter('login_messages', array($this, 'login_errors'));
