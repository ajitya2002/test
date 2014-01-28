<?php

/* * ***************************************************************************
 * requestSendApi extends repositoryFactory class to call repository services.
 * Author - Ajit Singh
 * Created Date: 28/01/2014 
 * *************************************************************************** */

include_once "repository_factory.php";

class requestSendApi extends repositoryFactory {
    /* @param array $argv 
     * @param array $arguments
     * @return string JSON containing [headers] and [response] received from Github.
     */

    public function requestApi($argv, $arguments) {
        try {
            $argv = $this->arrayKeyCheck($argv);
            $paraArray = array(
                "apiRepoUrl" => 5,
                "issueTitle" => 6,
                "issueDescription" => 7
            );
            if (empty($arguments['u'])) {
                echo "Username required";
            } elseif (empty($arguments['p'])) {
                echo "Password  required";
            } elseif (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $argv[$paraArray['apiRepoUrl']])) {
                echo "Invalid url";
            } elseif (empty($argv[$paraArray['issueTitle']])) {
                echo "Title required";
            } elseif (empty($argv[$paraArray['issueDescription']])) {
                echo "Description Required";
            } else {
                return $this->callService($arguments['u'], $arguments['p'], $argv[$paraArray['apiRepoUrl']], $argv[$paraArray['issueTitle']], $argv[$paraArray['issueDescription']]);
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /* @param string $username (github/bitbucket repository username)
     * @param string $password (github/bitbucket repository password)
     * @param string $apiRepoUrl (https://bitbucket.org/api/1.0/repositories/:username/:repository, https://api.github.com/repos/:username/:repository)
     * @param string $issueTitle (github/bitbucket repository issues title)
     * @param string $issueDescription (github/bitbucket repository issues description)
     * 
     * @return string JSON containing [headers] and [response] received from Bitbucket or Github.
     */

    private function callService($username, $password, $apiRepoUrl, $issueTitle, $issueDescription) {
        if (strpos($apiRepoUrl, 'github') !== false) {
            $repositoryObj = $this->getInstance('github');
            $response = $repositoryObj->createIssue($username, $password, $apiRepoUrl, $issueTitle, $issueDescription);
            return $response;
        } elseif (strpos($apiRepoUrl, 'bitbucket') !== false) {
            $repositoryObj = $this->getInstance('bitbucket');
            $response = $repositoryObj->createIssue($username, $password, $apiRepoUrl, $issueTitle, $issueDescription);
            return $response;
        } else {
            echo "No Service found.";
        }
    }

    /* @param array $output 
     * @return array $output.
     */

    private function arrayKeyCheck($output = array()) {

        $keys = array_keys($output);
        $desired_keys = array(5, 6, 7);
        foreach ($desired_keys as $desired_key) {
            if (in_array($desired_key, $keys))
                continue;  // already set
            $output[$desired_key] = '';
        }
        return $output;
    }

}
