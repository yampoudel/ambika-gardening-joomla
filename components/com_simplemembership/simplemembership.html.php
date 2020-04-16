<?php 
if (!defined('_VALID_MOS') && !defined('_JEXEC')) die('Direct Access to ' . basename(__FILE__) .
   ' is not allowed.');
/**
 *
 * @package simpleMembership
 * @copyright Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Anton Getman(ljanton@mail.ru);
 * Homepage: http://www.ordasoft.com
 * @version: 5.5.0 FREE
 * @license GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007; see LICENSE.txt
 *
 */

jimport( 'joomla.plugin.helper' );
if (version_compare(JVERSION, '3.0.0', 'lt')) require_once ($mosConfig_absolute_path . 
  "/libraries/joomla/html/toolbar.php");
else jimport('joomla.html.toolbar');
if (version_compare(JVERSION, '3.0.0', 'lt')) require_once ($mosConfig_absolute_path .
 "/administrator/components/com_simplemembership/menubar_ext.php");
$GLOBALS['database'] = $database;
class HTML_simplemembership {
    function congretulation($option) {
        echo  JText::_("COM_SIMPLEMEMBERSHIP_ACCOUNT_ACTIVATED") ;
    }
    function front($option) {
        global $mosConfig_live_site;
        $imgpath = 'images';
        $imgpath = $mosConfig_live_site . '/components/' . $option . '/images/';
        $footer = "<div align=\"center\" style ='font-size:xx-small; font-weight: bold; valign:bottom;'>Powered by
                    <a href=\"http://www.ordasoft.com\">Ordasoft</a></div>";
        $link = JRoute::_("index.php?option=$option&task=invite_user");
        ?>
        <script language = "Javascript">
            /**
             * DHTML email validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
             * Credit : Yves Christian
             */
    
            function echeck(str) {
            
                var at="@"
                var dot="."
                var lat=str.indexOf(at)
                var lstr=str.length
                var ldot=str.indexOf(dot)
            
                if (str.indexOf(at)==-1){
                    alert("<?php echo  JText::_("COM_SIMPLEMEMBERSHIP_INVALID_E_MAIL") ; ?>")
                    return false
                }
            
                if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
                    alert("<?php echo  JText::_("COM_SIMPLEMEMBERSHIP_INVALID_E_MAIL")  ?>")
                    return false
                }
            
                if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
                    alert("<?php echo  JText::_("COM_SIMPLEMEMBERSHIP_INVALID_E_MAIL")  ?>")
                    return false
                }
            
                if (str.indexOf(at,(lat+1))!=-1){
                    alert("<?php echo  JText::_("COM_SIMPLEMEMBERSHIP_INVALID_E_MAIL")  ?>")
                    return false
                }
            
                if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
                    alert("<?php echo  JText::_("COM_SIMPLEMEMBERSHIP_INVALID_E_MAIL")  ?>")
                    return false
                }
            
                if (str.indexOf(dot,(lat+2))==-1){
                    alert("<?php echo  JText::_("COM_SIMPLEMEMBERSHIP_INVALID_E_MAIL")  ?>")
                    return false
                }
            
                if (str.indexOf(" ")!=-1){
                    alert("<?php echo  JText::_("COM_SIMPLEMEMBERSHIP_INVALID_E_MAIL")  ?>")
                    return false
                }
                return true
            }
    
            function ValidateForm(){
            
                var emailID=document.loginForm.email_box;
            
                if ((emailID.value==null)||(emailID.value=="")){
                    alert("<?php echo _NO_EMAIL ?>");
                    emailID.focus();
                    return false;
                }
                if (echeck(emailID.value)==false){
                    emailID.value="";
                    emailID.focus();
                    return false;
                }
            
                if(document.loginForm.password_box.value =='') {
                    alert("<?php echo _NO_PASS ?>");
                    return false;
                }
            
                var chks = document.getElementsByName('provider_box');
                var hasChecked = false;
                return true
             }
        </script>

        <style type="text/css">
            td.importin {
                border-left-width: 1px;
                border-right: 1px solid #D8D8D8;
                border-top-width: 1px;
                border-bottom:1px solid #D8D8D8;
                border-top:1px solid #D8D8D8;
                border-left: 1px solid #D8D8D8;
                text-align:left;
            }
            table.importin2 td.importin2 {
                background-color:#CCCCCC;
                border-left-width: 1px;
                border-right: 1px solid #333;
                border-top-width: 1px;
                border-bottom:1px solid #333;
                border-top:1px solid #333;
                border-left: 1px solid #333;
                text-align:left;
            }
        </style>
        <div align="center">
            <form action="<?php echo sefRelToAbs($link); ?>" method="POST"  name="loginForm"
             onSubmit="return ValidateForm()">
                <br  />&nbsp;
                <table border="0" align="center" cellpadding="2" cellspacing="0" width="550">
                    <tr>
                        <td colspan='3' bgcolor="#F2F2F2" align="center">
                            <b>
                                <font face="Arial" size="4" color="#333333">
                                    <div align="center"><?php 
                                      echo  JText::_("COM_SIMPLEMEMBERSHIP_INVATE_FRIENDS") ; ?>!<br />&nbsp;</div>
                                </font>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center" class="importin">
                            <font face="Arial" size="2" color="#333333" >
                                <div align="center"><br /><?php 
                                      echo  JText::_("COM_SIMPLEMEMBERSHIP_FOLLOW_INSTRUCTIONS") ; ?> &nbsp; </div>
                            </font>
                        </td>
                    </tr>
                    <tr valign="middle" height="40">
                        <td width="200"  class="importin"><?php 
                                      echo  JText::_("COM_SIMPLEMEMBERSHIP_USEREDIT_USERNAME") ; ?></td>
                        <td colspan="2"  class="importin">
                            <input class='thTextbox' type='text' name='email_box' value='' size="40">
                        </td>
                    </tr>
                    <tr  valign="middle" height="40px">
                        <td class="importin" ><?php 
                                      echo  JText::_("COM_SIMPLEMEMBERSHIP_USEREDIT_PASSWORD") ; ?></td>
                        <td colspan="2"  class="importin">
                            <input class='thTextbox' type='password' name='password_box' value='' size="40">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="importin"><?php 
                                      echo  JText::_("COM_SIMPLEMEMBERSHIP_SELECT_SERVICE") ; ?></td>
                        <td colspan="2" valign="top" class="importin">
                            <table width="270" border="0" cellspacing="5" cellpadding="5" class="importin2">
                                <tr>
                                    <td>
                                        <select class='thSelect' name='provider_box'>
                                            <option value=''></option>
                                            <option disabled><?php 
                                              echo  JText::_("COM_SIMPLEMEMBERSHIP_EMAIL_PROVIDERS") ; ?></option>
                                            <option value='gmail'>GMail</option>
                                            <option value='mail_ru'>Mail.ru</option>
                                            <option value='operamail'>OperaMail</option>
                                            <option value='yahoo'>Yahoo!</option>
                                            <option disabled>Social Networks</option>
                                            <option value='myspace'>MySpace</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                            <div align="center"><br />&nbsp;
                                <input type="submit" name="submit" value="Import My Contacts"/><br />&nbsp;<br />&nbsp;
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center"><small><?php 
                                              echo  JText::_("COM_SIMPLEMEMBERSHIP_NOT_STORE_PASSWORD") ; ?></small></td>
                    </tr>
                </table>
                <input type="hidden" name="option" value="<?php echo $option; ?>">
                <input type="hidden" name="task" value="fetch">
            </form>
        </div>
        <div align="center">
            <table>
                <tr>
                    <td><img src="<?php echo $imgpath; ?>/gmail.png" alt="Gmail" style="float:right" /></td>
                    <td><img src="<?php echo $imgpath; ?>/yahoo.png" alt="Yahoo" style="float:right" /></td>
                    <td><img src="<?php echo $imgpath; ?>/mail_ru.png" alt="mail_ru" style="float:right" /></td>
                    <td><img src="<?php echo $imgpath; ?>/operamail.png" alt="OperaMail" style="float:right" /></td>
                </tr>
                <tr>
                    <td colspan="5" align="center"><img src="<?php echo $imgpath; ?>/myspace.png" alt="MySpace" /></td>
                </tr>
            </table>
        </div>
        <?php
        //    echo $footer;
        
    }
    function display($option, $rows, $from_email, $name, $contents) {
        global $mainframe, $mosConfig_live_site, $my;
        $link = "index.php?option=$option";
        $total = count($rows);
        ?>
        <script language="javascript" src="<?php echo $mosConfig_live_site ?>/includes/js/joomla.javascript.js" type="text/javascript"></script>
        <script language="javascript" type="text/javascript">
            function checkall(thestate){
                var el_collection = document.forms['adminForm'].elements['cid[]'];
                for (var c=0;c<el_collection.length;c++)
                el_collection[c].checked=thestate
            }

            function  checkvalidate() {
                var chks = document.getElementsByName('cid[]');
                var hasChecked = false;
                alert('checkvalidate');
                for (var i = 0; i < chks.length; i++){
                    if (chks[i].checked){
                        hasChecked = true;
                        break;
                    }
                }
            
                if (hasChecked == false){
                    alert("No contacts was selected!");
                    return false;
                }
            
                if (document.adminForm.name.value == ''){
                    alert("Name not set up");
                    return false;
                }
            
                if (document.adminForm.msg.value == ''){
                    alert("Message is empty");
                    return false;
                }
                document.adminForm.submit();
            }
        </script>
        <form action="<?php echo sefRelToAbs($link); ?>" method="post" name="adminForm" id="adminForm"   >
            <style type="text/css">
                <!--
                td.importin {
                    border-left-width: 1px;
                    border-right: 1px solid #D8D8D8;
                    border-top-width: 1px;
                    border-bottom:1px solid #D8D8D8;
                    border-top:1px solid #D8D8D8;
                    text-align:left;
                    height:25px;
                }
                -->
            </style>
            <br  />&nbsp;
            <br  />&nbsp;
            <div align="center">
                <table  cellspacing='0' cellpadding='0' style="border: 1px solid #D8D8D8" width="550">
                    <tr>
                        <td colspan='3' bgcolor="#F2F2F2">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td bgcolor="#F2F2F2" height="27" width="30%">
                                        <p align="center">
                                            <font face="Arial" style="font-size: 9pt">
                                                &nbsp;
                                                <a href="javascript:checkall(true)"><?php 
                                              echo  JText::_("COM_SIMPLEMEMBERSHIP_CHECK_ALL") ; ?></a> &nbsp; | &nbsp;
                                                <a href="javascript:checkall(false)"><?php 
                                              echo  JText::_("COM_SIMPLEMEMBERSHIP_UNCHECK_ALL") ; ?></a> &nbsp;&nbsp;&nbsp;
                                            </font>
                                        </p>
                                    </td>
                                    <td bgcolor="#F2F2F2" height="27" width="70%">
                                        <b>
                                            <font face="Arial" size="2" color="#333333">
                                                <div  align="center"> Invite contacts </div>
                                            </font>
                                        </b>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="25" colspan="3">
                            <div align="center">
                                <table cellpadding="0" cellspacing="0" width="100%" id="table4"  
                                  style="border-top: 1px solid #D8D8D8; ">
                                    <?php
                                    for ($i = 0, $n = count($rows);$i < $n;$i++) {
                                        $row = $rows[$i];
                                    ?>
                                        <tr>
                                            <td width="17" bgcolor="#FFFFFF" class="importin">
                                                <?php
                                                echo $i;
                                                ?>
                                            </td>
                                            <td bgcolor="#FFFFFF" width="17" class="importin" >
                                                <font face="Arial" size="2" color="#333333" >
                                                <input type="checkbox"  name="cid[]" value="<?php 
                                                  echo $row->id; ?>" checked="checked"  />
                                                </font>
                                            </td>
                                            <td bgcolor="#FFFFFF" width="212" class="importin" 
                                              style="padding-left:5px; margin-left:5px;" >
                                                <font face="Arial" size="2" color="#333333">
                                                    <?php
                                                    echo $row->invitee_name;
                                                    ?>
                                                </font>
                                            </td>
                                            <td bgcolor="#FFFFFF" class="importin"
                                               style="padding-left:5px; margin-left:5px;">
                                                <font face="Arial" size="2" color="#333333">
                                                    <?php
                                                    echo $row->invitee_email;
                                                    ?>
                                                </font>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                <br />
                <table>
                    <tr>
                        <td><?php echo  JText::_("COM_SIMPLEMEMBERSHIP_ENTER_NAME")  ?> <br /></td>
                        <td>
                            <input type="text" name="name" value="<?php echo $name ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo  JText::_("COM_SIMPLEMEMBERSHIP_MESSAGE")  ?></td>
                            <?php
                            $invi_text = stripslashes($row->msg);
                            ?>
                            <br />&nbsp;
                        <td>
                            <textarea rows="15" cols="50" name="msg">
                            </textarea><br />&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td  colspan="2" >
                            <div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="button" value="Invite Friends" onclick="alert('AA');" />
                                <br />&nbsp;<br />&nbsp;
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="from_email" value="<?php echo $from_email; ?>" />
            <input type="hidden" name="default_mesg" value="<?php echo $row->msg; ?>" />
            <input type="hidden" name="task" value="invite" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
        </form>
        <?php
        //        echo $footer;
    } //dispLay
    
    
    static function advregister_form($olist, $preregister, $user_profile_form, $ToSLink, $user = null) {
        global $mainframe, $document, $mosConfig_live_site,$Itemid;
        JHtml::_('behavior.keepalive');
        JHtml::_('behavior.tooltip');
        JHtml::_('behavior.formvalidation');
        echo $preregister; ?>
        <form action="<?php echo sefRelToAbs("index.php?option=com_simplemembership"); ?>"
	       method="post" class="form-validate" id="member-registration" enctype="multipart/form-data">
            <?php //begin profile
            foreach($user_profile_form->getFieldsets() as $fieldset) {
                $fields = $user_profile_form->getFieldset($fieldset->name);
                if (count($fields)) { //print profile fields
                ?>
                    <fieldset>
                        <?php
                        if (isset($fieldset->label)) { ?>
                            <legend>
                                <?php
                                echo JText::_($fieldset->label);
                                ?>
                            </legend>
                            <dl>
                        <?php
                        }
                        foreach($fields as $field) {

                            if ($field->hidden) {
                                $field->input;
                            } else {
                                if (strpos($field->name,'[tos]') !== false) {
                                    if (empty($ToSLink[0]['register'])) continue;
                                    echo "<dt><a href='" . JRoute::_($ToSLink[0]['register']) .
                                            "' style='position:relative; top:24px; text-decoration: none; '>";
                                    echo $field->label . "</a>";
                                } else
                                    echo "<dt>" . $field->label;
                                ?>
                                </dt>
                                <dd>
                                    <?php echo $field->input; ?>
                                </dd>
                            <?php
                            }
                        } 
                        if ($fieldset->name == 'default' && $olist != "") {
                            ?>
                            <dt>
                                <label id="gid-lbl" for="gid" class="hasTip" 
                                  title="Group::Please select Member Group"><?php
                                     echo  JText::_("COM_SIMPLEMEMBERSHIP_MEMBERGROUP") ; ?>:</label>
                            </dt>
                            <dd>
                                <?php
                                echo $olist;
                                ?>
                            </dd>
                        <?php
                        }
                        ?>
                    </dl>
                  </fieldset>
                <?php
                }
            }
            ?>
            <div>
                <button onclick="check_form();" class="validate btn btn-info" type="submit"><?php
                                     echo  JText::_("COM_SIMPLEMEMBERSHIP_REGISTER") ; ?></button> 
                <span><?php echo  JText::_("COM_SIMPLEMEMBERSHIP_MARKED_WITH_AN_ASTERISK") ; ?></span>
                <input type="hidden" name="task" value="add_user">
            </div>
        </form>
        <?php
    }
    
    
    static function advregister_prolong($olist, $user) 
    {
        global $mainframe, $document, $mosConfig_live_site,$Itemid;
        JHtml::_('behavior.keepalive');
        JHtml::_('behavior.tooltip');
        JHtml::_('behavior.formvalidation');
        ?>
        <form action="<?php echo sefRelToAbs("index.php?option=com_simplemembership"); ?>" method="post">
            <label id="gid-lbl" for="gid" class="hasTip" title="Group::Please select Member Group"><?php 
            echo  JText::_("COM_SIMPLEMEMBERSHIP_SELECT_A_MEMBER_GROUP")  ; ?>:
            </label><br/>
            <?php echo $olist;?><br/>
            <input id="newGroup" type="submit" value="Register" />
            <!-- email -->
            <input type="hidden" name="email1" value="<?php echo $user[0]->email;?>">
            <input type="hidden" name="email2" value="<?php echo $user[0]->email;?>">
            <!-- name -->
            <input type="hidden" name="name" value="<?php echo $user[0]->name;?>">
            <input type="hidden" name="username" value="<?php echo $user[0]->username;?>">
            <!-- pass -->
            <input type="hidden" name="password1" value="<?php echo $user[0]->password;?>">
            <input type="hidden" name="password2" value="<?php echo $user[0]->password;?>">
            <input type="hidden" name="task" value="user_prolong">    
        </form>
    <?php
    }

    
    static function accdetail($rows, $olist, $option, $msg, $user_profile_form, $ToSLink) {
        global $Itemid, $mosConfig_live_site;
        JHTML::_('behavior.formvalidation');
        ?>
        <form    action="<?php echo sefRelToAbs("index.php?option=com_simplemembership&amp;Itemid=" . $Itemid); ?>"
             method="post" name="userForm" class="form-validate" id="member-profile" enctype="multipart/form-data">
            <?php
            foreach($user_profile_form->getFieldsets() as $fieldset) {
                $fields = $user_profile_form->getFieldset($fieldset->name);
                
                if (count($fields)) { //print profile fields
                    ?>
                    <fieldset>
                        <?php
                        if (isset($fieldset->label)) { ?>
                            <legend>
                                <?php
                                echo JText::_($fieldset->label); ?>
                            </legend>
                            <dl>
                        <?php
                        }
                        foreach($fields as $field) {
                            if ($field->hidden) {
                                $field->input;
                            } else {
                               
                                if ($field->id == 'profile_tos') {
                                    
                                    if (empty($ToSLink[0]['register'])) continue;

                                    echo "<dt class='tos_link'><a href='" . JRoute::_($ToSLink[0]['profile']) .
                                     "' style='position:relative; text-decoration: none; '>";
                                    echo JText::_($field->label) . "</a>";
                                } else
                                    echo "<dt>" . JText::_($field->label);
                                ?>
                                <dd>
                                <?php
                                if ($field->name == "email1") { ?>
                                    <dd>
                                        <input id="email1" name="email1" size="30" value="<?php 
                                          echo $rows->email; ?>"
                                          class="inputbox required validate-email" maxlength="100" type="text">
                                    </dd>
                                    <?php
                                } elseif ($field->name == "email2") { ?>
                                    <dd>
                                        <input id="email2" name="email2" size="30" value="<?php
                                           echo $rows->email; ?>"
                                           class="inputbox required validate-email" maxlength="100" type="text">
                                    </dd>
                                <?php

                                } else
                                    echo $field->input;
                                if ($field->name == 'profile[file]') {
                                    if ($user_profile_form->getValue('file', 'profile', '') !== '') { ?>
                                        <input type="button" value="DELETE"
                                                onclick="document.getElementById('profile_photo').style.display='none';
                                                            document.getElementById('file_path').value='';"/>
                                        <div id='profile_photo' style="display:block;max-width:500px;">
                                            <img src="<?php echo $mosConfig_live_site .
                                                 $user_profile_form->getValue('file', 'profile', '') ?>"
                                                  style="max-width:500px;">
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </dd>
                            <?php
                            }
                        }
                        if ($fieldset->name == 'default' && $olist != "") {
                        ?>
                            <dt>
                                <label id="gid-lbl" for="gid" class="hasTip" 
                                  title="Group::Please select Member Group"><?php 
                                          echo  JText::_("COM_SIMPLEMEMBERSHIP_MEMBERGROUP") ; ?>:</label>
                            </dt>
                            <dd>
                                <?php
                                echo $olist;
                                print_r($msg);
                                ?>
                            </dd>
                        <?php
                        }
                        ?>
                        </dl>
                    </fieldset>
                <?php
                }
            }
            ?>
            <div>
                <input type="hidden" id="file_path" name="file_path"
                        value="<?php echo $user_profile_form->getValue('file', 'profile', ''); ?>" />
                <button class="validate btn btn-info" type="submit"><?php
                   echo  JText::_("COM_SIMPLEMEMBERSHIP_UPDATE") ; ?></button>
                <span><?php echo  JText::_("COM_SIMPLEMEMBERSHIP_MARKED_WITH_AN_ASTERISK") ; ?></span>
                <input type="hidden" name="task" value="update_user">
            </div>
        </form>
        <?php
    }
    // Duplicate class from admin.simplemembership.php
    static function categoryArray() {
        global $database;
        // get a list of the menu items
        $query = "SELECT c.*, c.parent_id AS parent" . 
          "\n FROM #__categories c" .
          "\n WHERE section='com_simplemembership'" . 
          "\n AND published <> -2" . 
          "\n ORDER BY ordering";
        $database->setQuery($query);
        $items = $database->loadObjectList();
        // establish the hierarchy of the menu
        $children = array();
        // first pass - collect children
        foreach($items as $v) {
            $pt = $v->parent;
            $list = @$children[$pt] ? $children[$pt] : array();
            array_push($list, $v);
            $children[$pt] = $list;
        }
        // second pass - get an indent list of the items
        $array = mosTreeRecurse(0, '', array(), $children);
        return $array;
    }
    
    
    
    static function ShowUserProfile($user_profile_form, $fieldsets, $profile_image, $joom_user) {
        
        global $database, $my, $Itemid,$mosConfig_absolute_path,$mosConfig_live_site, $user_configuration;
        
        require_once(JPATH_SITE."/components/com_users/views/profile/view.html.php");
        
        if (version_compare(JVERSION, '3.0.0', 'lt')) {
            $menu = new mosMenu($database);
            $menu->load($Itemid);
            $params = new mosParameters($menu->params);
        } else {
            $menu = new JTableMenu($database);
            $menu->load($Itemid);
            $params = new JRegistry;
            $params->loadString($menu->params);
        }
        

        $params->def('pageclass_sfx', '');
        $query = "SELECT profile_value
                  FROM #__user_profiles
                  WHERE user_id = " . $joom_user->id . " AND profile_value !=''";
        $database->setQuery($query);
        if (version_compare(JVERSION, '3.0.0', 'ge')) {
            $MyData = $database->loadColumn();
        } else {
            $MyData = $database->loadResultArray();
        }
        
        // Load the fields helper
        JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
        // Gets the fields associated with the 'com_users.user' instance
        // Since we give an actual object instance (and not, for example, just the id), in returned $customFields there will be a 'value' property for every additional fields
        $customFields = FieldsHelper::getFields('com_users.user', $joom_user, true);
        // In my case there where only one additional field, so a took the 0-indexed value, you shall see in which index is the field you are searching for
        $customFieldsValue = false;
        
        foreach ($customFields as $customField){
            if($customField->value != ''){
                $customFieldsValue = true;
                break;
            }
        }

        ?>
        <div class="baseclas<?php echo $params->get('pageclass_sfx'); ?>">
            <table class='profileTable'>
                <tr>
                    <td colspan="2">
                        <?php
                        if (empty($_REQUEST['userId'])) {
                                $e = $my->id;
                            } else {
                                $e = $_REQUEST['userId'];
                            }
                            if ((count($MyData) < 2) && ($e == ($my->id)) && !$customFieldsValue) {
                            ?>
                                <p class="text"><?php echo  JText::_("COM_SIMPLEMEMBERSHIP_PROFILE_ENPTY") ;?></p>
                            <?php
                            }
                            ?>
                    </td>
                </tr>
                <tr>
                    <?php 
                    if ($profile_image != '') {
                        ?>
                        <td valign="top">
                            <img id="profileFoto" src="<?php echo $mosConfig_live_site .
                             $user_profile_form->getValue('file', 'profile', '') ?>">
                            <center>
                            <?php
                            if (empty($my->Name)) {
                                $MeUser = $my->id;
                            }
                            if ($MeUser == $joom_user->id) {
                                ?>
                                <a href='<?php 
                                  echo JRoute::_("index.php?option=com_simplemembership&Itemid=$Itemid&task=accdetail"); ?>'>
                                    <?php echo  JText::_("COM_SIMPLEMEMBERSHIP_EDIT_ACCOUNT")   ?>
                                </a>
                                <?php       
                            }
                            ?>
                            </center>
                        </td>
                        <?php
                    }else{
                        ?>
                        <td valign="top">
                            <img id="profileFoto" src="<?php echo $mosConfig_live_site .
                             '/components/com_simplemembership/images/default.gif' ?>">
                            <center>
                            <?php
                            if (empty($my->Name)) {
                                $MeUser = $my->id;
                            }
                            if ($MeUser == $joom_user->id) {
                                ?>
                                <a href='<?php 
                                  echo JRoute::_("index.php?option=com_simplemembership&Itemid=$Itemid&task=accdetail"); ?>'>
                                    <?php echo  JText::_("COM_SIMPLEMEMBERSHIP_EDIT_ACCOUNT")   ?>
                                </a>
                                <?php       
                            }
                            ?>
                            </center>
                        </td>
                        <?php
                    }

                    ?>

                    <td valign="top">
                        <?php
                        echo "<b>" .  JText::_("COM_SIMPLEMEMBERSHIP_PROFILE_NAME") ."</b>".
                          "<b>" .$joom_user->name ."</b>" . "<br>";
                        echo "<b>" .  JText::_("COM_SIMPLEMEMBERSHIP_PROFILE_USERNAME") ."</b>".
                          "<b>" .$joom_user->username . "</b>";
                        if(JPluginHelper::isEnabled('simplemembership','plg_simplemembership_user_messages') && $my->id != $joom_user->id){
                        //if($msg_plugin && $my->id != $joom_user->id){ ?>
                        
                            <form action="index.php?option=com_simplemembership&task=view_dialogue&interlocutor_id=<?php echo $joom_user->id; ?>" method="post" name="adminForm"  class=""  id="adminForm">
                                <br>
                                <button class="message_button btn batton" style="margin-top: -2px !important;"value="Write Message"> Write Message </button> 
                            </form>
                        <?php } ?>
                    </td>
                </tr>
            </table>
        </div>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />

        <?php
        $tab = JRequest::getVar('tab');
        $db = JFactory::getDBO();
        $query = 'SELECT * FROM #__extensions '.
          ' WHERE folder="simplemembership" and enabled=1  Order by ordering ';
        $db->setQuery($query);
        $info = $db->loadObjectList();
         ////Tabs/////////
        $doc =JFactory::getDocument(); 
        $doc->addStyleSheet( 'components/com_simplemembership/TABS/tabcontent.css' );
        $doc->addScript('components/com_simplemembership/TABS/tabcontent.js');

        ?>

        <ul id="countrytabs_s" class="shadetabs">

        <?php 
        $new_fieldsets = array();
        $allow_fieldsets = explode(',', $user_configuration["allow_fieldsets"]);
        
        if(count($allow_fieldsets) > 0){ 
            foreach($fieldsets as $fieldset){
                if($fieldset->name == 'profile'){?>
                    <li><a href="#" rel="country_profile"><?php echo  JText::_($fieldset->label) ; ?></a></li>
                <?php }
            }
        }
        
        //var_dump($fieldsets);
//        foreach($fieldsets as $fieldset){ 
//
//
//            if($fieldset->name == 'default') continue;
//
//            $allow_fieldsets = explode(',', $user_configuration["allow_fieldsets"]);
//            var_dump($allow_fieldsets);
//            //var_dump($fieldset->name);
//            if($fieldset->name != 'user_details' && $fieldset->name != 'settings' && $fieldset->name != 'actionlogs'){
//                $new_fieldsets[] = $fieldset;
//            }
//            
//            if(!in_array($fieldset->name, $allow_fieldsets)) continue;
//
//            $fields = $user_profile_form->getFieldset($fieldset->name); 
//            
//            if(!count($fields)) continue;

//            if(count($MyData) > 1 || $customFieldsValue){
//                ?>
                <!--<li><a href="#" rel="country_//<?php echo $fieldset->name; ?>"><?php echo  JText::_($fieldset->label) ; ?></a></li>-->
                <?php
//            }
//            ?>

        <?php //}; ?>

            <?php $i=4;

            foreach($info as $inf) {

                if ($tab == $inf->element) {
                    $display = 'selected';
                } else {
                    $display = '';
                }

                $tab_params = new JRegistry($inf->params);
                $tab_name = $tab_params->get('tab_name') ;

                if ($inf->element == "plg_simplemembership_get_vehicles" or 
                  $inf->element == "plg_simplemembership_get_vehicles") {?>
                    <li><a href="#" rel="country_s2"
                       onmouseup="setTimeout('vm_initialize2263893()',10)"><?php echo $tab_name . '</a></li>';
                } 
                elseif ($inf->element == "plg_simplemembership_get_houses" or 
                  $inf->element == "plg_simplemembership_get_houses") {?>
                    <li><a href="#" rel="country_s3"
                       onmouseup="setTimeout('initialize2123()',10)"> <?php echo $tab_name . '</a></li>';
                }
                elseif ($inf->element == "plg_simplemembership_get_cck_user_instances" or 
                  $inf->element == "plg_simplemembership_get_cck_user_instances") {?>
                    <li><a href="#" rel="country_cck"> <?php echo $tab_name . '</a></li>';
                }
                elseif ($inf->element == "plg_simplemembership_get_cck_user_instances2" or 
                  $inf->element == "plg_simplemembership_get_cck_user_instances2") {?>
                    <li><a href="#" rel="country_cck2"> <?php echo $tab_name . '</a></li>';
                }
                elseif ($inf->element == "plg_simplemembership_get_cck_user_instances3" or 
                  $inf->element == "plg_simplemembership_get_cck_user_instances3") {?>
                    <li><a href="#" rel="country_cck3"> <?php echo $tab_name . '</a></li>';
                }
                elseif ($inf->element == "plg_simplemembership_get_cck_user_instances4" or 
                  $inf->element == "plg_simplemembership_get_cck_user_instances4") {?>
                    <li><a href="#" rel="country_cck4"> <?php echo $tab_name . '</a></li>';
                }
                elseif ($inf->element == "plg_simplemembership_get_cck_user_instances5" or 
                  $inf->element == "plg_simplemembership_get_cck_user_instances5") {?>
                    <li><a href="#" rel="country_cck5"> <?php echo $tab_name . '</a></li>';
                }
                elseif ($inf->element == "plg_simplemembership_get_cck_user_instances6" or 
                  $inf->element == "plg_simplemembership_get_cck_user_instances6") {?>
                    <li><a href="#" rel="country_cck6"> <?php echo $tab_name . '</a></li>';
                }
                elseif ($inf->element == "plg_simplemembership_get_cck_user_instances7" or 
                  $inf->element == "plg_simplemembership_get_cck_user_instances7") {?>
                    <li><a href="#" rel="country_cck7"> <?php echo $tab_name . '</a></li>';
                }
                elseif ($inf->element == "plg_simplemembership_get_cck_user_instances8" or 
                  $inf->element == "plg_simplemembership_get_cck_user_instances8") {?>
                    <li><a href="#" rel="country_cck8"> <?php echo $tab_name . '</a></li>';
                }
                elseif ($inf->element == "plg_simplemembership_get_cck_user_instances9" or 
                  $inf->element == "plg_simplemembership_get_cck_user_instances9") {?>
                    <li><a href="#" rel="country_cck9"> <?php echo $tab_name . '</a></li>';
                }
                elseif ($inf->element == "plg_simplemembership_get_cck_user_instances10" or 
                  $inf->element == "plg_simplemembership_get_cck_user_instances10") {?>
                    <li><a href="#" rel="country_cck10"> <?php echo $tab_name . '</a></li>';
                }
                elseif ($inf->element == "plg_simplemembership_user_messages" or 
                  $inf->element == "plg_simplemembership_user_messages") {
                    if($my->id > 0 && $my->id == $joom_user->id){?>
                        <li><a href="#" rel="country_messages"> <?php echo $tab_name . '</a></li>';
                    }
                }
                else {
                    echo '<li><a href="#" rel="country_s' . $i . '">' . $tab_name . '</a></li>';
                    $i++;
                }
            }
            ?>
        </ul>

        
            <div style="clear:both"></div>
            <div id="country_profile" class="tabcontent">
                <div class="baseclas<?php echo $params->get('pageclass_sfx'); ?>"></div>
                <table class='profileTable zzz'>
                    <tr>
                        <td valign="top">
                            <?php
                            $customFieldsGroup = array();
                            foreach ($fieldsets as $key => $fieldset){
                                if($fieldset->name == 'profile'){
                                    $temp_fieldset = $fieldset;
                                    unset($fieldsets[$key]);
                                    array_unshift($fieldsets, $temp_fieldset);
                                }
                                if(stripos($fieldset->name, 'fields-') === 0){
                                    $customFieldsGroup[] = $fieldset;
                                    unset($fieldsets[$key]);
                                }
                            }

                            foreach($fieldsets as $fieldset){

                                if($fieldset->name == 'default' || $fieldset->name == 'user_details' || $fieldset->name == 'settings') continue;
            
                                $fields = $user_profile_form->getFieldset($fieldset->name); 
                                $allow_fieldsets = explode(',', $user_configuration["allow_fieldsets"]);
                                if(!in_array($fieldset->name, $allow_fieldsets)) continue;
                                if(!count($fields)) continue;
                                echo "<dt>" . JText::_($fieldset->label) . "</dt>";
                                foreach($fields as $field) {
                                    
                                    if ($field->hidden) {
                                    } else {
                                        if ($field->name != 'profile[file]' && $field->value !== '') { ?>
                                          <table>
                                              <tr>
                                                  <td width="130px" valign="top">
                                                        <?php echo $field->label; ?>
                                                  </td>
                                                  <td width="340px">
                                                        <?php 
                                                        if(!is_array($field->value)){
                                                            if($field->type == 'Url'){
                                                                echo '<a href="';
                                                            }
                                                            echo $field->value;
                                                            if($field->type == 'Url'){
                                                                echo '">'.$field->value.'</a>';
                                                            }
                                                        }else{
                                                            echo '<table>';
                                                            foreach($field->value as $val){
                                                                echo '<tr><td>';
                                                                echo $val;
                                                                echo '</tr></td>';
                                                            }
                                                            echo '</table>';
                                                        }?>
                                                  </td>
                                              </tr>
                                          </table>
                                        <?php
                                        }
                                    }
                                }
                            }
                            
                            foreach ($customFieldsGroup as $fieldset) { 

                            $allow_fieldsets = explode(',', $user_configuration["allow_fieldsets"]);
                            if(!in_array($fieldset->name, $allow_fieldsets)) continue;
                            
                            $group = $fieldset->name;
                            $group_id = substr($group, (strrpos($group, '-')+1));
                            $fields = $customFields;

                            $isset_group_value = false;
                            foreach ($fields as $field){
                                if($field->group_id == $group_id && $field->value != ''){
                                    $isset_group_value = true;
                                    break;
                                }
                            }
                            
                            if (count($fields) && $isset_group_value) { ?>
                                    <div id="users-profile-custom-<?php echo $group; ?>" class="users-profile-custom-<?php echo $group; ?>">
                                            <?php if (isset($fieldset->label) && ($legend = trim(JText::_($fieldset->label))) !== '') : ?>
                                                    <legend><?php echo $legend; ?></legend>
                                            <?php endif; ?>
                                            <?php if (isset($fieldset->description) && trim($fieldset->description)) : ?>
                                                    <p><?php echo JText::_($fieldset->description); ?></p>
                                            <?php endif; ?>
                                            <dl class="dl-horizontal">
                                                    <?php foreach ($fields as $field) { 
                                                    //if($field->type = 'sql' ;var_dump($field);
                                                        ?>
                                                            <?php if ((!isset($field->hidden) ||!$field->hidden) && $field->type !== 'Spacer' && $field->group_id == $group_id && $field->value && $field->value != '') { ?>
                                                                    <dt>
                                                                            <?php echo $field->title; ?>
                                                                    </dt>
                                                                    <dd>
                                                                            <?php 
                                                                            echo ($field->value && $field->value != '') ? $field->value : JText::_('COM_USERS_PROFILE_VALUE_NOT_FOUND'); ?>
                                                                            
                                                                    </dd>
                                                            <?php } ?>
                                                    <?php } ?>
                                            </dl>
                                    </div>
                            <?php } 
                            
                            } ?>
                            
                        </td>
                    </tr>
                </table>
            </div>
        <?php //} ?>

        <?php
        
        $_SESSION['sms_user'] = $joom_user->name;
        $i = 4;
        foreach($info as $inf) {

            // print_r($inf);

            if ($inf->element == "plg_simplemembership_get_vehicles" or 
              $inf->element == "plg_simplemembership_get_vehicles") { ?>
                <div id="country_s2" class="tabcontent">
                <?php
                //select in router
                unset($GLOBALS['select_com']);  
                $GLOBALS['select_com'] = 'com_vehiclemanager';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
           }elseif ($inf->element == "plg_simplemembership_get_houses" or
             $inf->element == "plg_simplemembership_get_houses") {
                echo '<div id="country_s3" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
            }elseif ($inf->element == "plg_simplemembership_get_cck_user_instances" or
             $inf->element == "plg_simplemembership_get_cck_user_instances") {
                echo '<div id="country_cck" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
            }
            elseif ($inf->element == "plg_simplemembership_get_cck_user_instances2" or
             $inf->element == "plg_simplemembership_get_cck_user_instances2") {
                echo '<div id="country_cck2" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
            }elseif ($inf->element == "plg_simplemembership_get_cck_user_instances3" or
             $inf->element == "plg_simplemembership_get_cck_user_instances3") {
                echo '<div id="country_cck3" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
            }elseif ($inf->element == "plg_simplemembership_get_cck_user_instances4" or
             $inf->element == "plg_simplemembership_get_cck_user_instances4") {
                echo '<div id="country_cck4" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
            }elseif ($inf->element == "plg_simplemembership_get_cck_user_instances5" or
             $inf->element == "plg_simplemembership_get_cck_user_instances5") {
                echo '<div id="country_cck5" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
            }elseif ($inf->element == "plg_simplemembership_get_cck_user_instances6" or
             $inf->element == "plg_simplemembership_get_cck_user_instances6") {
                echo '<div id="country_cck6" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
            }elseif ($inf->element == "plg_simplemembership_get_cck_user_instances7" or
             $inf->element == "plg_simplemembership_get_cck_user_instances7") {
                echo '<div id="country_cck7" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
            }elseif ($inf->element == "plg_simplemembership_get_cck_user_instances8" or
             $inf->element == "plg_simplemembership_get_cck_user_instances8") {
                echo '<div id="country_cck8" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
            }elseif ($inf->element == "plg_simplemembership_get_cck_user_instances9" or
             $inf->element == "plg_simplemembership_get_cck_user_instances9") {
                echo '<div id="country_cck9" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
            }elseif ($inf->element == "plg_simplemembership_get_cck_user_instances10" or
             $inf->element == "plg_simplemembership_get_cck_user_instances10") {
                echo '<div id="country_cck10" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
            }elseif ($inf->element == "plg_simplemembership_user_messages" or
             $inf->element == "plg_simplemembership_user_messages") {
                echo '<div id="country_messages" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
            }else {
                
                echo '<div id="country_s' . $i . '" class="tabcontent">';
                require_once (JPATH_SITE . DS . 'plugins' . DS . 'simplemembership' .
                   DS . $inf->element . DS . $inf->element . '.php');
                echo '</div>';
                $i++;
            }
        }
        $moduleclass_sfx78 = $params->get('moduleclass_sfx78', '');
        echo $moduleclass_sfx78;


        ?>        
        </div>


        <script type="text/javascript">
            var countries = new ddtabcontent("countrytabs_s")
            countries.setpersist(true)
            countries.setselectedClassTarget("link") //"link" or "linkparent"
            countries.init()
        </script>
    <?php
    }
  
    function buyGroup($pr_lis, $userREquest){
        global $database, $my, $user_configuration, $mosConfig_absolute_path;

        $acl = JFactory::getACL();
        switch($pr_lis[0]->expire_units){
            case 'W':
                $units =  JText::_("COM_SIMPLEMEMBERSHIP_WEEK_S")  ;
                break;
            case 'M':
                $units =  JText::_("COM_SIMPLEMEMBERSHIP_MONTH_S") ;
                break;
            case 'Y':
                $units =  JText::_("COM_SIMPLEMEMBERSHIP_YEAR_S") ;
                break;
            default:
                $units =  JText::_("COM_SIMPLEMEMBERSHIP_DAY_S") ;
                break;
        }
        echo  JText::_("COM_SIMPLEMEMBERSHIP_GROUP_BUY_SUBSC") .$pr_lis[0]->name;
        ?><br/>
        <?php
        if($pr_lis[0]->expire_range != '0') echo  JText::_("COM_SIMPLEMEMBERSHIP_GROUP_BUY_SUBSC2") .$pr_lis[0]->expire_range.' '.$units;
        ?>
        <?php
        echo  JText::_("COM_SIMPLEMEMBERSHIP_GROUP_BUY_PRICE") .$pr_lis[0]->price . " " .$pr_lis[0]->currency_code;
        ?><br/>
        <br/>
        <?php
        if($pr_lis[0]->price == '0') return;
        echo  JText::_("COM_SIMPLEMEMBERSHIP_GROUP_BUY_DESC") ;
        ?>
        <br>
        <?php

       
    }
    
    function UsersList($list, $pageNav, $UsOnline, $UsOffline, $group_desc) {
        global $Itemid, $database;
        global $mosConfig_live_site;
        if (version_compare(JVERSION, '3.0', 'ge')) {
            $menu = new JTableMenu($database);
            $menu->load($Itemid);
            $params = new JRegistry;
            $params->loadString($menu->params);
        } else {
            $menu = new mosMenu($database);
            $menu->load($GLOBALS['Itemid']);
            $params = new mosParameters($menu->params);
            $params->def('pageclass_sfx', '');
        }
        $layout = $params->get('userslayout', 'default');
        ?>
        <div class="baseclas<?php echo $params->get('pageclass_sfx'); ?>">
            <?php if(count($group_desc) == 1){ ?>
            <div class="UserList_group_name">
                <h5><?php echo $group_desc[0]->name; ?></h5>
            </div>
            <div class="UserList_group_desc">
                <?php echo $group_desc[0]->description; ?>
            </div>
            <?php } 
            if($layout == 'list'){ ?>
                <table class='UserListtable'>
                    <tr><td colspan='3'><b> <?php echo $pageNav->total. " ".
                        JText::_("COM_SIMPLEMEMBERSHIP_REGISTERED_USERS")  ; ?> ! </b> </td></tr>
                    <tr><td> # </td><td> <?php echo   JText::_("COM_SIMPLEMEMBERSHIP_LABEL_USER")  ; ?>  </td><td> <?php
                     echo   JText::_("COM_SIMPLEMEMBERSHIP_ONLINE_STATUS")  ; ?>: </td><td> <?php
                     echo   JText::_("COM_SIMPLEMEMBERSHIP_LAST_ONLINE")  ; ?>: </td></tr>
                    <?php
                    $i = $pageNav->limitstart;
                    if (count($list) > 0) foreach($list as $user) {
                        $i++;
                        ?>
                        <tr>
                            <td> 
                                <?php echo " $i "; ?> 
                            </td>
                            <td>
                                <a href='<?php
                                 echo JRoute::_("index.php?option=com_simplemembership&Itemid=$Itemid&task=showUsersProfile&userId=".
                                  $user->id);?>'><?php echo $user->name; ?> </a> 
                            </td>
                            <td>
                                <?php 
                                $rr = $user->id;
                                if (in_array($rr, $UsOnline[0])) { ?>
                                    <p class="online"><img src='<?php
                                       echo $mosConfig_live_site; ?>/components/com_simplemembership/images/login.png'>
                                    <?php
                                       echo  JText::_("COM_SIMPLEMEMBERSHIP_ONLINE") ; ?>
                                    </p>
                                    <?php
                                } else { ?> 
                                    <p class="offline"><img src='<?php
                                      echo $mosConfig_live_site; ?>/components/com_simplemembership/images/logout.png'>
                                    <?php
                                       echo  JText::_("COM_SIMPLEMEMBERSHIP_OFFLINE") ; ?>
                                    </p> <?php
                                }            
                                ?>
                            </td>
                            <?php
                            if (($user->lastvisitDate) != "0000-00-00 00:00:00") {
                                echo "<td> " .JHtml::_('date', $user->lastvisitDate, 'Y-m-d H:i:s') . " </td>
                        </tr>";
                            } else {
                                echo "<td>  <Font size='-2'> ". JText::_("COM_SIMPLEMEMBERSHIP_NONE") ." </font> </td>
                        </tr>";
                            }
                    }
                    ?>
                </table>
            <?php } elseif($layout == 'default') { ?>
                <div  class="users_list_wrap">
                <?php
                    foreach($list as $user) {   
                        //var_dump($user);
                        ?>  
                        <div class="users_list">
                            <img src="<?php echo JURI::root() . $user->prof_img;?>" class="prof_img"><br>
                            <a class="user_text" href="<?php echo sefRelToAbs('index.php?option=com_simplemembership&Itemid='.
                                $Itemid.'&task=showUsersProfile&userId='.$user->id.''); ?>">
                            <?php  echo $user->name; ?>
                            </a>
                        </div>
                        <?php 
                    }
                    ?>
                </div>
            <?php }?>
        </div>    
        <?php 
        if($pageNav){
            echo '<div class="sms_page_links">' . $pageNav->getPagesLinks() . '</div>';
        }
    }
}
?>
