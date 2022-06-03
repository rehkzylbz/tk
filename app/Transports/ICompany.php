<?php

namespace Transports;

/**
 * Interface for Company
 *
 * @author rehkz
 */
interface ICompany {

    public function get_price(array $data): array;
}
