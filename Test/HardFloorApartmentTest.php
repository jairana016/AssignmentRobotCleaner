<?php

/**
 * HardFloorApartmentTest is a class to test the functionality of Apartment floor which is of hard type.
 * It is checking the methods of the class HardFloorApartment.
 *
 * @package CodingAssignmentTest
 * @author Jai Rana
 * @version 1.0
 * @access public
 */

require_once ('./Classes/HardFloorApartment.php');
use PHPUnit\Framework\TestCase;

class HardFloorApartmentTest extends TestCase
{
  private $oFloor;
  private $fFloorArea;

  /**
   * Used to set the floor area and the floor object.
   *
   * @return void
   * @access public
   */
  public function setUp()
  {
    $this->fFloorArea = 77.5;
    $this->oFloor = new \HardFloorApartment($this->fFloorArea);
  }

  /**
   * Used to test the value we are getting from HardFloorApartment::getFloorArea().
   *
   * @return void
   * @access public
   */
  public function testGetFloorArea()
  {
    $this->assertNotEmpty($this->oFloor->getFloorArea());
    $this->assertEquals($this->fFloorArea, $this->oFloor->getFloorArea());
  }

  /**
   * Used to test the value we are getting from HardFloorApartment::getFloorCleaningTimePerSquareMeter().
   *
   * @return void
   * @access public
   */
  public function testGetFloorCleaningTimePerSquareMeter()
  {
    $iCleaningTimePerSquareMeter = 1;
    $this->assertEquals($iCleaningTimePerSquareMeter, $this->oFloor->getFloorCleaningTimePerSquareMeter());
  }
}
