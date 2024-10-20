@extends('layouts.app')

@section('content')
    <div class="col-md-10">
        <div class="container py-4">
            <h1 class="mb-4">Create Task</h1>
            <form action="{{ route('tasks.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" class="form-control" required
                        placeholder="Enter title">
                    @if ($errors->has('title'))
                        <div class="error text-danger">{{ $errors->first('title') }}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="3" required
                        placeholder="Enter Description"></textarea>
                    @if ($errors->has('description'))
                        <div class="error text-danger">{{ $errors->first('description') }}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category_id" class="form-select" required>
                        <option value="">Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <div class="error text-danger">{{ $errors->first('category_id') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Create Task</button>
            </form>
        </div>
    </div>
@endsection
