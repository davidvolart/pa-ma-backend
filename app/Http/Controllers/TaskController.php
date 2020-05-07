<?php

namespace App\Http\Controllers;

use App\Child;
use App\Http\Requests\StoreTaskRequest;
use App\Task;
use App\User;
use App\Vaccine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function listTasks(Request $request)
    {
        $child_id = $request->user()->children_id;
        if ($child_id == null) {
            return response()->json(['message' => 'User has not registered a child yet.', "child" => null], 400);
        }
        $child = Child::find($child_id);

        return response()->json(['message' => 'List of task for child.', 'tasks' => $child->tasks()->get()], 200);
    }

    public function storeTask(StoreTaskRequest $request)
    {
        $child_id = $request->user()->children_id;
        if ($child_id == null) {
            return response()->json(['message' => 'User has not registered a child yest.', "child" => null], 400);
        }

        $task = Task::findOrNew(request("id"));

        if (filter_var(request("assigne_me"), FILTER_VALIDATE_BOOLEAN)) {
            $task->user_email = $request->user()->email;
        }

        $task->child_id = $child_id;
        $task->name = request("name");
        $task->description = request("description");

        if ($date_value = $this->getDateInUniversalFormat()) {
            $task->date = $date_value;
            $task->save();
            return response()->json(['message' => 'Task stored correctly', "task" => Task::find($task->id)], 201);
        }
        return response()->json(['message' => 'Field date must be a correct date format.'], 400);
    }

    public function deleteTask($id)
    {
        try{
            $task = Task::findOrFail($id);
        }catch(\Exception $e){
            return response()->json(['message' => 'Task id does not exist'], 400);
        }
        $task->delete();
        return response()->json(['message' => 'Task deleted correctly'], 200);
    }

    private function getDateInUniversalFormat()
    {
        try {
            $date = explode('/', request("date"));
            $date_value = Carbon::createFromDate($date[2], $date[1], $date[0], 'Europe/Madrid');
            return $date_value;
        } catch (\Exception $e) {
            return null;
        }
    }
}
