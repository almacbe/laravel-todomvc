<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Jobs\CompleteTask;
use App\Jobs\CreateTask;
use App\Jobs\GetAllTasks;
use App\Jobs\IncompleteTask;
use App\Jobs\RemoveTask;
use App\Jobs\UpdateDescriptionTask;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Todo\Application\CompleteTodo;
use Todo\Application\CreateTodo;
use Todo\Application\IncompleteTodo;
use Todo\Application\RemoveTodo;
use Todo\Application\UpdateTodoDescription;

class TaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    public function store(Request $request): Response
    {
        $request->validate([
            'description' => 'required',
        ]);
        $data = $request->all();

        $createTodo = CreateTodo::withDescription($data['description']);
        CreateTask::dispatch($createTodo);

        return response([], 201);
    }

    public function undone($id)
    {
        $incompleteTodo = IncompleteTodo::withId($id);
        IncompleteTask::dispatch($incompleteTodo);

        return response([]);
    }

    public function done($id)
    {
        $completeTodo = CompleteTodo::withId($id);
        CompleteTask::dispatch($completeTodo);

        return response([]);
    }

    public function update(Request $request, $id): Response
    {
        $request->validate([
            'description' => 'required',
        ]);

        $updateTodoDescription = UpdateTodoDescription::withIdAndDescription($id, $request->description);
        UpdateDescriptionTask::dispatch($updateTodoDescription);

        return response([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $removeTodo = RemoveTodo::withId($id);
        RemoveTask::dispatch($removeTodo);

        return response([], 204);
    }

    public function actives()
    {
        $tasks = Task::where('done', false)->get();

        return TaskResource::collection($tasks);
    }
}
