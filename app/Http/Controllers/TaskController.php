<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if($request->isMethod('POST')){

            if($request->title){
                $task = Task::create(
                    [
                        'title' => $request->title,
                        'description' => $request->description,
                    ]
                );
                return response()->json(
                    [
                        "acknowledge" => true,
                        "insertedId" => $task->id,
                    ]
                , 201);
            }else {
                return response()->json(
                    [
                        "message" => "Title should not be empty",
                    ]
                , 403);
            }
        }else {
            $task = Task::orderBy("created_at","asc")->get();
            return response()->json(
                [
                    "tasks" => $task,
                ]
            ,200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
