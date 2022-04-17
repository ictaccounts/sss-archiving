<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'SSS Archiving System',

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
	),

	'modules' => array(
		// uncomment the following to enable the Gii tool

		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '0pt1m7s',
			//If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => false, //array('127.0.0.1', '192.168.0.103', '192.168.0.116', '192.168.0.101', '192.168.0.111', '192.168.0.158',"192.168.0.167"),
			'generatorPaths' => array('bootstrap.gii',),
		),

	),

	// application components
	'components' => array(

		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		),



		'db' => array(
			'connectionString' => 'mysql:host=127.0.0.1; dbname=sss-archiving',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),


		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => YII_DEBUG ? null : 'site/error',
		),

		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
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
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'webmaster@example.com',
	),
);
