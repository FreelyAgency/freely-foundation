<?php

namespace Drupal\freely_foundation;

use Drupal\Core\Menu\MenuLinkTree;
use Drupal\Core\Menu\MenuTreeParameters;

/**
 * Class FreelyFoundationMenuService.
 *
 * @package Drupal\freely_foundation
 */
class FreelyFoundationMenuService implements FreelyFoundationMenuServiceInterface {

  static public $FOUNDATION_THEME_DROPDOWN = 'freely_foundation_menu_dropdown';
  static public $FOUNDATION_THEME_DRILLDOWN = 'freely_foundation_menu_drilldown';
  static public $FOUNDATION_THEME_MEDIUM_DROPDOWN_SMALL_DRILLDOWN = 'freely_foundation_menu_medium_dropdown_small_drilldown';
  static public $FOUNDATION_THEME_LARGE_DROPDOWN_MEDIUM_DRILLDOWN = 'freely_foundation_menu_large_dropdown_medium_drilldown';
  static public $FOUNDATION_THEME_ACCORDION = 'freely_foundation_menu_accordion';
  static public $FOUNDATION_THEME_TOP_BAR = 'freely_foundation_menu_top_bar';
  static public $FOUNDATION_THEME_RESPONSIVE_TOP_BAR = 'freely_foundation_menu_responsive_top_bar';
  static public $FOUNDATION_THEME_STICKY = 'freely_foundation_sticky';
  
  /**
   * Drupal\Core\Menu\MenuLinkTree definition.
   *
   * @var \Drupal\Core\Menu\MenuLinkTree
   */
  protected $menuLinkTree;
  /**
   * Constructor.
   */
  public function __construct(MenuLinkTree $menu_link_tree) {
    $this->menuLinkTree = $menu_link_tree;
  }
  
  public function getMenuFoundationMenu($menu_machine_name, MenuTreeParameters $menu_parameters = NULL) {
    // @TODO
  }
  
  public function getMenuFoundationMediumDropdownSmallDrilldown($menu_machine_name, MenuTreeParameters $menu_parameters = NULL, $show_submenu_for_dropdown = TRUE) {
    $menu_to_render = $this->getMenuTreeToRender($menu_machine_name, $menu_parameters);
    $menu_to_render['#theme'] = self::$FOUNDATION_THEME_MEDIUM_DROPDOWN_SMALL_DRILLDOWN;
    $menu_to_render['#show_submenu_for_dropdown'] = $show_submenu_for_dropdown;
    
    return $menu_to_render;
  }

  public function getMenuFoundationLargeDropdownMediumDrilldown($menu_machine_name, MenuTreeParameters $menu_parameters, $show_submenu_for_dropdown = TRUE) {
    $menu_to_render = $this->getMenuTreeToRender($menu_machine_name, $menu_parameters);
    $menu_to_render['#theme'] = self::$FOUNDATION_THEME_LARGE_DROPDOWN_MEDIUM_DRILLDOWN;
    $menu_to_render['#show_submenu_for_dropdown'] = $show_submenu_for_dropdown;

    return $menu_to_render;
  }
  
  public function getMenuFoundationDropdown($menu_machine_name, MenuTreeParameters $menu_parameters = NULL) {
    $menu_to_render = $this->getMenuTreeToRender($menu_machine_name, $menu_parameters);
    $menu_to_render['#theme'] = self::$FOUNDATION_THEME_DROPDOWN;
    
    return $menu_to_render;
  }
  
  public function getMenuFoundationDrilldown($menu_machine_name, MenuTreeParameters $menu_parameters = NULL) {
    $menu_to_render = $this->getMenuTreeToRender($menu_machine_name, $menu_parameters);
    $menu_to_render['#theme'] = self::$FOUNDATION_THEME_DRILLDOWN;
    
    return $menu_to_render;
  }
  
  public function getMenuFoundationAccordion($menu_machine_name, MenuTreeParameters $menu_parameters = NULL) {
    $menu_to_render = $this->getMenuTreeToRender($menu_machine_name, $menu_parameters);
    $menu_to_render['#theme'] = self::$FOUNDATION_THEME_ACCORDION;
    
    return $menu_to_render;
  }
  
  public function getMenuFoundationTopBar($top_bar_left, $top_bar_right = NULL, $top_bar_id = NULL) {
    // @TODO - add #cache property @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Render%21theme.api.php/group/theme_render/8.2.x
    $menu_to_render = [
      '#theme' => self::$FOUNDATION_THEME_TOP_BAR,
      '#top_bar_left' => $top_bar_left,
      '#top_bar_right' => $top_bar_right,
      '#top_bar_id' => $top_bar_id,
    ];
    
    return $menu_to_render;
  }
  
  public function getMenuFoundationResponsiveTopBar($top_bar_left, $top_bar_id, $top_bar_right = NULL, $mobile_menu_bar_title = NULL, $toggle_breakpoint = 'medium') {
    // @TODO - add #cache property @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Render%21theme.api.php/group/theme_render/8.2.x
    $menu_to_render = [
      '#theme' => self::$FOUNDATION_THEME_RESPONSIVE_TOP_BAR,
      '#top_bar_left' => $top_bar_left,
      '#top_bar_right' => $top_bar_right,
      '#top_bar_id' => $top_bar_id,
      '#mobile_menu_bar_title' => $mobile_menu_bar_title,
      '#toggle_breakpoint' => $toggle_breakpoint,
    ];
    
    return $menu_to_render;
  }

    public function getMenuTreeToRender($menu_machine_name, MenuTreeParameters $menu_parameters = NULL) {
    if (!isset($menu_parameters)) {
      $menu_parameters = new MenuTreeParameters();
      $menu_parameters->onlyEnabledLinks();
    }
    
    $menu_tree = $this->getMenuTree($menu_machine_name, $menu_parameters);
    
    // Transform the tree using the manipulators you want.
    $manipulators = [
      // Only show links that are accessible for the current user.
      ['callable' => 'menu.default_tree_manipulators:checkAccess'],
      // Use the default sorting of menu links.
      ['callable' => 'menu.default_tree_manipulators:generateIndexAndSort'],
    ];
    
    $menu_tree = $this->menuLinkTree->transform($menu_tree, $manipulators);
    
    return $this->menuLinkTree->build($menu_tree);
  }
  
  public function getMenuTree($menu_machine_name, MenuTreeParameters $menu_parameters) {
    return $this->menuLinkTree->load($menu_machine_name, $menu_parameters);
  }

  public function getSticky($render_array, $sticky_breakpoint = 'medium', $wrapper_classes = '') {
    return [
      '#theme' => self::$FOUNDATION_THEME_STICKY,
      '#render_array' => $render_array,
      '#sticky_breakpoint' => $sticky_breakpoint,
      '#wrapper_classes' => $wrapper_classes,
    ];
  }

}
