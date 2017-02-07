<?php
/*	
	SUMMARY
	
	The 'error-codes.php' file contains Fizzy's textual error information and directives. It is invoked by a call to "$Fizzy->reportError($code)", in PHP; or by a "window.location = '<?php echo $Fizzy->address; ?>#error&c='+code;", in JS. Error codes are tracked in our gAnalytics account, as well.
	
	The 'error-code' output can be defined/configured in: /fizzy/templates/static/_error.php
	
	----------------------------------------
	METHODOLOGY
	
	// [0-9] - Critical System Errors (Integral Asset Failure, Security Breach) {Send email to admin}
	// [10-99] - Semi-Critical Errors (Non-Integral Asset Failure, Security Concern) {Send email to admin}
	// [100-999] - Trivial-Errors/Inconsistencies
	
	----------------------------------------
	ARRAY STRUCTURE
	
	$errors = array(
		"-CODE-" => array(
			"title" => "-TITLE FOR HTML RENDERING-",
			"message" => "-MESSAGE FOR HTML RENDERING-"
		);
	----------------------------------------  */
	
	$errors = array(
		"10" => array(
			'title' => 'Messaging System Error',
			'message' => '<div class="row center">We\'re sorry, but there appears to be an error in the way our system is sending eMails and messages.<br /><br /><br /><i>Please try again later.</i></div>'
		),
		"11" => array(
			'title' => 'Messaging System Timeout',
			'message' => '<div class="row center">We\'re sorry, but your request has timed out to due a heavy system load.<br /><br /><br /><i>Please try again.</i></div>'
		),
		"404" => array(
			'title' => 'Page Not Found',
			'message' => '<div class="row center">We\'re sorry, but the page you were attempting to reach either does not exist, or has expired.</div>'
		),
		"600" => array(
			'title' => 'Invalid Login',
			'message' => '<div class="row center">Your <span class="fb">Facebook</span> login information was incorrect.<br /><br />Please try again.</div>'
		),
		"601" => array(
			'title' => 'Invalid Login',
			'message' => '<div class="row center">You are not a registered user in our system.<br /><br />Please try again.</div>'
		),
		"602" => array(
			'title' => 'Trial Expired',
			'message' => '<div class="row center">Your trial has expired.<br /><br />Please email support@meetcortex.com to upgrade your account.</div>'
		),
		"603" => array(
			'title' => 'Invalid Login',
			'message' => '<div class="row center">There was a procedural error in your login.<br /><br />Please try again.</div>'
		),
		"604" => array(
			'title' => 'Login Error',
			'message' => '<div class="row center">There was a procedural error in your login.<br /><br />Please try again.</div>'
		),
		"605" => array(
			'title' => 'Account Cancelled',
			'message' => '<div class="row center">Your account has been cancelled.<br /><br />Please email support@meetcortex.com to re-activate your account.</div>'
		),
		"640" => array(
			'title' => 'Not Logged-In',
			'message' => '<div class="row center">You must be logged-in to view our system.<br /><br />Please try again.</div>'
		),
		"641" => array(
			'title' => 'Session Expired',
			'message' => '<div class="row center">Your active session has expired.  Please Sign-in again.<br/><br/>
		    <button analytics-on analytics-event="Sign-In" analytics-category="Button" analytics-label="Error Page" class="btn btn-primary" data-toggle="modal" data-target="#login-modal">SIGN IN</button>
		    </div>'
		),
	    "642" => array(
	        'title' => 'Inconsistent Twitter Account',
	        'message' => '<div class="row center">You selected the wrong Twitter account for publishing.<br /><br />Please log-in and select the correct Twitter account.</div>'
	    ),	    
	    "643" => array(
	        'title' => 'Failed to Sign-in via Facebook',
	        'message' => '<div class="row center">Failed to Sign-in via Facebook.  Please try again.<br /><br />
	        <button analytics-on analytics-event="Sign-In" analytics-category="Button" analytics-label="Facebook Error Page" class="btn btn-primary" data-toggle="modal" data-target="#login-modal">SIGN IN</button>
		    </div>'
	    ),
	    "644" => array(
	        'title' => 'Inconsistent Pinterest Account',
	        'message' => '<div class="row center">You selected the wrong Twitter account for publishing.<br /><br />Please log-in and select the correct Twitter account.</div>'
	    ),
		"650" => array(
			'title' => 'Log-In Inconsistency',
			'message' => '<div class="row center">The session states do not match.<br /><br />Please try again.</div>'
		)
	);
?>