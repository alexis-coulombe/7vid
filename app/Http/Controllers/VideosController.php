<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rootController = new RootController();
        return $rootController->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:64',
            'upload' => 'file|required',
            'description' => 'max:100000'
        ], $this->messages());

        if(trim($request->input('description')) == null){
            $request->merge(['description' => 'No description provided']);
        }

        $file = null;
        $destinationPath = null;
        $filename = null;
        $extension = null;
        if($request->hasFile('upload')) {
            $file = $request->file('upload');
            $destinationPath = public_path().'\\videos';
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '_v.' . $extension;
            $allowedExtensions = ['avi', 'flv', 'wmv', 'mov', 'mp4'];

            if (!in_array(strtolower($extension), $allowedExtensions)) {
                redirect('/video')->with('error', 'Wrong format. Must be: avi, flv, wmv, mov, mp4');
            }
        }

        if($file == null) {
            redirect('/video')->with('error', 'There was an error when uploading your file.');
        }

        $file->move($destinationPath, $filename);

        $video = new Video;
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->extension = $extension;
        $video->location = $destinationPath.'\\'.$filename;
        $video->save();

        return redirect('/video')->with('success', 'Your video as been shared.');
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required for your video.',
            'upload.required'  => 'You must choose your video to upload.',
            'upload.file' => 'Your uploaded file must be a video.'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::find($id);
        return view('video.show')->with('video', $video);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
