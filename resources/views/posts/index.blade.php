@extends ('layouts.app')

@section('title') Index @endsection

@section ('content')
    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
    </div>
    <table class="table mt-5 container">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th scope="col">posted by</th>
                <th scope="col">created at</th>
                <th scope="col">actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user ? $post->user->name : 'user not found' }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td class="col">
                        <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="btn btn-info">View</a>
                        <a href="{{ route('posts.edit', ['post' => $post['id']]) }}" class="btn btn-primary">Edit</a>
                        <form style="display: inline;" method="POST" action="{{ route('posts.destroy', $post->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection