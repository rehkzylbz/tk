<?php

namespace Transports;

/**
 * Interface for Company
 *
 * @author rehkz
 */
interface ICompany {

    /**
     * 
     * @param array $data input data array from pack 
     * @return array formatted company api response, keys: price, date, error
     */
    public function get_price(array $data): array;
}
