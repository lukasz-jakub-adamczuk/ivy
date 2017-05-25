<?php

class CommentsNotifier {

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
		DataStorage::checkStorage(CACHE_DIR . '/sql');

		$sStorageKey = CACHE_DIR . '/sql/all-unauthorized-comments';
		if (DataStorage::is($sStorageKey)) {
			$aCounters['unauthorized'] = DataStorage::restore($sStorageKey);
		} else {
			foreach ($aElements as $element) {
				$sStorageKey = CACHE_DIR . '/sql/unauthorized-'.$element.'-comments';
				if (DataStorage::is($sStorageKey)) {
					$aCounters['unauthorized'][$element.'-comment'] = DataStorage::get($sStorageKey);
				} else {
					$aCounters['unauthorized'][$element.'-comment'] = $oCommentsCollection->getUnauthorizedComments($element);
					DataStorage::set($sStorageKey, $aCounters['unauthorized'][$element.'-comment']);
				}
			}

			DataStorage::store($sStorageKey, $aCounters['unauthorized']);
		}

		self::$_iTotal = array_sum($aCounters['unauthorized']);
		
		self::$_aCounters = $aCounters;
	}
}