<?php

namespace Ivy\Controller;

class InnerController extends FrontController {
    
    public function getTemplateAction() {
		$this->_contentType = 'template';
		$templateName = isset($_GET['name']) ? $_GET['name'] : null;
		$sFileName = TPL_DIR.THEME_DIR.DS.$templateName.'.tpl';
		if (file_exists($sFileName)) {
			$this->setTemplateName($templateName);
		}
	}
}