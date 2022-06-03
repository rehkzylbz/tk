<?php

namespace Transports;

/**
 * absctract class Company
 *
 * @author rehkz
 */
abstract class Company implements ICompany {

    protected $_api_url = '';
    protected $_fields = [];
    protected $_settings = [];

    /**
     * instance concrete company object
     * @param string $company_name classname for concrete company
     * @param array $company_config company options array, keys: url, fields
     * @return Company concrete company object
     */
    public static function build(string $company_name, array $company_config): Company {
        $classname = 'Transports\\' . $company_name;
        $company = new $classname;
        $company->_api_url = $company_config['api_url'];
        $company->_fields = $company_config['fields'];
        if (isset($company_config['settings'])) {
            $company->_settings = $company_config['settings'];
        }
        return $company;
    }

    /**
     * get price from company api
     * @param type $data input data array from pack 
     * @return array formatted company api response, keys: price, date, error
     */
    public abstract function get_price(array $data): array;

    /**
     * translate pack data to company format
     * @param array $data fields from sended form data
     * @return array translated data for request to api
     */
    protected function format_request_data(array $data): array {
        $request_data = [];
        foreach ($this->_fields as $request_field => $data_field) {
            $request_data[$request_field] = $data[$data_field];
        }
        return $request_data;
    }

    /**
     * get response from company source
     * @param array $data data array sending to company api
     * @return array company api response
     */
    protected function get_response(array $data): array {
        return [];
    }

    /**
     * translate response data to uniform format
     * @param string $response company api response json to format
     * @return array formatted response, keys: price, date, error
     */
    protected function format_response(array $response): array {
        return [];
    }

}
