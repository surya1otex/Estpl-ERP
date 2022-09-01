<?php

namespace App\Repositories;

use App\Models\Client;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ClientContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class ClientRepository extends BaseRepository implements ClientContract
{
    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Client $model)
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
    public function listClients(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findClientById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Category|mixed
     */
    public function createClient(array $params)
    {
        try {
            $collection = collect($params);
            $status = $collection->has('status') ? 1 : 0;

            $merge = $collection->merge(compact('status'));

            //$merge = $collection->merge();
            $client = new Client($merge->all());

            $client->save();

            return $client;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateClient(array $params)
    {
        $category = $this->findCategoryById($params['id']);

        $collection = collect($params)->except('_token');

        if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {

            if ($category->image != null) {
                $this->deleteOne($category->image);
            }

            $image = $this->uploadOne($params['image'], 'categories');
           // $merge = $collection->merge(compact('image'));
        }
        else {
            $image = $category->image;
        }
        //$image = $this->uploadOne($params['image'], 'categories');
        $featured = $collection->has('featured') ? 1 : 0;
        $menu = $collection->has('menu') ? 1 : 0;
        
        $merge = $collection->merge(compact('menu', 'image', 'featured'));

        $category->update($merge->all());

        return $category;



        // $category = $this->findCategoryById($params['id']);

        // $collection = collect($params)->except('_token');

        // if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {

        //     if ($category->image != null) {
        //         $this->deleteOne($category->image);
        //     }

        //     $image = $this->uploadOne($params['image'], 'categories');
        // }

        // $featured = $collection->has('featured') ? 1 : 0;
        // $menu = $collection->has('menu') ? 1 : 0;

        // $merge = $collection->merge(compact('menu', 'image', 'featured'));

        // $category->update($merge->all());

        // return $category;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteClient($id)
    {
        $category = $this->findCategoryById($id);

        if ($category->image != null) {
            $this->deleteOne($category->image);
        }

        $category->delete();

        return $category;
    }

    /**
     * @return mixed
     */

}
