<?php

namespace Ivy\Helper;

use Aya\Core\Dao;
use Aya\Helper\FileStorage;

class CommentManager {

    static private $_total = 0;

    static private $_counters = array();

    public static function getCommentsCounters() {
        return self::$_counters;
    }

    public static function getCommentsTotal() {
        return self::$_total;
    }

    public static function analyzeComments() {
        self::$_total = 0;

        $elements = array(
            'news',
            'article',
            'story',
            'user'
        );

        $commentsCollection = Dao::collection('comments');

        // check does storage dir exists
        FileStorage::checkStorage(CACHE_DIR . '/sql');

        $storageKey = CACHE_DIR . '/sql/all-unauthorized-comments';
        if (FileStorage::is($storageKey)) {
            $counters['unauthorized'] = FileStorage::restore($storageKey);
        } else {
            foreach ($elements as $element) {
                $storageKey = CACHE_DIR . '/sql/unauthorized-'.$element.'-comments';
                if (FileStorage::is($storageKey)) {
                    $counters['unauthorized'][$element.'-comment'] = FileStorage::get($storageKey);
                } else {
                    $counters['unauthorized'][$element.'-comment'] = $commentsCollection->getUnauthorizedComments($element);
                    FileStorage::set($storageKey, $counters['unauthorized'][$element.'-comment']);
                }
            }

            FileStorage::store($storageKey, $counters['unauthorized']);
        }

        self::$_total = array_sum($counters['unauthorized']);
        
        self::$_counters = $counters;
    }
}