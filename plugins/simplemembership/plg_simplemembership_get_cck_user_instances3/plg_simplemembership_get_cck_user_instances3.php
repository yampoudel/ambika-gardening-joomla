<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
 *
 * @package simpleMembership
 * @copyright Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Anton Getman(ljanton@mail.ru);
 * Homepage: http://www.ordasoft.com
 * @version: 5.0.0 FREE
 * @license GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007; see LICENSE.txt
 *
 */
$document = JFactory::getDocument();
$document->addStyleSheet('plugins/simplemembership/plg_simplemembership_get_cck_user_instances3/buttons.css');


        global $option;
        $path = JPATH_SITE.DS.'components'.DS.'com_os_cck'.DS.'os_cck.php';
        if (!function_exists('showInstanceManager')){
            $false = false;
            if (file_exists($path)){ 
                ob_start();
                $user=Jfactory::getUser();
                $db=Jfactory::getDBO();
                $id=Jrequest::getVAr('userId');
                $task = "";
                
                $lang = JFactory::getLanguage();
                $extension = 'com_os_cck';
                $base_dir = JPATH_SITE;
                $language_tag = 'en-GB';
                $reload = true;
                $lang->load($extension, $base_dir, $language_tag, $reload);
                
                
                if (isset($_REQUEST['task'])) $task=$_REQUEST['task'];

                if($id==''){
                  $id=$user->id;
                }
                $query='SELECT * FROM #__users WHERE id='.$id;
                $db->setQuery($query);
                $info=$db->loadObject();
                
                $_SESSION['sms_user'] = $info->name;
                $_REQUEST['Ownername']='on';
                $_REQUEST['exactly']='on';
                $_GLOBALS['option'] = $option = "com_simplemembership";
                $_GLOBALS['number_of_plugin'] = 3;
                if(isset($_REQUEST['number_of_plugin']) && $_GLOBALS['number_of_plugin'] != $_REQUEST['number_of_plugin']){
                    $task = 'ShowUserInstances';
                }
                $plugin = JPluginHelper::getPlugin('simplemembership', 'plg_simplemembership_get_cck_user_instances3');
                $params = new JRegistry($plugin->params);
                $lid = $params->get('user_layout');
                //var_dump($id); exit;
                switch ($task){
                    
                    case 'instance_manager': 
                        $_GLOBALS['task'] = $task = "instance_manager";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    
                    case 'unpublish_instances':
                        $_GLOBALS['task'] = $task = "unpublish_instances";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'publish_instances':
                        $_GLOBALS['task'] = $task = "publish_instances";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'unapprove_instances':
                        $_GLOBALS['task'] = $task = "unapprove_instances";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'approve_instances':
                        $_GLOBALS['task'] = $task = "approve_instances";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'edit_rent':
                        $_GLOBALS['task'] = $task = "edit_rent";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'show_rent_request_instances':
                        $_GLOBALS['task'] = $task = "show_rent_request_instances";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'show_buy_request_instances':
                        $_GLOBALS['task'] = $task = "show_buy_request_instances";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'show_user_rent_history':
                        $_GLOBALS['task'] = $task = "show_user_rent_history";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'edit_instance':
                        $_GLOBALS['task'] = $task = "edit_instance";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'save_instance':
                        $_GLOBALS['task'] = $task = "save_instance";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'save_rent_request':
                        $_GLOBALS['task'] = $task = "save_rent_request";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'rent_requests': 
                        $_GLOBALS['task'] = $task = "rent_requests";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'rent_return':
                        $_GLOBALS['task'] = $task = "rent_return";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'save_rent':
                        $_GLOBALS['task'] = $task = "save_rent";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'buying_requests':
                        $_GLOBALS['task'] = $task = "buying_requests";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'buying_request':
                        $_GLOBALS['task'] = $task = "buying_request";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'accept_buying_requests':
                        $_GLOBALS['task'] = $task = "accept_buying_requests";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    case 'decline_buying_requests':
                        $_GLOBALS['task'] = $task = "decline_buying_requests";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        break;
                    
                    
                    case 'ajax_rent_calcualete': 
                        $_GLOBALS['task'] = $task = "ajax_rent_calcualete";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                    default:
                        $_GLOBALS['task'] = $task = "user_instances";
                        $_GLOBALS['option'] = $option = "com_simplemembership";
                        $_GLOBALS['lid'] = $lid
                        //$_GLOBALS['userId'] = $id;
                    ?>
                    <?php
                        break;
                }
                
                //var_dump($_GLOBALS); exit;
                require ($path);
                $view = ob_get_contents();
                ob_end_clean();
                print_r($view);
                
            } else{
                JError::raiseWarning( 0, 'View showInstanceManager not supported. File not found.' );
                return $false;
            }
            return $view;
        } 
        ?>
