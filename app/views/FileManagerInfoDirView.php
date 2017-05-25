<?php
require_once AYA_DIR.'/Core/View.php';

class FileManagerInfoDirView extends View {

	public function fill() {
		// get list of files

		// look to pub/imgs
		$sBasePath = ROOT_DIR . '/../renaissance/pub';

		$sPath = isset($_GET['path']) ? $_GET['path'] : '';

		// print_r($_GET);

		$aPath = explode(',', $sPath);
		foreach ($aPath as $pk => $path) {
			$tmp[] = $path;
			$aPathItems[$path] = implode(',', $tmp);
		}

		$sContentPath = $sBasePath . '/' . str_replace(',', '/', $sPath);

		$aContent = $this->_getDirectoryContent($sContentPath);

		$aFields = array();
		$aFields['name'] = end($aPath);

		// print_r($aPath);

		// up dir path
		if (count($tmp) > 1) {
			array_pop($tmp);
			$sUpDirPath = '/' . implode(',', $tmp);
		} else {
			$sUpDirPath = '';
		}

		// counts
		$aCounts = array();
		$aCounts['dirs'] = count($aContent['dirs']) > 1 ? count($aContent['dirs']) - 1 : 0;
		$aCounts['files'] = isset($aContent['files']) ? count($aContent['files']) : 0;


		// print_r($aDirs);
		// print_r($aFiles);
		// echo $sPath;

		$this->_renderer->assign('aFields', $aFields);


		$this->_renderer->assign('sPath', $sPath);

		$this->_renderer->assign('sUpDirPath', $sUpDirPath);
		$this->_renderer->assign('aPathItems', $aPathItems);

		$this->_renderer->assign('aCounts', $aCounts);

		$this->_renderer->assign('aDirs', $aContent['dirs']);
		if (isset($aContent['files'])) {
			$this->_renderer->assign('aFiles', $aContent['files']);
		}
	}

	public function afterFill() {
		echo 'after fill info';
	}

	protected function _getDirectoryContent($path) {
		if ($handle = opendir($path)) {
			while (($file = readdir($handle)) !== false) {
				// no file, no . in name
				if (!is_file($file) && strpos($file, '.') == false) {
					if ($file != '.') {
						$aContent['dirs'][] = $file;
					}
				} else {
					$aContent['files'][] = $file;
				}
				// if (is_file($file)) {
				// 	$aContent['files'][] = $file;
				// } else {
				// 	if ($file != '.') {
				// 		$aContent['dirs'][] = $file;
				// 	}
				// }
				$aContent['all'] = $file;
			}
			closedir($handle);

			return $aContent;
		}
		return false;
	}
}

function files_in_dir($dir_path, $ext=NULL)
{
  $i=0;
  if($handle = opendir($dir_path))
  {
    while(($file = readdir($handle)) !== false)
    {
      if(isset($ext))
      {
        if(in_array(substr($file, -4, 4), $ext) && $file != '.' && $file != '..')
        {
          $aFiles[$i]['name'] = $file;
          $aFiles[$i]['size'] = filesize($dir_path.$file);
          $i++;
        }
      }
      else
      {
        if(strpos($file, '.') && $file != '.' && $file != '..')
        {
          $aFiles[$i]['name'] = $file;
          $aFiles[$i]['size'] = filesize($dir_path.$file);
          $i++;
        }
      }
    }
    closedir($handle);
  }
  return $aFiles;
}

function dirs_in_dir($dir_path, $array_excluded)
{
  $i=0;
  if($handle = opendir($dir_path))
  {
    while(($file = readdir($handle)) !== false)
    {
      // if(!strpos($file, '.') && !in_array($file, $array_excluded))
    	if (is_dir($file))
      {
        $aFiles[$i] = $file;
        $i++;
      }
    }
    closedir($handle);
  }
  return $aFiles;
}