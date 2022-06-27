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
                <h1 class="m-0 text-dark">Create Service</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
                    <li class="breadcrumb-item active">Create Service</li>
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
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.service.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Link</label>
                <input value="{{ old('link') }}" type="text" class="form-control" placeholder="Link" name="link">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input value="{{ old('title') }}" type="text" class="form-control" placeholder="Title" name="title">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Title (in Armenian)</label>
                <input value="{{ old('title_am') }}" type="text" class="form-control" placeholder="Title (in Armenian)" name="title_am">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Title (in Russian)</label>
                <input value="{{ old('title_ru') }}" type="text" class="form-control" placeholder="Title (in Russian)" name="title_ru">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Meta Title</label>
                <input value="{{ old('meta_title') }}" type="text" class="form-control" placeholder=" Meta Title" name="meta_title">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Meta Title (in Armenian)</label>
                <input value="{{ old('meta_title_am') }}" type="text" class="form-control" placeholder="Meta Title (in Armenian)" name="meta_title_am">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Meta Title (in Russian)</label>
                <input value="{{ old('meta_title_ru') }}" type="text" class="form-control" placeholder="Meta Title (in Russian)" name="meta_title_ru">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Logo</label>
                <input value="{{ old('logo') }}" type="file" class="form-control" name="logo">
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
                <label for="exampleInputEmail1">Meta Description</label>
                <input type="hidden" name="meta_description">
                <div id="meta_description" class="textarea form-control" style="height: auto;" name="meta_description"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Meta Description (in Armenian)</label>
                <input type="hidden" name="meta_description_am">
                <div id="meta_description_am" class="textarea form-control" style="height: auto;" name="meta_description_am"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Meta Description (in Russian)</label>
                <input type="hidden" name="meta_description_ru">
                <div id="meta_description_ru" class="textarea form-control" style="height: auto;" name="meta_description_ru"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Approach</label>
                <input type="hidden" name="approach">
                <div id="approach" class="textarea form-control" style="height: auto;" name="approach"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Approach (in Armenian)</label>
                <input type="hidden" name="approach_am">
                <div id="approach_am" class="textarea form-control" style="height: auto;" name="approach_am"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Approach (in Russian)</label>
                <input type="hidden" name="approach_ru">
                <div id="approach_ru" class="textarea form-control" style="height: auto;" name="approach_ru"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Benefit</label>
                <input type="hidden" name="benefit">
                <div id="benefit" class="textarea form-control" style="height: auto;" name="benefit"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Benefit (in Armenian)</label>
                <input type="hidden" name="benefit_am">
                <div id="benefit_am" class="textarea form-control" style="height: auto;" name="benefit_am"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Benefit (in Russian)</label>
                <input type="hidden" name="benefit_ru">
                <div id="benefit_ru" class="textarea form-control" style="height: auto;" name="benefit_ru"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Category</label>
                <select class="form-control" name="category">
                    @if (count($categories)>0)
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Status</label>
                <select class="form-control" name="status">
                    <option>Publish</option>
                    <option>Draft</option>
                </select>
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
        placeholder: 'Let`s write an awesome service content!',
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
            logo: {
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
        data: {!! old('description') ?? json_encode([]) !!}
    });

    let description_am = new EditorJS({
        holder: $('#description_am')[0],
        ...options,
        data: {!! old('description_am') ?? json_encode([]) !!}
    });

    let description_ru = new EditorJS({
        holder: $('#description_ru')[0],
        ...options,
        data: {!! old('description_ru') ?? json_encode([]) !!}
    });

    let meta_description = new EditorJS({
        holder: $('#meta_description')[0],
        ...options,
        data: {!! old('meta_description') ?? json_encode([]) !!}
    });

    let meta_description_am = new EditorJS({
        holder: $('#meta_description_am')[0],
        ...options,
        data: {!! old('meta_description_am') ?? json_encode([]) !!}
    });

    let meta_description_ru = new EditorJS({
        holder: $('#meta_description_ru')[0],
        ...options,
        data: {!! old('meta_description_ru') ?? json_encode([]) !!}
    });

    let approach = new EditorJS({
        holder: $('#approach')[0],
        ...options,
        data: {!! old('approach') ?? json_encode([]) !!}
    });

    let approach_am = new EditorJS({
        holder: $('#approach_am')[0],
        ...options,
        data: {!! old('approach_am') ?? json_encode([]) !!}
    });

    let approach_ru = new EditorJS({
        holder: $('#approach_ru')[0],
        ...options,
        data: {!! old('approach_ru') ?? json_encode([]) !!}
    });

    let benefit = new EditorJS({
        holder: $('#benefit')[0],
        ...options,
        data: {!! old('benefit') ?? json_encode([]) !!}
    });

    let benefit_am = new EditorJS({
        holder: $('#benefit_am')[0],
        ...options,
        data: {!! old('benefit_am') ?? json_encode([]) !!}
    });

    let benefit_ru = new EditorJS({
        holder: $('#benefit_ru')[0],
        ...options,
        data: {!! old('benefit_ru') ?? json_encode([]) !!}
    });

    window.editors = [
        description, description_am, description_ru, meta_description, meta_description_am, meta_description_ru, approach, approach_am, approach_ru, benefit, benefit_am, benefit_ru
    ];

    $('form').on('submit', async function () {
        $(this).find('[name="description"]').val(JSON.stringify(await description.save()))
        $(this).find('[name="description_am"]').val(JSON.stringify(await description_am.save()))
        $(this).find('[name="description_ru"]').val(JSON.stringify(await description_ru.save()))
        $(this).find('[name="meta_description"]').val(JSON.stringify(await meta_description.save()))
        $(this).find('[name="meta_description_am"]').val(JSON.stringify(await meta_description_am.save()))
        $(this).find('[name="meta_description_ru"]').val(JSON.stringify(await meta_description_ru.save()))
        $(this).find('[name="approach"]').val(JSON.stringify(await approach.save()))
        $(this).find('[name="approach_am"]').val(JSON.stringify(await approach_am.save()))
        $(this).find('[name="approach_ru"]').val(JSON.stringify(await approach_ru.save()))
        $(this).find('[name="benefit"]').val(JSON.stringify(await benefit.save()))
        $(this).find('[name="benefit_am"]').val(JSON.stringify(await benefit_am.save()))
        $(this).find('[name="benefit_ru"]').val(JSON.stringify(await benefit_ru.save()))
    });
</script>
@endsection
