<?php

/* * ***************************************************************************
 * Lib create issues in Github and Bitbucket repository
 * @Author - Ajit Singh
 * Created Date: 28/01/2014 
 * *************************************************************************** */
include_once "request_send_api.php";
$argv = $GLOBALS['argv'];
$arguments = getopt("u:p:");
if (count($arguments) > 0 and count($argv) > 0) {
    $serviceObj = new requestSendApi(5, 6, 7); // 5= url, 6=title, 7= description 
    $response = $serviceObj->requestApi($argv, $arguments);
    
    echo $response; // displaye JSON reponse from github/bitbucket on CLI
} else {
    echo "Kindly provide username, password, repository API url, issue title and description.";
}

