<?php
if (!defined('_VALID_MOS') && !defined('_JEXEC')) die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
/**
 *
 * @package simpleMembership
 * @copyright Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Anton Getman(ljanton@mail.ru);
 * Homepage: http://www.ordasoft.com
 * @version: 6.0.0 FREE
 * @license GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007; see LICENSE.txt
 *
 */

require_once(JPATH_SITE.DS.'plugins'.DS.'simplemembership'.DS.'plg_simplemembership_user_messages'.DS.'messages.html.php');


class Messages{
     static function viewUserMessages($option, $task){
         global $Itemid;
         $my=Jfactory::getUser();
        $database = JFactory::getDBO();
        $menu = new mosMenu($database);
        $menu->load($Itemid);
        $input = JFactory::getApplication()->input;
        
        if ($my->id > 0) { 
            $user = JFactory::getUser($my->id); }
        //else { echo "You haven't not access"; exit(); }
        if($user->id > 0 && $user->id == $my->id){
            
            $limit = $input->getInt('limit', 20);
            $limitstart=mosGetParam($_REQUEST,'limitstart',0);

            $database->setQuery("SELECT COUNT(msg_id) FROM #__simplemembership_messages WHERE sender_id='".$user->id."' OR recipient_id='".$user->id."' GROUP BY sender_id, recipient_id");
            $total=$database->loadResult();
             

            //getting my cars
            $selectstring = "SELECT * FROM #__simplemembership_messages WHERE sender_id='".$user->id."' OR recipient_id='".$user->id . "' ORDER BY msg_date DESC;";

            $database->setQuery($selectstring);
            $messages = $database->loadObjectList();

            //$query = "SELECT sender_id, recipient_id FROM #__simplemembership_messages WHERE sender_id='".$user->id."' OR recipient_id='".$user->id . "' GROUP BY sender_id, recipient_id ORDER BY msg_date LIMIT $pageNav->limitstart,$pageNav->limit;";
            $query = "SELECT sender_id, recipient_id FROM #__simplemembership_messages WHERE sender_id='".$user->id."' OR recipient_id='".$user->id . "' GROUP BY sender_id, recipient_id ORDER BY msg_date";
            $database->setQuery($query);
            $interlocutors = $database->loadObjectList();
            
            $my_interlocutors_id = array();
            
            foreach ($interlocutors as $interlocutor){
                if($interlocutor->sender_id != $my->id && !in_array($interlocutor->sender_id, $my_interlocutors_id)){

                        $my_interlocutors_id[] = $interlocutor->sender_id;

                }
                if($interlocutor->recipient_id != $my->id && !in_array($interlocutor->recipient_id, $my_interlocutors_id)){
                    $my_interlocutors_id[] = $interlocutor->recipient_id;
                }
            }

            $my_interlocutors = array();
            foreach ($my_interlocutors_id as $interlocutor_id){
                $interlocutor = JFactory::getUser($interlocutor_id);
                $my_interlocutors[] = array('int_id' => $interlocutor_id, 'int_name'=>$interlocutor->name );
                //var_dump($interlocutor);
            }
            //var_dump($my_interlocutors);
            $total = count($my_interlocutors);
            
            $pageNav = new JPagination( $total, $limitstart, $limit );
           HtmlMessages::showMyInterlocutors($my_interlocutors,$messages,$pageNav);
       }
    }
    
    static function viewDialogue($option, $interlocutor){
        global $database, $Itemid, $mainframe, $my, $vehiclemanager_configuration;
        $query = "SELECT * FROM #__simplemembership_messages WHERE (sender_id='".$interlocutor."' AND recipient_id='".$my->id . "') OR (recipient_id='".$interlocutor . "' AND sender_id='".$my->id . "') ORDER BY msg_date ";
        //var_dump($query);
        $database->setQuery($query);
        $messages = $database->loadObjectList();
        
        $query = "SELECT name FROM #__users WHERE id=" . $interlocutor;
        $database->setQuery($query);
        $interlocutor_name = $database->loadResult();
        $database->setQuery($query);
        


            $query = $database->getQuery(TRUE);

            $fields = array(
                $database->quoteName('read') . ' = ' . $database->quote('1'),
            );

            $query->update($database->quoteName('#__simplemembership_messages'));
            $query->set($fields);
            $query->where($database->quoteName('sender_id') . ' = '. $database->quote($interlocutor));
            $query->where($database->quoteName('recipient_id') . ' = '. $database->quote($my->id));

            $database->setQuery($query);
            $result = $database->execute();

        
        

        HtmlMessages::showDialogue($messages, $interlocutor, $interlocutor_name);
    }
    
    static function sendMessage($option, $user_id){
        global $my, $database;
        
        $input = JFactory::getApplication()->input;
        $session = JFactory::getSession();
        $plugin = JPluginHelper::getPlugin('simplemembership', 'plg_simplemembership_user_messages');
        $params = new JRegistry($plugin->params);
        $enable_captcha = $params->get('show_captcha');
        if($enable_captcha == 1){
            //Check enabled plugin captcha-recaptcha
            $recaptchaPluginEnabled = JPluginHelper::isEnabled('captcha', 'recaptcha');

            //Check enable option captcha-recaptcha in admin form
            $app = JFactory::getConfig();
            $recaptchaAdminEnabled = false;

            if($app->get('captcha') == 'recaptcha'){
              $recaptchaAdminEnabled = true;
            }

            //Check enable google recaptcha in vehicle settings
            $gooleRecaptchaShow = false;
            if($recaptchaPluginEnabled && $recaptchaAdminEnabled && $params->get('show_captcha') == 1){
              $gooleRecaptchaShow = true;
            }
            //var_dump($session); exit;
            $access = FALSE;
            foreach($my->groups as $group){
                foreach($params->get('captcha_acces') as $access_group){
                    if($access_group == 1){
                        $access = true;
                    }
                    if($access_group == $group){
                        $access = true;
                    }
                }
            }
            if($access){
                if($gooleRecaptchaShow){
                    if ( trim( $input->getString( 'g-recaptcha-response' ) ) === '' ) {
                        echo "<script> alert('Captcha is not verified!'); window.history.go(-1); </script>\n";
                        exit;
                    }

                }else{
                    if($session->get('captcha_keystring', 'default') != $input->getVar('keyguest')){
                        echo "<script> alert('Captcha is not verified!'); window.history.go(-1); </script>\n";
                        exit;
                    }
                }
            }
        }
        $query = "SELECT name, email FROM #__users WHERE id=" . $user_id;
        $database->setQuery($query);
        $recipient = $database->loadObjectList();
        
        
        $sql = "INSERT INTO `#__simplemembership_messages`(sender_id, sender_name, sender_email, recipient_id,
            recipient_name, recipient_email, message, msg_date)
            VALUES ('".$my->id."',
            '".$my->name."',
            '".$my->email."',
            '".$user_id."',
            '".$recipient[0]->name."',
            '".$recipient[0]->email."',
            '".$input->getVar('message')."',
            now())";
        $database->setQuery($sql);
        $database->query();
        
        $send_email = $params->get('email_to_user');
        if($send_email == 1){
            $send_text_message = $params->get('send_text_message');
            $mailer = JFactory::getMailer();
            $config = JFactory::getConfig();
            
            $sender = array($config->get('mailfrom'), $config->get('fromname') );
            
            $mailer->setSender($sender);
            $user = JFactory::getUser($user_id);
            $mailer->addRecipient($user->email);
            $body = JText::_("COM_SIMPLEMEMBERSHIP_NEW_MESSAGE_EMAIL_TEXT");
            if($send_text_message == 1){
                $body .= "<br> <em>" . $input->getVar('message') . "</em>";
            }
            
            $mailer->setSubject(JText::_("COM_SIMPLEMEMBERSHIP_NEW_MESSAGE_EMAIL_SUBJECT"));
            $mailer->isHTML(true);
            $mailer->setBody($body);
            $mailer->Send();
        }
        
        Messages::viewDialogue($option, $user_id);
    }
}
