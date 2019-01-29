<?php

namespace App\Contracts;

/**
 * Interface Repository
 */
interface Repository
{
    /**
     * Update method
     *
     * @param $id
     * @param $data
     */
    public function update($id, array $data);

    /**
     * Store method
     *
     * @param $data
     */
    public function save(array $data);

    /**
     * Destroy method
     *
     * @param $id
     */
    public function destroy($id);

    /**
     * Find method
     *
     * @param $id
     */
    public function find($id);
}
