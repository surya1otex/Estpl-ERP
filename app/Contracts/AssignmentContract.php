<?php

namespace App\Contracts;

/**
 * Interface CategoryContract
 * @package App\Contracts
 */
interface AssignmentContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listAssignments(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findAssignmentById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createAssignment(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAssignment(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteAssignment($id);
}