<?php

namespace Ivy\Helper;

use Symfony\Component\Yaml\Yaml;

class NavigationManager {

    private static $_aNavigation;

    public static function getNavigation() {
        $sNavigationCacheFile = TMP_DIR . '/navigation.obj';
        if (file_exists($sNavigationCacheFile)) {
            self::$_aNavigation = unserialize(file_get_contents($sNavigationCacheFile));
        } else {
            // require_once dirname(ROOT_DIR) . '/XhtmlTable/Aya/Yaml/AyaYamlLoader.php';

            $sNavigationConfFile = ROOT_DIR . '/app/config/postman/feeds.yml';

            self::$_aNavigation = Yaml::parse($sNavigationConfFile);

            // foreach ($aSections as $sk => &$section) {
            //     $section['url'] = 'postman/index/' . $sk;
            // }
        }

        return self::$_aNavigation;
    }
}