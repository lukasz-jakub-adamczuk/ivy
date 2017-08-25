<?php
namespace Ivy\Helper;

use Aya\Core\Folder;
use Aya\Helper\MessageList;

class FileBroker {

    public static function handleUpload() {
        self::_handleFileTransfer('upload');
    }

    public static function handleDownload() {
        self::_handleFileTransfer('download');
    }

    public static function handleDelete() {
        self::_handleFileDelete();
    }

    public static function handleRemove() {
        self::_handleFileDelete(true);
    }

    // priatve methods
    private static function _handleFileTransfer($sTransfer) {
        if (isset($_GET['path']) || isset($_POST['path'])) {
            // paths
            $sPath = $_REQUEST['path'];
            $sFragmentPath = ($sPath == '' ? '' : '/') . str_replace(',', '/', $sPath);
            $sCompletePath = WEB_DIR . $sFragmentPath;

            // echo $sPath.', '.$sFragmentPath.', '.$sFragmentPath;

            // FileBroker::makeDirectory(ASSETS_DIR, $sFragmentPath);

            // create directory if does not exists
            if (!file_exists($sCompletePath)) {
                if (mkdir($sCompletePath, 0755, true)) {
                    // make each directory is writable
                    // $aParts = explode('/', $sFragmentPath);
                    // $sTmpPath = ASSETS_DIR . '';
                    // foreach ($aParts as $dir) {
                    //     if ($dir) {
                    //         $sTmpPath .= '/' . $dir;
                    //     }
                    //     chmod($sTmpPath, 0755);    
                    // }

                }
            }

            // default name
            $sAutoName = !empty($_POST['options']['name']) ? $_POST['options']['name'] : '';

            // names generated
            if (isset($_POST['options']['automatic-names']) || isset($_POST['options']['create-fragments'])) {
                $sAutoName = 'bg-';
                $aPathParts = explode(',', $sPath);
                if (isset($_POST['options']['create-fragments'])) {
                    $sAutoName = end($aPathParts).'-bg-';
                }
            }

            $aAllContent = Folder::getContent($sCompletePath, true);

            $iExistingFiles = 0;
            if (isset($aAllContent['files'])) {
                foreach ($aAllContent['files'] as $file) {
                    if ($file['type'] == 'image') {
                        if (strlen($file['name']) > 6 && substr($file['name'], 0, 6) != '__rm__') {
                            $iExistingFiles++;
                        }
                    }
                }
            }

            // handle file transfer
            $sMethod = '_handleFile'.ucfirst($sTransfer);
            $aFiles = self::$sMethod($sAutoName, $sCompletePath, $sFragmentPath, $iExistingFiles);

            // sync ivy /assets with renaissance /assets
            if (isset($aFiles['ok']) && count($aFiles['ok'])) {
                foreach ($aFiles['ok'] as $file) {
                    $dir = SITE_DIR . $sFragmentPath;
                    $src = $sCompletePath . '/' . $file;
                    $dst = $dir . '/' . $file;
                    $cmd = "mkdir -p $dir && cp $src $dst";
                    // echo $cmd;
                    exec($cmd);
                }
            }

            if (isset($aFiles['ok'])) {
                MessageList::raiseInfo('Plik/i <strong>'.implode(', ', $aFiles['ok']).'</strong> zostały wgrane.');
            }
            if (isset($aFiles['bad'])) {
                MessageList::raiseWarning('Wystąpił błąd. Brak uprawnień dostępu dla tego katalogu.');
            }
        } else {
            MessageList::raiseError('Wystąpił błąd. Brak oczekiwanych parametrów.');
        }
    }

    private static function _handleFileUpload($sAutoName, $sCompletePath, $sFragmentPath, $iExistingFiles) {
        $i = $iExistingFiles;
        $aFiles = array();
        foreach ($_FILES['files']['error'] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $sName = $sAutoName != '' ? $sAutoName : $_FILES['files']['name'][$key];
                $sExt = pathinfo($sCompletePath . $_FILES['files']['name'][$key], PATHINFO_EXTENSION);

                if (substr($sName, -(strlen($sExt))) != $sExt) {
                    $sName .= '.' . $sExt;
                }
                // names generated
                if (isset($_POST['options']['automatic-names']) || isset($_POST['options']['create-fragments'])) {
                    $sIteration = str_pad(($i+1), 2, '0', STR_PAD_LEFT);
                    $sName = $sAutoName . $sIteration . '.' . $sExt;
                }

                // echo $sCompletePath . '/' . $sName;

                if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $sCompletePath . '/' . $sName)) {
                    $aFiles['ok'][] = $sName;
                    $i++;

                    if (isset($_POST['options']['create-fragments'])) {
                        $oFragmentEntity = Dao::entity('fragment', 0, 'id_fragment');
                        
                        $aFragment = array();
                        $aFragment['id_fragment_type'] = 2;
                        $aFragment['id_author'] = $_SESSION['user']['id'];
                        $aFragment['name'] = $sAutoName . $sIteration;
                        $aFragment['fragment'] = $sFragmentPath . '/' . $sName;
                        // $aFragment['params'] = null;
                        // $aFragment['creation_date'] = date('Y-m-d H:i:s');
                        
                        $oFragmentEntity->setFields($aFragment);

                        if ($oFragmentEntity->insert(true)) {
                            // ok
                            
                        }
                    }
                } else {
                    $aFiles['bad'][] = $sName;
                }
            }
        }
        return $aFiles;
    }

    private static function _handleFileDownload($sAutoName, $sCompletePath, $sFragmentPath, $iExistingFiles) {
        if (!empty($_POST['dataset']['urls'])) {
            // $sInput = stripslashes($_POST['dataset']['urls']);
            $mInput = $_POST['dataset']['urls'];
            if (is_array($mInput)) {
                $aUrls = $mInput;
            } else {
                $aUrls = explode("\n", $mInput);
            }
            // urls as JSON
            // $aUrls = json_decode($sInput, true);
            // $aUrls = explode("\n", $sInput);
            if (!is_array($aUrls)) {
                // urls as string
                
            }

            $i = $iExistingFiles;
            foreach ($aUrls as $url) {
                $fp = fopen($url, 'r');
                $content = '';

                if (is_resource($fp)) {
                    while (!feof($fp)) {
                        $content .= fread($fp, 4096);
                    }
                    fclose($fp);

                    $aParts = explode('/', $url);
                    $aFileParts = explode('.', end($aParts));
                    $sName = isset($_POST['name']) ? $_POST['name'].'.'.end($aFileParts) : end($aParts);
                    // $sName = !empty($_POST['options']['name']) ? $_POST['options']['name'] : $_FILES['files']['name'][$key];
                    $sExt = pathinfo($url, PATHINFO_EXTENSION);

                    if (substr($sName, -(strlen($sExt))) != $sExt) {
                        $sName .= '.' . $sExt;
                    }
                    // names generated
                    if (isset($_POST['options']['automatic-names']) || isset($_POST['options']['create-fragments'])) {
                        $sIteration = str_pad(($i+1), 2, '0', STR_PAD_LEFT);
                        $sName = $sAutoName . $sIteration . '.' . $sExt;
                    }

                    // file to write
                    // $path = TMP_DIR . '/'.md5($url);
                    // $fw = fopen($path, 'w');
                    // fwrite($fw, $content);
                    // fclose($fw);

                    // $dest = $sCompletePath . '/'.$sName. '';
                    // if (copy($path, $dest)) {
                    //     unlink($path);    
                    // }
                    $dest = $sCompletePath . '/'.$sName. '';
                    $fw = fopen($dest, 'w');
                    fwrite($fw, $content);
                    fclose($fw);

                    $i++;
                    $aFiles['ok'][] = $sName;
                }
            }
        }
        return $aFiles;
    }

    private static function _handleFileDelete($bHardDelete = false) {
        if (isset($_POST['path'])) {
            $sPath = $_POST['path'];

            $sCompletePath = SITE_DIR . ($sPath == '' ? '' : '/') . str_replace(',', '/', $sPath);

            if (isset($_POST['files'])) {
                $aFiles = $_POST['files'];
                // unlink($sCompletePath . '/' . $file);
                foreach ($aFiles as $file) {
                    if ($bHardDelete) {
                        if (unlink($sCompletePath . '/' . $file)) {
                            $aDelFiles[] = $file;    
                        } else {
                            $aElseFiles[] = $file;    
                        }
                    } else {
                        if (rename($sCompletePath . '/' . $file, $sCompletePath . '/__rm__' . $file)) {
                            $aDelFiles[] = $file;
                        } else {
                            $aElseFiles[] = $file;
                        }
                    }
                }
                if (isset($aDelFiles)) {
                    if (count($aDelFiles) == 1) {
                        MessageList::raiseInfo('Plik <strong>'.implode(', ', $aDelFiles).'</strong> został usunięty.');
                    } else {
                        MessageList::raiseInfo('Pliki <strong>'.implode(', ', $aDelFiles).'</strong> zostały usunięte.');
                    }
                }
                if (isset($aElseFiles)) {
                    if (count($aElseFiles) == 1) {
                        MessageList::raiseError('Plik <strong>'.implode(', ', $aElseFiles).'</strong> nie został usunięty.');
                    } else {
                        MessageList::raiseError('Pliki <strong>'.implode(', ', $aElseFiles).'</strong> nie zostały usunięte.');
                    }
                }
            }

            if (isset($_POST['dirs'])) {
                $aDirs = $_POST['dirs'];
                foreach ($aDirs as $dir) {
                    if ($bHardDelete) {
                        if (rmdir($sCompletePath . '/' . $dir)) {
                            $aDelDirs[] = $dir;
                        } else {
                            $aElseDirs[] = $dir;
                        }
                    } else {
                        if (rename($sCompletePath . '/' . $dir, $sCompletePath . '/__rm__' . $dir)) {
                            $aDelDirs[] = $dir;
                        } else {
                            $aElseDirs[] = $dir;
                        }
                    }
                }
                if (isset($aDelDirs)) {
                    if (count($aDelDirs) == 1) {
                        MessageList::raiseInfo('Katalog <strong>'.implode(', ', $aDelDirs).'</strong> został usunięty.');
                    } else {
                        MessageList::raiseInfo('Katalogi <strong>'.implode(', ', $aDelDirs).'</strong> zostały usunięte.');
                    }
                }
                if (isset($aElseDirs)) {
                    if (count($aElseDirs) == 1) {
                        MessageList::raiseError('Katalog <strong>'.implode(', ', $aElseDirs).'</strong> nie został usunięty.');
                    } else {
                        MessageList::raiseError('Katalogi <strong>'.implode(', ', $aElseDirs).'</strong> nie zostały usunięte.');
                    }
                }
            }
        }
    }
}