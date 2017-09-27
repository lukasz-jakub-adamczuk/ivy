<?php

namespace Ivy\Helper;

use Symfony\Component\Yaml\Yaml;

class PostmanManager {

    static private $_total = 0;

    static private $_counters = [];

    public static function getFeedsCounters() {
        return self::$_counters;
    }

    public static function getFeedsTotal() {
        return self::$_total;
    }

    public static function info() {
        return ['total' => self::$_total, 'counters' => self::$_counters];
    }

    public static function getFeedsSections() {
        $configInCacheFile = CACHE_DIR . '/postman.obj';
        if (file_exists($configInCacheFile)) {
            $sections = unserialize(file_get_contents($configInCacheFile));
        } else {
            $sitesConfFile = APP_DIR . '/conf/postman/feeds.yml';

            $sections = Yaml::parse(file_get_contents($sitesConfFile));

            foreach ($sections as $sk => &$section) {
                $section['url'] = 'postman/index/' . $sk;
            }
        }

        return $sections;
    }

    public static function analyzeFeeds() {
        self::$_total = 0;
        $feedKeys = array_keys(self::getFeedsSections());

        $feedStatsDir = CACHE_DIR . '/feeds';
        if (!file_exists($feedStatsDir)) {
            mkdir($feedStatsDir, 0777, true);
        }

        foreach ($feedKeys as $item) {
            $feedFile = AYA_DIR . '/../postman/feeds/'.$item.'.json';
            $feedStatsFile = $feedStatsDir.'/'.$item.'.json';
            
            // update feed stats if news elements came
            $elements = array();
            if (file_exists($feedFile)) {
                $elements = json_decode(file_get_contents($feedFile), true);
            }
            // print_r($elements);
            $feedStats = array();
            if (file_exists($feedStatsFile)) {
                $feedStats = unserialize(file_get_contents($feedStatsFile));
            }

            $stats = array();
            if (count($elements)) {
                foreach ($elements as $elem) {
                    $sHash = md5(trim(strip_tags($elem['title'])));
                    if (isset($feedStats[$sHash])) {
                        $stats[$sHash] = true;
                    }
                }
                self::$_counters[$item]['value'] = count($elements) - count($stats);
            } else {
                self::$_counters[$item]['value'] = -1;
            }

            // save stats to file
            file_put_contents($feedStatsFile, serialize($stats));

            self::$_total += count($elements) - count($stats);
        }
    }
}