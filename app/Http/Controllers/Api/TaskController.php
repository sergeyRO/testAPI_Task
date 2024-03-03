<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Получить список задач (с фильтрами и настраиваемой пагинацией) метод GET
        $limit = $request['limit'];
        $status = $request['status'];
        $created_at = $request['created_at'];

        $query = Task::orderBy('created_at', 'desc');
        if(isset($status))
        {
            $query = $query->where('status',$status);
        }
        if(isset($created_at))
        {
            $query = $query->whereBetween('created_at', [Carbon::parse($created_at), Carbon::parse(strtotime($created_at . ' +1 day'))]);
        }
        if(!isset($limit))
        {
            $limit=10;
        }
        $query = $query->paginate($limit);
        return response()->json([
            'result' => $query,
        ],200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Создать задачу метод POST
        $status='active';

        $task_id = Task::insertGetId([
            'status'=>$status,
            'desсription'=>$request->desсription
        ]);

        return response()->json([
            'task_id' => $task_id,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //Обновить задачу метод PUT
        Task::where('id',$task->id)->update(['desсription'=>$request->desсription, 'status'=>$request->status]);

        return response()->json([
            'result'=>'Task #'.$task->id.' updated'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        Task::destroy($task->id);
        return response()->json([
            'result'=>'Task #'.$task->id.' deleted'
        ],200);
    }
}
