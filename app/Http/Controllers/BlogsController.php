<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //allow the user to view his/her own data
        $blogs = Blog::with('author')->where('user_id',Auth::id())->orderByDesc('created_at')->simplePaginate(5);

        return view('blog', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-edit-blog');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|min:5|max:120|unique:blogs,title',
            'tags'=> 'string|nullable',
            'content'=> 'required|string|min:10|max:255',
        ]);

        //insert
        Blog::create([
            'title'=>$request->title,
             'tags'=>$request->tags,
             'content'=>$request->content,
             'user_id' =>Auth::id()
        ]);

        //redirect
        return back()->with('Success','Article created successfully');
        //second way of redirecting
        //return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('create-edit-blog', compact('blog'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->validate($request, [
            'title' => 'required|string|min:5|max:120|unique:blogs,title,'.$blog->id,
            'tags'=> 'string|nullable',
            'content'=> 'required|string|min:10|max:255',
        ]);

        //insert
        $blog->update([
            'title'=>$request->title,
             'tags'=>$request->tags,
             'content'=>$request->content,
             'user_id' =>Auth::id()
        ]);

        //redirect
        return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();
        return back()->with('success','blog deleted Successfully');
    }

    public function homeBlogs()
    {
        $blogs = Blog::with('author')->orderByDesc('created_at')->simplePaginate(5);

        return view('welcome-blog',compact('blogs'));
    }
}
