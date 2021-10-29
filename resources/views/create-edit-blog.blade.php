@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if (session()->has('success'))
                <span class="alert alert-success">{{session()->get('success')}}</span>
                @endif
            <form action="{{isset($blog)?route('update.blogs', $blog->id):route('store.blogs') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($blog)
                    @method('PUT')
                @endisset
                <div class="form-group">
                    <label for="title">Blog Title</label>
                    <input type="text" name="title" value="{{isset($blog)?$blog->title:old('title')}}" class="form-control @error('title') 
                    is-invalid @enderror">
                    @error('title')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" name="tags" value="{{isset($blog)?$blog->tags:old('tags')}}" class="form-control @error('tags') 
                    is-invalid @enderror">
                    @error('tags')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Blog Content</label>
                    <textarea name="content" id="content" rows="5" class="form-control @error('content') 
                    is-invalid @enderror">{{isset($blog)?$blog->content:old('content')}}</textarea>
                    @error('content')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-success">{{isset($blog)?'Update':'Submit'}}</button>
                </div>
            </form> 
            </div>
        </div>
    </div>
@endsection