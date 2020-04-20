<?php

/**
 * RobotFloorCleanerTest is a class to test the functionality of RobotFloorCleaner class.
 * It is checking the properties and actions of Robot.
 *
 * @package CodingAssignmentTest
 * @author Jai Rana
 * @version 1.0
 * @access public
 */

require_once ('./Classes/CarpetFloorApartment.php');
require_once ('./Classes/HardFloorApartment.php');
require_once ('./Classes/RobotFloorCleaner.php');
use PHPUnit\Framework\TestCase;

class RobotFloorCleanerTest extends TestCase
{
  private $oRobot;
  private $oFloor;
  private $fFloorArea;
  private $sFloorType;
  private $iCleaningTimePerSquareMeter;

  /**
   * Used to set the required data and objects in order to test the functionality.
   *
   * @return void
   * @access public
   */
  public function setUp()
  {
    $this->oRobot     = new RobotFloorCleaner();
    $this->sFloorType = 'hard';
    $this->fFloorArea = 77.5;
    $this->oFloor     = (
      ($this->sFloorType === 'hard')
        ? new HardFloorApartment($this->fFloorArea)
        : new CarpetFloorApartment($this->fFloorArea)
    );
    $this->oRobot->setCleaningFloor($this->oFloor);

    $this->iCleaningTimePerSquareMeter = $this->oFloor->getFloorCleaningTimePerSquareMeter();
  }

  /**
   * Used to test the floor object which we are getting is of right floor area type.
   * For example: object of the class 'HardFloorApartment' or 'CarpetFloorApartment'.
   *
   * @return void
   * @access public
   */
  public function testGetCleaningFloor()
  {
    // Here we can also check it with $this->assertInstanceOf().
    $this->assertEquals($this->oFloor, $this->oRobot->getCleaningFloor());
  }

  /**
   * Used to test the value we are getting from RobotFloorCleaner::getAreaCleanedInSingleCharge().
   *
   * @return void
   * @access public
   */
  public function testGetAreaCleanedInSingleCharge()
  {
    $this->assertEquals(60, $this->oRobot->getAreaCleanedInSingleCharge());
  }

  /**
   * Used to test the value we are getting from RobotFloorCleaner::getTotalTimeRequiredToCleanFloor().
   *
   * @return void
   * @access public
   */
  public function testGetTotalTimeRequiredToCleanFloor()
  {
    $this->assertEquals(107.5, $this->oRobot->getTotalTimeRequiredToCleanFloor());
  }

  /**
   * Used to test the value we are getting from RobotFloorCleaner::getRobotActionStateStatus().
   * For Example: Charging the battery.
   *
   * @return void
   * @access public
   */
  public function testGetRobotActionStateStatusCharging()
  {
    $this->oRobot->setBatteryFullyCharged(false);
    $this->assertEquals('Charging the battery', $this->oRobot->getRobotActionStateStatus());
  }

  /**
   * Used to test the value we are getting from RobotFloorCleaner::getRobotActionStateStatus().
   * For Example: Cleaning the floor.
   *
   * @return void
   * @access public
   */
  public function testGetRobotActionStateStatusCleaning()
  {
    $this->oRobot->setBatteryFullyCharged(true);
    $this->assertEquals('Cleaning the floor', $this->oRobot->getRobotActionStateStatus());
  }
}
