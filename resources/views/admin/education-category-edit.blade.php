@extends("layouts.admin")

    @section('styles')
    @endsection

@section('content')

    <style type="text/css">
        .hidden{
            display: none;
        }
    </style>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Education Category Edit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.education-categories.index') }}">Education Categories</a></li>
                        <li class="breadcrumb-item active">Education Category Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card card-primary">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(session('success'))
        <span class="alert alert-success" role="alert">
            <strong>{{ session('success') }}</strong>
        </span>
        @endif
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.education-category.update') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="educationCategory">Category Name</label>
                    <input value="{{ $category->id }}" type="hidden" class="form-control" name="id">
                    <input value="{{ old('name',$category->name) }}" type="text" class="form-control" name="name" id="educationCategory">
                </div>
                <div class="form-group">
                    <label for="name_am">Category Name (Armenian)</label>
                    <input value="{{ old('name_am', $category->name_am) }}" type="text" class="form-control" placeholder="Category Name (Armenian)" name="name_am" id="name_am">
                </div>
                <div class="form-group">
                    <label for="name_ru">Category Name (Russian)</label>
                    <input value="{{ old('name_ru', $category->name_ru) }}" type="text" class="form-control" placeholder="Category Name (Russian)" name="name_ru" id="name_ru">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

@endsection
