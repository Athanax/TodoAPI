<?php

namespace App\Http\Controllers;

use App\Exceptions\TaskNotBelongsToUser;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TaskCollection;

class TasksController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
       
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return TaskCollection::collection(Task::paginate(10));
        //get request
        // show the tasks of the logged in user
        return TaskCollection::collection(Task::where('user_id',Auth::user()->id)->get());
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        //post request
        // the request should be from the TaskRequest class
        // return  $request;
        $task = new Task;
        $task->name=$request->name;
        $task->desciption= $request->description;
        $task->complete=false;
        $task->user_id = Auth::user()->id;
        $task->save();

        return response([
            'data'=>new TaskResource($task)
            // for the response type below, you can also hard code the error code, 201 in HTTP_CREATED
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $this->CheckTaskUser($task);
        //get request
        // this is wrapped in a new TaskResource only because it it a single object

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $this->CheckTaskUser($task);

        $task->desciption=$request->description;
        $task->name=$request->name;

        $task->save();

        return Response([
            'data'=>new TaskResource($task)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //delete request
        $this->CheckTaskUser($task);

        // return $task;

        $task->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function CheckTaskUser($task){
        if (Auth::id() != $task->user_id) {
            throw new TaskNotBelongsToUser;
        }
    }
}