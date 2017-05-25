<?php
require_once APP_DIR.'/helpers/Utilities.php';

class StreamManager {

	public static function handleItem($sName, $mId) {
		$mButton = isset($_POST['button']) ? $_POST['button']: null;

		if ($mButton == 'promote') {
			StreamManager::_addItem($sName, $mId);
		}
	}

	private static function _addItem($sName, $mId) {
		$sStreamFile = CACHE_DIR.'/stream';
		if (file_exists($sStreamFile)) {
			$aStreamItems = unserialize(file_get_contents($sStreamFile));
			if (!isset($aStreamItems[$sName][$mId])) {
				$aItems = $aStreamItems[$sName];
				array_pop($aItems);
				$aReversedItems = array_reverse($aItems);
				$aReversedItems[$mId] = self::_prepareItem($sName, $mId);
				$aStreamItems[$sName] = array_reverse($aReversedItems);

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
			'slug' => Utilities::slugify($_POST['dataset']['title']),
			'creation_date' => date('Y-m-d H:i:s'),
			'visible' => $_POST['dataset']['visible'],
			'user' => $_POST['dataset']['id_author'],
			'comments' => '???',
			'category_slug' => isset($_POST['hidden']['category']) ? Utilities::slugify($_POST['hidden']['category']) : '',
			'category' => isset($_POST['hidden']['category']) ? $_POST['hidden']['category'] : '',
			// 'category_abbr' => isset($_POST['hidden']['abbr']) ? Utilities::slugify($_POST['hidden']['abbr']) : '',
			'fragment' => isset($_POST['fragment']['cover']['fragment']) ? $_POST['fragment']['cover']['fragment'] : '',
			'type' => $sName,
			'url' => 'url'
		);

		return $aItem;
	}
}