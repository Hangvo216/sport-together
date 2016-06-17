<?php

require_once(__DIR__  . '/../config.php');
require_once(__DIR__  . '/BootstrapDB.php');
require_once(__DIR__  . '/../model/Player.php');
require_once(__DIR__  . '/../util/Util.php');


$Fizzy = new Fizzy ();
$Fizzy->initialize ( $fizzyInit );

// if (! isset ( $_SESSION ['tz'] )) {
//   $Fizzy->setTz ( '-5', '1' );
// } else {
//   date_default_timezone_set ( $_SESSION ['tz'] );
// }

	
	// The Fizzy class.
	class Fizzy{
		// Prepare definitions for settings in '/config.php'
		var $mysqli;
		var $baseDir;
		var $htmlDir;
		var $libDir;
		var $jsDir;
		var $templateDir;
		var $stripeSecret;
		var $stripePublic;
		var $mailer;
		var $mode;
		var $googleAnalytics;
		var $s3Key;
		var $s3Secret;
		private $sessionsDir;
		
		// Initialize said definitions; able to be recalled anywhere you can call $Fizzy.
		function initialize($fizzyInit){
		    global $log;
		    $log->info("Call fizzy init");
		    
			$this->fbAppid = $fizzyInit['fbAppid'];
			$this->fbSecret = $fizzyInit['fbSecret'];
			$this->address = $fizzyInit['address'];
// 			$this->baseDir = $fizzyInit['baseDir'];
			$this->sessionsDir = $fizzyInit['sessionsDir'];
// 			$this->htmlDir = $fizzyInit['htmlDir'];
// 			$this->libDir = $fizzyInit['libDir'];
// 			$this->driverDir = $fizzyInit['driverDir'];
// 			$this->templateDir = $fizzyInit['templateDir'];
// 			$this->mode = $fizzyInit['mode'];
// 			$this->s3Key = $fizzyInit['S3Key'];
// 			$this->s3Secret = $fizzyInit['S3Secret'];
			
			
			$this->mysqli = BootstrapDB::getMYSQLI();
			
			// Instantiate the PHPmailer object.
// 			$this->mailer = $fizzyInit['mailer'];
			
			// Begin $_SESSION handling.
			session_save_path($this->sessionsDir);
			if(!isset($_SESSION)){
				$log->addInfo("%%%%%%%% SESSION start");
				session_start();
				header("Cache-Control: no-cache");
				header("Pragma: no-cache");
			}
			
			// Determine user's log-in state.
			
			$this->loggedIn = false;
			if(isset($_SESSION["user"]["id"]) && $_SESSION["user"]["id"] > 0){
				$this->loggedIn = true;
			}
			
			// Set-up new $_SESSION
			if(!isset($_SESSION['session-active'])){
				$_SESSION['session-active'] = date('U');
			}
			// Remove expired $_SESSION
			elseif(((date('U')-$_SESSION['session-active']) > 43200) && $this->loggedIn){
				session_destroy();
				header("Location: ".$this->address."#error?c=641");
			}
			// Updates session timer.
			else{
				$_SESSION['session-active'] = date('U');
			}
			
			$log->addInfo("End fizzi init");
		}
		
		
		
		
		// When called, redirects the user to the proper error-handling URL, and kills the current script's execution.
		function reportError($code){
			include($this->libDir."error-codes.php");
			if($this->loggedIn){
				echo '<script type="text/javascript">setTimeout(function(){window.location = "'.$this->address.'usr#/error";},200);</script>';
			}
			else{
				echo '<script type="text/javascript">setTimeout(function(){window.location = "'.$this->address.'#/error";},200);</script>';
			}
			exit();
		}
		
		// Takes a Facebook user_id (after verifying its existence) and loads relevant account data, into the specified $_SESSION array.
		function pullUserDetails($userId){
		    global $log;
		    $log->info("Call pullUserDetails, userId: $userId");
			$mysqli = BootstrapDB::getMYSQLI();
			$user = array();
			
			$result = $mysqli->query("select * from players where facebook_id = $userId");	
			
			$row = $result->fetch_assoc();
			
			// Set $_SESSION variables.
			$user['facebook_id'] = $row['facebook_id'];
			$user['int_user_id'] = $row['id'];
			$user['name'] = json_decode('"'.$row['player_name'].'"');
			$user['email'] = json_decode('"'.$row['email'].'"');
			$user['access_token'] = $row['access_token'];
			$user['team_id'] = $row['int_team_id'];
				
// 			// Set Fizzy's timezone.
// 			$this->setTz($user['tz'],$user['dsv']);

// 			// Account for daylight savings.
// 			if(date("I") == 1){
// 				$user['tz']++;
// 			}
			
// 			$user['accounts'] = array();
// 			$user['tos'] = (bool)$row['tos'];
			$log->addInfo("****************");
			$log->addInfo(json_encode($user));
			
			// Clear the mysqli cache.
			while($row = $result->fetch_assoc()){}						
		
			// Set the user $_SESSION.
			$_SESSION['user'] = $user;
		}		
				
		// Sets the user's timezone, based off their settings. Contains all possible timezones.
		function setTz($tz,$dsv){
			// Array-key format is "-UTC OFFSET-,-DSV EXISTS-"=>"-PHP VAILD TIMEZONE NAME-"
			$timezones = array( 			    
			    "-11,0"=>"Pacific/Midway",
			    "-10,0"=>"Pacific/Honolulu",
			    "-9,1"=>"America/Anchorage",
			    "-8,1"=>"America/Los_Angeles",
			    "-7,0"=>"America/Phoenix",
			    "-7,1"=>"America/Denver",
			    "-6,0"=>"America/Regina",
			    "-6,1"=>"America/Chicago",
			    "-5,0"=>"America/Bogota",
			    "-5,1"=>"America/New_York",
			    "-4.5,0"=>"America/Caracas",
			    "-4,1"=>"America/Halifax",
			    "-3.5,1"=>"America/St_Johns",
			    "-3,1"=>"America/Godthab",
			    "-3,0"=>"America/Argentina/Buenos_Aires",
			    "-2,0"=>"Atlantic/South_Georgia",
			    "-1,1"=>"Atlantic/Azores",
			    "-1,0"=>"Atlantic/Cape_Verde",
			    "0,0"=>"Atlantic/Reykjavik",
			    "0,1"=>"Europe/Dublin",
			    "1,1"=>"Europe/Amsterdam",
			    "1,0"=>"Africa/Algiers",
			    "2,1"=>"Europe/Athens",
			    "2,0"=>"Africa/Harare",
			    "3,1"=>"Africa/Windhoek",
			    "3,0"=>"Asia/Kuwait",
			    "3.5,1"=>"Asia/Tehran",
			    "4,0"=>"Asia/Muscat",
			    "4,1"=>"Asia/Baku",
			    "5,0"=>"Asia/Dushanbe",
			    "5,1"=>"Asia/Yekaterinburg",
			    "5.5,0"=>"Asia/Kolkata",
			    "5.75,0"=>"Asia/Katmandu",
			    "6,0"=>"Asia/Dhaka",
			    "6.5,0"=>"Asia/Rangoon",
			    "7,0"=>"Asia/Bangkok",
			    "8,0"=>"Asia/Brunei",
			    "9,0"=>"Asia/Seoul",
			    "9.5,0"=>"Australia/Darwin",
			    "9.5,1"=>"Australia/Adelaide",
			    "10,0"=>"Australia/Brisbane",
			    "10,1"=>"Australia/Sydney",
			    "11,0"=>"Asia/Magadan",
			    "12,1"=>"Pacific/Auckland",
			    "12,0"=>"Pacific/Fiji"			   
			);
			$_SESSION['tz'] = $timezones[$tz.','.$dsv];
			date_default_timezone_set($_SESSION['tz']);
		}
		
		// Iterates through user's account $_SESSION and pulls all posts associated to the specific Page id, during the given time-period.
		function loadAccountData($my_id,$id,$start,$end){
		    global $log;
		    $userId = $_SESSION ['user'] ['id'];
		    $log->addInfo("Call loadAccountData: my_id: $my_id , id: $id, start: $start, end: $end, user: $userId");
			try {
				$account = $_SESSION['user']['accounts'][$my_id];
			} catch(\Exception $e) {
			    $log->addError("Failed to get account, id: $my_id");
				$my_id = $my_id . '';
				$account = $_SESSION['user']['accounts'][$my_id];
			}	
			// Makes sure Fizzy's $_SESSION controller-array is aware of the current account.
			
			$_SESSION['user']['accounts']['current'] = $my_id;						
			$int_page_id = $_SESSION['user']['accounts'][$my_id]['int_page_id'];
			$log->addInfo("Get all the tags for the following int_page id: $int_page_id");
								
			// Checks if the user's account has expired, and makes necessary changes to the user's account, to reflect this.
			if($_SESSION['user']['accounts'][$my_id]['role'] === 'trial' && ($_SESSION['user']['accounts'][$my_id]['created_time'] + 1209600 <= $_SESSION['user']['accounts'][$my_id]['last_login'])){
				
				Users::setExpiredRole('expired',$userId,$id);									
				$success = 602;
			}
			elseif($_SESSION['user']['accounts'][$my_id]['role'] === 'expired'){
				$success = 602;
			}
			// Handles a cancelled account.
			elseif($_SESSION['user']['accounts'][$my_id]['role'] === 'cancelled'){
				$success = 605;
			}
			else{
				$compset = array();
				$group = explode('_',$id);
				
				// Checks if the requested ID is a SuperGroup.
				if(count($group) == 2){
					foreach(explode(',',$account['groups'][$group[1]]['pages']) as $page){
						array_push($compset, (int) $page);
					}
				}
				// Otherwise the Page array contains just the requested page.
				else{
					$compset = array($id);
				}
				
				// Pull date-constrained posts for page, including handling for SuperGroup pages.
				foreach($compset as $pageId){
					$result = Pages::getNetworksId($pageId);
					while($row = $result->fetch_assoc()){
						$_SESSION['user']['comp'][$pageId]['int_twitter_page_id'] = $row['int_twitter_page_id'];
						$_SESSION['user']['comp'][$pageId]['int_instagram_page_id'] = $row['int_instagram_page_id'];
						$_SESSION['user']['comp'][$pageId]['int_pinterest_page_id'] = $row['int_pinterest_page_id'];
					}
								
					// Put data in $_SESSION					
					// Identified by the page_id, the Page's record in the $_SESSION hold meta-data for the current date-range, of posts, to prevent redundancy or over-lap.
					$_SESSION['sessionData'][$pageId] = array();
					$_SESSION['sessionData'][$pageId]['timeStart'] = $start;
					$_SESSION['sessionData'][$pageId]['timeEnd'] = $end;
					
					$result = Pages::getName($pageId);
					
					while($row = $result->fetch_assoc()){
						$_SESSION['sessionData'][$pageId]['name'] = json_decode('"'.$row['name'].'"');
					}																			
				}
				
				// If the script finishes, it was successful.
				$success = 0;
			}
			$log->addInfo("Call loadAccountData: END");
			return $success;
		}
				
	}
		
	
	// Contructs the 'View' class. Used to handle and inject MVC CSS files, to the HTML header. Utilizes jQuery to check if the CSS element has been loaded (by comparing MVC hierachical IDs) to prevent redundancy.
	class View{
		function load($id){
			global $Fizzy;
			echo 'View.load("'.$id.'_css","';
			stripLines(file_get_contents($Fizzy->templateDir.$id.'/v.css'));
			echo '");';
		}
	}
	
	// Similar to the 'View' class, the 'Controller' class loads a MVC JS file, injecting it into the MVC's m.php element. This get overwritten/deleted if another element is $().load()-ed, on top of it.
	class Controller{
		function load($id){
			global $Fizzy;
			include($Fizzy->templateDir.$id.'/c.js');
		}
	}
	
	
	// Utilized for stripping lines/whitespace from text.
	function stripLines($input){
		$output = str_replace(array("\r\n","\r"), "\n", $input);
		$lines = explode("\n", $output);
		$new_lines = array();
		
		foreach ($lines as $i => $line) {
		    if(!empty($line))
		        $new_lines[] = trim($line);
		}
		echo implode($new_lines);
	}
	
	// Generates a random string for $_SESSSION state variables, or otherwise.
	function randomPassword() {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    for ($i = 0; $i < 16; $i++) {
	        $n = rand(0, strlen($alphabet)-1); //use strlen instead of count
	        $pass[$i] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}
	
	// Helps to sort a string alphabetically.
	function usrCmp($a,$b){
		$first = $a['name'];
		$second = $b['name'];
		$cmp = strcasecmp($first,$second);
		return $cmp;
	}
	
	// Initializes the (M)VC, meaning the View and Controller classes.
	$View = new View();
	$Controller = new Controller();
?>
