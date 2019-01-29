<?php

namespace App\Repository;

use App\Contracts\Repository;
use App\Models\Member;

/**
 * @package App\Repository
 */
class MemberRepository implements Repository
{
    /**
     * @param array $data
     * @return Member
     */
    public function save(array $data): Member
    {
        $model = (new Member())->fill($data);

        $model->save();

        return $model;
    }

    public function findAll()
    {
        return Member::all();
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
