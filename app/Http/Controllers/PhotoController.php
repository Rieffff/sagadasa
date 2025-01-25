<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::with('maintenanceLog')->get();
        return response()->json($photos);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'maintenance_log_id' => 'required|exists:maintenance_logs,id',
            'photo_url' => 'required|string|max:255', // Validasi URL
        ]);

        $photo = Photo::create($data);

        return response()->json(['message' => 'Photo uploaded successfully', 'data' => $photo]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'maintenance_log_id' => 'sometimes|exists:maintenance_logs,id',
            'photo_url' => 'sometimes|string|max:255',
        ]);

        $photo = Photo::findOrFail($id);
        $photo->update($data);

        return response()->json(['message' => 'Photo updated successfully', 'data' => $photo]);
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();

        return response()->json(['message' => 'Photo deleted successfully']);
    }
}
