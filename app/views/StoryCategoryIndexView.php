<?php
require_once AYA_DIR.'/Management/IndexView.php';
require_once AYA_DIR.'/Helpers/MassActions.php';

class StoryCategoryIndexView extends IndexView {

	protected function _getSections() {
		$aSections = array(
			'article-category' => array(
				'name' => 'Gry',
			),
			'story-category' => array(
				'name' => 'Publicystyka',
			)
		);
		return $aSections;
	}

	protected function _getMassActions() {
		return MassActions::getStandardActions();
	}

	// extentending regular collection result
	public function postProcessDataset($aRows) {
		// make a queries
		$sql = 'SELECT id_story_category, COUNT( id_story ) total
				FROM  `story` 
				GROUP BY id_story_category';

		$db = Db::getInstance();
		$aArticlesCounts = $db->getArray($sql, 'id_story_category');

		$sql = 'SELECT id_story_category, COUNT( id_story ) good
				FROM  `story` 
				WHERE verified = 1
				GROUP BY id_story_category';

		$db = Db::getInstance();
		$aVerifiedArticlesCounts = $db->getArray($sql, 'id_story_category');

		foreach ($aRows as $rk => $row) {
			if (isset($aArticlesCounts[$rk])) {
				$aRows[$rk]['articles'] = $aArticlesCounts[$rk]['total'];
			}
			if (isset($aVerifiedArticlesCounts[$rk]) && isset($aVerifiedArticlesCounts[$rk]['good'])) {
				$aRows[$rk]['good'] = round($aVerifiedArticlesCounts[$rk]['good'] / $aArticlesCounts[$rk]['total'] * 100);
			} else {
				$aRows[$rk]['good'] = 0;
			}

		}
		return $aRows;
	}

	public function afterFill() {
		$this->_renderer->assign('sHeader', 'Kategorie');
	}
}