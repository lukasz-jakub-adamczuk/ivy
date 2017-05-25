<?php
require_once AYA_DIR . '/Core/Folder.php';

class DevController extends CrudController {

	public function indexAction() {
		// require_once APP_DIR . '/../../XhtmlTable/Aya/Yaml/AyaYamlLoader.php';
		
		// $file = APP_DIR . '/todo.yml';
		// $cache = APP_DIR . '/tmp/todo.cache';
		// if (file_exists($cache)) {
		// 	$aList = unserialize(file_get_contents($cache));
		// } else {
		// 	if (file_exists($file)) {
		// 		$aList = AyaYamlLoader::parse($file);
		// 	}
		// }

		// $this->_renderer->assign('aList', $aList);
		

		// $aCounts = array();
		// foreach ($aList as $tk => $tasks) {
		// 	if (is_array($tasks)) {
		// 		$aCounts[$tk] = count($tasks);
		// 	}
		// }

		// $this->_renderer->assign('aCounts', $aCounts);
		echo 'DevIndex';
	}

	public function todoInsertAction() {
		if (!empty($_POST['task'])) {
			require_once APP_DIR . '/../../XhtmlTable/Aya/Yaml/AyaYamlLoader.php';
		
			$file = APP_DIR . '/todo.yml';
			$cache = APP_DIR . '/tmp/todo.cache';
			if (file_exists($cache)) {
				$aList = unserialize(file_get_contents($cache));
			} else {
				if (file_exists($file)) {
					$aList = AyaYamlLoader::parse($file);
				}
			}

			$aList['todo'][] = $_POST['task'];
			
			file_put_contents($cache, serialize($aList));

			$this->actionForward('index', $this->_ctrlName, true);
		}
	}

	public function todoDoingAction() {
		if (isset($_POST['ids'])) {
			$aIds = $_POST['ids'];

			if (count($aIds) > 0) {
				$cache = APP_DIR . '/tmp/todo.cache';
				if (file_exists($cache)) {
					$aList = unserialize(file_get_contents($cache));
				}

				foreach ($aList['todo'] as $tk => $task) {
					if (in_array($task, $aIds)) {
						unset($aList['todo'][$tk]);
					}
				}

				foreach ($aIds as $task) {
					if (in_array($task, $aList['todo'])) {
						// to remove
					}
					$aList['doing'][] = $task;
				}

				file_put_contents($cache, serialize($aList));

				$this->actionForward('index', $this->_ctrlName, true);
			}
		}
	}

	public function todoDoneAction() {
		if (isset($_POST['ids'])) {
			$aIds = $_POST['ids'];

			if (count($aIds) > 0) {
				$cache = APP_DIR . '/tmp/todo.cache';
				if (file_exists($cache)) {
					$aList = unserialize(file_get_contents($cache));
				}

				foreach ($aList['doing'] as $tk => $task) {
					if (in_array($task, $aIds)) {
						unset($aList['doing'][$tk]);
					}
				}

				foreach ($aIds as $task) {
					if (in_array($task, $aList['doing'])) {
						// to remove
					}
					$aList['done'][] = $task;
				}

				file_put_contents($cache, serialize($aList));

				$this->actionForward('index', $this->_ctrlName, true);
			}
		}
	}

	public function clearNavigatorAction() {
		unset($_SESSION['_nav_']);
	}

	public function clearUserAction() {
		unset($_SESSION['user']);
	}

	public function importTextsAction() {
		$sPath = ROOT_DIR . '/../renaissance/texts';

		$aUrlsToConvertTexts = array();

		$aExclude = array('.', '..', '.DS_Store');

		// articles
		$aArticles = Folder::getContent($sPath . '/article', false, $aExclude);

		// print_r($aArticles['dirs']);

		
		foreach ($aArticles['dirs'] as $ak => $art) {
			$aTmp = Folder::getContent($sPath . '/article/' . $art['name'], false, $aExclude);
			$aTexts[$art['name']] = $aTmp['files'];
		}
		foreach ($aTexts as $gk => $game) {
			foreach ($game as $tk => $text) {
				$aParts = explode('.', $text['name']);
				$sSlug = $aParts[0];
				$sCategory = $gk;
				$sContent = file_get_contents($sPath . '/article/' . $gk . '/' . $text['name']);

				$sql = 'SELECT a.id_article
						FROM article a 
						LEFT JOIN article_category ac ON(ac.id_article_category=a.id_article_category) 
						WHERE ac.slug="'.$sCategory.'" AND a.slug="'.$sSlug.'" ';

				// echo $sql;

				// read
				$oArticleEntity = Dao::entity('article');
				$oArticleEntity->query($sql);
				$aArticle = $oArticleEntity->getFields();

				if (isset($aArticle['id_article'])) {

					// save
					$oArticleEntity = Dao::entity('article', $aArticle['id_article'], 'id_article');

					// print_r($aArticle);
					if ($aParts[1] == 'md') {
						// if ($oArticleEntity->getField('markdown') == '') {
							$oArticleEntity->setField('markdown', $sContent);
							$oArticleEntity->setField('markup', '');
						// }
					}
					if ($aParts[1] == 'html') {
						// if ($oArticleEntity->getField('markdown') == '') {
							$oArticleEntity->setField('markdown', $sContent);
							$oArticleEntity->setField('markup', $sContent);
						// }
					}
					$oArticleEntity->setField('verified', 1);
					$oArticleEntity->update();

					$aFiles[$text['name']] = $aArticle['id_article'];
					$aUrlsToConvertTexts[] = BASE_URL . '/article/' . $aArticle['id_article'];
				}
			}
		}

		// stories
		$aStories = Folder::getContent($sPath . '/story', false, $aExclude);

		// print_r($aStories);

		$aTexts = array();
		foreach ($aStories['dirs'] as $ak => $art) {
			$aTmp = Folder::getContent($sPath . '/story/' . $art['name'], false, $aExclude);
			$aTexts[$art['name']] = $aTmp['files'];
		}
		foreach ($aTexts as $gk => $game) {
			foreach ($game as $tk => $text) {
				$aParts = explode('.', $text['name']);
				$sSlug = $aParts[0];
				$sCategory = $gk;
				$sContent = file_get_contents($sPath . '/story/' . $gk . '/' . $text['name']);

				$sql = 'SELECT a.id_story
						FROM story a 
						LEFT JOIN story_category ac ON(ac.id_story_category=a.id_story_category) 
						WHERE ac.slug="'.$sCategory.'" AND a.slug="'.$sSlug.'" ';

				// read
				$oArticleEntity = Dao::entity('story');
				$oArticleEntity->query($sql);
				$aArticle = $oArticleEntity->getFields();

				// save
				$oArticleEntity = Dao::entity('story', $aArticle['id_story'], 'id_story');

				// print_r($aArticle);
				if ($aParts[1] == 'md') {
					$oArticleEntity->setField('markdown', $sContent);
					$oArticleEntity->setField('markup', '');
				}
				if ($aParts[1] == 'html') {
					$oArticleEntity->setField('markdown', $sContent);
					$oArticleEntity->setField('markup', $sContent);
				}
				$oArticleEntity->setField('verified', 1);
				$oArticleEntity->update();

				$aFiles[$text['name']] = $aArticle['id_story'];
				$aUrlsToConvertTexts[] = BASE_URL . '/story/' . $aArticle['id_story'];
			}
		}

		// print_r($aFiles);

		// file_put_contents(ROOT_DIR . '/pub/urls-to-convert-texts.json', json_encode($aUrlsToConvertTexts));
		file_put_contents(TMP_DIR . '/urls-to-convert-texts.json', json_encode($aUrlsToConvertTexts));
	}

	public function setCategoryCreationDateAction() {
		$sql = 'SELECT a.id_article, a.creation_date, a.id_article_category
				FROM article a
				LEFT JOIN article_comment ac ON (a.id_article=ac.id_article)
				GROUP BY a.id_article_category';

		$db = Db::getInstance();

		$aDates = $db->getArray($sql, 'id_article_category');

		$sql = '';
		foreach ($aDates as $row) {
			// $oEntity = Dao::entity
			$sql = 'UPDATE article_category SET creation_date="'.$row['creation_date'].'" WHERE id_article_category="'.$row['id_article_category'].'";';
			$db->execute($sql);
		}

		// $db->execute($sql);
	}

	public function setArticleCreationDateAction() {
		$sql = 'SELECT a.id_article, MIN(ac.creation_date) c_date, a.creation_date a_date
				FROM article_comment ac
				LEFT JOIN article a
				ON (a.id_article=ac.id_article)
				GROUP BY a.id_article';

		$db = Db::getInstance();

		$aDates = $db->getArray($sql, 'id_article');

		$sql = '';
		foreach ($aDates as $row) {
			if ($row['a_date'] > $row['c_date']) {
			// 	$sDate = $row['a_date'];
			// } else {
				$sDate = $row['c_date'];
				$sql = 'UPDATE article SET creation_date=SUBTIME("'.$sDate.'", "01:12:23") WHERE id_article="'.$row['id_article'].'";';
				$db->execute($sql);
			}
		}


	}

	public function setStoryCreationDateAction() {
		$sql = 'SELECT s.id_story, MIN(sc.creation_date) c_date, s.creation_date s_date
				FROM story_comment sc
				LEFT JOIN story s
				ON (s.id_story=sc.id_story)
				GROUP BY s.id_story';

		$db = Db::getInstance();

		$aDates = $db->getArray($sql, 'id_story');

		$sql = '';
		foreach ($aDates as $row) {
			if ($row['s_date'] > $row['c_date']) {
			// 	$sDate = $row['s_date'];
			// } else {
				$sDate = $row['c_date'];
				$sql = 'UPDATE story SET creation_date=SUBTIME("'.$sDate.'", "01:12:23") WHERE id_story="'.$row['id_story'].'";';
				$db->execute($sql);
			}
			
		}


	}

	public function getCreationDateAction() {
		$this->_sContentType = 'json';

		// print_r($_GET);

		$sType = isset($_GET['path']) ? $_GET['path'] : 'news';

		if ($sType == 'user') {
			$sql = 'SELECT a.id_'.$sType.', a.register_date creation_date
					FROM '.$sType.' a
					ORDER BY a.id_'.$sType.'';			
		} elseif ($sType == 'article') {
			$sql = 'SELECT a.id_'.$sType.', a.creation_date
					FROM '.$sType.' a
					GROUP BY a.id_'.$sType.'
					ORDER BY a.id_'.$sType.'';
		} else {
			$sql = 'SELECT a.id_'.$sType.', a.creation_date
					FROM '.$sType.' a
					ORDER BY a.id_'.$sType.'';
		}

		$db = Db::getInstance();

		$aDates = $db->getArray($sql, 'id_'.$sType);

		


		foreach ($aDates as $row) {
			$aJson[] = $row['creation_date'];
		}

		echo json_encode($aJson);

	}
}