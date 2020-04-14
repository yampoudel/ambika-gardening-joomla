<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @package simpleMembership
* @copyright Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru);
* Homepage: http://www.ordasoft.com
* Updated on October, 2018
* @license GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007; see LICENSE.txt
*/
$document = JFactory::getDocument();
$document->addStyleSheet('plugins/simplemembership/plg_simplemembership_user_messages/buttons.css');
      global $option;
        $path = JPATH_SITE.DS.'plugins'.DS.'simplemembership'.DS.'plg_simplemembership_user_messages'.DS.'messages.php';
        
        $false = false;
        if (file_exists($path)){
            ob_start();
            $jinput = JFactory::getApplication()->input;
            $user=Jfactory::getUser();
            $db=Jfactory::getDBO();
            $id=$jinput->getVar('userId');
            $task = "";
            if (isset($_REQUEST['task'])) $task=$_REQUEST['task'];
            if($id !=='' && $user->id == $id  && $task == "showUsersProfile")
            {
                $_GLOBALS['task'] = $task = "viewUserMessages";
            }
            //var_dump($task); exit;
            
            $_GLOBALS['option'] = $option = "com_simplemembership";
            $interlocutor = $jinput->getVar('interlocutor_id');
            require_once($path);
            switch ($task){
                case 'view_dialogue':
                    Messages::viewDialogue($option, $interlocutor);
                    break;
                case 'send_message':
                    Messages::sendMessage($option, $interlocutor);
                    break;
                case 'my_messages':
                    Messages::viewUserMessages($option, $task);
                    break;
                 default:
                    Messages::viewUserMessages($option, $task);

                    break;
            }
            
            $view = ob_get_contents();
            ob_end_clean();
            print_r($view);

        } else{
            JError::raiseWarning( 0, 'View showMyCars not supported. File not found.' );
            return $false;
        }
        return $view;
         
        ?>
 

