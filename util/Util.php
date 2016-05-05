<?php
class Util {
  public static function getDataTimeZone() {
    return "UTC";
  }
  
  public static function toJsonString(DateTime $dateTime) {
    return json_encode ( $dateTime );
  }
  
  public static function toString(DateTime $dateTime) {
    return  $dateTime->format(DateTime::ATOM);
  }
  
  public static function toUTC(DateTime $dateTime) {
    global $log;
    $timeZoneName = $dateTime->getTimezone ()->getName ();
    
    if ($timeZoneName !== "UTC") {
      $log->debug( "Converting timezone from:$timeZoneName to:UTC" );
    }
    
    $newDateTime = clone $dateTime;
    $newDateTime->setTimezone ( new DateTimeZone ( "UTC" ) );
    return $newDateTime;
  }
  
  public static function toStartOfDay(DateTime $dateTime) {
    $newDateTime = clone $dateTime;
    $newDateTime->setTime(0, 0, 0);
    return $newDateTime;
  }
  
  public static function toEndOfDay(DateTime $dateTime) {
    $newDateTime = clone $dateTime;
    $newDateTime->setTime(23, 59, 59);
    return $newDateTime;
  }
  
  public static function toDateTime($dateTimeSt, $timezoneSt = "UTC") {
    global $log;
    if (preg_match ("/^[0-9]+$/",$dateTimeSt)) { 
      $dateTimeSt = "@" . $dateTimeSt;
    }
   
    $dateTime = new DateTime ( $dateTimeSt, new DateTimeZone ( $timezoneSt ) );
    //If the dateTimeSt is unix time, we need to do this
    $dateTime->setTimezone(new DateTimeZone ( $timezoneSt ));
    return $dateTime;
  }
  public static function toArray($result) {
    global $log;
    $log->addInfo("Call to Array in Util");
    $items = array ();
    if (! isset ( $result )) {
      $log->err( "Called Util::toArray with a empty result" );
      return $items;
    }
    
    while($row = $result->fetch_assoc()){
      array_push($items, $row);
    }
    return $items;
  }
 
  public static function fromUnixToDatetime($unixTimeStamp) {
  	$dateTime = new DateTime();
  	$dateTime->setTimestamp($unixTimeStamp);
  	return $dateTime;
  }
  
  public static function arrayToString($someArray) {
    if(!isset($someArray)) {
      return "";
    }
    if (is_array($someArray)) {
      return join(',', $someArray);
    } 
    if (is_string($someArray)) {
      return $someArray;
    }
    if(is_numeric($someArray)) {
      return (string)$someArray;
    }
    return "";
  }
  
  public static function stringToArray($someString) {
    if(!isset($someString)) {
      return array();
    }
    if(is_array($someString)) {
      return $someString;
    }
    if (strpos($someString, ',') !== false) {
      return explode(',', $someString);
    } else {
      return array($someString);
    }
  }
  
  public static function logArgs(array $argList, $numargs, $funName) {
    global $log;
    for($i = 0; $i < $numargs; $i ++) {
      $jsonArg = json_encode($argList [$i]);
      $log->addInfo("Call $funName argument $i is: $jsonArg");
    }
    
  }
  
  public static function array_push_assoc(&$array, $key, $value){
  	$array[$key] = $value;
  	return $array;
  }
 
}
