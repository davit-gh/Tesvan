<script type="text/javascript">

  $(function () {
      $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('team.list.dt') !!}",
        columns: [
        { data: "name" },
        { data: "position" },
        { data: "place_number" },
        { data: "photo" },
        { data: "background_color" },
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
