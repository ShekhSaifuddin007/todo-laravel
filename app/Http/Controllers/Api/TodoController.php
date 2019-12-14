<?php

namespace App\Http\Controllers\Api;

use App\Http\{Controllers\Controller, Resources\TodoResource};
use App\Todo;
use Illuminate\Http\{Request, Resources\Json\AnonymousResourceCollection};

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $todos = Todo::query();

        return TodoResource::collection($todos->latest('id')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return TodoResource
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3',
            'completed' => 'required|boolean'
        ]);

        $todo = Todo::create($data);

        return new TodoResource($todo);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TodoResource
     */
    public function show($id)
    {
        return new TodoResource(
            Todo::query()->findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return TodoResource
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3',
            'completed' => 'required|boolean'
        ]);
        $todo = Todo::query()->findOrFail($id);

        $todo->update($data);

        return new TodoResource($todo);
    }

    public function updateAll(Request $request)
    {
        $data = $request->validate([
            'completed' => 'required|boolean'
        ]);
       Todo::query()->update($data);

       return response('Updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return TodoResource
     * @throws \Exception
     */
    public function destroy($id)
    {
        $todo = Todo::query()->findOrFail($id);
        $todo->delete();

        return new TodoResource($todo);
    }

    public function deleteAll(Request $request)
    {
        $request->validate([
            'todos' => 'required|array'
        ]);

        Todo::destroy($request->todos);

        return response('Deleted', 200);
    }
}
