<?php

namespace Ivy\Helper;

use Aya\Helper\Text;

class StreamManager {

    public static function handleItem($sName, $mId) {
        $mButton = isset($_POST['button']) ? $_POST['button']: null;

        if ($mButton == 'promote') {
            StreamManager::_addItem($sName, $mId);
        }

        StreamManager::clearStreamCache();
    }

    private static function _addItem($sName, $mId) {
        $sStreamFile = CACHE_DIR.'/stream-'.$sName;
        if (file_exists($sStreamFile)) {
            $aStreamItems = unserialize(file_get_contents($sStreamFile));
            if (!isset($aStreamItems[$mId])) {
                array_pop($aStreamItems);
                $item = StreamManager::_prepareItem($sName, $mId);
                $aStreamItems = [$mId => $item] + $aStreamItems;

                file_put_contents($sStreamFile, serialize($aStreamItems));
            }
        }
    }

    private static function _prepareItem($sName, $mId) {
        // ...
        // need to fetch comments, user name
        $aItem = array(
            'id' => $mId,
            'title' => $_POST['dataset']['title'],
            'slug' => Text::slugify($_POST['dataset']['title']),
            'creation_date' => date('Y-m-d H:i:s'),
            'visible' => $_POST['dataset']['visible'],
            'user' => $_POST['dataset']['id_author'],
            'comments' => '???',
            'category_slug' => isset($_POST['hidden']['category']) ? Text::slugify($_POST['hidden']['category']) : '',
            'category_name' => isset($_POST['hidden']['category']) ? $_POST['hidden']['category'] : '',
            // 'category_abbr' => isset($_POST['hidden']['abbr']) ? Text::slugify($_POST['hidden']['abbr']) : '',
            'fragment' => isset($_POST['fragment']['cover']['fragment']) ? $_POST['fragment']['cover']['fragment'] : '',
            'type' => $sName,
            // 'url' => 'url'
        );

        return $aItem;
    }

    public static function clearStreamCache($sStreamType = null) {
		$sStreamFile = CACHE_DIR . '/stream';

		// verify by file_exists()
		if (file_exists($sStreamFile)) {
			unlink($sStreamFile);
		}

		if ($sStreamType) {
			if (file_exists($sStreamFile.'-'.$sStreamType)) {
				unlink($sStreamFile.'-'.$sStreamType);
			}
		}
	}
}