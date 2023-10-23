<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\type_rooms;

class RoomsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $listTypeRooms = type_rooms::all();
        return view('admin.rooms_type.indexRoomsType', compact('listTypeRooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rooms_type.addRoomsType');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        type_rooms::create($request->all());
        return redirect()->route('rooms_type.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(type_rooms $rooms_type)
    {
        return view('admin.rooms_type.editRoomsType',compact('rooms_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, type_rooms $rooms_type)
    {
        try {
            //code...
            $rooms_type->update($request->all());
            return redirect()->route('rooms_type.index')->with('success','Update successful');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        type_rooms::where('id',$id)->delete();
        return redirect()->route('rooms_type.index');
    }
    public function trash(){
        $deleted_at = type_rooms::onlyTrashed()->get();
        return view('admin.rooms_type.trash',compact('deleted_at'));
    }
    public function restore($id) {
        type_rooms::withTrashed()->where('id',$id)->restore();
        return redirect()->route('rooms_type.index');
    }
    public function forceDeleted($id) {
        type_rooms::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->route('rooms_type.trash');
    }
}
