<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rooms;
use App\Models\type_rooms;
use App\Models\images;
use App\Http\Requests\Admin\RoomPostRequest;
use App\Http\Requests\Admin\RoomEditRequest;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = rooms::all();
        return view('admin.rooms.indexRooms', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_rooms = type_rooms::all();
        return view('admin.rooms.addRooms',compact('type_rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomPostRequest $request)
    {
        
        $fileName = $request->photo->getClientOriginalName();
        $request->photo->StoreAs('public/images',$fileName);
        $request->merge(['image'=>$fileName]);
        try {
            
            $rooms = rooms::create($request->all());
            if ($fileName && $request->photos) {
                foreach ($request->photos as $key => $value) {
                    $fileNames = $value->getClientOriginalName();
                    $value->StoreAs('public/images',$fileNames);
                    images::create([
                        'room_id'=>$rooms->id,
                        'image'=>$fileNames
                    ]);
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->route('rooms.index')->with('success','added successfully');
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
    public function edit(rooms $room)
    {
        $listRoom = rooms::all();
        // dd($listRoom->all());
        $listimages = images::where('room_id',$room->id)->get();
        $type_rooms = type_rooms::all();
        return view('admin.rooms.editRooms',compact('room','type_rooms','listimages','listRoom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomEditRequest $request, rooms $room)
    {         
        
        if(!$request->photo==""){
            $fileName = $request->photo->getClientOriginalName();
            $request->photo->StoreAs('public/images',$fileName);
            $request->merge(['image'=>$fileName]);
        }else{
            $request->merge(['image'=>$room->image]);
        }
        try {
         
            $room->update($request->all());
            if ($room && $request->photos) {
                images::where('room_id',$room->id)->delete();  
                foreach ($request->photos as $key => $value) {                    
                    $fileNames = $value->getClientOriginalName();
                    $value->StoreAs('public/images',$fileNames);
                    images::where('id',$request->room_id)->create([
                        'room_id'=>$room->id,
                        'image'=>$fileNames
                    ]);
                }
            }
        } catch (\Throwable $th) {
            dd($th) ;
        }
        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            rooms::where('id',$id)->delete();
            return redirect()->route('rooms.index');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
