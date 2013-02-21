<?php

class Ga {

    public static function hit($account_id) {
        $id = (isset($_SERVER["HTTP_X_MXIT_USERID_R"])) ? $_SERVER["HTTP_X_MXIT_USERID_R"] : uniqid();
        $visitor_id = "0x" . substr(md5($id), 0, 16);

        $domain_name = (isset($_SERVER["SERVER_NAME"]) ? $_SERVER["SERVER_NAME"] : "");
        $document_referer = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : "-";
        $document_path = (isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : "");

        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = array_shift(explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']));
        else
            $ip = $_SERVER["REMOTE_ADDR"];

        // Capture the first three octects of the IP address and replace the forth with 0
        if (preg_match("/^([^.]+\.[^.]+\.[^.]+\.).*/", $ip, $matches))
            $ip = $matches[1] . "0";

        // Construct the gif hit url.
        $utm_url = "http://www.google-analytics.com/__utm.gif?" .
            "utmwv=4.4sh" .
            "&utmn=" . rand(0, 0x7fffffff) .
            "&utmhn=" . urlencode($domain_name) .
            "&utmr=" . urlencode($document_referer) .
            "&utmp=" . urlencode($document_path) .
            "&utmac=" . $account_id .
            "&utmcc=__utma%3D999.999.999.999.999.1%3B" .
            "&utmvid=" . $visitor_id .
            "&utmip=" . $ip
            ;

        if(!isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
            $_SERVER["HTTP_ACCEPT_LANGUAGE"] = "en";

        if(isset($_SERVER['HTTP_X_DEVICE_USER_AGENT']))
            $user_agent = $_SERVER['HTTP_X_DEVICE_USER_AGENT'];
        elseif(isset($_SERVER["HTTP_USER_AGENT"]))
            $user_agent = $_SERVER["HTTP_USER_AGENT"];
        else
            $user_agent = "";

        $c = curl_init();

        curl_setopt($c, CURLOPT_URL, $utm_url);
        curl_setopt($c, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept-Language: '.$_SERVER["HTTP_ACCEPT_LANGUAGE"]));

        $result = curl_exec($c);
        $status = curl_getinfo($c, CURLINFO_HTTP_CODE);

        curl_close($c);

    } // hit

} // Ga
