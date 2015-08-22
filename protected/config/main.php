<?php

/* yiistrap php 5.2 fix */
if (!defined('__DIR__')) {
    define('__DIR__', dirname(__FILE__));
}
/* */

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Folio Ninja',

	// preloading 'log' component
	'preload'=>array('log'),

    // aliases
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change this if necessary
    ),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'bootstrap.behaviors.*',
        'bootstrap.components.*',
        'bootstrap.form.*',
        'bootstrap.helpers.*',
        'bootstrap.widgets.*',
	),

	'modules'=>array(
        'dashboard',
        'portfolio',
        'discover',

		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths' => array('bootstrap.gii')
		),
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),

		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
            'showScriptName' => false,
			'urlFormat'=>'path',
			'rules'=>array(
                '<_c:(site)>/index'=>'<_c>/index',
                '<_c:(site)>/captcha'=>'<_c>/captcha',
                '<_c:(site)>/<view>'=>'<_c>/page',
                'signup'=>'site/signup',
                'login'=>'site/login',
                'logout'=>'site/logout',
				'contact'=>'site/contact',

                '<_m:(dashboard)>'=>'<_m>/default/index',
                '<_m:(dashboard)>/settings/<page:\w+>'=>'<_m>/default/settings',
                '<_m:(dashboard)>/settings'=>'<_m>/default/settings',
                '<_m:(dashboard)>/projects'=>'<_m>/project/index',
                '<_m:(dashboard)>/project/<id:\d+>'=>'<_m>/project/manage',
                '<_m:(dashboard)>/<_c:(project|folder|picture|video|link)>/<id:\d+>/<action:\w+>'=>'<_m>/<_c>/<action>',

                'gii'=>'gii',
                'gii/<controller:\w+>'=>'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',

                '<_m:(dashboard)>/<controller:\w+>/<action\w+>/<id:\d+>'=>'<_m>/<controller>/<action>',
                '<_m:(dashboard)>/<controller:\w+>/<action\w+>/<page:\w+>'=>'<_m>/<controller>/<action>',
                '<_m:(dashboard)>/<controller:\w+>/<action\w+>'=>'<_m>/<controller>/<action>',

                '<_m:(discover)>'=>'<_m>/default/index',
                '<_m:(discover)>/<pagination:\d+>'=>'<_m>/default/index',

                '<alias:\w+>/<action:\w+>'=>'portfolio/default/<action>',
                '<alias:\w+>/<action:\w+>/<id:\w+>'=>'portfolio/default/<action>',
                '<alias:\w+>'=>'portfolio/default/index',

                '<module:\w>/<controller:\w+>/<action\w+>'=>'<_m>/<controller>/<action>',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<page:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

			),
		),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'contactEmail'=>'support@folio.ninja',
        'uploadFolder'=>'/upload/'
	),
);
