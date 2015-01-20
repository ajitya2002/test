<?php

/* * *****************************************************************************
 * Bitbucket repository service class
 * @Author - Ajit Singh
 * Created Date: 28/01/2014 
 * *************************************************************************** */

class bitbucket {
    /* @param string $username (bitbucket repository username)
     * @param string $password (bitbucket repository password)
     * @param string $apiRepoName (bitbucket repository name)
     * @param string $issueTitle (bitbucket repository issues title)
     * @param string $issueDescription (bitbucket repository issues description)
     * 
     * @return string JSON containing [headers] and [response] received from bitbucket.
     */

    public function createIssue($username, $password, $apiRepoName, $issueTitle, $issueDescription) {

        $data = array("title" => $issueTitle, "content" => $issueDescription);
        // Build POST url:
        $dataString = '';
        foreach ($data as $key => $value) {
            $dataString .= $key . '=' . $value . '&';
        }
        rtrim($dataString, '&');
         $apiRepoUrl = "https://bitbucket.org/api/1.0/repositories/$username/$apiRepoName";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($dataString)));
        curl_setopt($ch, CURLOPT_URL, $apiRepoUrl . '/issues');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

}
