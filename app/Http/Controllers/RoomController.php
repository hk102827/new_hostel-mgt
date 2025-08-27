<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|string|max:255',
            'room_type' => 'required|string|in:Single,Double,Triple,Quad,Quint',
            'capacity' => 'required|integer|min:1|max:5',
            'occupied' => 'required|integer|min:0|max:5',
            'rent' => 'required|numeric|min:0',
            'status' => 'required|string|in:available,full,maintenance',
            'facilities' => 'nullable|string',
        ]);

        Room::create($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully.');
    }

        public function edit($id)
        {
            $room = Room::findOrFail($id);
            return view('admin.rooms.edit', compact('room'));
        }

        public function update(Request $request, $id)
        {
            $room = Room::findOrFail($id);

            $request->validate([
                'room_number' => 'required|string|max:255',
                'room_type' => 'required|string|in:Single,Double,Triple,Quad,Quint',
                'capacity' => 'required|integer|min:1|max:5',
                'occupied' => 'required|integer|min:0|max:5',
                'rent' => 'required|numeric|min:0',
                'status' => 'required|string|in:available,full,maintenance',
                'facilities' => 'nullable|string',
            ]);

            $room->update($request->all());

            return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully.');
        }

        public function destroy($id)
        {
            $room = Room::findOrFail($id);
            $room->delete();

            return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
        }

}
