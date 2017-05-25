<?php

class PostmanNotification {

	static private $_iTotal = 0;

	static private $_aCounters = array();

	public static function getFeedsCounters() {
		return self::$_aCounters;
	}

	public static function getFeedsTotal() {
		return self::$_iTotal;
	}

	public static function getFeedsSections() {
		$sConfigInCacheFile = TMP_DIR . '/postman.obj';
		if (file_exists($sConfigInCacheFile)) {
			$aSections = unserialize(file_get_contents($sConfigInCacheFile));
		} else {
			require_once dirname(ROOT_DIR) . '/XhtmlTable/Aya/Yaml/AyaYamlLoader.php';

			$sSitesConfFile = PUB_DIR . '/config/postman/feeds.yml';

			$aSections = AyaYamlLoader::parse($sSitesConfFile);

			foreach ($aSections as $sk => &$section) {
				$section['url'] = 'postman/index/' . $sk;
			}
		}

		return $aSections;
	}

	public static function analyzeFeeds() {
		self::$_iTotal = 0;
		$aKeys = array_keys(self::getFeedsSections());

		$sFeedStatsDir = TMP_DIR . '/feeds';
		if (!file_exists($sFeedStatsDir)) {
			mkdir($sFeedStatsDir, 0777, true);
		}

		foreach ($aKeys as $item) {
			$sFeedFile = AYA_DIR . '/../postman/feeds/'.$item.'.json';
			$sFeedStatsFile = $sFeedStatsDir.'/'.$item.'.json';
			
			// update feed stats if news elements came
			$aElements = array();
			if (file_exists($sFeedFile)) {
				$aElements = json_decode(file_get_contents($sFeedFile), true);
			}
			$aFeedStats = array();
			if (file_exists($sFeedStatsFile)) {
				$aFeedStats = unserialize(file_get_contents($sFeedStatsFile));
			}

			$aStats = array();
			if (count($aElements)) {
				foreach ($aElements as $elem) {
					$sHash = md5(trim(strip_tags($elem['title'])));
					if (isset($aFeedStats[$sHash])) {
						$aStats[$sHash] = true;
					}
				}
				self::$_aCounters[$item]['value'] = count($aElements) - count($aStats);
			} else {
				self::$_aCounters[$item]['value'] = -1;
			}

			// save stats to file
			file_put_contents($sFeedStatsFile, serialize($aStats));

			self::$_iTotal += count($aElements) - count($aStats);
		}
	}
}