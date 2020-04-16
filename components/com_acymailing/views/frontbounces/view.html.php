<?php
/**
 * @package	AcyMailing for Joomla!
 * @version	5.10.13
 * @author	acyba.com
 * @copyright	(C) 2009-2020 ACYBA S.A.R.L. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die('Restricted access');
?><?php
include(ACYMAILING_BACK.'views'.DS.'bounces'.DS.'view.html.php');

class FrontbouncesViewFrontbounces extends BouncesViewBounces{

	var $ctrl='frontbounces';

	function display($tpl = null){
		global $Itemid;
		$this->Itemid = $Itemid;
		parent::display($tpl);
	}
}
