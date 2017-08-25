<?php

namespace Ivy\Controller;

use Aya\Management\CrudController;

use Ivy\Helper\FileBroker;

class FileManagerController extends FrontController {

    // public function indexAction() {
        // echo 'FMC...';
    // }

    public function infoAction() {
        
        // echo 'infoAction()';
    }

    public function deleteAction() {
        if (isset($_POST['path'])) {
            $sPath = $_POST['path'];

            FileBroker::handleDelete();

            // prevent endless loop
        }
    }

    public function removeAction() {
        if (isset($_POST['path'])) {
            $sPath = $_POST['path'];

            FileBroker::handleRemove();

            // $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
        }
    }

    public function infoDirAction() {
        $this->setViewName('FileManagerInfo');
        $this->setTemplateName('file-manager-info-dir');
    }

    public function infoDirAddAction() {
        $this->setViewName('FileManagerInfo');
        $this->setTemplateName('file-manager-info-dir-add');
    }

    public function infoFileAddAction() {
        $this->setViewName('FileManagerInfo');
        $this->setTemplateName('file-manager-info-file-add');
    }

    public function uploadFileAction() {
        // echo ini_get('upload_max_filesize');
        FileBroker::handleUpload();

        $sPath = isset($_POST['path']) ? $_POST['path'] : '';

        $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
    }

    public function downloadFileAction() {
        FileBroker::handleDownload();

        $sPath = isset($_POST['path']) ? $_POST['path'] : '';

        $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
    }

    public function makeDirAction() {
        if (isset($_POST['path']) && isset($_POST['dataset']['dir'])) {
            $sPath = $_POST['path'];
            $sName = $_POST['dataset']['dir'];

            $sCompletePath = SITE_DIR . ($sPath == '' ? '' : '/') . str_replace(',', '/', $sPath) . '/' . $sName;

            echo $sCompletePath;

            // create directory if does not exists
            if (!file_exists($sCompletePath)) {
                if (mkdir($sCompletePath, 0755, true)) {
                    // // make each directory is writable
                    // $aParts = explode('/', $sFragmentPath);
                    // $sTmpPath = ASSETS_DIR . '';
                    // foreach ($aParts as $dir) {
                    //     if ($dir) {
                    //         $sTmpPath .= '/' . $dir;
                    //     }
                    //     chmod($sTmpPath, 0777);    
                    // }
                }
            }

            if (mkdir($sCompletePath, 0755, true)) {
                $this->raiseInfo('Katalog <strong>'.$sName.'</strong> został stworzony.');
                $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
            } else {
                // $this->raiseError('Wystąpił nieoczekiwany wyjątek 2 pewnie brak uprawnień/katalog istnieje.');
                $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
            }
        } else {
            $this->raiseError('Wystąpił błąd. Brak oczekiwanych parametrów.');
            $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
        }
    }

    public function updateDirAction() {
        if (isset($_POST['action'])) {
            if (isset($_POST['path']) && isset($_POST['dataset']['name'])) {
                $sPath = $_POST['path'];
                $sName = $_POST['dataset']['name'];

                $sCompletePath = SITE_DIR . '/pub' . ($sPath == '' ? '' : '/') . str_replace(',', '/', $sPath);

                if (isset($_POST['action']['save'])) {
                    // rename
                    if (strpos($sName, ' ') == false) {
                        $aParts = explode('/', $sCompletePath);
                        array_pop($aParts);
                        if (rename($sCompletePath, implode('/', $aParts).'/'.$sName)) {
                            $this->raiseInfo('Nazwa katalogu została zmieniona.');
                            $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
                        } else {
                            $this->raiseError('Nazwa katalogu nie została zmieniona.');
                            $this->actionForward('info', $this->_ctrlName, true, array('get:path' => $sPath));
                        }
                    } else {
                        $this->raiseError('Proponowana nazwa katalogu zawiera niedozwolone znaki.');
                        $this->actionForward('info', $this->_ctrlName, true, array('get:path' => $sPath));
                    }
                }
                if (isset($_POST['action']['delete'])) {
                    // delete dir
                    if (rmdir($sCompletePath)) {
                        $aParts = explode('/', $sCompletePath);
                        array_pop($aParts);
                        $this->raiseInfo('Katalog został usunięty.');
                        $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
                    } else {
                        $this->raiseError('Wystąpił błąd. Katalog nie jest pusty.');
                        $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
                    }
                }
            }
        }
    }
}