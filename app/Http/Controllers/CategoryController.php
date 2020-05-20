<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function list()
    {
        return Category::orderBy('id','desc')->get();
    }
    public function store(Request $req)
    {
        $this->validate($req, [
            'categoryName' => 'required',
            'icon' => 'required'
        ]);

        return Category::create($req->all());
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function upload(Request $req)
    {
        $this->validate($req, [
            'file'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $iconName = time().'.'.$req->file->extension();
        $req->file->move(public_path('uploads'), $iconName);
        return $iconName;
    }
    public function deleteIcon(Request $request){
        $fileName = $request->icon;
        $this->deleteFileFromServer($fileName, false);
        return 'done';
    }
    public function deleteFileFromServer($fileName, $hasFullPath = false){
        if(!$hasFullPath){
            $filePath = public_path().'/uploads/'.$fileName;
        }
        if(file_exists($filePath)){
            @unlink($filePath);
        }
        return;
    }


    public function destroy(Request $request){
        $this->deleteFileFromServer($request->icon);
        $this->validate($request, [
            'id' => 'required',
        ]);
        return Category::where('id', $request->id)->delete();
    }
}
