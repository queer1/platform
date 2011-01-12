<?php
require('./includes/constants.php');
$pages_path = ADMIN_BASE_PATH . '/includes/pages/';

// grab path from .htaccess redirect
if ($_REQUEST['p']) {
	define('REQUEST_STRING', str_replace('/','_',trim($_REQUEST['p'],'/')));
	$requested_filename = REQUEST_STRING.'.php';
} else {
	define('REQUEST_STRING','');
	$requested_filename = 'dashboard.php';
}

include_once(SEED_PATH);

if (isset($_POST['login'])) {
	if ($_POST['login'] == 'sure') {
		$_SESSION['seed_admin_login'] = true;
	}
}

if ($_SESSION['seed_admin_login'] === true) {
	if (file_exists($pages_path . 'base/' . $requested_filename)) {
		include($pages_path . 'base/' . $requested_filename);
	} else {
		include($pages_path . 'base/error.php');
	}
	include(ADMIN_BASE_PATH . '/includes/ui/default/top.php');
	if (file_exists($pages_path . 'base/content/' . $requested_filename)) {
		include($pages_path . 'base/content/' . $requested_filename);
	} else {
		include($pages_path . 'base/content/error.php');
	}
	include(ADMIN_BASE_PATH . '/includes/ui/default/bottom.php');
} else {
	include(ADMIN_BASE_PATH . '/includes/ui/default/login.php');
}
?>