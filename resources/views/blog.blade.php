@extends('layouts.app');

@section('content')
    <h2><center>Welcome to Nada's first Laravel Blog</center></h2>
    <h3><center>You can Read, Edit, Delete some Articles </center></h3>
        <div class="container">
            <div class="card">
                <div class ="card-header d flex justify-content-end">
                    <a href="{{ route('create.blogs') }}" class="btn btn-sm btn-primary"> Create Blog</a>
                </div>

                    <div class="card-body">
                        <div class="table-responsive-sm">
                            @if (session()->has('success'))
                                <span class="alert alert-success">{{session()->get('success')}}</span>
                                
                            @endif
                            <table class = "table table-hover">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Content</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($blogs as $blog )
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            
                                            <td>{{Str::limit($blog->title,10)}}</td>
                                            <td>{{$blog->author->name}}</td>
                                            <td>{{Str::limit($blog->content,30)}}</td>
                                            <td>
                                                <a href="{{ route('edit.blogs', $blog->id) }}">Edit</a>
                                                <a href="{{ route('delete.blogs', $blog->id) }}">Delete</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <h3>You  Have No Blogs <br> Click on create blog button to continue</h3>
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>
                        </div>
                    </div>
            </div>
        </div>
@endsection