<?php

namespace App\Repository;

use App\Contracts\Repository;
use App\Models\File;

/**
 * @package App\Repository
 */
class FileRepository implements Repository
{
    /**
     * @param array $data
     * @return File
     */
    public function save(array $data): File
    {
        $data['status'] = File::STATUS_PENDING;

        $model = (new File)->fill($data);

        $model->save();

        return $model;
    }

    public function findAll()
    {
        return File::all();
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }
}
