@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session()->has('error'))
            <div class="alert alert-error">
                {{ session()->get('error') }}
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h1 class="mb-4">Tasks</h1>
            <a class="btn btn-primary mb-2" href="{{ route('task.create') }}" role="button">Create Task</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>description</th>
                        <th>User Name</th>
                        <th>Category Name</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Task as $key => $val)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $val->title }}</td>
                            <td>{{ $val->description }}</td>
                            <td>{{ $val->user ? $val->user->name : 'User not found' }}</td>
                            <td>{{ $val->category ? $val->category->name : 'Category not found' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center alert alert-warning">
                                No tasks available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
