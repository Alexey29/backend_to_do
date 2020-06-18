<?php


namespace App\Repositories;


use App\Contracts\TaskContract;
use App\Exceptions\EntityNotFoundException;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository implements TaskContract
{
    public function getAll()
    {
        return Auth::user()->tasks()->get();
    }

    public function getOne(int $id)
    {
        return Auth::user()->tasks()->find($id);
    }

    public function create(array $conditions) {
        $entity = new Task();

        $entity->fill($conditions);
        $entity->save();

        return $entity;
    }

    public function update(array $conditions)
    {
        $task = $this->getOne($conditions['id']);

        if (!$task) {
            throw new EntityNotFoundException('Task');
        }

        $task->update($conditions);
        $task->save();

        return $task;
    }

    public function delete(int $id)
    {
        $task = $this->getOne($id);

        if (!$task) {
            throw new EntityNotFoundException('Task');
        }

        $task->delete();
    }
}
