<?php


namespace App\Services;


use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAll()
    {
        return $this->taskRepository->getAll();
    }

    public function getOne($id)
    {
        return $this->taskRepository->getOne($id);
    }

    public function create($conditions)
    {
        $conditions['user_id'] = Auth::user()->id;

        return $this->taskRepository->create($conditions);
    }

    public function update($conditions)
    {
        return $this->taskRepository->update($conditions);
    }

    public function delete($id)
    {
        $this->taskRepository->delete($id);
    }
}