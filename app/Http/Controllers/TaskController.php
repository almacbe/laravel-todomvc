<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

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
        $data['done'] = false;
        Task::create($data);

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
        Task::where('id', $id)->delete();

        return response([], 204);
    }
}
