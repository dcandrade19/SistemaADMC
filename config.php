<<<<<<< HEAD
<?php
	define('DB_NAME', 'bd_sistema');

	define('DB_USER', 'root');

	define('DB_PASSWORD', '');

	define('DB_HOST','localhost');
	
	define('CHARSET', 'utf8');

	if(!defined('ABSPATH')){
		define('ABSPATH', dirname(__FILE__) . '/');
	}

	if(!defined('BASEURL')){
		define('BASEURL', '/sistemaadmc/');
	}

	if(!defined('DBAPI')){
		define('DBAPI', ABSPATH .'model/database.php');
	}
	
	define('HEADER_TEMPLATE', ABSPATH . 'view/header.php');
	define('FOOTER_TEMPLATE', ABSPATH . 'view/footer.php');

=======
<?php
	define('DB_NAME', 'bd_sistema');

	define('DB_USER', 'root');

	define('DB_PASSWORD', '');

	define('DB_HOST','localhost');
	
	define('CHARSET', 'utf8');

	if(!defined('ABSPATH')){
		define('ABSPATH', dirname(__FILE__) . '/');
	}

	if(!defined('BASEURL')){
		define('BASEURL', '/sistemaadmc/');
	}

	if(!defined('DBAPI')){
		define('DBAPI', ABSPATH .'model/database.php');
	}
	
	define('HEADER_TEMPLATE', ABSPATH . 'view/header.php');
	define('FOOTER_TEMPLATE', ABSPATH . 'view/footer.php');

>>>>>>> 383c10ba9d48ad89772a8dd6c1115cb2aaa3efe1
?>