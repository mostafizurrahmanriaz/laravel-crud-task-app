<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = task::paginate(5);

        return view('home', compact('tasks'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add-task');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        // return $request->all();

        $task = new task;

        $task->title = $request->title;
        $task->description = $request->details;
        $task->status = $request->status;
        $task->due_date = $request->due_date;

        if($task->save()){
            return redirect()->route('tasks.index')->with('status', 'New task added!');
        }else{
            return redirect()->route('tasks.index')->with('status', 'failed to  update task!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        return view('single-task', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task)
    {
        return view('edit-task', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        
        $task = task::find($id)->update([
            'title' => $request->title,
            'description' => $request->details,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        if($task){
            return redirect()->route('tasks.index')->with('status', 'Updated task successfully!');
        }else{
            return redirect()->route('tasks.index')->with('status', 'failed to  update task!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = task::find($id);

        if($task){
            $task->delete();
            return redirect()->route('tasks.index')->with('status', 'Task deleted successfully!');
        }else{
            return redirect()->route('tasks.index')->with('status', 'Task not found!');
        }
    }

    // 

    public function searchTask(Request $req){

        if($req->search !== ''){
            $tasks = Task::whereAny(
                ['title', 'description'], 
                'like', 
                "%$req->search %"
            )
            ->paginate(5)
            ->appends(['search' => $req->search]);
        }else{
            $tasks = task::all();
        }
        return view('home', compact('tasks'));

        }
}
