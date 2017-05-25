<?php
require_once AYA_DIR.'/Management/InfoView.php';
require_once AYA_DIR.'/Core/Folder.php';

class ArticleImageInfoView extends InfoView {

	public function fill() {

	}

	public function afterFill() {
		// authors
		// $oAuthors = Dao::collection('user');
		
		// $this->_renderer->assign('aAuthors', $oAuthors->getAuthors());

		// categories
		// $oCategories = Dao::collection('article-category');
		// $oCategories->orderby('name');
		// $oCategories->load(-1);

		// $this->_renderer->assign('aCategories', $oCategories->getRows());



		// templates

		$mId = isset($_GET['id']) ? $_GET['id'] : 0;

		

		// temporary walkaround
		$sBasePath = SITE_DIR . '/pub';
		
		$sPath = isset($_GET['path']) ? $_GET['path'] : '';

		// ???
		$sUrl = '/' . str_replace(',', '/', $sPath);
		$this->_renderer->assign('sUrl', substr($sUrl, 1).'/');

		// complete path for dir search
		$sContentPath = $sBasePath . $sUrl;

		$aAllContent = Folder::getContent($sContentPath, false);
		$aImages = $aAllContent['files'];

		// print_r($aImages);

		$this->_renderer->assign('aImages', $aImages);
	}
}