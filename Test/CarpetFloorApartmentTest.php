<?php

/**
 * CarpetFloorApartmentTest is a class to test the functionality of Apartment floor which is of carpet type.
 * It is checking the methods of the class CarpetFloorApartment.
 *
 * @package CodingAssignmentTest
 * @author Jai Rana
 * @version 1.0
 * @access public
 */

require_once ('./Classes/CarpetFloorApartment.php');
use PHPUnit\Framework\TestCase;

class CarpetFloorApartmentTest extends TestCase
{
  private $oFloor;
  private $fFloorArea;

  /**
   * Used to set the floor area and the floor object.
   *
   * @return void
   * @access public
   */
  public function setUp() {
    $this->fFloorArea = 77.5;
    $this->oFloor = new \CarpetFloorApartment($this->fFloorArea);
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
    $iCleaningTimePerSquareMeter = 2;
    $this->assertEquals($iCleaningTimePerSquareMeter, $this->oFloor->getFloorCleaningTimePerSquareMeter());
  }
}
