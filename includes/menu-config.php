<?php 

/* Add custom classes to list item "li" */
function _namespace_menu_item_class($classes, $item)
{
    $classes[] = "header__main__nav__list__item"; // you can add multiple classes here
    return $classes;
}

add_filter('nav_menu_css_class', '_namespace_menu_item_class', 10, 2);

/* Add custom class to link in menu */
function _namespace_modify_menuclass($ulclass)
{
    return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
}

add_filter('wp_nav_menu', '_namespace_modify_menuclass');

?>