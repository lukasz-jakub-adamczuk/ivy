<?php

date_default_timezone_set('Europe/Warsaw');
setlocale(LC_ALL, 'pl_PL');

if ($_SERVER['HTTP_HOST'] == 'localhost') {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require_once 'config/local.php';
}
if ($_SERVER['HTTP_HOST'] == 'admin.squarezone.dev') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once 'config/vhost.php';
}
if ($_SERVER['HTTP_HOST'] == 'dev.admin.squarezone.pl') {
	error_reporting(0);
	require_once 'config/dev.php';
}
if ($_SERVER['HTTP_HOST'] == 'admin.squarezone.pl') {
	error_reporting(0);
	require_once 'config/production.php';
}


require_once AYA_DIR.'/Core/Time.php';

Time::start();


require_once AYA_DIR.'/Core/Logger.php';

$sLogFile = LOG_DIR.'/visits.log';

$sHttpReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$sRequestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$sRemoteAddr = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
$sHttpUserAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';

$aLogs[] = array(date('c'), $sHttpReferer, $sRequestUri, $sRemoteAddr, $sHttpUserAgent);


Logger::write($sLogFile, $aLogs);

// begin all
require_once AYA_DIR.'/Core/Starter.php';

Starter::init();

require_once AYA_DIR.'/Core/Debug.php';

require_once AYA_DIR.'/Core/Db.php';
require_once AYA_DIR.'/Core/Dao.php';
require_once AYA_DIR.'/Core/User.php';
require_once AYA_DIR.'/Core/Navigator.php';
require_once AYA_DIR.'/Core/MessageList.php';
require_once AYA_DIR.'/Core/Text.php';

require_once AYA_DIR.'/Core/DataStorage.php';

require_once AYA_DIR.'/Core/Router.php';

require_once CTRL_DIR.'/FrontController.php';
require_once CTRL_DIR.'/CrudController.php';

require_once AYA_DIR.'/Management/IndexView.php';


require_once AYA_DIR.'/Helpers/NavigationManager.php';
require_once AYA_DIR.'/Helpers/Breadcrumbs.php';
require_once AYA_DIR.'/Helpers/ValueMapper.php';
require_once AYA_DIR.'/Helpers/MassActions.php';
require_once AYA_DIR.'/Helpers/RelatedActions.php';
require_once AYA_DIR.'/Helpers/Lock.php';


require_once APP_DIR.'/helpers/PostmanNotification.php';
require_once APP_DIR.'/helpers/CommentsNotifier.php';

Router::init();

// Debug::showLogs();

// Time::show();

