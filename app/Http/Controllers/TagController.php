<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function list()
    {
        return Tag::orderBy('id','desc')->get();
    }
    public function create()
    {
        //
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'tagName'=> 'required'
        ]);
        return Tag::create($req->all());
    }

    public function update(Request $req)
    {
        $this->validate($req, [
            'tagName'=> 'required',
            'id'=> 'required'
        ]);
        return Tag::where('id', $req->id)->update($req->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $this->validate($req, [
            'id'=> 'required'
        ]);
        return Tag::where('id', $req->id)->delete();
    }
}
