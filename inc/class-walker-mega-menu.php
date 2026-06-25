<?php
if (!defined('ABSPATH')) exit;
/**
 * Мега-меню для пункту "Послуги" в головній навігації.
 * Рівні: 0 — топ-пункти, 1 — категорії (ліва колонка),
 * 2 — групи маршрутів, 3 — самі маршрути.
 * Інші топ-пункти меню рендеряться стандартним Walker_Nav_Menu.
 */
class Walker_Mega_Menu extends Walker_Nav_Menu
{
    private $in_services = false;
    private $is_first_cat = true;
    private $services_url = '#';
    private $first_cat_title = '';
    private $first_cat_url = '#';

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        if ($this->in_services && $depth === 0) {
            $this->is_first_cat = true;
            $output .= '<div class="mega-menu"><div class="mega-menu__inner container">'
                . '<div class="mega-menu__col-categories"><ul class="mega-menu__categories">';
            return;
        }
        if ($this->in_services && $depth === 1) {
            $output .= '<ul class="mega-menu__groups">';
            return;
        }
        if ($this->in_services && $depth === 2) {
            $output .= '<ul class="mega-menu__routes">';
            return;
        }
        parent::start_lvl($output, $depth, $args);
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        if ($this->in_services && $depth === 0) {
            $output .= '</ul>' . glc_megamenu_all_link($this->services_url) . '</div>'
                . glc_megamenu_footer_active($this->first_cat_title, $this->first_cat_url)
                . glc_megamenu_images()
                . '</div></div>';
            return;
        }
        if ($this->in_services && ($depth === 1 || $depth === 2)) {
            $output .= '</ul>';
            return;
        }
        parent::end_lvl($output, $depth, $args);
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        if ($depth === 0) {
            $this->in_services = (trim($item->title) === 'Послуги');

            if ($this->in_services) {
                $this->services_url = $item->url;
                $classes = array_filter((array) $item->classes);
                $classes[] = 'has-mega';
                $output .= '<li class="' . esc_attr(implode(' ', $classes)) . '">';
                $output .= '<a href="' . esc_url($item->url) . '" class="mega-menu__toggle">' . esc_html($item->title) . '</a>';
                return;
            }

            parent::start_el($output, $item, $depth, $args, $id);
            return;
        }

        if ($this->in_services && $depth === 1) {
            $is_active = $this->is_first_cat;
            $this->is_first_cat = false;

            if ($is_active) {
                $this->first_cat_title = $item->title;
                $this->first_cat_url = $item->url;
            }

            $has_children = in_array('menu-item-has-children', (array) $item->classes, true);

            $class = 'mega-menu__cat-item';
            if ($is_active) $class .= ' is-active';
            if ($has_children) $class .= ' has-children';

            $output .= '<li class="' . esc_attr($class) . '" data-title="' . esc_attr($item->title) . '" data-link="' . esc_url($item->url) . '">';
            $output .= '<a href="' . esc_url($item->url) . '" class="mega-menu__cat-link">' . esc_html($item->title) . '</a>';
            if ($has_children)
                $output .= '<button type="button" class="mega-menu__cat-toggle" aria-label="Open subcategories"><span class="mega-menu__cat-arrow"></span></button>';
            return;
        }

        if ($this->in_services && $depth === 2) {
            $output .= '<li class="mega-menu__group">';
            $output .= '<a href="' . esc_url($item->url) . '" class="mega-menu__group-title">' . esc_html($item->title) . '</a>';
            return;
        }

        if ($this->in_services && $depth === 3) {
            $output .= '<li class="mega-menu__route">';
            $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
            return;
        }

        parent::start_el($output, $item, $depth, $args, $id);
    }

    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        if ($depth === 0 && $this->in_services) {
            $output .= '</li>';
            $this->in_services = false;
            return;
        }
        if ($this->in_services && in_array($depth, [1, 2, 3], true)) {
            $output .= '</li>';
            return;
        }
        parent::end_el($output, $item, $depth, $args);
    }
}
