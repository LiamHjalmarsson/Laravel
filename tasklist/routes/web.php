<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    // return redirect("/tasks");
    return redirect()->route("tasks.index");
});

Route::get('/tasks', function () {
    return view("index", [
        // "tasks" => Task::all()
        // Paginate it will make sure that all the results are devided properly into pages & generate links to different pages that can be used
        // also automatically read any query parameters that are appended to the url 
        "tasks" => Task::latest()->paginate(5)
        // "tasks" => Task::latest()->where("completed", true)->get() // Query builder and get t
    ]);
})->name("tasks.index");

Route::view("/tasks/create", "create")->name("tasks.create");

// Route model binding 
 // laravel automataically resolove a o model istace based on the type hinted variable name in the route defination
    // route to display the edit form and it is fetching a singel task instead of using the id argument we can rename it to task and then we type hint it with the task class

Route::get("/tasks/{id}/edit", function ($id) {
    return view("edit", ["task" => Task::findOrFail($id)]);
})->name("tasks.edit");
// It will now automatically fetch the model from the database
// But if the model wont be found it will throw the model not found exception which in laravel means a 404 pages
// dont have to worry about model fetching 
// Default laravel will ssume that this task {} is the id which is the default name of a primary key
Route::get("/tasks/{task}/edit", function (Task $task) {
    return view("edit", ["task" => $task]);
})->name("tasks.edit");

Route::get("/tasks/{id}", function ($id) {
    // $task = collect($tasks)// collection turn the tasks array into a collection object and lets you call methods configure the key in TASK model
    //     ->firstWhere("id", $id);
    
    // if (!$task) {
    //     abort(Response::HTTP_NOT_FOUND);
    // } 

    return view("show", ["task" => Task::findOrFail($id)]);
})->name("tasks.show");


// Route::put("/tasks/{id}", function ( $id, Request $request) {
Route::put("/tasks/{id}", function ($id, Request $request) {
    $data = $request->validate(
        [
            "title" => "required|max:15",
            "description" => "required",
            "long_description" => "required",
        ]
    );

    $task = Task::findOrFail($id);

    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();
    
    // create and updated are mass assginemnts means that you set or change multiple attributes of a model once to enable got to the model 
    // $task->update($request->validated());
    return redirect()->route("tasks.show", ["id" => $task->id])->with("success", "Task updated successfully");
})->name("tasks.update");

Route::post("/tasks", function (TaskRequest $request) {
    // Request if reused validation 
    $data = $request->validated();

    // $task = new Task;

    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // $task->save();
    // Do four lines above at ones with Model 
    $task = Task::create($data);

    // sessgion typically starts when the user first visits the website and ends when they close the browser
    // session system lets you store and retrive session data in the appliaction  
    // unique session id and will be stored in a cookie 
    // default stored inside storage framework sessions directory 

    return redirect()->route("tasks.show", ["id" => $task->id])->with("success", "Task created successfully");
})->name("tasks.store");

Route::fallback(function () {
    return "Still got here";
}); // Will catch all urls that dosent match any defined routes 


Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

// ROUTE MODEL BINDING
Route::put("/tasls/{task}/toggle-complete", function (Task $task) {

    // can add method to model 
    $task->toggleComplete();
    // $task->completed = !$task->completed;
    // $task->save();

    return redirect()->back()->with("success", "Task updated successfully");
})->name("tasks-toggle-complete");