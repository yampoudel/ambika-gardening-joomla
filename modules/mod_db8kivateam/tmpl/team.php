<?php
/**
 * @package	mod_db8kivateam
 * @author	Peter Martin, www.db8.nl
 * @copyright	Copyright (C) 2014 Peter Martin. All rights reserved.
 * @license	GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die;
$document = JFactory::getDocument();
// add minified CSS stylesheet (original CSS: db8socialmediashare_style.css)
$document->addStyleSheet('modules/mod_db8kivateam/assets/db8kivateam_style.css');
?>
<div class="db8kivateam<?php echo $moduleclass_sfx; ?>">
    <section id="teamProfile">
        <?php if ($params->get('team_showlogo')) { ?>
            <div class="teamProfileImage">
                <a target="_blank" title="<?php echo $team->name; ?>" href="http://www.kiva.org/img/w800/<?php echo $team->image->id; ?>.jpg">
                    <img src="http://www.kiva.org/img/w200h200/<?php echo $team->image->id; ?>.jpg" 
                         alt="Click to enlarge" title="Click to enlarge" width="<?php echo $params->get('team_logo_width', 100); ?>" height="<?php echo $params->get('team_logo_height', 100); ?>">
                </a>
            </div>
        <?php } ?>
        <div class="profileStats">
            <?php if ($params->get('team_showloan_because')) { ?>
                <p><span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_TEAMSHOWLOANBECAUSE_LABEL'); ?></span><br>
                    <?php echo $team->loan_because; ?>
                </p>
            <?php } ?>
            <?php if ($params->get('team_showdescription')) { ?>
                <p><span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_TEAMSHOWDESCRIPTION_LABEL'); ?></span><br>
                    <?php echo $team->description; ?>
                </p>
            <?php } ?>
            <?php if ($params->get('team_showwhereabouts')) { ?>
                <p><span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_TEAMSHOWWHEREABOUTS_LABEL'); ?></span><br/>  
                    <?php echo $team->whereabouts; ?>;
                </p>
            <?php } ?>
            <?php if ($params->get('team_showwebsite_url')) { ?>
                <p><span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_TEAMSHOWWEBSITE_LABEL'); ?></span><br/> 
                    <a href="<?php echo $team->website_url; ?>" target="_blank" title="<?php echo $team->name; ?>"><?php echo $team->website_url; ?></a>
                </p>
            <?php } ?>
            <?php if ($params->get('team_showcategory')) { ?>
                <p><span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_TEAMSHOWCATEGORY_LABEL'); ?></span>
                    <br><?php echo $team->category; ?>
                </p>
            <?php } ?>
            <?php if ($params->get('team_showteam_since')) { ?>
                <p><span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_TEAMSHOWTEAMSINCE_LABEL'); ?></span>
                    <br><?php echo $team->team_since; ?>
                </p>
            <?php } ?>
            <?php if ($params->get('team_showmember_type')) { ?>
                <p><span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_TEAMSHOWMEMBERSHIPTYPE_LABEL'); ?></span>
                    <br><?php echo $team->membership_type; ?>
                </p>
            <?php } ?>
            <?php if ($params->get('team_showkivateamlink')) { ?>
                <p><span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_TEAMSHOWKIVAPAGE_LABEL'); ?></span>
                    <a href="http://www.kiva.org/team/<?php echo $team->shortname; ?>" target="_blank" 
                       title="<?php echo $team->name; ?>">http://www.kiva.org/team/<?php echo $team->shortname; ?>
                    </a>
                </p>
            <?php } ?>
        </div>

        <?php if ($params->get('team_showjoin')) { ?>
            <div class="teamAction_join">
                <a href="http://www.kiva.org/teams/join/process?team_id=<?php echo $team->id; ?>" target="_blank"
                   title="<?php echo JText::_('MOD_DB8KIVATEAM_TEAMSHOWJOIN_LABEL'); ?>"><?php echo JText::_('MOD_DB8KIVATEAM_TEAMSHOWJOIN_LABEL'); ?>
                </a>
            </div>
        <?php } ?>
    </section>    

    <?php if ($params->get('team_showstats')) { ?>    
        <section>
            <h2 class="noMT"><?php echo JText::_('MOD_DB8KIVATEAM_TEAMIMPACT'); ?></h2>
            <div class="impactStatistic">
                <span class="icon-users"></span> <?php echo JText::_('MOD_DB8KIVATEAM_TEAMMEMBERS'); ?>: <?php echo $team->member_count; ?>
            </div>

            <div class="impactStatistic">
                <span class="icon-coin"></span> <?php echo JText::_('MOD_DB8KIVATEAM_TEAMAMOUNTLOANED'); ?>: <?php echo $team->loaned_amount; ?>
            </div>

            <div class="impactStatistic">
                <span class="icon-bars"></span> <?php echo JText::_('MOD_DB8KIVATEAM_TEAMLOANVOUNT'); ?>: <?php echo $team->loan_count; ?>
            </div>

            <div class="impactStatistic">
                <span class="icon-stats"></span> <?php echo JText::_('MOD_DB8KIVATEAM_TEAMLOANPERMEMBER'); ?>: <?php echo $team->loan_count / $team->member_count; ?>
            </div>
        </section>
    <?php } ?>
</div>