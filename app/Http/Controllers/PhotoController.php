<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Validator;
use App\Photo;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Photo::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photoImg' => [
                'required', Rule::dimensions()->maxWidth(320)->maxHeight(320),
            ],
            'description' => 'required|string|max:300'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $path = $request->photoImg->store('uploads');
        Photo::create(['file_path' => 'storage/'.$path, 'description' => $request->description]);

        return response()->json('Create successfuly', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        return $photo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $validator = Validator::make($request->all(), [
            'photoImg' => [ Rule::dimensions()->maxWidth(320)->maxHeight(320) ],
            'description' => 'required|string|max:300'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $update = ['description' => $request->description];
        
        if ($request->photoImg) {
            Storage::delete(str_replace('storage/','',$photo->file_path));
            $path = $request->photoImg->store('uploads');
            $update['file_path'] = 'storage/'.$path;
        }

        $photo->update($update);
        return response()->json('Create successfuly', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        Storage::delete(str_replace('storage/','',$photo->file_path));        
        $photo->delete();
        return response()->json(['success' => 'Deleted successfully'], 204);
    }
}
