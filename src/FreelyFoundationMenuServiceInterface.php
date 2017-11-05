<?php

namespace Drupal\freely_foundation;

use Drupal\Core\Menu\MenuTreeParameters;

/**
 * Interface FreelyFoundationMenuServiceInterface.
 *
 * @package Drupal\freely_foundation
 */
interface FreelyFoundationMenuServiceInterface {

  public function getMenuFoundationMenu($menu_machine_name, MenuTreeParameters $menu_parameters);
  
  public function getMenuFoundationDropdown($menu_machine_name, MenuTreeParameters $menu_parameters);
  
  public function getMenuFoundationDrilldown($menu_machine_name, MenuTreeParameters $menu_parameters);
  
  public function getMenuFoundationMediumDropdownSmallDrilldown($menu_machine_name, MenuTreeParameters $menu_parameters, $show_submenu_for_dropdown = TRUE);
  
  public function getMenuFoundationAccordion($menu_machine_name, MenuTreeParameters $menu_parameters);
  
  public function getMenuTreeToRender($menu_machine_name, MenuTreeParameters $menu_parameters);
  
  public function getMenuTree($menu_machine_name, MenuTreeParameters $menu_parameters);
}
