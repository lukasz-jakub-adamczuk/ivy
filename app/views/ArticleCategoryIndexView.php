<?php
require_once AYA_DIR.'/Management/IndexView.php';

class ArticleCategoryIndexView extends IndexView {

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

	protected function _getRelatedActions() {
		return RelatedActions::getActions(array('refresh', 'order', 'add'));
	}

	protected function _getFilters() {
		$aFilters = array(
			'search' => array(
				'label' => 'Wyszukiwarka',
				'type' => 'text',
				'default' => '',
				'selected' => 'null'
			)
		);
		return $aFilters;
	}

	protected function _getSearchFields() {
		return array('name');
	}

	// extentending regular collection result
	public function postProcessDataset($aRows) {
		// make a queries
		$sql = 'SELECT id_article_category, COUNT( id_article ) total
				FROM  `article` 
				GROUP BY id_article_category';

		$db = Db::getInstance();
		$aArticlesCounts = $db->getArray($sql, 'id_article_category');

		$sql = 'SELECT id_article_category, COUNT( id_article ) good
				FROM  `article` 
				WHERE verified = 1
				GROUP BY id_article_category';

		$db = Db::getInstance();
		$aVerifiedArticlesCounts = $db->getArray($sql, 'id_article_category');

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

	public function beforeFill() {
		$this->_iCollectionSize = 50;
	}

	public function afterFill() {
		$this->_renderer->assign('sHeader', 'Kategorie');
	}
}