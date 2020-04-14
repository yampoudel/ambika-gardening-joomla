<?php
if (!defined('_VALID_MOS') && !defined('_JEXEC')) die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
/**
*
* @package simpleMembership
* @copyright Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru);
* Homepage: http://www.ordasoft.com
* Updated on October, 2018
* @license GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007; see LICENSE.txt
*/

$doc = JFactory::getDocument();
require_once (JPATH_BASE . "/components/com_simplemembership/functions.php");
$doc->addStyleSheet(JURI::root() . 'components/com_simplemembership/includes/simplemembership.css');
if(checkJavaScriptIncludedSMS('jQuerOs-2.2.4.min.js') === false){
  $doc->addScript(JURI::base() . "/components/com_simplemembership/includes/jQuerOs-2.2.4.min.js");
  $doc->addScriptDeclaration("jQuerOs=jQuerOs.noConflict();");
}
$doc->addScript(JURI::base() . "/components/com_simplemembership/includes/simple-modal.js");
$doc->addStyleSheet("https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css");

if (!array_key_exists('user_configuration', $GLOBALS) || 
      array_key_exists('user_configuration', $GLOBALS) 
      && !count($GLOBALS['user_configuration'])) {
    require_once (JPATH_BASE .
     "/administrator/components/com_simplemembership/admin.simplemembership.class.conf.php");
    $GLOBALS['user_configuration'] = $user_configuration;
} else
    global $user_configuration;

if(!function_exists('getReturnURL_SM')) {
  function getReturnURL_SM($params, $type)
  {
    $app    = JFactory::getApplication();
    $router = $app->getRouter();
    $url = null;
    if ($itemid = $params->get($type)){
      $db     = JFactory::getDbo();
      $query  = $db->getQuery(true)
        ->select($db->quoteName('link'))
        ->from($db->quoteName('#__menu'))
        ->where($db->quoteName('published') . '=1')
        ->where($db->quoteName('id') . '=' . $db->quote($itemid));
      $db->setQuery($query);
      if ($link = $db->loadResult()){
        if ($router->getMode() == JROUTER_MODE_SEF){
          $url = 'index.php?Itemid=' . $itemid;
        }else{
          $url = $link . '&Itemid=' . $itemid;
        }
      }
    }
    if (!$url){
      // Stay on the same page
      $uri = clone JUri::getInstance();
      $vars = $router->parse($uri);
      unset($vars['lang']);
      if ($router->getMode() == JROUTER_MODE_SEF){
        if (isset($vars['Itemid'])){
          $itemid = $vars['Itemid'];
          $menu = $app->getMenu();
          $item = $menu->getItem($itemid);
          unset($vars['Itemid']);
          if (isset($item) && $vars == $item->query){
            $url = 'index.php?Itemid=' . $itemid;
          }else{
            $url = 'index.php?' . JUri::buildQuery($vars) . '&Itemid=' . $itemid;
          }
        }else{
          $url = 'index.php?' . JUri::buildQuery($vars);
        }
      }else{
        $url = 'index.php?' . JUri::buildQuery($vars);
      }
    }
    return base64_encode($url);
  }
}
if(!function_exists('getReturnURL_SM2')) {
  function getReturnURL_SM2($params, $type)
  {
    $app  = JFactory::getApplication();
    $item = $app->getMenu()->getItem($params->get($type));
    if ($item)
    {
      $url = 'index.php?Itemid=' . $item->id;
    }
    else
    {
      // Stay on the same page
      $url = JUri::getInstance()->toString();
    }
    return  base64_encode($url);
  }
}
if(!function_exists('showLoginCaptcha')) {
    function showLoginCaptcha($params) {
        global $my, $Itemid;
        
        if($params->get('show_captcha') == 0){
            return;
        }
        //$plugin = JModuleHelper::getModule('simplemembership', 'plg_simplemembership_user_messages');
        //var_dump($params);
//$params = new JRegistry($plugin->params);
        if($my->id == 0){
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
                    <span classs="col_01"><?php echo JText::_("MOD_SMS_CAPTCHA_INPUT"); ?></span>
                </div>
                <div class="row_09">
                    <span class="col_01">
                        <input class="inputbox" type="text" name="keyguest" size="6" maxlength="6" style="width: 148px;"/>
                    </span>
                </div>
                <!--****************************   end add antispam guest   ******************************-->
                <?php
            }
        }
    }
}
global $mosConfig_absolute_path, $mosConfig_allowUserRegistration;
$usersConfig =JComponentHelper::getParams( 'com_users' );
//  Show login or logout?
  $my = JFactory::getUser();
  $user = JFactory::getUser();
  //$type = (!$user->get('guest')) ? 'logout' : 'login';
  $type = (!$user->get('guest')) ? JText::_('MOD_SMS_LOGIN_LOGOUT')  : JText::_('MOD_SMS_LOGIN_LOGIN') ;
  $session = JFactory::getSession();
  $input = JFactory::getApplication()->input;
// Determine settings based on CMS version
  if( $type == 'login' ) {
    // Lost password
    $reset_url = JRoute::_( 'index.php?option=com_users&amp;view=reset' );
    // User name reminder (Joomla 1.5 only)
    $remind_url = JRoute::_( 'index.php?option=com_users&amp;view=remind' );
    // Set the validation value
    if (version_compare(JVERSION, '3.0.0', 'lt')) 
    $validate = JUtility::getToken();
  } else {
    $database =JFactory::getDBO();
    $joom_id = $user->id;
    $query = "SELECT u.*, uum.group_id as gid from #__users as u 
              LEFT JOIN #__user_usergroup_map as uum ON uum.user_id=u.id WHERE id='$joom_id'";
    $database->setQuery($query);
    $juser = $database->loadObject();
    $email = $juser->email;
    $id = $juser->id;
    $name = $juser->name;
    $username = $juser->username;
    if (version_compare(JVERSION, '3.0.0','lt')) {
      $query = "update #__simplemembership_users set name='$name', 
                        username='$username',
                        email='$email' where fk_users_id='$id' ";
    } else {
      $query = "update #__simplemembership_users set name='$name',
                        username='$username',
                        email='$email' where fk_users_id='$id' ";
    }
    $database->setQuery($query);
    $database->query();
    // Set the greeting name
    $user = JFactory::getUser();
    $name = ( $params->get( 'name') ) ? $user->name : $user->username;
  }
  
  //if($params->get('layout') == 0){
    require JModuleHelper::getLayoutPath('mod_simplemembership_login', 'default');
//  }elseif($params->get('layout') == 1){
//      require JModuleHelper::getLayoutPath('mod_simplemembership_login', 'modal');
//  }

