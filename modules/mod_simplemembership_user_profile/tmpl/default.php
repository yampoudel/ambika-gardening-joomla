<?php
if (!defined('_VALID_MOS') && !defined('_JEXEC')) die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
/**
*
* @package simpleMembership
* @copyright Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru);
* Homepage: http://www.ordasoft.com
* Updated on January, 2019
* @license GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007; see LICENSE.txt
*/
?>
    <script type="text/javascript">

    /* for hide label */
    
  
          if (window.jQuery) {

            jQuery(document).ready(function () {

                jQuery("#mod_simple_membership_user_profile label").removeClass('hasTooltip').attr('data-original-title', '');

            });


          }

    </script>

  <div id="mod_simple_membership_user_profile">
    <?php
    $joom_user = new JUser();
    $joom_user->load($user_id);
    $dispatcher = JDispatcher::getInstance();
    JPluginHelper::importPlugin('user');
    JForm::addFormPath($mosConfig_absolute_path.'/components/com_simplemembership/forms');
    JModuleHelper::getModule('mod_simplemembership_user_profile');
    $user_profile_form = JForm::getInstance('com_users.module', 'registration');
    $results2 = $dispatcher->trigger('onContentPrepareData', array('com_users.module', $joom_user));
    $results = $dispatcher->trigger('onContentPrepareForm', array($user_profile_form, $joom_user));
    $user_profile_form->bind($joom_user);
    $fields=$user_profile_form->getFieldset('profile');
    $profile_image=$user_profile_form->getValue('file','profile','');
    //var_dump($params->get('image_size'));exit;
    if($view_vh == 0){ ?>
      <table class="profileTable">
      <?php 
      if(isset($fields['profile_file'])){
          if($profile_image !=''){?>
            <tr>
            <td colspan="2">
                <img src="<?php echo JURI::base().$user_profile_form->getValue('file','profile','')?>" class="ver-<?php echo $params->get('image_size'); ?>">
            </td>
            </tr>
          <?php
          }else{
            ?>
            <tr>
              <td colspan="2">
                <img src="<?php echo $mosConfig_live_site . '/components/com_simplemembership/images/default.gif' ?>" class="ver-<?php echo $params->get('image_size'); ?>">
              </td>
            </tr>
          <?php
          }
      }
      ?>
        <tr>
        <td colspan="2">
   <?php if ($user_id != $my->id) { ?>
            <a href="<?php echo JRoute::_('index.php?option=com_simplemembership&Itemid='.
             $Itemid_simp.'&task=showUsersProfile&userId='.$user_id.''); ?>" >
            <?php echo "<b>" . $joom_user->name . "</b>"; ?></a>
  <?php  } else { ?>
          <a href="<?php echo JRoute::_('index.php?option=com_simplemembership&view='.
            'my_account&layout=myaccount&Itemid='.$Itemid_simp.''); ?>" >
            <?php echo "<b>" . $joom_user->name . "</b>"; ?></a>
  <?php  } ?>
        </td>
        </tr>
    <?php 

      foreach($fields as $field){
        //        if($field->hidden) {
//          //non
//        }
        if(!$params->get($field->id)) {
          //non
          
        }
        else{
          if($field->name != 'profile[file]' && $field->value !==''){
            ?>
            <tr>
            <td>
              <?php
              echo $field->label; ?>
            </td>
            <td>
              <?php
                if($field->type != 'Url'){
                    echo $field->value;
                }else{
                    echo '<a href="'.$field->value.'">'.$field->value.'</a>';
                }
              ?>
            </td>
            </tr>
          <?php
          }
        }
      }?>
      </table>
      <?php
    }
    else if($view_vh == 1){?>
      
      
      <?php
      if($profile_image !=''){?>
        <div class="module-profile-image">
          <img src="<?php echo $mosConfig_live_site.$user_profile_form->getValue('file','profile','')?>" class="hor-<?php echo $params->get('image_size'); ?>">
        </div>
      <?php
      }?>
      <div class="module-profile-textfield-wrap">
        <div class="module-user-name">
          <?php echo "<b>".$joom_user->name."</b>";?>
        </div>
          <div class="module-field-bottom-wrap">
      <?php
      foreach($fields as $field){
        if(!$params->get($field->id)) {
          //non
          
        }
//        if($field->hidden) {
//          //non
//        }
        else{
          if($field->name != 'profile[file]' && $field->value !==''){
            ?>
            <div class="module-field-wrap"><div>
              <?php
              echo $field->label; ?>
            </div>
            <div>
              <?php
                if($field->type != 'Url'){
                    echo $field->value;
                  }else{
                      echo '<a href="'.$field->value.'">'.$field->value.'</a>';
                  }
              ?>
            </div></div>
          <?php
          }
        }
      }
      ?>
      </div>  
      </div>
    <?php
    }
    ?>
  </div>
