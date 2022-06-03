<?php

namespace Transports;

/**
 * Class for CURL actions
 *
 * @author rehkz
 */
class CURL {

    /**
     * send post request
     * @param type $curl_handler curl handler from curl_init()
     * @param array $data post data to send
     * @param string $url target endpoint url
     * @return array response from target endpoint, keys: error, data 
     */
    public static function send_post_request($curl_handler, array $data = [], string $url = ''): array {
        $options = array(
            CURLOPT_POST => 1,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS => http_build_query($data)
        );
        $response = self::send_request($curl_handler, $options);
        return $response;
    }

    /**
     * send get request
     * @param type $curl_handler curl handler from curl_init()
     * @param array $data get data to send
     * @param string $url target endpoint url
     * @return array response from target endpoint, keys: error, data 
     */
    public static function send_get_request($curl_handler, array $data = [], string $url = ''): array {
        $request_url = self::build_get_query_url($url, $data);
        $options = array(
            CURLOPT_URL => $request_url,
            CURLOPT_RETURNTRANSFER => 1,
        );
        $response = self::send_request($curl_handler, $options);
        return $response;
    }

    /**
     * build query_url from api endpoint and data to send
     * @param string $url endpoint url
     * @param array $data data to glue
     * @return string builded url with get parameters
     */
    private static function build_get_query_url(string $url, array $data = []): string {
        $q_sign_position = mb_strpos($url, '?');
        if ($q_sign_position === FALSE) {
            $glue = '?';
        } elseif ($q_sign_position === (mb_strlen($url) - 1)) {
            $glue = '';
        } else {
            $glue = '&';
        }
        $request_url = $url . $glue . http_build_query($data);
        return $request_url;
    }

    /**
     * send curl request
     * @param type $curl_handler curl handler from curl_init()
     * @param array $options options for curl_setopt
     * @return array response from request exec, keys: error, data
     */
    private static function send_request($curl_handler, array $options = []): array {
        curl_setopt_array($curl_handler, $options);
        $response = [
            'error' => '',
            'data' => ''
        ];
        if (($response['data'] = curl_exec($curl_handler)) === false) {
            $response['error'] = curl_error($curl_handler);
        }
        return $response;
    }

}
