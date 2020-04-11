<?php

/**
 * @package	mod_db8kivateam
 * @author	Peter Martin, www.db8.nl
 * @copyright	Copyright (C) 2014 Peter Martin. All rights reserved.
 * @license	GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$display = $params->get('display');

if($display == 1)
{
    $team = modDB8KivaTeamHelper::getTeam($params);
    require JModuleHelper::getLayoutPath('mod_db8kivateam', $params->get('layout', 'team'));    

}
elseif($display == 2)
{
    $lenders = modDB8KivaTeamHelper::getLenders($params);
    require JModuleHelper::getLayoutPath('mod_db8kivateam', $params->get('layout', 'lenders'));

}
elseif($display == 3)
{
    $loans = modDB8KivaTeamHelper::getLoans($params);
    require JModuleHelper::getLayoutPath('mod_db8kivateam', $params->get('layout', 'loans'));    
}