<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Http\Resources\Todo as TodoResource;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Listado de todo
        $todos = Todo::paginate(15);
        return TodoResource::collection($todos);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = $request->isMethod('put') ?  Todo::FindOrFail
        ($request->todo_id) : new Todo;

        $todo->id = $request->input('todo_id');
        $todo->titulo = $request->input('titulo');
        $todo->descripcion = $request->input('descripcion');
        $todo->estado = $request->input('estado');

        if ($todo->save()) {
          return new TodoResource($todo);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Todo independiente
        $todo = Todo::FindOrFail($id);

        // Regresar un Todo Independiente como resource
        return new TodoResource($todo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // Obtener Todo
      $todo = Todo::FindOrFail($id);

      if ($todo->delete()) {
        return new TodoResource($todo);
      }
    }

    public function update(Request $request, $id)
    {
      $todo = Todo::FindOrFail($id);
      $todo->estado = $request->input('estado');
      $todo->save();

    }
}
