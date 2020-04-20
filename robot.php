<?php
/**
 * This file is a entry point for this assignment, which handles the data coming from the command
 * prompt and call the particular methods. It also validate the params and throw exceptions if data is invalid.
 *
 * @package CodingAssignment
 * @author Jai Rana
 * @version 1.0
 */

require_once ('Classes/HardFloorApartment.php');
require_once ('Classes/CarpetFloorApartment.php');
require_once ('Classes/RobotFloorCleaner.php');

if($argv) {

  define('FLOOR_TYPE_CARPET', 'carpet');
  define('FLOOR_TYPE_HARD', 'hard');
  define('ACTION_CLEAN', 'clean');

  $aAllowedFloorType = [FLOOR_TYPE_CARPET, FLOOR_TYPE_HARD];

  // Handling of params received from command line.
  $sAction    = (($argv[1] && strtolower($argv[1]) == ACTION_CLEAN) ? $argv[1] : ACTION_CLEAN);

  $aFloorType = (($argv[2]) ? explode('floor=', $argv[2]) : []);
  $sFloorType = ((count($aFloorType) > 1) ? strtolower($aFloorType[1]) : '');

  $aFloorArea = (($argv[3]) ? explode('area=', $argv[3]) : []);
  $fFloorArea = (float) ((count($aFloorArea) > 1) ? strtolower($aFloorArea[1]) : '');

  // Validating params received from command line, throw exceptions if params are invalid or empty.
  try {
    $sError = '';
    if (empty($sFloorType) || false === in_array($sFloorType, $aAllowedFloorType)) {
      $sError .= 'Floor type is not given or invalid, please provide valid floor type (i.e. hard or carpet).' . PHP_EOL;
    }

    if (empty($fFloorArea) || is_nan($fFloorArea)) {
      $sError .= 'Floor area is not given or invalid, please provide valid floor area i.e. numbers only.' . PHP_EOL;
    }

    if (!empty($sError)) {
      throw new Exception($sError);
    }

    /**
     * Below block of code, will creat an object of RobotFloorCleaner class and on the basis of parameter floor type,
     * the apartment floor area object will be set, then on the basis of particular floor area the cleaning actions
     * will be taken by the RobotFloorCleaner class.
     */
    $oRobot = new RobotFloorCleaner();
    $oFloor = (
      ($sFloorType === 'hard')
        ? new HardFloorApartment($fFloorArea)
        : new CarpetFloorApartment($fFloorArea)
    );
    $oRobot->setCleaningFloor($oFloor);
    $oRobot->cleanApartmentFloor();

  } catch (Exception $oException) {
    echo 'Error: ',  $oException->getMessage(), PHP_EOL;
  }
}
