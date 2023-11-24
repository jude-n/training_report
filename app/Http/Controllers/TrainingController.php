<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    //

    public function index()
    {
        return view('welcome');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes: txt',
        ]);

        $fileName = time().'.'.$request->file->extension();

//        store content of file in variable
        $fileContent = file_get_contents($request->file);
        dd($fileContent);

//        $request->file->move(public_path('uploads'), $fileName);
//
//        return back()
//            ->with('success','You have successfully upload file.')
//            ->with('file',$fileName);
//    }
}
