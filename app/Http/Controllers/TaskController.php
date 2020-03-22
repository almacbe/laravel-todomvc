<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tasks'] = Task::all();

        return view('todomvc', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        $data = $request->all();
        $data['done'] = false;
        Task::create($data);

        return Redirect::to('tasks')
            ->with('success', 'Greate! Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $update = ['description' => $request->description];
        Task::where('id', $id)->update($update);

        return Redirect::to('tasks')
            ->with('success', 'Great! Task updated successfully');
    }

    public function done(Request $request, $id)
    {
        $request->validate([
            'done' => 'required',
        ]);

        $update = ['done' => !$request->done];
        Task::where('id', $id)->update($update);


        return Redirect::to('tasks')
            ->with('success', 'Great! Task updated successfully');
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

        return Redirect::to('tasks')
            ->with('success', 'Task deleted successfully');
    }
}
