<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Jobs\CreateTask;
use App\Jobs\RemoveTask;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Todo\Application\CreateTodo;
use Todo\Application\RemoveTodo;

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
        $task = Task::findOrFail($id);
        $task->done = false;
        $task->save();

        return response([]);
    }

    public function done($id)
    {
        $task = Task::findOrFail($id);
        $task->done = true;
        $task->save();

        return response([]);
    }

    public function update(Request $request, $id): Response
    {
        $request->validate([
            'description' => 'required',
        ]);

        $update = ['description' => $request->description];
        Task::where('id', $id)->update($update);

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
}
