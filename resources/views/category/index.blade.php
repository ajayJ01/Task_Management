@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1 class="mb-4">Category</h1>
            <a class="btn btn-primary mb-2" href="{{ route('category.create') }}" role="button">Create Category</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category as $key => $val)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $val->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center alert alert-warning">
                                No Category available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
