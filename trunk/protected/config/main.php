<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	#'name'=>'ZoomTyre.ru', 	'theme'=>'simple',
	'name'=>'sevenparts.ru', 'theme'=>'23000',
	'sourceLanguage' => 'ru', 'language' => 'ru',
	'defaultController'=>'index',


	// preloading 'log' component
	#'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models.behaviors.*',
		'application.models.forms.*',
		'application.helpers.*',
		'application.components.*',
		'ext.yiiext.components.shoppingCart.*',
		'application.modules.admin.modules.autocatalog.models.*',
		'application.modules.admin.modules.trbac.models.*',
	),

	'modules'=>array(
		'admin'=>array(
			'defaultController'=>'Orders',
			'layout'=>'main',
			'modules'=>array(
				'trbac',
				'autocatalog',
			),
		),
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		'shoppingCart'=>array(
			'class'=>'ext.yiiext.components.shoppingCart.EShoppingCart',
		),
		'file'=>array(
			'class'=>'EFile',
		),
		'image'=>array(
			'class'=>'EImage2',
		),
		'mail' => array(
 			'class' => 'ext.yii-mail.YiiMail',
 			'transportType' => 'php',
 			'viewPath' => 'application.mail',
 			'logging' => true,
 			'dryRun' => false
 		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'guestName'=>'Гость',
			'loginUrl'=>array('index/login'),
		),

		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'connectionID'=>'db',
			'itemTable'=>'auth_item',
			'itemChildTable'=>'auth_itemchild',
			'assignmentTable'=>'auth_assignment',
			'defaultRoles'=>array('guest'),
		),

		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
		
				// modules
				'<module:(gii|admin)>'=>'<module>',
				## !!!!!!!
				# это правило нужно для правильно работы виджета menu2
				'<module:(admin)>/<action:(stub)>'=>'<module>/parts/<action>',
				## !!!!!!!
				'<module:(gii|admin)>/<controller:\w+>'=>'<module>/<controller>',
				'<module:(gii|admin)>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
				'<module:(gii|admin)>/<submodule:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<submodule>/<controller>/<action>',
				
				'<action:(login|logout|captcha)>'=>array('index/<action>', 'urlSuffix'=>'.html', 'append'=>true),

				'catalog/<action:(tyres|disks)>/<aliasProducer:([\w-\.]+)>/<aliasModel:([\w-\.]+)>/<aliasSize:([\d]+)-[\w-\.]+>' => array('catalog/<action>', 'urlSuffix'=>'.html'),
				'catalog/<action:(tyres|disks)>/<aliasProducer:([\w-\.]+)>/<aliasModel:([\w-\.]+)>' => array('catalog/<action>', 'urlSuffix'=>'.html'),
				'catalog/<action:(tyres|disks)>/<aliasProducer:([\w-\.]+)>' => array('catalog/<action>', 'urlSuffix'=>'.html'),

				'<controller:(catalog|selection)>/<action:(tyres|disks)>' => array('<controller>/<action>', 'urlSuffix'=>'.html'),

				'<controller:(articles|news)>/<action:(view|print)>/<alias>' => array('<controller>/<action>', 'urlSuffix'=>'.html'),
		
				'<controller:(users)>/<action:(view|edit|orders|comments)>/<username:[^\/]+>'=>array('<controller>/<action>', 'urlSuffix'=>'.html'),
				'<controller:(managers)>/<action:(view)>/<username:[^\/]+>'=>array('<controller>/<action>', 'urlSuffix'=>'.html'),

				'<view:\w+>'=>array('index/page', 'urlSuffix'=>'.html'),
				#'<controller:\w+>'=>array('<controller>/index', 'urlSuffix'=>'.html'),
				#'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>array('<controller>/<action>', 'urlSuffix'=>'.html'),
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=u1427748_zoom',
			'emulatePrepare' => true,
			'username' => 'u1427748_zoom',
			'password' => '123',
			'charset' => 'utf8',
			#'enableProfiling' => true,
		),
		'errorHandler'=>array(
            'errorAction'=>'index/error',
        ),
        		/*
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(

				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
				),

			),
		),
						*/
		/*
'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CProfileLogRoute',
                    'enabled' => true,
                ),
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'trace',
                    'categories' => 'system.db.CDbCommand',
                    'enabled' => true,
                ),
            ),
        ),
		 */
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'email'=>'info@sevenparts.ru',
		#'email'=>'info@zoomtyre.ru',
		'articlesOnPage' => 10,
		'newsOnPage' => 10,
	
		'watermark'=>'/images/watermark/logo.png',
		'watermark'=>'/themes/23000/images/watermark/logo.png',
		'small_watermark'=>'/images/watermark/smalllogo.jpg',
		'disk.emptyPhoto.tb' => '/images/empty/tb_disk.jpg',
		'disk.emptyPhoto' => '/images/empty/disk.jpg',
		'tyre.emptyPhoto.tb' => '/images/empty/tb_tyre.jpg',
		'tyre.emptyPhoto' => '/images/empty/tyre.png',
		'addthisAPI'=>'http://s7.addthis.com/js/250/addthis_widget.js#username=ra-4d6b94e95c82fb63',
		'adminEmail'=>'webmaster@zoomtyre.ru',

		'salt'=>'APfjW0wBAAAACukbEQIADCrwkP1_6DV028KtsLgXG_-nmk0AAAAAAAAAAABK-4ouombj7ksyDx6UDWmFtLADOQ==',
		'captchaAction'=>'index/captcha',
		#'yandexApiKey' => 'AJAzmE0BAAAAZMd5RAIAQUjlbcEOaZXyuTp3hCqZx72L3GcAAAAAAAAAAAChcqfmyRayvrFDHjfbf53VPQV0_w==',
		'yandexApiKey' =>'ADc0mE0BAAAA9awScQIA0Qh79JzXGY6SlNJiNZMUysQatG8AAAAAAAAAAADhCvld1lNvDI_9O5mWgon6oY7Hnw==',
		'phone'=>'+7 (495) 792-2598',
		'address'=>'Большой Полуярославский пер., д. 18',
	),
);


function d($var = false, $showHtml = false, $showFrom = true){
	if ($showFrom) {
			$calledFrom = debug_backtrace();
			echo '<strong>' . $calledFrom[0]['file'] . '</strong>';
			echo ' (line <strong>' . $calledFrom[0]['line'] . '</strong>)';
	}
	echo "\n<pre class=\"debug\">\n";
	
	$var = print_r($var, true);
	if ($showHtml) {
		$var = str_replace('<', '&lt;', str_replace('>', '&gt;', $var));
	}
	echo $var . "\n</pre>\n\n";
}