<?php

/* * ***************************************************************************
 * requestSendApi extends repositoryFactory class to call repository services.
 * @Author - Ajit Singh
 * Created Date: 28/01/2014 
 * *************************************************************************** */

namespace Request\Send\Api;

use Repository\Factory\repositoryFactory as repositoryFactory;

include_once "repository_factory.php";

class requestSendApi extends repositoryFactory {

    private $apiRepoName;
    private $issueTitlePos;
    private $issueDescriptionPos;
    private $apiUser;
    private $apiPass;
    private $service;

    /* @param string $service (github/bitbucket)
     * @param string $apiUser 
    /* @param string $apiPass
    /* @param string $apiRepoName
     * @param string $issueTitlePos
     * @param string $issueDescriptionPos
     * Parameterised constructor
     */

    public function __construct($service, $apiUser, $apiPass, $apiRepoName, $issueTitlePos, $issueDescriptionPos) {
        $this->service = $service;
        $this->apiUser = $apiUser;
        $this->apiPass = $apiPass;
        $this->apiRepoName = $apiRepoName;
        $this->issueTitlePos = $issueTitlePos;
        $this->issueDescriptionPos = $issueDescriptionPos;
    }

    /*
     * @return string JSON containing [headers] and [response] received from Github.
     */

    public function requestApi() {
        try {

            if (empty($this->apiUser)) {
                echo "Username required";
            } elseif (empty($this->apiPass)) {
                echo "Password  required";
            } elseif (empty($this->apiRepoName)) {
                echo "Repository Name Required";
            } elseif (empty($this->issueTitlePos)) {
                echo "Title required";
            } elseif (empty($this->issueDescriptionPos)) {
                echo "Description Required";
            } else {
                return $this->callService($this->service, $this->apiUser, $this->apiPass, $this->apiRepoName, $this->issueTitlePos, $this->issueDescriptionPos);
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /* @param string $service (github/bitbucket)
    /* @param string $username (github/bitbucket repository username)
     * @param string $password (github/bitbucket repository password)
     * @param string $apiRepoName (github/bitbucket repository name)
     * @param string $issueTitle (github/bitbucket repository issues title)
     * @param string $issueDescription (github/bitbucket repository issues description)
     * 
     * @return string JSON containing [headers] and [response] received from Bitbucket or Github.
     */

    private function callService($service, $username, $password, $apiRepoName, $issueTitle, $issueDescription) {

        if (trim($service) == "github") {
            $repositoryObj = $this->getInstance('github');
            return $repositoryObj->createIssue(trim($username), trim($password), trim($apiRepoName), trim($issueTitle), trim($issueDescription));
        } else if (trim($service) == "bitbucket") {
            $repositoryObj = $this->getInstance('bitbucket');
            return $repositoryObj->createIssue(trim($username), trim($password), trim($apiRepoName), trim($issueTitle), trim($issueDescription));
        } else {
            echo "No Service found.";
        }
    }

   

}
