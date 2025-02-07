@extends('employer.master')
@section('my.active','active')
@section('content')
@if (session('success'))
<div class="alert alert-danger mt-1">
    {{ session('success') }}
</div>
@endif
@if (session('update_success'))
<div class="alert alert-success text-dark mt-1">
    {{ session('update_success') }}
</div>
@endif
@if (session('create_success'))
<div class="alert alert-success text-dark mt-1">
    {{ session('create_success') }}
</div>
@endif
    <div class="container">
        <a href="{{ route('post.create') }}" class="btn btn-primary w-25 my-5"> Create New Post</a>
        <table class="table">
            <thead>
                <tr>
                    {{-- <th>id</th> --}}
                    <th>title</th>
                    <th>Category</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($posts as $item)
                @if (Auth::guard('employer')->user()->can('show-post', $item))

                    <tr>
                        {{-- <td>{{ $item->id }}</td> --}}
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td><a href="{{ route('post.show', $item) }}" class="btn btn-info"> View</td>
                        <td> <a href="{{ route('post.edit', $item) }}" class="btn btn-success"> Update</a>
                        </td>
                        <td>
                            <form action="{{ route('post.destroy', $item) }}" method="POST"
                               >

                                @csrf
                                @method('DELETE')
                                
                                <input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger" value="Delete">
                            </form>
                        </td>
@endif
                    </tr>
                @endforeach
                {{ $posts->links() }}


            </tbody>

        </table>
    </div>
@endsection