<?php

/* * ***************************************************************************
 * Lib create issues in Github and Bitbucket repository
 * Author - Ajit Singh
 * Created Date: 28/01/2014 
 * *************************************************************************** */
include_once "request_send_api.php";
$serviceObj = new requestSendApi();
$argv = $GLOBALS['argv'];
$arguments = getopt("u:p:");
if (count($arguments) > 0 and count($argv) > 0) {
    $response = $serviceObj->requestApi($argv, $arguments);
    print_r($response);
} else {
    echo "Kindly provide username, password, repository API url, issue title and description.";
}

