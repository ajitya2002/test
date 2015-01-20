<?php

/* * *****************************************************************************
 * Github repository service class
 * @Author - Ajit Singh
 * Created Date: 27/01/2014 
 * Updated Date: 20/01/2015
 * *************************************************************************** */

class github {
    /* @param string $username (github repository username)
     * @param string $password (github repository password)
     * @param string $apiRepoName (github repository name)
     * @param string $issueTitle (github repository issues title)
     * @param string $issueDescription (github repository issues description)
     * 
     * @return string JSON containing [headers] and [response] received from Github.
     */

    public function createIssue($username, $password, $apiRepoName, $issueTitle, $issueDescription) {

        /* $agent for window environment */
        $agent = '(Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311';
        $data = array("title" => $issueTitle, "body" => $issueDescription);
        $dataString = json_encode($data);
        $apiRepoUrl= "https://api.github.com/repos/$username/$apiRepoName";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, $apiRepoUrl . '/issues');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

}
