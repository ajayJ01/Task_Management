@extends('layouts.app')

@section('content')
    <div class="col-md-10">
        <div class="container py-4">
            <h1 class="mb-4">Create Category</h1>
            <form action="{{ route('category.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Name</label>
                    <input type="text" id="title" name="name" class="form-control"
                        placeholder="Enter Category name" required>
                    @if ($errors->has('name'))
                        <div class="error text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Create Category</button>
            </form>
        </div>
    </div>
@endsection
