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

if ($params->get('loans_count') < count($loans)) {
    $count = $params->get('loans_count', 5);
} else {
    $count = count($loans);
}
?>
<div class="db8kivateam<?php echo $moduleclass_sfx; ?>">
    <?php
    for ($i = 0; $i <= ($count - 1); $i++) {
        $loan = $loans[$i];
        ?>
        <article class="loanCard default vertical ">

            <?php if ($params->get('loans_showlogo')) { ?>
                <a class="img img-s100 thumb" data-kv-trackevent="" target="_blank" href="http://www.kiva.org/lend/<?php echo $loan->id; ?>">
                    <img src="http://s3-1.kiva.org/img/s100/<?php echo $loan->image->id; ?>.jpg" alt="<?php echo $loan->name; ?>" title="<?php echo $loan->name; ?>" 
                         width="<?php echo $params->get('loans_logo_width', 100); ?>" height="<?php echo $params->get('loans_logo_height', 100); ?>">
                </a>
            <?php } ?>

            <span class="info_status">
                <div class="name">
                    <a href="http://www.kiva.org/lend/<?php echo $loan->id; ?>" target="_blank" title="<?php echo $loan->name ?>"><?php echo $loan->name; ?></a>				
                </div>
                <div class="info">
                    <?php if ($params->get('loans_show_activity') && isset($loan->activity)) { ?>
                        <div class="activity">
                            <span class="icon-wrench"></span> 
                            <span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_LOANSSHOWACTIVITY_LABEL'); ?></span>
                            <?php echo $loan->activity; ?>
                        </div>
                    <?php } ?> 

                    <?php if ($params->get('loans_show_sector') && isset($loan->sector)) { ?>
                        <div class="sector">
                            <span class="icon-pie"></span> 
                            <span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_LOANSSHOWSECTOR_LABEL'); ?></span>                            
                            <?php echo $loan->sector; ?>
                        </div>
                    <?php } ?> 

                    <?php if ($params->get('loans_show_theme') && isset($loan->theme)) { ?>
                        <div class="theme">
                            <span class="icon-folder-open"></span>
                            <span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_LOANSSHOWTHEME_LABEL'); ?></span>                            
                            <?php echo $loan->theme; ?>
                        </div>
                    <?php } ?> 

                    <?php if ($params->get('loans_show_use') && isset($loan->use)) { ?>
                        <div class="use">
                            <span class="icon-office"></span>
                            <span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_LOANSSHOWUSE_LABEL'); ?></span>                            
                            <?php echo $loan->use; ?>
                        </div>
                    <?php } ?> 

                    <?php if ($params->get('loans_show_posted_date') && isset($loan->posted_date)) { ?>
                        <div class="planned_expiration_date">
                            <span class="icon-calendar"></span>
                            <span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_LOANSSHOWPOSTED_LABEL'); ?></span>                            
                            <?php echo substr($loan->posted_date, 0, 10); ?>
                        </div>
                    <?php } ?> 

                    <?php if ($params->get('loans_show_planned_expiration_date') && isset($loan->planned_expiration_date)) { ?>
                        <div class="planned_expiration_date">
                            <span class="icon-alarm"></span>
                            <span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_LOANSSHOWEXPIRATION_LABEL'); ?></span>                            
                            <?php echo substr($loan->planned_expiration_date, 0, 10); ?>
                        </div>
                    <?php } ?> 

                    <?php if ($params->get('loans_show_loan_amount') && isset($loan->loan_amount)) { ?>
                        <div class="loan_amount">
                            <span class="icon-coin"></span>
                            <span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_LOANSSHOWAMOUNT_LABEL'); ?></span>                            
                            <?php echo $loan->loan_amount; ?>
                        </div>
                    <?php } ?> 

                    <?php if ($params->get('loans_show_borrower_count') && isset($loan->borrower_count)) { ?>
                        <div class="borrower_count">
                            <span class="icon-users"></span>
                            <span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_LOANSSHOWBORROWER_LABEL'); ?></span>                            
                            <?php echo $loan->borrower_count; ?>
                        </div>
                    <?php } ?> 

                    <?php if ($params->get('loans_show_lender_count') && isset($loan->lender_count)) { ?>
                        <div class="lender_count">
                            <span class="icon-users"></span>
                            <span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_LOANSSHOWLENDER_LABEL'); ?></span>                            
                            <?php echo $loan->lender_count; ?>
                        </div>
                    <?php } ?> 

                    <?php if ($params->get('loans_show_country') && isset($loan->country)) { ?>
                        <div class="country">
                            <span class="f16 py"></span><span class="icon-earth"></span>
                            <a href="http://www.kiva.org/lend?countries=<?php echo $loan->location->country_code; ?>" 
                               target="_blank" title="<?php echo $loan->location->country; ?>"><?php echo $loan->location->country; ?></a>
                        </div>	
                    <?php } ?> 

                    <?php if ($params->get('loans_show_status') && isset($loan->status)) { ?>
                        <div class="loan_status">
                            <span class="icon-busy"></span>
                            <span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_LOANSSHOWLOANSTATUS_LABEL'); ?></span>                            
                            <?php echo $loan->status; ?>
                        </div>
                    <?php } ?> 

                    <?php if ($params->get('loans_show_funded_amount') && isset($loan->funded_amount)) { ?>
                        <div class="loan_status">
                            <span class="icon-coin"></span>
                            <span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_LOANSSHOWFUNDEDAMOUNT_LABEL'); ?></span>                            
                            <?php echo $loan->funded_amount; ?>
                        </div>
                    <?php } ?> 

                    <?php if ($params->get('loans_show_paid_amount') && isset($loan->paid_amount)) { ?>
                        <div class="loan_status">
                            <span class="icon-coin"></span>
                            <span class="bold"><?php echo JText::_('MOD_DB8KIVATEAM_LOANSSHOWPAIDAMOUNT_LABEL'); ?></span>                            
                            <?php echo $loan->paid_amount; ?>
                        </div>
                    <?php } ?> 
                </div>
            </span>
        </article>
    <?php } ?>    
</div>