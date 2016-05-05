<?php
require_once (__DIR__ . '/../lib/global_funcs.php');

class HTTPUtil {
  public static function getParams($tz) {
    return GetParams::createGetParams($tz);
  }
  
  public static function getCompanyGroup1(GetParams $params, $default) {
    return self::getCompanyGroup($default, $params->compId, $params->groupId);
  }
  
  public static function getCompanyGroup2(GetParams $params, $default) {
    return self::getCompanyGroup($default, $params->compId2, $params->groupId2);
  }
  
  private static function getCompanyGroup($default, $compId, $groupId) {
    $companyGroup = false;
    if  ($groupId) {
      $companyGroup = ( string ) $groupId;
    } else if ($compId) {
      $companyGroup = ( string ) $compId;
    } else if ($default) {
      $companyGroup = ( string ) $default;
    } 
    return $companyGroup;
  }
  
  public static function isLogin($redirect = true) {
    global $Fizzy;
    global $app;
    global $log;
    if (! isset($Fizzy) || ! $Fizzy->loggedIn || ! isset($_SESSION ['user'])) {
      $log->addError("Bad session data, user doesn't seem to be logged in.");
      if ($redirect) {
          session_destroy();
          header('HTTP/1.1 401 Unauthorized', true, 401);
          exit();
      }
      return false;
    }
    return true;
  }
  
}

class GetParams {
  public $date;
  public $timeStart;
  public $timeEnd;
  public $slice;
  public $type;
  public $compId;
  public $compId2;
  public $groupId;
  public $groupId2;
  public function __construct() {
  }
  public static function createGetParams($tz) {
    global $log;
    $params = new GetParams();
    
    if (isset($_GET ['date'])) {
      $_SESSION ['ctrlr'] ['date'] = $_GET ['date'];
      $date = $_SESSION ['ctrlr'] ['date'];
      $params->date = $date;
      $log->addInfo("GET Param, date: $date");
    }
    
    if (isset($_GET ['startDate'])) {
      $startDateSt = $_GET ['startDate'];
      $log->addInfo("GET Param,time start: $startDateSt");
      $dayStart = Util::toDateTime($startDateSt, $tz);
      $dayStart = Util::toStartOfDay($dayStart);
      $timeStart = $dayStart->getTimestamp();
      $params->timeStart = $timeStart;
    }
    
    if (isset($_GET ['endDate'])) {
      $endDateSt = $_GET ['endDate'];
      $log->addInfo("GET Param,time end: $endDateSt");
      $dayEnd = Util::toDateTime($endDateSt, $tz);
      $dayEnd = Util::toEndOfDay($dayEnd);
      $timeEnd = $dayEnd->getTimestamp();
      $params->timeEnd = $timeEnd;
    }
    
    if (isset($_GET ['slice'])) {
      $_SESSION ['ctrlr'] ['slice'] = $_GET ['slice'];
      $slice = $_SESSION ['ctrlr'] ['slice'];
      $log->addInfo("GET Param, slice: $slice");
      $params->slice = $slice;
    } else {
      $params->slice = false;
    }
    
    if (isset($_GET ['compId']) && is_numeric($_GET ['compId'])) {
      $compId = $_GET ['compId'];
      $log->addInfo("GET Param, compId: $compId");
      $params->compId = $compId;
    } else {
      $params->compId = false;
    }
    
    if (isset($_GET ['compId2']) && is_numeric($_GET ['compId2'])) {
      $compId2 = $_GET ['compId2'];
      $log->addInfo("GET Param, compId2: $compId2");
      $params->compId2 = $compId2;
    } else {
      $params->compId2 = false;
    }
    
    if (isset($_GET ['slice'])) {
      $slice = $_GET ['slice'];
    }
    
    if (isset($_GET ['groupId2']) && is_numeric($_GET ['groupId2'])) {
      $groupId2 = $_GET ['groupId2'];
      $log->addInfo("GET Param, group2: $groupId2");
      $params->groupId2 = $groupId2;
    } else {
      $params->groupId2 = false;
    }
    
    if (isset($_GET ['groupId']) && is_numeric($_GET ['groupId'])) {
      $groupId = $_GET ['groupId'];
      $log->addInfo("GET Param, groupId: $groupId");
      $params->groupId = $groupId;
    } else {
      $params->groupId = false;
    }
    return $params;
  }
}