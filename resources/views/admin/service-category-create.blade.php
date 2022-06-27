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
                <h1 class="m-0 text-dark">Create Service Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.service-categories.index') }}">Service Categories</a></li>
                    <li class="breadcrumb-item active">Create Category</li>
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
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.service-category.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="serviceCategory">Category Name</label>
                <input value="{{ old('name') }}" type="text" class="form-control" placeholder="Category Name" name="name" id="serviceCategory">
            </div>
            <div class="form-group">
                <label for="name_am">Category Name (Armenian)</label>
                <input value="{{ old('name_am') }}" type="text" class="form-control" placeholder="Category Name (Armenian)" name="name_am" id="name_am">
            </div>
            <div class="form-group">
                <label for="name_ru">Category Name (Russian)</label>
                <input value="{{ old('name_ru') }}" type="text" class="form-control" placeholder="Category Name (Russian)" name="name_ru" id="name_ru">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@endsection

@section('scripts')
    {{-- @include('admin.scripts.service-categories') --}}
@endsection
