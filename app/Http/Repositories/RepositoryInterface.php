<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface.
 *
 * @package App\Http\Repositories
 * @author Etibar Rustamzada <etibar.rustem@gmail.com>
 */
interface RepositoryInterface
{
    /**
     * The limit of the all data.
     */
    public const MAX_LIMIT = 50;

    /**
     * Create one record.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data);

    /**
     * Bulk insertion.
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data);

    /**
     * Update by id.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function update(int $id, array $params = []);

    /**
     * Delete by id.
     *
     * @param array $id
     * @return mixed
     */
    public function delete(array $id);

    /**
     * Find Record by id.
     *
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * Get All data by params.
     *
     * @param array $params (parameters for selection)
     * @param array $relations
     * @param array $selects
     * @return mixed
     */
    public function all(array $params = [], array $relations = [], array $selects = ['*']);
}
