<?php
if (!defined('_VALID_MOS') && !defined('_JEXEC')) die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
/**
 *
 * @package simpleMembership
 * @copyright Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Anton Getman(ljanton@mail.ru);
 * Homepage: http://www.ordasoft.com
 * @version: 6.5.0 FREE
 * @license GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007; see LICENSE.txt
 *
 */
$GLOBALS['mosConfig_absolute_path'] = JPATH_SITE;
class com_simplemembershipInstallerScript {
    /**
     * method to install the component
     *
     * @return void
     */
    function install($parent) {
        // $parent is the class calling this method
        
    }
    /**
     * method to uninstall the component
     *
     * @return void
     */
    function uninstall($parent) {
        // $parent is the class calling this method
        require_once ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_simplemembership/uninstall.simplemembership.php");
    }
    /**
     * method to update the component
     *
     * @return void
     */
    function update($parent) {
        // $parent is the class calling this method
        self::updateDatabase();
    }

    static function updateDatabase(){
        $db = JFactory::getDBO();

        $query = "SELECT * FROM #__simplemembership_orders LIMIT 1";
        $db->setQuery($query);
        $result = $db->loadObjectList();

        $query_array = array();
        $query_array[] = "ALTER TABLE `#__simplemembership_orders` CHANGE `fk_user_id` `fk_sm_users_id` INT(11) NULL DEFAULT NULL";
        $query_array[] = "ALTER TABLE `#__simplemembership_orders` ADD `fk_sm_users_email` varchar(255) NOT NULL DEFAULT '' AFTER `fk_sm_users_id`";
        $query_array[] = "ALTER TABLE `#__simplemembership_orders` ADD `fk_sm_users_name` varchar(255) NOT NULL DEFAULT '' AFTER `fk_sm_users_email`";

        if(isset($result[0]->fk_user_id)){
            foreach ($query_array as $query) {
                $db->setQuery($query);
                $db->query();
            }
        }

        $query = "SELECT * FROM #__simplemembership_orders_details LIMIT 1";
        $db->setQuery($query);
        $result = $db->loadObjectList();

        $query_array = array();
        $query_array[] = "ALTER TABLE `#__simplemembership_orders_details` CHANGE `fk_user_id` `fk_sm_users_id` INT(11) NULL DEFAULT NULL";
        $query_array[] = "ALTER TABLE `#__simplemembership_orders_details` ADD `fk_sm_users_email` varchar(255) NOT NULL DEFAULT '' AFTER `fk_order_id`";
        $query_array[] = "ALTER TABLE `#__simplemembership_orders_details` ADD `fk_sm_users_name` varchar(255) NOT NULL DEFAULT '' AFTER `fk_sm_users_email`";

        if(isset($result[0]->fk_user_id)){
            foreach ($query_array as $query) {
                $db->setQuery($query);
                $db->query();
            }
        }
        //var_dump($result); exit;
    }
    /**
     * method to run before an install/update/uninstall method
     *
     * @return void
     */
    function preflight($type, $parent) {
        // $parent is the class calling this method
        // $type is the type of change (install, update or discover_install)
        /*$db = JFactory::getDBO();
        $db->setQuery("DELETE FROM #__update_sites WHERE name = 'Simplemembership`s FREE Update'");
        $db->query();*/
    }
    /**
     * method to run after an install/update/uninstall method
     *
     * @return void
     */
    function postflight($type, $parent) {
        // $parent is the class calling this method
        // $type is the type of change (install, update or discover_install)
        require_once (dirname(__FILE__) . "/install.simplemembership.php");
        updateSMSConfigurationVersion();
        //com_install();
        // DMInstallHelper::setAdminMenuImages();
    }
}
