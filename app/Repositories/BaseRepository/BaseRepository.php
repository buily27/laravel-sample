<?php

namespace App\Repositories\BaseRepository;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * model
     *
     * @var mixed
     */
    protected $model;
    public function __construct()
    {
        $this->setModel();
    }
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * store
     *
     * @param  mixed $data
     * @return void
     */
    public function store($data)
    {
        $this->model->create($data);
    }

    /**
     * get One
     * 
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function find($id)
    {
        $data = $this->model->find($id);
        return $data;
    }

    /**
     *  Update
     * 
     * @param int $id
     * @param array $data
     * @return bool|mixed
     */
    public function update($data, $id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($data);
            return $result;
        }
        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
