<?php
defined('_JEXEC') or die('Restricted access');

/**
* @package OS CCK
* @copyright 2016 OrdaSoft.
* @author Andrey Kvasnevskiy(akbet@mail.ru),Roman Akoev (akoevroman@gmail.com)
* @link http://ordasoft.com/cck-content-construction-kit-for-joomla.html
* @license GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007; see LICENSE.txt
* @description OrdaSoft Content Construction Kit
*/
 
?>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function(){ 
    if(!document.getElementById('instance').value){
      document.getElementById('instance').parentNode.parentNode.style.display = 'none';
    }
  }, false);
</script>
<?php
JHTML::_('behavior.modal', 'a.modal-button');
$doc = JFactory::getDocument();
$doc->addScript(JURI::root().'/components/com_os_cck/assets/js/functions.js');
$doc->addStyleSheet(JURI::root().'/components/com_os_cck/assets/css/admin_style.css');

class JFormFieldInstanceManagerLayout extends JFormField{

  protected function getInput(){
    $db = JFactory::getDBO();
    
    $plugin = JPluginHelper::getPlugin('simplemembership', 'plg_simplemembership_get_cck_user_instances3');
    $params = new JRegistry($plugin->params);
    
    $query = "SELECT ce.eid AS id, ce.name AS title FROM #__os_cck_entity AS ce WHERE published='1' ";
    $db->setQuery($query);
    $entities = $db->loadObjectList();
    $list = array();
    foreach ($entities as $entity) {
      $list[]  = JHTML::_('select.option',$entity->id,$entity->title);
    }
    return JHTML::_('select.genericlist', $list,'jform[params][entity_list][]','class="inputbox" multiple="true"','value','text', $params->get('entity_list',''));
  }
}
class JFormFieldUserinstanceslayout extends JFormField{
  protected function getInput(){
      
    
    $plugin = JPluginHelper::getPlugin('simplemembership', 'plg_simplemembership_get_cck_user_instances3');
    if(!empty($plugin)){
        $params = new JRegistry($plugin->params);
    }
    
    
    $link = JRoute::_('index.php?option=com_os_cck&task=manage_layout_modal&layout_type=user_instances&tmpl=component');
    $rel="{handler: 'iframe', size: {x: 900, y: 550}}";
    if(isset($params)){
        $lid = $params->get('user_instances_layout', '');
    }else{
        $lid = '';
    }
    $html = '<input id="selected_layout" type="text" name="'.$this->name.'" value="'.$lid.'" readonly>';
    $html .= '<div class="fixedform">'.
                '<a class="btn modal-button" href="'.$link.'" rel="'.$rel.'">'.
                  'Select layout'.
                '</a>'.
              '</div>';
    return $html;
  }
}

class JFormFieldUserCck extends JFormField{   

  protected function getInput(){ 
    $db = JFactory::getDBO();
    
    $menuId = 0;
    if(JRequest::getVar('id') != '') {
        $db->setQuery("SELECT `params` FROM `#__menu` WHERE `id` = ".JRequest::getVar('id'));
        $params = json_decode($db->loadResult());
    }
    $selected_entity = $eiid = '';
    if(isset($params->user_instances_layout) && !empty($params->user_instances_layout)){
      $selected_entity = $db->loadResult($db->setQuery("SELECT tt.eid FROM `#__os_cck_layout` AS cl "
                                                            . "\n LEFT JOIN #__os_cck_entity AS tt ON cl.fk_eid = tt.eid "
                                                            . "\n WHERE cl.lid=".$params->user_instances_layout));
      $eiid = $params->user;
    }
    
    $ceid = ($selected_entity)? '&fk_eid='.$selected_entity : '';
    $link = JRoute::_('index.php?option=com_os_cck&task=show_categories_modal'.$ceid.'&tmpl=component');
    $rel="{handler: 'iframe', size: {x: 900, y: 550}}";
    $html = '<input id="user" type="text" name="'.$this->name.'" value="'.$eiid.'" readonly>';
    $html .= '<div class="fixedform">'.
                '<a id="changeLink" class="btn modal-button" href="'.$link.'" rel="'.$rel.'">'.
                  'Select user'.
                '</a>'.
              '</div>';
    return $html;
  }
}