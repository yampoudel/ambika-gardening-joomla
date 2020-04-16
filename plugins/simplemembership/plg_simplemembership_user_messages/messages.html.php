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
class HtmlMessages{
    static function showMyInterlocutors ($my_interlocutors,$messages,$pageNav){
            ?>
                  <script type="text/javascript">
                      function ready() {
                          var href = window.location.href;
                          if(href.indexOf('my_messages') > -1){
                            document.querySelector('[rel="country_messages"]').click();
                            
                          }
                            
                          var elements = document.getElementsByClassName("pagenav");
                          var limit = document.getElementById("limit").value;
                          
                          for(index = 0; index < elements.length; ++index){
                              elements[index].href = elements[index].href + '&limit=' + limit;

                          }
                            
                      }

                      document.addEventListener("DOMContentLoaded", ready);
                  </script>
        <form action="index.php?option=com_simplemembership&task=my_messages" method="post" name="adminForm" class="vehicles_main" id="adminForm">
            <div class="my_messages">
                <div class="msg_limit_box">
                    <?php echo $pageNav->getLimitBox(); ?>
                </div>
                <?php 
                $even = 0;
                //var_dump($pageNav);
                foreach ($my_interlocutors as $interlocutor){ 
                    if($even >= $pageNav->limitstart && $even < ($pageNav->limitstart + $pageNav->limit)){
                    
                    ?> <div class="my_messages_wrap <?php echo ( $even & 1 ) ? '' : 'even'; ?>"> <?php
                    $unread = FALSE; 
                    $last_date = array();
                    $last_msg = array();
                    foreach($messages as $message){
                        if($message->sender_id == $interlocutor['int_id'] && ($message->read == '0' || !$message->read)){
                            $unread = TRUE;
                        }
                        
                        if($message->sender_id == $interlocutor['int_id'] || $message->recipient_id == $interlocutor['int_id']){
                            $last_date[] = $message->msg_date;
                            if(strlen($message->message) > 30){
                                $last_msg[] = substr($message->message, 0, 30);
                            } else {
                                $last_msg[] = $message->message;
                            }
                        }
                        
                    }
                    
                    $open_b = ($unread) ? ' <strong>' : '';
                    $close_b = ($unread) ? ' </strong>' : '';?>
                    <div class="interlocutor"> <?php echo '<a href="'.JURI::base () .'index.php?option=com_simplemembership&task=view_dialogue&interlocutor_id='. $interlocutor['int_id'] . '">' . $open_b . $interlocutor['int_name'] . $close_b . '</a>'; ?> </div>
                    <div class="message_date"> <?php echo '<a href="'.JURI::base () .'index.php?option=com_simplemembership&task=view_dialogue&interlocutor_id='. $interlocutor['int_id'] . '">' . $open_b . $last_date[0] . $close_b . '</a>'; ?> </div>
                    <div class="message_text"> <?php echo '<a href="'.JURI::base () .'index.php?option=com_simplemembership&task=view_dialogue&interlocutor_id='. $interlocutor['int_id'] . '">' . $open_b . $last_msg[0] . $close_b . '</a>'; ?> </div>
                    <div class="message_icon">
                        <?php if($unread){echo "<img src='".JURI::root()."/components/com_simplemembership/images/email.png'>";
                        }else{
                            echo "<img src='".JURI::root()."/components/com_simplemembership/images/email-open.png'>";
                        }?>
                    </div>
                    </div>
                     <?php
                    
                 }
                 $even++;
                }?>
                <div class = "pagination">
                        <?php echo $pageNav->getListFooter(); ?>
                </div>
            </div>
        </form>
        <?php }
        
        static function showDialogue($messages, $interlocutor, $interlocutor_name){
            global $my;
            
            ?>
                  <div class="dialogue">
                  <script type="text/javascript">
                      function ready() {
                        document.querySelector('[rel="country_messages"]').click();
                      }

                      document.addEventListener("DOMContentLoaded", ready);
                  </script>
                  <div class="msg_header">
                  <div class="btn button msg_button_back" value="<?php echo JText::_("COM_SIMPLEMEMBERSHIP_MESSAGES_MESSAGE_LIST"); ?>">
                      <a href="<?php echo JURI::base (); ?>index.php?option=com_simplemembership&task=my_messages"><?php echo JText::_("COM_SIMPLEMEMBERSHIP_MESSAGES_MESSAGE_LIST"); ?></a>
                  </div> 
                  <div class="interlocutor_name">
                      <h3><?php echo JText::_("COM_SIMPLEMEMBERSHIP_MESSAGES_MESSAGES_WITH"); ?><?php echo $interlocutor_name; ?></h3>
                  </div> 
                  </div>
                 
            <?php      
            if(count($messages) == 0){
                echo '<div class="message_write"><h3>'. JText::_("COM_SIMPLEMEMBERSHIP_MESSAGES_NO_MESSAGES") . '</h3></div>';
            }else{
                foreach ($messages as $message){
                    if($my->id == $message->sender_id){
                        $class = 'my_msg';
                    }elseif ($my->id == $message->recipient_id) {
                        $class = 'recipient_msg';
                    } 
                    if($message->message != ''){?>
                    <div class="msg_wrap">
                        <div class="msg_info">
                          <?php if($my->id == $message->sender_id){
                                echo '<div class="my_msg_name">My message</div>';
                                echo '<div class="my_msg_date">' . $message->msg_date . '</div>';
                            }elseif ($my->id == $message->recipient_id) {
                                echo '<div class="rec_msg_name">' . $message->sender_name . '</div>';
                                echo '<div class="rec_msg_date">' . $message->msg_date . '</div>';
                            } 

                            ?>
                        </div>
                      <div class="<?php echo $class; ?>">
                          <p><?php echo $message->message; ?></p>
                      </div>
                    </div>
                <?php }
                } 
            }?>
            <div class="message_form">
                      <div class="message_write"><h4><?php echo JText::_("COM_SIMPLEMEMBERSHIP_MESSAGES_WRITE_MESSAGE"); ?></h4></div>
                      <form action="index.php?option=com_simplemembership&task=send_message&interlocutor_id=<?php echo $interlocutor; ?>" method="post" name="adminForm"  class="vehicles_main"  id="adminForm">
                        <p><textarea name="message" rows="10" style="width: 80%"></textarea></p>
                        <div class="message_captcha"><?php HtmlMessages::showMessagesCaptcha(); ?></div>
                        <input class="message_button" type="submit" value="<?php echo JText::_("COM_SIMPLEMEMBERSHIP_MESSAGES_BUTTON_SEND"); ?>">
                      </form>
                  </div>
                  </div>
        <?php }
        
        static function showMessagesCaptcha() {
            global $my, $Itemid;

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
                    $captcha = JCaptcha::getInstance('recaptcha', array('namespace' => 'anything'));
                    echo $captcha->display('recaptcha', 'recaptcha','required');
                    }else{
                    ?>
                    <div class="row_06">
                        <span class="col_01">
                            <!--*********************************   begin insetr image   **********************************-->
                            <?php
                                // begin create kod
                            $st = "      ";
                            $algoritm = mt_rand(1, 2);
                            switch ($algoritm) {
                                case 1:
                                for ($j = 0; $j < 6; $j+=2) {
                                    $st = substr_replace($st, chr(mt_rand(97, 122)), $j, 1); //abc
                                    $st = substr_replace($st, chr(mt_rand(50, 57)), $j + 1, 1); //23456789
                                }
                                break;
                                case 2:
                                for ($j = 0; $j < 6; $j+=2) {
                                    $st = substr_replace($st, chr(mt_rand(50, 57)), $j, 1); //23456789
                                    $st = substr_replace($st, chr(mt_rand(97, 122)), $j + 1, 1); //abc
                                }
                                break;
                            }

                        //**************   begin search in $st simbol 'o, l, i, j, t, f'   ********************************
                            $st_validator = "olijtf";
                            for ($j = 0; $j < 6; $j++) {
                                for ($i = 0; $i < strlen($st_validator); $i++) {
                                    if ($st[$j] == $st_validator[$i]) {
                                    $st[$j] = chr(mt_rand(117, 122)); //uvwxyz
                                }
                            }
                        }
                        //**************   end search in $st simbol 'o, l, i, j, t, f'   **********************************

                        $session = JFactory::getSession();
                        $session->set('captcha_keystring', $st);

                        if (isset($_REQUEST['error']) && $_REQUEST['error'] != "")
                            echo "<font style='color:red'>" . $_REQUEST['error'] . "</font><br />";
                        $name_user = "";
                        if (isset($_REQUEST['name_user']))
                            $name_user = protectInjectionWithoutQuote('name_user','','STRING');

                        if (isset($_REQUEST["err_msg"]))
                            echo "<script> alert('Error: " . $_REQUEST["err_msg"] . "'); </script>\n";

                        echo "<br /><img src='" . JRoute::_( "index.php?option=com_simplemembership&amp;task=secret_image&Itemid=$Itemid&uniqid=".uniqid())."' alt='CAPTCHA_picture'/><br/>";
                        ?>
                        <!--**********************   end insetr image   *******************************-->
                    </span>
                        </div>
                        <div class="row_08">
                            <span classs="col_01"><?php echo JText::_("COM_SIMPLEMEMBERSHIP_CAPTCHA"); ?></span>
                        </div>
                        <div class="row_09">
                            <span class="col_01">
                                <input class="inputbox" type="text" name="keyguest" size="6" maxlength="6" />
                            </span>
                        </div>
                        <!--****************************   end add antispam guest   ******************************-->
                        <?php
                    }
                }

            }
        
        }
                                
}
