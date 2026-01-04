<?php
/**
 * Installer script for mod_ccctwoclick
 *
 * Blocks installation on Joomla versions lower than 5.4.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Version;

/**
 * Class Mod_CcctwoclickInstallerScript
 */
class Mod_CcctwoclickInstallerScript
{
    /**
     * Method to run before an install/update/uninstall method
     *
     * @param string                    $type      The type of change (install, update or discover_install)
     * @param \Joomla\CMS\Installer\Adapter\ModuleAdapter $parent The class calling this method
     *
     * @return boolean
     *
     * @throws \RuntimeException
     */
    public function preflight($type, $parent)
    {
        $version = new Version;

        // Require Joomla 5.4 or higher
        if (version_compare($version->getShortVersion(), '5.4', '<'))
        {
            throw new \RuntimeException(
                'Dieses Modul benötigt Joomla 5.4 oder höher. Die Installation wurde abgebrochen.'
            );
        }

        return true;
    }

    /**
     * Runs after install/update to migrate legacy privacy link params.
     *
     * @param   string  $type    install|update|discover_install
     * @param   \Joomla\CMS\Installer\Adapter\ModuleAdapter  $parent  Parent adapter
     *
     * @return  void
     */
    public function postflight($type, $parent)
    {
        if (!in_array($type, ['install', 'update'], true))
        {
            return;
        }

        $db    = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select($db->quoteName(['id', 'params']))
            ->from($db->quoteName('#__modules'))
            ->where($db->quoteName('module') . ' = ' . $db->quote('mod_ccctwoclick'));

        $db->setQuery($query);

        foreach ($db->loadObjectList() as $module)
        {
            $params = json_decode($module->params, true);

            if (!is_array($params))
            {
                continue;
            }

            $needsUpdate = false;

            // Migrate legacy allowfullscreen value "8" (old false) to "false"
            if (isset($params['allowfullscreen']) && $params['allowfullscreen'] === '8')
            {
                $params['allowfullscreen'] = 'false';
                $needsUpdate = true;
            }

            // Migrate legacy position value "center" to "overlay"
            if (isset($params['contentbeforepos']) && $params['contentbeforepos'] === 'center')
            {
                $params['contentbeforepos'] = 'overlay';
                $needsUpdate = true;
            }

            // Skip privacy migration if already done
            if (!empty($params['privacy_link_url']))
            {
                // Only update if other migrations were needed
                if ($needsUpdate)
                {
                    $update = $db->getQuery(true)
                        ->update($db->quoteName('#__modules'))
                        ->set($db->quoteName('params') . ' = ' . $db->quote(json_encode($params)))
                        ->where($db->quoteName('id') . ' = ' . (int) $module->id);

                    $db->setQuery($update)->execute();
                }

                continue;
            }

            // Check if there's legacy data to migrate
            $hasLegacyData = isset($params['privacypolicy']) || isset($params['privacypolicytext']) || isset($params['displayprivacypolicy']);

            if (!$hasLegacyData)
            {
                continue;
            }

            $displayPrivacy = !empty($params['displayprivacypolicy']);
            $privacyPolicy  = trim((string) ($params['privacypolicy'] ?? ''));

            if ($privacyPolicy !== '')
            {
                $privacyLinkUrl = $privacyPolicy;

                if (is_numeric($privacyPolicy))
                {
                    $privacyLinkUrl = 'index.php?Itemid=' . (int) $privacyPolicy;
                }

                $params['privacy_link_url'] = $privacyLinkUrl;
            }

            if ($displayPrivacy)
            {
                $privacyText = trim((string) ($params['privacypolicytext'] ?? ''));

                if ($privacyText === '' || $privacyText === 'MOD_CCCTWOCLICK_PRIVACYLINK_TXT')
                {
                    $privacyText = Text::_('MOD_CCCTWOCLICK_PRIVACYLINK_TXT');
                }

                $params['privacy_link_text'] = $privacyText;
            }
            else
            {
                $params['privacy_link_text'] = '';
            }

            // Clean up legacy parameters
            unset($params['privacypolicy'], $params['privacypolicytext'], $params['displayprivacypolicy']);

            $update = $db->getQuery(true)
                ->update($db->quoteName('#__modules'))
                ->set($db->quoteName('params') . ' = ' . $db->quote(json_encode($params)))
                ->where($db->quoteName('id') . ' = ' . (int) $module->id);

            $db->setQuery($update)->execute();
        }
    }
}
