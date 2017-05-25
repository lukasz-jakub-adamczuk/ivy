<?php
require_once AYA_DIR.'/Management/IndexView.php';

class CleanupIndexView extends IndexView {

	protected function _getSections() {
		$aSections = array(
			'cleanup-article' => array(
				'name' => 'Gry',
				'icon' => 'icon-game',
				// 'url' => 'cleanup/index/article'
			),
			'cleanup-story' => array(
				'name' => 'Publicystyka',
				'icon' => 'icon-article',
				// 'url' => 'cleanup/index/story'
			)
		);
		return $aSections;
	}

	protected function _getMassActions() {
		return MassActions::getStandardActions();
	}

	protected function _getFilters() {
		return array();
	}

	// protected function _getFilters() {
	// 	$aFilters = array(
	// 		'search' => array(
	// 			'label' => 'Wyszukiwarka',
	// 			'type' => 'text',
	// 			'default' => '',
	// 			'selected' => 'null'
	// 		),
	// 		'id_article_category' => array(
	// 			'label' => 'Kategoria',
	// 			'type' => 'select',
	// 			'options' => array('null' => '---'),
	// 			'default' => '',
	// 			'selected' => 'null'
	// 		),
	// 		'id_author' => array(
	// 			'label' => 'Autor',
	// 			'type' => 'select',
	// 			'options' => array('null' => '---'),
	// 			'default' => '',
	// 			'selected' => 'null'
	// 		)
	// 	);
	// 	return $aFilters;
	// }

	
	// public function beforeFill() {
	// 	parent::beforeFill();

	// 	$this->_sOwner = $this->_sDaoName.'-'.$_GET['ctrl'].'-'.$_GET['path'];
	// 	Navigator::setOwner($this->_sOwner);
	// }

	public function afterFill() {
		$this->_renderer->assign('sHeader', 'Porządki');

		// $this->_renderer->assign('sPrimaryKey', 'id_'.str_replace('-', '_', $_GET['ctrl']));
		$this->_renderer->assign('sPrimaryKey', 'id_'.str_replace('cleanup-', '', $_GET['ctrl']));

		// categories
		// $oCategories = Dao::collection('article-category');
		// $oCategories->orderby('name');
		// $oCategories->load(-1);

		// // authors
		// $oAuthors = Dao::collection('user');
		// $oAuthors->orderby('name');
		// $oAuthors->load(-1);

		// $aFilterValues = array();
		// $aFilterValues['id_article_category'] = $oCategories->getColumn();
		// $aFilterValues['id_author'] = $oAuthors->getColumn();
		// $this->_renderer->assign('aFilterValues', $aFilterValues);
	}
	
	public function _handleCollection() {
		Navigator::init();

		// echo '_handleCollection';
		// print_r();

		$sDaoName = str_replace('cleanup-', '', $_GET['ctrl']);

		$aNavigator = Navigator::load($this->_sOwner);

		$iSize = 20;
		$iPage = isset($aNavigator['page']) ? $aNavigator['page'] : 0;
		$iPage = $iPage > 0 ? $iPage-1 : 0;

		$sLimit = ' LIMIT '.($iPage) * $iSize.','.$iSize;

		$sql = $this->_getCleanupQuery('cleanup-'.$sDaoName, $sLimit);

		// echo $sName = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', str_replace('-', '_', $_GET['ctrl'])));

		$this->_oCollection = Dao::collection($sDaoName, $this->_sOwner);
		$this->_oCollection->query($sql);
		

		$this->_oCollection->load();

		// echo $this->_sOwner;

		// echo $this->_oCollection->getQuery();

		// $aArticles = $oCollection->getRows();

		// $this->_handleDataset($aArticles);
	}

	protected function _handleDataset($aRows) {
		// list
		$this->_renderer->assign('aList', $aRows);
	}

	private function _getCleanupQuery($sType, $sLimit) {
		// sType CamelCase
		$sMethod = '_get'.str_replace(' ', '', ucwords(str_replace('-', ' ', $sType))).'Query';
		return $this->$sMethod($sLimit);
	}

	private function _getCleanupArticleQuery($sLimit) {
		return 'SELECT a.id_article, a.slug object_slug, a.title object_name, a.sum/a.rated score, a.rated, a.views, ac.slug category_slug, ac.name category_name 
				FROM `article` a
				LEFT JOIN article_category ac ON (ac.id_article_category=a.id_article_category)
				WHERE a.visible = 1 AND a.verified = 0
				ORDER BY a.views DESC, `score` DESC, a.rated DESC
				'.$sLimit.'';
	}

	private function _getCleanupStoryQuery($sLimit) {
		return 'SELECT s.id_story, s.slug object_slug, s.title object_name, s.sum/s.rated score, s.rated, s.views, sc.slug category_slug, sc.name category_name 
				FROM `story` s
				LEFT JOIN story_category sc ON (sc.id_story_category=s.id_story_category)
				WHERE s.visible = 1 AND s.verified = 0
				ORDER BY s.views DESC, `score` DESC, s.rated DESC
				'.$sLimit.'';
	}
}
