<?php
/**
 * @package	mod_db8kivateam
 * @author	Peter Martin, www.db8.nl
 * @copyright	Copyright (C) 2014 Peter Martin. All rights reserved.
 * @license	GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die;

if ($params->get('lenders_count') < count($lenders)) {
    $count = $params->get('lenders_count', 5);
} else {
    $count = count($lenders);
}
?>
<div class="db8kivateam<?php echo $moduleclass_sfx; ?>">
    <?php
    for ($i = 0; $i <= ($count - 1); $i++) {
        $lender = $lenders[$i];
        ?>
        <div class="lenderCard default vertical">
            <?php if ($params->get('lenders_showlogo')) { ?>

                <a class="img img-s100 thumb" target="_blank" href="http://www.kiva.org/lender/<?php echo $lender->uid; ?>">
                    <img src="http://www.kiva.org/img/s100/<?php echo $lender->image->id; ?>.jpg" 
                         width="<?php echo $params->get('lenders_logo_width', 100); ?>" height="<?php echo $params->get('lenders_logo_height', 100); ?>">
                </a>
            <?php } ?>
            <div class="name">
                <a href="http://www.kiva.org/lender/<?php echo $lender->uid; ?>" target="_blank">
                    <?php echo $lender->name; ?></a>
            </div>

            <div class="description">
                <?php if ($params->get('lenders_show_whereabouts') && isset($lender->whereabouts)) { ?>
                    <span class="city"><?php echo $lender->whereabouts; ?></span>
                <?php } ?> 
                <?php if ($params->get('lenders_show_country_code') && isset($lender->country_code)) { ?>
                    <span class="country"><?php echo $lender->country_code; ?></span>
                <?php } ?> 
            </div>

            <?php if ($params->get('lenders_show_join_date') && isset($lender->team_join_date)) { ?>
                <div>
                    Joined team: <?php echo substr($lender->team_join_date, 0, 10); ?>
                </div>
            <?php } ?>   
        </div>    
    <?php } ?>   
</div>