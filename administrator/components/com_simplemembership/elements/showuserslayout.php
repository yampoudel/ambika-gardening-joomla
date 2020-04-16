 <?php
defined('_JEXEC') or die('Restricted access');
/**
 *
 * @package simpleMembership
 * @copyright Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Anton Getman(ljanton@mail.ru);
 * Homepage: http://www.ordasoft.com
 * @version: 5.5.0 FREE
 * @license GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007; see LICENSE.txt
 *
 */
 class JFormFieldShowuserslayout extends JFormField{
  protected $type = 'showuserslayout';
  protected function getInput(){
    $database = JFactory::getDBO();
    $menuId = 0;
    if(JRequest::getVar('id') != '') {
      $database->setQuery("SELECT `params` FROM `#__menu` WHERE `id` = ".JRequest::getVar('id'));
      $params = json_decode($database->loadResult());
    }
    if(JRequest::getVar('view') == 'module'){
      $mod_row =  JTable::getInstance ( 'Module', 'JTable' );//load module tables and params
      if (! $mod_row->load ( JRequest::getVar('id') )) {
          JError::raiseError ( 500, $mod_row->getError () );
      }
      //module params
      if (version_compare(JVERSION, '3.0', 'ge')) {
          $params = new JRegistry;
          $params->loadString($mod_row->params);
      } else {
          $params = new JRegistry($mod_row->params);
      }//end
      $params->show_users_group = $params->get('show_users_group');
    }
    $groups = array();
    $query = "SELECT name ,id 
              FROM #__simplemembership_groups AS sm_group
              WHERE sm_group.published='1'";
    $database->setQuery($query);
    $groups = $database->loadObjectList();
    $options = array();
    foreach ($groups as $item) 
      $options[] = JHtml::_('select.option', $item->id, $item->name);
    return JHTML::_('select.genericlist',$options, $this->name,
                        'size="" multiple="multiple" class="inputbox" ',
                        'value', 'text',(isset($params->show_users_group))?$params->show_users_group:'');
  }
} 

 class JFormFieldViewlayout extends JFormField{
  protected $type = 'viewlayout';
  protected function getInput(){
    $options = Array();
    $options[] = JHtml::_('select.option', 'default', 'Default');
    $options[] = JHtml::_('select.option', "list", "List");
    
    return  JHtml::_('select.genericlist', $options, $this->name, 'class="inputbox"', 'value', 'text', $this->value, $this->id);
  }
} 