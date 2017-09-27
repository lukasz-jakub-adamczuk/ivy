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
            'gallery',
            'user'
        );

        $commentsCollection = Dao::collection('comment');

        // check does storage dir exists
        FileStorage::checkStorage(CACHE_DIR . '/sql');

        $allCommentsKey = CACHE_DIR . '/sql/all-unauthorized-comments';
        if (FileStorage::is($allCommentsKey)) {
            $counters = FileStorage::restore($allCommentsKey);
        } else {
            foreach ($elements as $element) {
                $commentsKey = CACHE_DIR . '/sql/unauthorized-'.$element.'-comments';
                if (FileStorage::is($commentsKey)) {
                    $counters[$element.'-comment']['value'] = FileStorage::get($commentsKey);
                } else {
                    $counters[$element.'-comment']['value'] = $commentsCollection->getUnauthorizedComments($element);
                    FileStorage::set($commentsKey, $counters[$element.'-comment']);
                }
            }

            FileStorage::store($allCommentsKey, $counters);
        }

        foreach ($counters as $comments) {
            self::$_total += $comments['value'];
        }
        
        self::$_counters = $counters;
    }
}