<?php

namespace App\Repositories\BaseRepository;


interface BaseRepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * store
     *
     * @param  mixed $data
     * @return void
     */
    public function store($data);

    /**
     * Get one
     *
     * @param int $id
     * @return mixed
     */
    public function find($id);

    /**
     * Update
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update($data, $id);

    /**
     * Delete
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id);
}
