<?php
// -----
// Admin-level initialization script for the Edit Orders plugin for Zen Cart, by lat9.
// Copyright (C) 2018, Vinos de Frutas Tropicales.
//
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

define('ZXOI_CURRENT_VERSION', '1.1.0');

// -----
// Only update configuration when an admin is logged in.
//
if (isset($_SESSION['admin_id'])) {
    if (!defined('ZX_OPTIMIZED_IMAGES_VERSION')) {
        $configurationGroupTitle = 'ZX Optimized Images';
        $configuration = $db->Execute(
            "SELECT configuration_group_id 
           FROM " . TABLE_CONFIGURATION_GROUP . " 
          WHERE configuration_group_title = '$configurationGroupTitle' 
          LIMIT 1"
        );
        if ($configuration->EOF) {
            $db->Execute(
                "INSERT INTO " . TABLE_CONFIGURATION_GROUP . " 
                (configuration_group_title, configuration_group_description, sort_order, visible) 
            VALUES 
                ('$configurationGroupTitle', '$configurationGroupTitle', '1', '1')"
            );
            $cgi = $db->Insert_ID();
            $db->Execute("UPDATE " . TABLE_CONFIGURATION_GROUP . " SET sort_order = $cgi WHERE configuration_group_id = $cgi;");
        } else {
            $cgi = $configuration->fields['configuration_group_id'];
        }

        // ----
        // If not already set, record the configuration's current version in the database.
        //

        $db->Execute(
            "INSERT INTO " . TABLE_CONFIGURATION . "
                (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, date_added, sort_order, set_function)
             VALUES
                ('ZX Optimized Images Version', 'ZX_OPTIMIZED_IMAGES_VERSION', '1.0.0', 'Currently installed version of ZX Optimized Images.<br />Module brought to you by <a href=\"https://zenexpert.com\" target=\"_blank\">ZenExpert</a>', $cgi, now(), 10, 'trim(')"
        );

        $db->Execute(
            "INSERT INTO " . TABLE_CONFIGURATION . " 
                ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) 
             VALUES 
                ( 'ZX Optimized Images Enabled', 'ZX_OPTIMIZED_IMAGES_ENABLED', 'off', 'Enable ZX Optimized Images to automatically optimize all images using reSmush.it service', $cgi, 20, now(), NULL, 'zen_cfg_select_option(array(\'on\', \'off\'),')"
        );

        $db->Execute(
            "INSERT INTO " . TABLE_CONFIGURATION . " 
                ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) 
             VALUES 
                ( 'Large Image Maximum Width', 'ZX_OPTIMIZED_IMAGES_LARGE_IMAGE_WIDTH', '1000', 'Maximum width for the large optimized image', $cgi, 30, now(), NULL, NULL)"
        );

        $db->Execute(
            "INSERT INTO " . TABLE_CONFIGURATION . " 
                ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) 
             VALUES 
                ( 'Large Image Maximum Height', 'ZX_OPTIMIZED_IMAGES_LARGE_IMAGE_HEIGHT', '1000', 'Maximum height for the large optimized image', $cgi, 40, now(), NULL, NULL)"
        );

        $next_sort = $db->Execute("SELECT MAX(sort_order) as max_sort FROM " . TABLE_ADMIN_PAGES . " WHERE menu_key='customers'", false, false, 0, true);
        zen_register_admin_page('configZXOptimizedImages', 'BOX_CONFIGURATION_ZX_OPTIMIZED_IMAGES', 'FILENAME_CONFIGURATION', "gID=$cgi", 'configuration', 'Y', $cgi);

        $messageStack->add('ZX Optimized Images installed. Please enable it from Configuration->ZX Optimized Images menu.', 'success');
    }



        if (ZX_OPTIMIZED_IMAGES_VERSION != '0.0.0' && ZX_OPTIMIZED_IMAGES_VERSION != ZXOI_CURRENT_VERSION) {
            $messageStack->add(sprintf('ZX Optimized Images successfully updated to version %s', ZXOI_CURRENT_VERSION), 'success');
            $db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '".ZXOI_CURRENT_VERSION."', last_modified = now() WHERE configuration_key = 'ZX_OPTIMIZED_IMAGES_VERSION' LIMIT 1");
        }


}