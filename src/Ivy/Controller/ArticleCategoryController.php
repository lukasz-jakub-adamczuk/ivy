<?php

namespace Ivy\Controller;

use Aya\Management\CrudController;

class ArticleCategoryController extends FrontController {

    public function afterInsert($iId) {
        if (isset($_POST['dataset']['abbr'])) {
            $sName = $_POST['dataset']['abbr'];
            $sCategoryDir = SITE_DIR . '/assets/games/' . $sName;

            if (!file_exists($sCategoryDir)) {
                if (mkdir($sCategoryDir, 0777)) {
                    $this->raiseInfo('Katalog mediów został utworzony.');
                    $this->actionForward('index', $this->_ctrlName, true);
                } else {
                    $this->raiseError('Wystąpił błąd.');
                    $this->actionForward('info', $this->_ctrlName, true);
                }
            }
        }
    }

    public function afterUpdate($iId) {
        $this->afterInsert(0);
    }

    public function orderAction() {}

    public function updateOrderAction() {
        $aIds = isset($_POST['ids']) ? $_POST['ids'] : null;
        
        if ($aIds) {
            $iSuccessful = $iFailed = 0;

            $sCtrl = isset($_POST['ctrl']) ? $_POST['ctrl'] : $this->_ctrlName;

            foreach ($aIds as $id => $value) {
                $oEntity = Dao::entity($sCtrl, $id, 'id_'.$sCtrl);

                $oEntity->setField('idx', $value);

                if ($oEntity->update()) {
                    $iSuccessful++;
                } else {
                    $iFailed++;
                }
            }

            if ($iFailed == 0 && $iSuccessful == count($aIds))  {
                $this->actionForward('index', $this->_ctrlName, true);
            } else {
                $this->raiseError('Wystąpił nieoczekiwany wyjątek.');
                $this->actionForward('info', $this->_ctrlName);
            }
        } else {
            $this->raiseError('Niespełnione warunki akcji.');
            $this->actionForward('info', $this->_ctrlName);
        }
    }
}