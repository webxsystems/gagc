<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 2/28/2020
 * Time: 12:24 PM
 */

//require '/opt/bitnami/apache2/htdocs/repo/vendor/autoload.php';
//require '/opt/bitnami/apache2/htdocs/repo/config.class.php';

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.class.php';


$configParms = new Config();
$dbConfig = $configParms->get('db');
@parse_str(http_build_query($dbConfig));

$db = new Mysqlidb ($host, $user, $pwd, $database);

$appSettings = $db->getOne('appsettings');
@parse_str(http_build_query($appSettings));

$rateConfig = $configParms->get('pricing');
@parse_str(http_build_query($rateConfig));

