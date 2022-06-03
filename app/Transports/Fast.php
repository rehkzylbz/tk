<?php

namespace Transports;

/**
 * Class Company Fast
 *
 * @author rehkz
 */
class Fast extends Company {

    /**
     * get price from company api
     * @param type $data input data array from pack 
     * @return array formatted company api response, keys: price, date, error
     */
    public function get_price(array $data): array {
        $request_data = $this->format_request_data($data);
        $response = $this->get_response($request_data);
        $answer = $this->format_response($response);
        return $answer;
    }

    /**
     * get response from company source
     * @param array $data data array sending to company api
     * @return string company api response
     */
    protected function get_response(array $data): array {
        $curl_handler = curl_init();
        $response = CURL::send_post_request($curl_handler, $data, $this->_api_url);
        curl_close($curl_handler);
        return $response;
    }

    /**
     * translate response data to uniform format
     * @param string $response company api response json to format
     * @return array formatted response, keys: price, date, error
     */
    protected function format_response(array $response): array {
        $response_data = json_decode($response['data'], true);
        if ($response['error'] !== '') {
            $response_formatted = [
                'error' => $response['error']
            ];
        } else {
            $response_formatted = [
                'price' => $response_data['price'],
                'date' => $this->_response_period_to_delivery_date((int) $response_data['period']),
                'error' => $response_data['error']
            ];
        }
        return $response_formatted;
    }

    /**
     * translate response period to real deliverydate
     * @param int $period delivery count of days from response
     * @return string calculated delivery date 
     */
    private function _response_period_to_delivery_date(int $period): string {
        if ((int) date('H') >= $this->_settings['work_hours_end']) {
            $period++;
        }
        $date = date('Y-m-d', time() + $period * 24 * 3600);
        return $date;
    }

}
