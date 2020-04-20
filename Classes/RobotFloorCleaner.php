<?php

/**
 * RobotFloorCleaner is a class for the Robot, which handles the properties and actions
 * of Robot.
 *
 * @package CodingAssignment
 * @author Jai Rana
 * @version 1.0
 * @access public
 */

class RobotFloorCleaner {

  const BATTERY_LIFE_ONCE_FULLY_CHARGED   = 60;
  const TIME_TAKEN_TO_FULL_CHARGE_BATTERY = 30;
  const ROBOT_ACTION_STATES               = ['Charging the battery', 'Cleaning the floor'];

  Protected $bIsBatteryFullyCharged = true;
  protected $oCleaningFloor;

  //--------------------------------------- Public Methods-----------------------------------\\

  /**
   * Sets the floor object i.e carpet or hard.
   *
   * @param ApartmentInterface $oFloor Floor area object.
   * @return void
   * @access public
   */
  public function setCleaningFloor(ApartmentInterface $oFloor) {
    $this->oCleaningFloor = $oFloor;
  }

  /**
   * Returns the floor object i.e carpet or hard.
   *
   * @return ApartmentInterface Floor area object
   * @access public
   */
  public function getCleaningFloor() {
    return $this->oCleaningFloor;
  }
  
  /**
   * Sets the status of battery to fully charged or not.
   *
   * @param bool    $bFullCharged true if fully charged.
   * @return void
   * @access public
   */
  public function setBatteryFullyCharged($bFullCharged) {
    $this->bIsBatteryFullyCharged = $bFullCharged;
  }
  
  /**
   * Returns status of battery fully charged or not.
   *
   * @return bool true if fully charged else false.
   * @access public
   */
  public function isBatteryFullyCharged($bFullCharged) {
    $this->bIsBatteryFullyCharged;
  }

  /**
   * Handles the cleaning action of robot.
   *
   * @return void
   * @access public
   */
  public function cleanApartmentFloor() {
    $fTotalTimeRequiredToClean = $this->getTotalTimeRequiredToCleanFloor();
    $fEstimatedCleaningEndTime = time() + $fTotalTimeRequiredToClean;
    $fTimeForRobotActionChange = time() + self::BATTERY_LIFE_ONCE_FULLY_CHARGED;
    $bIsCleaningLeft           = true;

    $this->showRobotActionStateStatus($this->getRobotActionStateStatus());

    $iStateChangeCount = 1;
    do {
      $iCurrentTime = time();
      if ($iCurrentTime >= $fTimeForRobotActionChange && $iCurrentTime < $fEstimatedCleaningEndTime) {

        if ($iStateChangeCount % 2 === 0) {
          $this->setBatteryFullyCharged(true);
          $fTimeForRobotActionChange = $iCurrentTime + self::BATTERY_LIFE_ONCE_FULLY_CHARGED;
        } else {
          $this->setBatteryFullyCharged(false);
          $fTimeForRobotActionChange = $iCurrentTime + self::TIME_TAKEN_TO_FULL_CHARGE_BATTERY;
        }

        $this->showRobotActionStateStatus($this->getRobotActionStateStatus());
        $iStateChangeCount++;
      }

      if ($iCurrentTime >= $fEstimatedCleaningEndTime) {
        $bIsCleaningLeft = false;
        $this->showRobotActionStateStatus('Floor Cleaned');
      }
    } while ($bIsCleaningLeft);
  }

  /**
   * Returns the floor area cleaned by robot in single charge of battery.
   *
   * @return  float Floor area cleaned by robot in single charge of battery.
   * @access public
   */
  public function getAreaCleanedInSingleCharge() {
    return (self::BATTERY_LIFE_ONCE_FULLY_CHARGED / $this->oCleaningFloor->getFloorCleaningTimePerSquareMeter());
  }

  /**
   * Returns the total time which will be taken by robot to clean the floor including
   * battery recharge time.
   *
   * @return  float     Total time will be taken by robot to clean the floor.
   * @access public
   */
  public function getTotalTimeRequiredToCleanFloor() {
    $iCleanAreaOnceBatteryFullyCharged = $this->getAreaCleanedInSingleCharge();
    $iCleaningTimePerSquareMeter       = $this->oCleaningFloor->getFloorCleaningTimePerSquareMeter();
    $fFloorArea                        = $this->oCleaningFloor->getFloorArea();
    $fTotalTimeRequiredToClean         = 0;

    if ($fFloorArea > $iCleanAreaOnceBatteryFullyCharged) {
      $iTurnsRequiredToClean = (int) ($fFloorArea / $iCleanAreaOnceBatteryFullyCharged);
      $fTotalTimeRequiredToClean = (
        $iTurnsRequiredToClean * self::BATTERY_LIFE_ONCE_FULLY_CHARGED
      )
      +
      (
        $iTurnsRequiredToClean * self::TIME_TAKEN_TO_FULL_CHARGE_BATTERY
      );
    } elseif ($fFloorArea == $iCleanAreaOnceBatteryFullyCharged) {
      $fTotalTimeRequiredToClean = self::BATTERY_LIFE_ONCE_FULLY_CHARGED;
    }

    $fAreaLeftToClean           = fmod($fFloorArea, $iCleanAreaOnceBatteryFullyCharged);
    $fTotalTimeRequiredToClean += (($fAreaLeftToClean !== 0) ? ($fAreaLeftToClean * $iCleaningTimePerSquareMeter) : 0);

    return $fTotalTimeRequiredToClean;
  }

  /**
   * Returns the robot action state status i.e. cleaning the floor or charging the battery.
   *
   * @return  string  The robot action state status.
   * @access public
   */
  public function getRobotActionStateStatus() {
    return self::ROBOT_ACTION_STATES[$this->bIsBatteryFullyCharged];
  }

  //--------------------------------------- Protected Methods-----------------------------------\\

  /**
   * Prints the robot action state status i.e. cleaning the floor or charging the battery.
   *
   * @access protected
   */
  protected function showRobotActionStateStatus($sStatus) {
    echo date('[Y-m-d H:i:s] ') . $sStatus . PHP_EOL;
  }
}
