<?php

namespace App\Repositories;

use App\Models\Vendor;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\VendorContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class VendorRepository extends BaseRepository implements VendorContract
{
    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param Brand $model
     */
    public function __construct(Vendor $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listVendors(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findVendorById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Brand|mixed
     */
    public function createVendor(array $params)
    {
        try {
            $collection = collect($params);

            $logo = null;

            if ($collection->has('logo') && ($params['logo'] instanceof  UploadedFile)) {
                $logo = $this->uploadOne($params['logo'], 'vendors');
            }

            $merge = $collection->merge(compact('logo'));

            $vendor = new Vendor($merge->all());

            $vendor->save();

            return $vendor;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateVendor(array $params)
    {
        $vendor = $this->findVendorById($params['id']);

        $collection = collect($params)->except('_token');

        if ($collection->has('logo') && ($params['logo'] instanceof  UploadedFile)) {

            if ($vendor->logo != null) {
                $this->deleteOne($vendor->logo);
            }

            $logo = $this->uploadOne($params['logo'], 'vendors');
        }
        else {
          $logo = $vendor->logo;
        }
        $merge = $collection->merge(compact('logo'));

        $vendor->update($merge->all());

        return $vendor;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteVendor($id)
    {
        $vendor = $this->findVendorById($id);

        if ($vendor->logo != null) {
            $this->deleteOne($vendor->logo);
        }

        $vendor->delete();

        return $vendor;
    }
}