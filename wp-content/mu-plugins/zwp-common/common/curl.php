<?php

class ZwpCurl
{

    public static function getCurl($url, $timeout = 30)
    {
        $parseUrl = parse_url($url);
        // fragment
        if (!empty($parseUrl['fragment']) && preg_match('|^!|', $parseUrl['fragment']) != 0) {
            $path = $parseUrl['path'];
            if ($path == '/') {
                $path = '';
            }
            $flagment = preg_replace('|^!|', '', $parseUrl['fragment']);
            $url = $parseUrl['host'] . $path . '?_escaped_fragment_=' . $flagment;
        }

        // init curl
        $ch = curl_init($url);

        // set curl options
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookiefile');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

        // SSL disable
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $header = array();
        $header[0] = 'Accept: text/xml,application/xml,application/xhtml+xml,';
        $header[0] .= 'text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5';
        $header[] = 'Cache-Control: max-age=0';
        $header[] = 'Connection: keep-alive';
        $header[] = 'Keep-Alive: 300';
        $header[] = 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7';
        $header[] = 'Accept-Language: en-us,en;q=0.5';
        $header[] = 'Pragma: '; // browsers keep this blank. 

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        // get url
        $returnValue = curl_exec($ch);

        // error check
        if (curl_errno($ch)) {
            $curlErrorStr = curl_error($ch);
            syslog(LOG_ERR, $curlErrorStr);
            syslog(LOG_ERR, 'Curl error(' . $url . '): ' . $curlErrorStr);
            curl_close($ch);
            return false;
        }
        // content-typeが取得出来ないまたは、text/htmlでない場合はエラーとする
        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        if (empty($contentType) || strpos($contentType, 'text/html') === false) {
            syslog(LOG_ERR, 'Curl error(' . $url . '): ' . "CONTENT_TYPE_ERROR");
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        return $returnValue;
    }
}

?>