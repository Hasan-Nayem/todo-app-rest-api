<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

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
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);
        if($task){
            return response()->json([
                "task" => $task,
            ], 200);
        }else {
            return response()->json(
                [
                    'error' => 'Invalid Id, No data found!'
                ], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){

    $task = Task::find($id);

    if($task){
        $task->title = $request->title;
        $task->description = $request->description;
        $task->is_completed = $request->is_completed;
        $task->save();

        return response()->json(
            [
                'message' => 'Task updated successfully',
                'task' => $request->all()
            ], 200);
    }else{
        return response()->json(
            [
                'error' => 'Invalid Id, No data found!'
            ], 404);
    }

}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if($task){
            $task->delete();
            return response()->json(
                [
                    'message' => 'Task deleted successfully',
                ], 200);
        }else{
            return response()->json(
                [
                    'error' => 'Invalid Id, No data found!'
                ], 404);
        }
    }
}
