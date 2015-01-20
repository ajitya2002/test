<?php

/* * ***************************************************************************
 * Lib create issues in Github and Bitbucket repository
 * @Author - Ajit Singh
 * Created Date: 28/01/2014 
 * Updated Date: 20/01/2015
 * *************************************************************************** */
include_once "request_send_api.php";

use Request\Send\Api\requestSendApi as requestSendApi;


echo "Enter Service Name like github or bitbucket\n";
$service = fgets(STDIN);
echo "Enter User Name\n";
$username = fgets(STDIN);
echo "Enter Your Password\n";
 system('stty -echo');
$password = rtrim(fgets(STDIN), PHP_EOL);
 system('stty echo');
echo PHP_EOL;
echo "Enter Your Repository Name\n";
$apiRepoName = fgets(STDIN);
echo "Enter Issue Title\n";
$title = fgets(STDIN);
echo "Enter Issue Desc\n";
$desc = fgets(STDIN);

$serviceObj = new requestSendApi($service, $username, $password, $apiRepoName, $title, $desc);

$response = $serviceObj->requestApi();

echo $response; // displaye JSON reponse from github/bitbucket on CLI

