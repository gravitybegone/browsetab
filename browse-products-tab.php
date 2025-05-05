<?php
/**
 * Plugin Name: Browse Products Tab
 * Plugin URI: https://gravitygone.co
 * Description: Adds a slide-out "Browse Products" tab with customizable styles and positioning.
 * Version: 1.2
 * Author: gravityGone
 * Author URI: https://gravitygone.co
 */

add_action('wp_footer', 'bpt_render_tab');
add_action('wp_enqueue_scripts', 'bpt_enqueue_scripts');
add_action('wp_head', 'bpt_custom_inline_style');
add_action('admin_menu', 'bpt_add_admin_menu');
add_action('admin_init', 'bpt_settings_init');

function bpt_enqueue_scripts() {
    wp_enqueue_style('bpt-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('bpt-script', plugins_url('script.js', __FILE__), array('jquery'), null, true);
}

function bpt_render_tab() {
    $position = get_option('bpt_tab_position', 'left');
    $panel_position_class = ($position === 'right') ? 'bpt-right' : 'bpt-left';

    $tab_text = get_option('bpt_tab_text', 'Browse Products');
echo '<div id="bpt-tab" class="' . esc_attr($panel_position_class) . '">' . esc_html($tab_text) . '</div>';
    echo '<div id="bpt-panel" class="' . esc_attr($panel_position_class) . '">';
$panel_title = get_option('bpt_panel_title', 'Browse');
$panel_intro = get_option('bpt_panel_intro', '');

echo '<div id="bpt-close">&times;</div>';
echo '<h3>' . esc_html($panel_title) . '</h3>';
echo wp_kses_post($panel_intro);

    $menu_id = get_option('bpt_selected_menu');
    if ($menu_id) {
        wp_nav_menu(array(
            'menu' => $menu_id,
            'container' => false,
            'menu_class' => 'bpt-menu',
        ));
    } else {
        echo '<p>No menu selected. Please configure it in Settings > Browse Products Tab.</p>';
    }

    echo '</div>';
}

function bpt_add_admin_menu() {
    add_options_page('Browse Products Tab', 'Browse Products Tab', 'manage_options', 'browse_products_tab', 'bpt_options_page');
}

function bpt_settings_init() {
    register_setting('bpt_settings_group', 'bpt_selected_menu');
    register_setting('bpt_settings_group', 'bpt_tab_bg_color');
    register_setting('bpt_settings_group', 'bpt_tab_font_color');
    register_setting('bpt_settings_group', 'bpt_panel_bg_color');
    register_setting('bpt_settings_group', 'bpt_menu_text_color');
    register_setting('bpt_settings_group', 'bpt_close_color');
    register_setting('bpt_settings_group', 'bpt_tab_position');
  register_setting('bpt_settings_group', 'bpt_tab_text');
  register_setting('bpt_settings_group', 'bpt_tab_text_size');
register_setting('bpt_settings_group', 'bpt_menu_font_size');
  register_setting('bpt_settings_group', 'bpt_tab_vertical_position');
  register_setting('bpt_settings_group', 'bpt_panel_title');
register_setting('bpt_settings_group', 'bpt_panel_intro');
  register_setting('bpt_settings_group', 'bpt_tab_padding_top');
register_setting('bpt_settings_group', 'bpt_tab_padding_right');
register_setting('bpt_settings_group', 'bpt_tab_padding_bottom');
register_setting('bpt_settings_group', 'bpt_tab_padding_left');

    add_settings_section('bpt_section_main', __('Settings', 'bpt'), null, 'browse_products_tab');
  add_settings_field('bpt_tab_text_size', 'Tab Text Size (e.g. 16px)', 'bpt_font_size_input_render', 'browse_products_tab', 'bpt_section_main', array('option_name' => 'bpt_tab_text_size', 'default' => '16px'));
add_settings_field('bpt_menu_font_size', 'Menu Item Font Size (e.g. 14px)', 'bpt_font_size_input_render', 'browse_products_tab', 'bpt_section_main', array('option_name' => 'bpt_menu_font_size', 'default' => '14px'));
  add_settings_field('bpt_tab_text', 'Tab Label Text', 'bpt_tab_text_render', 'browse_products_tab', 'bpt_section_main');
    add_settings_field('bpt_selected_menu', 'Select Menu', 'bpt_menu_dropdown_render', 'browse_products_tab', 'bpt_section_main');
    add_settings_field('bpt_tab_position', 'Tab Position (Left or Right)', 'bpt_tab_position_render', 'browse_products_tab', 'bpt_section_main');
    add_settings_field('bpt_tab_bg_color', 'Tab Background Color', 'bpt_color_input_render', 'browse_products_tab', 'bpt_section_main', array('option_name' => 'bpt_tab_bg_color'));
    add_settings_field('bpt_tab_font_color', 'Tab Font Color', 'bpt_color_input_render', 'browse_products_tab', 'bpt_section_main', array('option_name' => 'bpt_tab_font_color'));
    add_settings_field('bpt_panel_bg_color', 'Panel Background Color', 'bpt_color_input_render', 'browse_products_tab', 'bpt_section_main', array('option_name' => 'bpt_panel_bg_color'));
    add_settings_field('bpt_menu_text_color', 'Menu Text Color', 'bpt_color_input_render', 'browse_products_tab', 'bpt_section_main', array('option_name' => 'bpt_menu_text_color'));
    add_settings_field('bpt_close_color', 'Close Button Color', 'bpt_color_input_render', 'browse_products_tab', 'bpt_section_main', array('option_name' => 'bpt_close_color'));
  add_settings_field('bpt_tab_padding_top', 'Tab Padding Top (e.g. 12px)', 'bpt_padding_input_render', 'browse_products_tab', 'bpt_section_main', array('name' => 'bpt_tab_padding_top', 'default' => '12px'));
add_settings_field('bpt_tab_padding_right', 'Tab Padding Right', 'bpt_padding_input_render', 'browse_products_tab', 'bpt_section_main', array('name' => 'bpt_tab_padding_right', 'default' => '16px'));
add_settings_field('bpt_tab_padding_bottom', 'Tab Padding Bottom', 'bpt_padding_input_render', 'browse_products_tab', 'bpt_section_main', array('name' => 'bpt_tab_padding_bottom', 'default' => '12px'));
add_settings_field('bpt_tab_padding_left', 'Tab Padding Left', 'bpt_padding_input_render', 'browse_products_tab', 'bpt_section_main', array('name' => 'bpt_tab_padding_left', 'default' => '16px'));
  add_settings_field('bpt_tab_vertical_position', 'Tab Vertical Position (e.g. 40%)', 'bpt_vertical_position_render', 'browse_products_tab', 'bpt_section_main');
  add_settings_field('bpt_panel_title', 'Panel Title (H3)', 'bpt_panel_title_render', 'browse_products_tab', 'bpt_section_main');
add_settings_field('bpt_panel_intro', 'Panel Intro Message (HTML Allowed)', 'bpt_panel_intro_render', 'browse_products_tab', 'bpt_section_main');
}

function bpt_panel_title_render() {
    $value = get_option('bpt_panel_title', 'Browse');
    echo '<input type="text" name="bpt_panel_title" value="' . esc_attr($value) . '" placeholder="Browse">';
}

function bpt_panel_intro_render() {
    $value = get_option('bpt_panel_intro', '');
    echo '<textarea name="bpt_panel_intro" rows="4" style="width: 100%;">' . esc_textarea($value) . '</textarea>';
}

function bpt_vertical_position_render() {
    $value = get_option('bpt_tab_vertical_position', '40%');
    echo '<input type="text" name="bpt_tab_vertical_position" value="' . esc_attr($value) . '" placeholder="e.g. 40% or 120px">';
}

function bpt_padding_input_render($args) {
    $val = get_option($args['name'], $args['default']);
    echo '<input type="text" name="' . esc_attr($args['name']) . '" value="' . esc_attr($val) . '" placeholder="' . esc_attr($args['default']) . '">';
}

function bpt_font_size_input_render($args) {
    $option = get_option($args['option_name'], $args['default']);
    echo '<input type="text" name="' . esc_attr($args['option_name']) . '" value="' . esc_attr($option) . '" placeholder="' . esc_attr($args['default']) . '">';
}

function bpt_tab_text_render() {
    $value = get_option('bpt_tab_text', 'Browse Products');
    echo '<input type="text" name="bpt_tab_text" value="' . esc_attr($value) . '" style="width: 300px;">';
}

function bpt_menu_dropdown_render() {
    $selected_menu = get_option('bpt_selected_menu');
    $menus = wp_get_nav_menus();
    echo '<select name="bpt_selected_menu">';
    foreach ($menus as $menu) {
        echo '<option value="' . esc_attr($menu->term_id) . '"' . selected($selected_menu, $menu->term_id, false) . '>' . esc_html($menu->name) . '</option>';
    }
    echo '</select>';
}

function bpt_tab_position_render() {
    $value = get_option('bpt_tab_position', 'left');
    echo '<select name="bpt_tab_position">
        <option value="left" ' . selected($value, 'left', false) . '>Left</option>
        <option value="right" ' . selected($value, 'right', false) . '>Right</option>
    </select>';
}

function bpt_color_input_render($args) {
    $option = get_option($args['option_name'], '#000000');
    echo '<input type="color" name="' . esc_attr($args['option_name']) . '" value="' . esc_attr($option) . '">';
}

function bpt_options_page() {
    ?>
    <form action="options.php" method="post">
        <h2>Browse Products Tab Settings</h2>
        <?php
        settings_fields('bpt_settings_group');
        do_settings_sections('browse_products_tab');
        submit_button();
        ?>
    </form>
    <?php
}

function bpt_custom_inline_style() {
    $tab_bg = get_option('bpt_tab_bg_color', '#333333');
    $tab_color = get_option('bpt_tab_font_color', '#ffffff');
    $panel_bg = get_option('bpt_panel_bg_color', '#f9f9f9');
    $menu_color = get_option('bpt_menu_text_color', '#333333');
    $close_color = get_option('bpt_close_color', '#000000');
  $tab_text_size = get_option('bpt_tab_text_size', '16px');
$menu_font_size = get_option('bpt_menu_font_size', '14px');
  $pad_top = get_option('bpt_tab_padding_top', '12px');
$pad_right = get_option('bpt_tab_padding_right', '16px');
$pad_bottom = get_option('bpt_tab_padding_bottom', '12px');
$pad_left = get_option('bpt_tab_padding_left', '16px');
  $top = get_option('bpt_tab_vertical_position', '40%');

echo "<style>
:root {
    --bpt-tab-bg: {$tab_bg};
    --bpt-tab-color: {$tab_color};
    --bpt-panel-bg: {$panel_bg};
    --bpt-menu-color: {$menu_color};
    --bpt-close-color: {$close_color};
    --bpt-tab-font-size: {$tab_text_size};
    --bpt-menu-font-size: {$menu_font_size};
    --bpt-tab-padding-top: {$pad_top};
--bpt-tab-padding-right: {$pad_right};
--bpt-tab-padding-bottom: {$pad_bottom};
--bpt-tab-padding-left: {$pad_left};
--bpt-tab-top: {$top};
}
</style>";
}