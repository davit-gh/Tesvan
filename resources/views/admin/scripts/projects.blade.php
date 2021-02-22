<script type="text/javascript">

  $(function () {
      $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('project.list.dt') !!}",
        columns: [
        { data: "project_name" },
        { data: "project_logo" },
        { data: "project_overview" },
        { data: "project_challenge" },
        { data: "project_solution" },
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
          url: "{{ route('project.delete') }}",
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
