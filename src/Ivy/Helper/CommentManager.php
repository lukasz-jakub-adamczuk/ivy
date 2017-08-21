<?php

namespace Ivy\Helper;

use Aya\Core\Dao;
use Aya\Helper\FileStorage;

class CommentManager {

    static private $_iTotal = 0;

    static private $_aCounters = array();

    public static function getCommentsCounters() {
        return self::$_aCounters;
    }

    public static function getCommentsTotal() {
        return self::$_iTotal;
    }

    public static function analyzeComments() {
        self::$_iTotal = 0;

        $aElements = array(
            'news',
            'article',
            'story',
            'user'
        );

        $oCommentsCollection = Dao::collection('comments');

        // check does storage dir exists
        FileStorage::checkStorage(CACHE_DIR . '/sql');

        $sStorageKey = CACHE_DIR . '/sql/all-unauthorized-comments';
        if (FileStorage::is($sStorageKey)) {
            $aCounters['unauthorized'] = FileStorage::restore($sStorageKey);
        } else {
            foreach ($aElements as $element) {
                $sStorageKey = CACHE_DIR . '/sql/unauthorized-'.$element.'-comments';
                if (FileStorage::is($sStorageKey)) {
                    $aCounters['unauthorized'][$element.'-comment'] = FileStorage::get($sStorageKey);
                } else {
                    $aCounters['unauthorized'][$element.'-comment'] = $oCommentsCollection->getUnauthorizedComments($element);
                    FileStorage::set($sStorageKey, $aCounters['unauthorized'][$element.'-comment']);
                }
            }

            FileStorage::store($sStorageKey, $aCounters['unauthorized']);
        }

        self::$_iTotal = array_sum($aCounters['unauthorized']);
        
        self::$_aCounters = $aCounters;
    }
}