<?php

namespace App\Repositories;

use Illuminate\Http\Request;

abstract class BaseRepository
{
    /**
     * The Model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    //abstract public function getAll();

    abstract public function getDataTable(Request $request);

    /**
     * Get Model by id.
     *
     * @param  int  $id
     * @return \App\Models\Model
     */
    //abstract protected function getById($id);
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    //abstract public function saveData(array $attributes);
    abstract public function store(array $inputs);
    abstract public function update(array $inputs, $id);

    /**
     * Destroy a model.
     *
     * @param  int $id
     * @return void
     */
    //abstract protected function delete($id);
    public function delete($id)
    {
        return $this->getById($id)->delete();
    }
}
