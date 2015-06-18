<?php

// uncomment the following to define a path alias
Yii::setPathOfAlias('chartjs', dirname(__FILE__) . '/../extensions/yii-chartjs');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Analytics Service',
    // preloading 'log' component
    'preload' => array(
        'log',
        'chartjs'
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'root',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'user' => array(
            'tableUsers' => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
        ),
        'rights' => array(
            // Name of the role with super user privileges.
            'superuserName' => 'Admin',
            // Name of the authenticated user role.
            'authenticatedName' => 'Authenticated',
            // Name of the user id column in the database.
            'userIdColumn' => 'id',
            // Name of the user name column in the database.
            'userNameColumn' => 'username',
            // Whether to enable authorization item business rules.
            'enableBizRule' => true,
            // Whether to enable data for business rules.
            'enableBizRuleData' => false,
            // Whether to use item description instead of name.
            'displayDescription' => true,
            // Key to use for setting success flash messages.
            'flashSuccessKey' => 'RightsSuccess',
            // Key to use for setting error flash messages.
            'flashErrorKey' => 'RightsError',
            // Whether to install rights.
            'install' => true,
            // Base URL for Rights. Change if module is nested.
            'baseUrl' => '/rights',
            // Layout to use for displaying Rights.
            'layout' => 'rights.views.layouts.main',
            // Application layout.
            'appLayout' => 'application.views.layouts.main',
            // Style sheet file to use for Rights.
            'cssFile' => 'rights.css',
            // Whether to enable installer.
            'install' => false,
            // Whether to enable debug mode.
            'debug' => false,

        ),
    ),
    // application components
    'components' => array(
        'chartjs' => array('class' => 'chartjs.components.ChartJs'),
        'user' => array(
            'class' => 'RWebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
        ),
        'authManager' => array(
//            'connectionID'=>'db',
//            'defaultRoles'=>array('Authenticated', 'Guest'),
            'class' => 'RDbAuthManager',
            'assignmentTable' => 'authassignment',
            'itemTable' => 'authitem',
            'itemChildTable' => 'authitemchild',
            'rightsTable' => 'rights',

        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
            'showScriptName' => false,
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=analytics_service',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'email_host' => 'smtp.gmail.com',
        'email_port' => '465',
        'email_SMTPSecure' => 'ssl'

    ),
);