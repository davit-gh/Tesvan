@extends("layouts.admin")

@section('styles')


@endsection

@section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Job Applications</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('job_applications.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Job Applications</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card card-primary">
  <div class="container">
    <style type="text/css">
      table.dataTable tbody td {
        word-break: break-word;
        vertical-align: top;
      }
    </style>
  <table id="datatable" class="table table-bordered table-hover">
      <thead>
          <tr>
              <th>Full Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>City</th>
              <th>Experience</th>
              <th>QA Course</th>
              <th>Frameworks</th>
              <th>Tools</th>
              <th>Salary</th>
              <th>English Level</th>
              <th>CV</th>
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
          ajax: "{!! route('job_applications.data') !!}",
          columns: [
            { data: "name" },
            { data: "email" },
            { data: "phone" },
            { data: "city" },
            { data: "experience" },
            { data: "course" },
            { data: "frameworks" },
            { data: "tools" },
            { data: "salary" },
            { data: "level" },
            { data: "cv" },
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
            url: "{{ route('team.delete') }}",
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
