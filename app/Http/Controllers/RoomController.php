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
    $validated = $request->validate([
        'room_number' => 'required|string|max:255',
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'room_type' => 'required|string|in:Single,Double,Triple,Quad,Quint',
        'capacity' => 'required|integer|min:1|max:5',
        'occupied' => 'required|integer|min:0|max:5',
        'rent' => 'required|numeric|min:0',
        'status' => 'required|string|in:available,full,maintenance',
        'facilities' => 'nullable|string',
    ]);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('rooms', 'public');
            $validated['picture'] = $path;
        } else {
            logger('No file uploaded!');
        }


    Room::create($validated);

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
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // ✅ image validation
    ]);

    // ✅ form ke data copy
    $data = $request->all();

 if ($request->hasFile('picture')) {
    // purani picture delete
    if ($room->picture && file_exists(public_path('storage/' . $room->picture))) {
        unlink(public_path('storage/' . $room->picture));
    }

    // new picture save
    $path = $request->file('picture')->store('rooms', 'public');
    $data['picture'] = $path; // ✅ same format like store()
}


    $room->update($data);

    return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully.');
}


}
