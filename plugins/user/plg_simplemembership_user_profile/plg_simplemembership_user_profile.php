<?php
/**
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.utilities.date');

/**
 * An example custom profile plugin.
 *
 * @package		Joomla.Plugin
 * @subpackage	User.profile
 * @version		5.0.0 FREE
 */
class plgUserplg_simplemembership_user_profile extends JPlugin
{
  /**
   * Constructor
   *
   * @access      protected
   * @param       object  $subject The object to observe
   * @param       array   $config  An array that holds the plugin configuration
   * @since       3.0 FREE
   */
  public function __construct(& $subject, $config)
  {
    parent::__construct($subject, $config);
    $this->loadLanguage();
  }

  /**
   * @param	string	$context	The context for the data
   * @param	int		$data		The user id
   * @param	object
   *
   * @return	boolean
   * @since	3.0 FREE
   */
  function onContentPrepareData($context, $data)
  {
 //         echo "plgUserplg_simplemembership_user_profile onContentPrepareData"; exit;

    // Check we are manipulating a valid form.
    if (!in_array($context, array('com_users.profile', 'com_users.user',
       'com_users.registration', 'com_admin.profile', 'com_users.module'))) {
      return true;
    }

    if (is_object($data))
    {
      $userId = isset($data->id) ? $data->id : 0;

      if (!isset($data->profile) and $userId > 0) {

        // Load the profile data from the database.
        $db = JFactory::getDbo();
        $db->setQuery(
          'SELECT profile_key, profile_value FROM #__user_profiles' .
          ' WHERE user_id = '.(int) $userId." AND profile_key LIKE 'profile.%'" .
          ' ORDER BY ordering'
        );
        $results = $db->loadRowList();
        // Check for a database error.
        if ($db->getErrorNum())
        {
          $this->_subject->setError($db->getErrorMsg());
          return false;
        }

        // Merge the profile data.
        $data->profile = array();

        JForm::addFormPath(dirname(__FILE__).'/profiles');
        $form = JForm::getInstance('plg_simplemembership_user_profile.form', 'profile');
        foreach ($results as $v)
        {

          if(isset($v[1]) && !empty($v[1]) && is_string($v[1])  ){
            if(strpos($v[1], '"') === 0){
              $v[1] = substr($v[1], 1);
            }
            if(strpos($v[1], '"',strlen($v[1])-1) == strlen($v[1])-1){
              $v[1] = substr($v[1], 0,strlen($v[1])-1);
            }
          }
          $k = str_replace('profile.', '', $v[0]);
          if (@$form->getField($k, 'profile')->multiple)
          {
            $data->profile[$k] = json_decode($v[1], true);
          }
          else
          {
            $data->profile[$k] = $v[1];
          }
        }
      }

      if (!JHtml::isRegistered('users.url')) {
        JHtml::register('users.url', array(__CLASS__, 'url'));
      }
      if (!JHtml::isRegistered('users.calendar')) {
        JHtml::register('users.calendar', array(__CLASS__, 'calendar'));
      }
      if (!JHtml::isRegistered('users.tos')) {
        JHtml::register('users.tos', array(__CLASS__, 'tos'));
      }
    }

    return true;
  }
  function TermsOfService()
  {
    $ret['register'] = $this->params->get('register-require_tos_link');
    $ret['profile'] = $this->params->get('profile-require_tos_link');
    $ret['module'] = $this->params->get('module-require_tos_link');

    return $ret;
  }
  public static function url($value)
  {
    if (empty($value))
    {
      return JHtml::_('users.value', $value);
    }
    else
    {
      $value = htmlspecialchars($value);
      if(substr ($value, 0, 4) == "http") {
        return '<a href="'.$value.'">'.$value.'</a>';
      }
      else {
        return '<a href="http://'.$value.'">'.$value.'</a>';
      }
    }
  }

  public static function calendar($value)
  {
    if (empty($value)) {
      return JHtml::_('users.value', $value);
    } else {
      return JHtml::_('date', $value, null, null);
    }
  }

  public static function tos($value)
  {
    if ($value) {
      return JText::_('JYES');
    }
    else {
      return JText::_('JNO');
    }
  }

  /**
   * @param	JForm	$form	The form to be altered.
   * @param	array	$data	The associated data for the form.
   *
   * @return	boolean
   * @since	3.0 FREE
   */
  function onContentPrepareForm($form, $data)
  {
    
//          echo "plgUserplg_simplemembership_user_profile onContentPrepareData"; exit;
    
    if (!($form instanceof JForm))
    {
      $this->_subject->setError('JERROR_NOT_A_FORM');
      return false;
    }

    // Check we are manipulating a valid form.
    $name = $form->getName();
    if (!in_array($name, array('com_admin.profile', 'com_users.user', 'com_users.profile',
       'com_users.registration','com_users.module'))) {
      return true;
    }

    // Add the registration fields to the form.
    JForm::addFormPath(dirname(__FILE__).'/profiles');
    $form->loadFile('profile', false);
    $fields=array();
    foreach($form->getFieldset('profile') as $field){
      $fields[]=str_replace('profile[','',(str_replace(']','',$field->name)));
    }
     $fields = array(
      'address1',
      'address2',
      'city',
      'region',
      'country',
      'postal_code',
      'phone',
      'paypal_email',
      'website',
      'favoritebook',
      'aboutme',
      'tos',
      'dob',
      'file'
    );

    foreach ($fields as $field) {
      // Case using the users manager in admin
      if ($name == 'com_users.user') {
        // Remove the field if it is disabled in registration and profile
        if ($this->params->get('register-require_' . $field, 1) == 0 &&
          $this->params->get('profile-require_' . $field, 1) == 0) {
          $form->removeField($field, 'profile');
        }
      }
      if ($name == 'com_users.module') {
        // Remove the field if it is disabled in registration and profile
        if ($this->params->get('module-require_' . $field, 1) == 0) {
          $form->removeField($field, 'profile');
        }
      }


      // Case registration
      elseif ($name == 'com_users.registration') {
        // Toggle whether the field is required.
        if ($this->params->get('register-require_' . $field, 1) > 0) {
          $form->setFieldAttribute($field, 'required',
            ($this->params->get('register-require_' . $field) == 2) ? 'required' : '', 'profile');
        }
        else {
          $form->removeField($field, 'profile');
        }
      }
      // Case profile in site or admin
      elseif ($name == 'com_users.profile' || $name == 'com_admin.profile') {
        // Toggle whether the field is required.
        if ($this->params->get('profile-require_' . $field, 1) > 0) {
          $form->setFieldAttribute($field, 'required',
            ($this->params->get('profile-require_' . $field) == 2) ? 'required' : '', 'profile');
        }
        else {
          $form->removeField($field, 'profile');
        }
      }
    }

    return true;
  }


  /**
   * Method is called before user data is stored in the database
   *
   * @param   array    $user   Holds the old user data.
   * @param   boolean  $isnew  True if a new user is stored.
   * @param   array    $data   Holds the new user data.
   *
   * @return    boolean
   *
   * @since   3.1
   * @throws    InvalidArgumentException on invalid date.
   */
  public function onUserBeforeSave($user, $isnew, $data)
  {
          //print_r($data);
          //echo "plgUserplg_simplemembership_user_profile onUserBeforeSave"; exit;

    // Check that the date is valid.
    if (!empty($data['profile']['dob']))
    {
      try
      {
        $date = new JDate($data['profile']['dob']);
        $this->date = $date->format('Y-m-d H:i:s');
      }
      catch (Exception $e)
      {
        // Throw an exception if date is not valid.
        throw new InvalidArgumentException(JText::_('PLG_USER_SIMPLEMEMBERSHIP_ERROR_INVALID_DOB'));
      }
      if (JDate::getInstance('now') < $date)
      {
        // Throw an exception if dob is greather than now.
        throw new InvalidArgumentException(JText::_('PLG_USER_SIMPLEMEMBERSHIP_ERROR_INVALID_DOB'));
      }
    }
    // Check that the tos is checked if required ie only in registration from frontend.
    $task       = JFactory::getApplication()->input->getCmd('task');
    $option     = JFactory::getApplication()->input->getCmd('option');
    $tosarticle = $this->params->get('register_tos_article');
    $tosenabled = ($this->params->get('register-require_tos', 0) == 2) ? true : false;
    if (($task == 'register') && ($tosenabled) && ($tosarticle) && ($option == 'com_user'))
    {
      // Check that the tos is checked.
      if ((!($data['profile']['tos'])))
      {
        throw new InvalidArgumentException(JText::_('PLG_USER_SIMPLEMEMBERSHIP_FIELD_TOS_DESC_SITE'));
      }
    }

    return true;
  }



  function onUserAfterSave($data, $isNew, $result, $error)
  {
    
    
  //add save file
   
  if(isset($_FILES['jform']['tmp_name']["profile"]['file']) 
      && $_FILES['jform']['tmp_name']["profile"]['file']!==''){
  
    $file_for_value='/images/'.time().'_user_'.$data['id'].'-'.$_FILES['jform']['name']["profile"]['file'];
    $file=JPATH_SITE.$file_for_value;
    move_uploaded_file($_FILES['jform']['tmp_name']["profile"]['file'], $file);
    $data['profile']['file']=$file_for_value;
  }
  else {

    if(isset($_FILES['profile']['tmp_name']['file']) 
        && $_FILES['profile']['tmp_name']['file']!==''){
    
      $file_for_value='/images/'.time().'_user_'.$data['id'].'-'.$_FILES['profile']['name']['file'];
      $file=JPATH_SITE.$file_for_value;
      move_uploaded_file($_FILES['profile']['tmp_name']['file'], $file);
      $data['profile']['file']=$file_for_value;

    }
    else {
     if( isset($data['profile'] ) && 
      ( !isset($data['profile']['file']) || $data['profile']['file']=="") )
         $data['profile']['file']=(JRequest::getVar('file_path')) ? JRequest::getVar('file_path') :
       '/components/com_simplemembership/images/default.gif';
    }
  }
  //end add save file
    $userId	= JArrayHelper::getValue($data, 'id', 0, 'int');

    if ($userId && $result && isset($data['profile']) && (count($data['profile'])))
    {
      try
      {
        //Sanitize the date
        if (!empty($data['profile']['dob'])) {
          $date = new JDate($data['profile']['dob']);
          $data['profile']['dob'] = $date->format('Y-m-d');
        }

        $db = JFactory::getDbo();
        $db->setQuery(
          'DELETE FROM #__user_profiles WHERE user_id = '.$userId .
          " AND profile_key LIKE 'profile.%'"
        );

        if (!$db->query()) {
          throw new Exception($db->getErrorMsg());
        }

        $tuples = array();
        $order	= 1;

        JForm::addFormPath(dirname(__FILE__).'/profiles');
        $form = JForm::getInstance('plg_simplemembership_user_profile.form', 'profile');
        foreach ($data['profile'] as $k => $v)
        {
          if ($form->getField($k, 'profile')->multiple)
          {
            $tuples[] = '('.$userId.', '.$db->quote('profile.'.$k).', '.$db->quote(json_encode($v)).', '.$order++.')';
          }
          else
          {
            $tuples[] = '('.$userId.', '.$db->quote('profile.'.$k).', '.$db->quote($v).', '.$order++.')';
          }
        }

        $db->setQuery('INSERT INTO #__user_profiles VALUES '.implode(', ', $tuples));

        if (!$db->query()) {
          throw new Exception($db->getErrorMsg());
        }

      }
      catch (JException $e)
      {
        $this->_subject->setError($e->getMessage());
        return false;
      }
    }
        //print_r($data);
        //echo "plgUserplg_simplemembership_user_profile onUserAfterSave 2"; exit;
    
    return true;
  }

  /**
   * Remove all user profile information for the given user ID
   *
   * Method is called after user data is deleted from the database
   *
   * @param	array		$user		Holds the user data
   * @param	boolean		$success	True if user was succesfully stored in the database
   * @param	string		$msg		Message
   */
  function onUserAfterDelete($user, $success, $msg)
  {
    if (!$success) {
      return false;
    }

    $userId	= JArrayHelper::getValue($user, 'id', 0, 'int');

    if ($userId)
    {
      try
      {
        $db = JFactory::getDbo();
        $db->setQuery(
          'DELETE FROM #__user_profiles WHERE user_id = '.$userId .
          " AND profile_key LIKE 'profile.%'"
        );

        if (!$db->query()) {
          throw new Exception($db->getErrorMsg());
        }
      }
      catch (JException $e)
      {
        $this->_subject->setError($e->getMessage());
        return false;
      }
    }

    return true;
  }
}
