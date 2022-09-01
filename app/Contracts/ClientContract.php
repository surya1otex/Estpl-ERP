<?php

namespace App\Contracts;

/**
 * Interface CategoryContract
 * @package App\Contracts
 */
interface ClientContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listClients(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findClientById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createClient(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateClient(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteClient($id);
}