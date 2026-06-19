@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5" style="max-width: 600px;">
        <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input value="{{ $post->title }}" name="title" type="text" class="form-control" id="title">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control">{{ $post->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="post_creator" class="form-label">Post Creator</label>
                <select class="form-control" name="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <button class="btn btn-success" type="submit">update</button>
            </div>
        </form>
    </div>
@endsection