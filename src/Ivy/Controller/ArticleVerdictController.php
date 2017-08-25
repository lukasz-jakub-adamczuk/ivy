<?php

namespace Ivy\Controller;

use Aya\Management\CrudController;

class ArticleVerdictController extends FrontController {

    public function afterUpdate($iId) {
        $oEntity = Dao::entity('article-verdict', $iId, 'id_article_fragment');

        if (isset($_POST['features'])) {
            $aFeatures = array('plus' => array(), 'minus' => array());
            foreach (array('plus', 'minus') as $type) {
                if (isset($_POST['features'][$type])) {
                    foreach ($_POST['features'][$type] as $item) {
                        $aFeatures[$type][] = trim($item);
                    }
                }
            }

            // add article and features to verdict
            $oEntity->setField('id_article', $_POST['hidden']['id_article']);
            $oEntity->setField('features', json_encode($aFeatures, JSON_UNESCAPED_UNICODE));
            // print_r($oEntity);

            if ($oEntity->update()) {
                // echo $oEntity->getQuery();
                $this->raiseInfo('Werdykt <strong>'.$iId.'</strong> został zmieniony.');
            } else {
                $this->raiseError('Werdykt <strong>'.$iId.'</strong> nie został zmieniony.');
            }
        }
    }
    
}