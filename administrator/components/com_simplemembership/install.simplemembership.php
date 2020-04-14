<?php
if (!defined('_VALID_MOS') && !defined('_JEXEC')) die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
/**
 *
 * @package simpleMembership
 * @copyright Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Anton Getman(ljanton@mail.ru);
 * Homepage: http://www.ordasoft.com
 * @version: 6.0.0 FREE
 * @license GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007; see LICENSE.txt
 *
 */
$mosConfig_absolute_path = $GLOBALS['mosConfig_absolute_path'] = JPATH_SITE;
require_once ($mosConfig_absolute_path . "/components/com_simplemembership/compat.joomla1.5.php");
if (version_compare(JVERSION, "2.0.0", "lt")) {
    require_once ($mosConfig_absolute_path . "/administrator/components/com_simplemembership/install.simplemembership.helper.php");
} else {
    require_once (dirname(__FILE__) . "/install.simplemembership.helper.php");
}
require_once ($mosConfig_absolute_path . "/administrator/components/com_simplemembership/admin.simplemembership.class.conf.php");
require_once ($mosConfig_absolute_path . "/administrator/components/com_simplemembership/admin.simplemembership.class.others.php");
$GLOBALS['user_configuration'] = $user_configuration;
if (version_compare(JVERSION, "1.6.0", "lt") || version_compare(JVERSION, "3.0.0", "ge")) {
    function com_install() {
        return com_install2();
    }
}

function updateSMSConfigurationVersion() {
    global $user_configuration, $mosConfig_absolute_path;
    $xml = JFactory::getXml($mosConfig_absolute_path . "/administrator/components/com_simplemembership/simplemembership.xml");
    $user_configuration['release']['version'] = (string)$xml->version;
    $user_configuration['release']['date'] = (string)$xml->creationDate;
    mos_alUserOthers::setParams();
    unset($xml);
}

if (!function_exists("com_install2")) {
    function com_install2() {
        global $database, $mosConfig_absolute_path, $mosConfig_live_site;
        //*******************************   begin check version PHP   **********************************
        $is_warning = false;
        if ((phpversion()) < 5) {
            $is_warning = true;
?>
<center>
<table width="100%" border="0">
  <tr>
    <td>
      <code>Installation status: <font color="red">fault</font></code>
    </td>
  </tr>
  <tr>
    <td>
      <code><font color="red">This component works correctly under PHP version 5.0 and higher.</font></code>
    </td>
  </tr>
</table>
</center>

            <?php
            return '<h2><font color="red">Component installation fault</font></h2>';
        }?>
<center>
<table width="100%" border="0">
  <tr>
    <td>
      <br/>
      <strong>Simplemembership</strong><br/> is published under the <a href="<?php echo $mosConfig_live_site . "/administrator/components/com_simplemembership/doc/LICENSE.txt"; ?>"
       target="new">License</a>.
    </td>
  </tr>
  <tr>
    <td>
      <code>Installation: <font color="green">succesful</font></code>
    </td>
  </tr>
</table>
</center>
<?php
        if ($is_warning) return '<h2><font color="red">The simplemembershipComponent installed with a warning about a missing PHP extension! Please read carefully and uninstall simplemembership. Next fix your PHP installation and then install simplemembership again.</font></h2>';
    }
}
?>
