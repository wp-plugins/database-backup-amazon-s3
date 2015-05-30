<?php
/*
Plugin Name: Database Backup Amazon s3 
Description: Amazon s3  Backup Plugin to create Amazon s3 Database of your Web Page
Version: 1.0
*/

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'wpadm.php';

add_action('init', 'wpadm_db_backup_s3_run');
register_activation_hook( __FILE__, 'wpadm_activation' );
register_deactivation_hook( __FILE__, 'wpadm_deactivation' );
register_uninstall_hook( __FILE__, 'wpadm_uninstall' );

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'wpadm-class-wp.php';

add_action('admin_print_scripts', array('wpadm_wp_db_backup_s3', 'include_admins_script' ));
add_action('admin_menu', array('wpadm_wp_db_backup_s3', 'draw_menu'));
add_action('admin_post_activate_db_wpadm_backup_s3', array('wpadm_wp_db_backup_s3', 'activatePlugin') );

if ( !get_option('wpadm_pub_key')/* && (is_admin())*/) {
    add_action('admin_notices', 'wpadm_admin_notice');
}

if (!function_exists('wpadm_db_backup_s3_run')) {
    function wpadm_db_backup_s3_run()
    {
        wpadm_run('database-backup-amazon-s3', dirname(__FILE__));
    }
}

