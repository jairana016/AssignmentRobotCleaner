<?php

/**
 * CarpetFloorApartment is a class for the Apartment floor which is of carpet type.
 * It has properties related to carpet floor.
 *
 * @package CodingAssignment
 * @author Jai Rana
 * @version 1.0
 * @access public
 */

require_once ('./Interfaces/ApartmentInterface.php');

class CarpetFloorApartment implements ApartmentInterface
{
  protected $fFloorArea;
  const CLEANING_TIME_PER_SQUARE_METER = 2;

  /**
   * Sets the floor area while creation of an object of this class.
   *
   * @param  float  $fFloorArea Area of the floor in square meters.
   * @access public
   */
  public function __construct($fFloorArea) {
    $this->fFloorArea = $fFloorArea;
  }

  /**
   * Returns the floor area.
   *
   * @return float  Area of the floor in square meters.
   * @access public
   */
  public function getFloorArea() {
    return $this->fFloorArea;
  }

  /**
   * Returns the cleaning time for per square meter area of floor.
   *
   * @return int    Cleaning time for per square meter area of floor.
   * @access public
   */
  public function getFloorCleaningTimePerSquareMeter() {
    return self::CLEANING_TIME_PER_SQUARE_METER;
  }
}
