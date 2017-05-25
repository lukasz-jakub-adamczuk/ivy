<?php

class CommentNotifier {

	static private $_iTotal = 0;

	static private $_aCounters = array();

	public static function getCommentsCounters() {
		return self::$_aCounters;
	}

	public static function getCommentsTotal() {
		return self::$_iTotal;
	}

	public static function getCommentsSections() {
		$sConfigInCacheFile = TMP_DIR . '/postman.obj';
		if (file_exists($sConfigInCacheFile)) {
			$aSections = unserialize(file_get_contents($sConfigInCacheFile));
		} else {
			require_once dirname(ROOT_DIR) . '/XhtmlTable/Aya/Yaml/AyaYamlLoader.php';

			$sSitesConfFile = ROOT_DIR . '/pub/config/postman.yml';

			$aSections = AyaYamlLoader::parse($sSitesConfFile);

			foreach ($aSections as $sk => &$section) {
				$section['url'] = 'postman/index/' . $sk;
			}
		}

		return $aSections;
	}

	public static function analyzeComments() {
		self::$_iTotal = 0;
		$aKeys = array_keys(self::getCommentsSections());

		$sCommentStatsDir = TMP_DIR . '/comments';
		if (!file_exists($sCommentStatsDir)) {
			mkdir($sCommentStatsDir, 0777, true);
		}

		$aCounters = array();
		$aCounters['news-comment']['value'] = $db->getOne('SELECT COUNT(id_news_comment) FROM news_comment WHERE visible=0');
		$aCounters['article-comment']['value'] = $db->getOne('SELECT COUNT(id_article_comment) FROM article_comment WHERE visible=0');
		$aCounters['story-comment']['value'] = $db->getOne('SELECT COUNT(id_story_comment) FROM story_comment WHERE visible=0');
		$aCounters['user-comment']['value'] = $db->getOne('SELECT COUNT(id_user_comment) FROM user_comment WHERE visible=0');

		self::$_iTotal = array_sum($aCounters);
		
		self::$_aCounters = $aCounters;
	}
}