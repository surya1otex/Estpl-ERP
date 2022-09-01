<?php

namespace App\Contracts;

/**
 * Interface BrandContract
 * @package App\Contracts
 */
interface VendorContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listVendors(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findVendorById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createVendor(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateVendor(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteVendor($id);
}