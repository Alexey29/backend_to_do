<?php


namespace App\Http\Controllers;


use App\Contracts\TaskContract;
use App\Exceptions\MissingFieldException;
use App\Http\Resources\Task;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function getAll(TaskService $taskService) {
        return response()->json(Task::collection($taskService->getAll()), 200);
    }

    public function getOne(int $id, TaskService $taskService) {
        return response()->json(new Task($taskService->getOne($id)), 200);
    }

    public function create(Request $request, TaskService $taskService) {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:30', 'min:1'],
            'description' => ['required', 'string', 'max:7000', 'min:1'],
            'status_id' =>  ['required', 'int'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'massage' => $validator->errors()
            ], 401);
        }

        $item = $taskService->create($data);

        return response()->json([
            'item' => new Task($item),
            'massage' => 'task was created!'
        ], 200);
    }

    public function update(int $id, Request $request, TaskService $taskService) {
        if (!$id) {
            throw new MissingFieldException('$id');
        }

        $data = $request->all();

        $data['id'] = $id;

        $validator = Validator::make($data, [
            'id' => ['required', 'int'],
            'title' => ['string', 'max:30'],
            'description' => ['string', 'max:7000'],
            'status_id' =>  ['int'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'massage' => $validator->errors()
            ], 401);
        }

        $item = $taskService->update($data);

        return response()->json([
            'item' => new Task($item),
            'massage' => 'task was updated!'
        ], 200);
    }

    public function delete(int $id, TaskService $taskService) {
        $taskService->delete($id);

        return response()->json([
            'massage' => 'task was deleted!'
        ], 200);
    }
}
