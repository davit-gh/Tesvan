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
                <h1 class="m-0 text-dark">Education Edit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.educations.index') }}">Educations</a></li>
                    <li class="breadcrumb-item active">Education Edit</li>
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
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.education.update') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input value="{{ $education->id }}" type="hidden" class="form-control" name="id">
                <input value="{{ old('title',$education->title) }}" type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Title (in Armenian)</label>
                <input value="{{ old('title_am',$education->title_am) }}" type="text" class="form-control" placeholder="Title (in Armenian)" name="title_am">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Title (in Russian)</label>
                <input value="{{ old('title_ru',$education->title_ru) }}" type="text" class="form-control" placeholder="Title (in Russian)" name="title_ru">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Image</label>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <input type="hidden" name="description">
                <div id="description" class="textarea form-control" style="height: auto;" name="description"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Description (in Armenian)</label>
                <input type="hidden" name="description_am">
                <div id="description_am" class="textarea form-control" style="height: auto;" name="description_am"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Description (in Russian)</label>
                <input type="hidden" name="description_ru">
                <div id="description_ru" class="textarea form-control" style="height: auto;" name="description_ru"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Category</label>
                <select class="form-control" name="category">
                    @if (count($categories)>0)
                        @foreach ($categories as $c)
                            @if ($education->category_id==$c->id)
                                <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                            @else
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Status</label>
                <select class="form-control" name="status">
                    <option {{ ($education->status=="Publish") ? "selected":"" }}>Publish</option>
                    <option {{ ($education->status=="Draft") ? "selected":"" }}>Draft</option>
                </select>
            </div>
            <div class="form-group">
                <label for="createdBy">Created By</label>
                <input value="{{ old('created_by', $education->created_by) }}" type="text" class="form-control" placeholder="Created By" name="created_by" id="createdBy">
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
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/nested-list@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
<script src="{{ asset('admin-asset/js/hyperlink.js') }}"></script>
<script>
    let editors = [];
    let options = {
        placeholder: 'Let`s write an awesome education content!',
        tools: {
            header: {
                class: Header,
                inlineToolbar: true,
                config: {
                    placeholder: 'Enter a header',
                    levels: [1, 2, 3, 4],
                    defaultLevel: 1
                },
            },
            image: {
                class: ImageTool,
                config: {
                    endpoints: {
                        byFile: '{{ route('admin.upload') }}',
                    }
                }
            },
            link: LinkTool,
            list: NestedList,
            table: Table,
            code: CodeTool,
            delimiter: Delimiter,
            quote: Quote,
            hyperlink: Hyperlink,
        },
    };

    let description = new EditorJS({
        holder: $('#description')[0],
        ...options,
        data: @json(old('description') ?? $education->description ?? [])
    });

    let description_am = new EditorJS({
        holder: $('#description_am')[0],
        ...options,
        data: @json(old('description_am') ?? $education->description_am ?? [])
    });

    let description_ru = new EditorJS({
        holder: $('#description_ru')[0],
        ...options,
        data: @json(old('description_ru') ?? $education->description_ru ?? [])
    });

    window.editors = [
        description, description_am, description_ru
    ];

    $('form').on('submit', async function () {
        $(this).find('[name="description"]').val(JSON.stringify(await description.save()))
        $(this).find('[name="description_am"]').val(JSON.stringify(await description_am.save()))
        $(this).find('[name="description_ru"]').val(JSON.stringify(await description_ru.save()))
    });
</script>
@endsection
