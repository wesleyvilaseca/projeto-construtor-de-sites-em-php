<?php

namespace app\classes\supports\supports_apirequest;

trait PullApi
{
    public function pullApi($param1, $url, $data = null, $headers = false)
    {
        $curl = curl_init();
        switch ($param1) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS,  $data);
                }
                break;
            case "PUT":
                curl_setopt($curl,  CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            default:
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }


        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            //header("Location: " . URL_BASE . 'pageerror');
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }
}
