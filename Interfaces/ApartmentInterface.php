<?php

/**
 * ApartmentInterface is an interface for apartments which has signatures of methods
 * to define by the classes implements it.
 *
 * @package CodingAssignment
 * @author Jai Rana
 * @version 1.0
 * @access public
 */

interface ApartmentInterface {

  /**
   * Returns the floor area.
   *
   * @access public
   */
  public function getFloorArea();

  /**
   * Returns the cleaning time per square meter area.
   *
   * @access public
   */
  public function getFloorCleaningTimePerSquareMeter();
}
