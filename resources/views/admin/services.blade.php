@extends("layouts.admin")

@section('styles')


@endsection

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Services</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Services</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<a href="{{ route('admin.service.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a><br><br>
<div class="card card-primary">
  @if(session('success'))
     <span class="alert alert-success" role="alert">
         <strong>{{ session('success') }}</strong>
     </span>
  @endif
  <div class="container">
  <table id="datatable" class="table table-bordered table-hover">
      <thead>
          <tr>
              <th>Title</th>
              <th>Meta Title</th>
              <th>Description</th>
              <th>Meta Description</th>
              <th>Approach</th>
              <th>Benefit</th>
              <th>Category</th>
              <th>Logo</th>
              <th>Status</th>
              <th>Published Date</th>
              <th width="200">Action</th>
          </tr>
      </thead>
  </table>
  </div>

@endsection

@section('scripts')

<script type="text/javascript">

    $(function () {
        $("#datatable").DataTable({
          processing: true,
          serverSide: true,
          ajax: "{!! route('service.dt') !!}",
          columns: [
          { data: "title" },
          { data: "meta_title" },
          { data: "description" },
          { data: "meta_description" },
          { data: "approach" },
          { data: "benefit" },
          { data: "category" },
          { data: "logo" },
          { data: "status" },
          { data: "published_date" },
          { data: "action", bSortable: false, className: "text-center" },
          ],
      });
    });

      $(document).ready(function(){

          $(document).on("click",".deleteItem",function(){
        id = $(this).data('id');
        let data = {
            "_token": "{{ csrf_token() }}",
            "id":id
         }

        $.ajax({
            url: "{{ route('admin.service.delete') }}",
            data: data,
            type: "POST",
            dataType : "json",
        })
          // Code to run if the request succeeds (is done);
          // The response is passed to the function
          .done(function(data) {
            window.location.reload();
          })
          .fail(function( xhr, status, errorThrown ) {
            console.log( "Error: " + errorThrown );
            console.log( "Status: " + status );
            console.dir( xhr );
          });

      });

      });

  </script>

@endsection
