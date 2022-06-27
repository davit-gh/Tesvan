<script type="text/javascript">

  function deleteEntity(id, caseEntity, returnData){
    let data = {
        "_token": "{{ csrf_token() }}",
        "id":id,
        "case":caseEntity
     }
    $.ajax({
        url: "{{ route('project.delete.entity') }}",
        data: data,
        type: "POST",
        dataType : "json",
    }).done(function(data) {
      returnData(data);
    }).fail(function( xhr, status, errorThrown ) {
      returnData(errorThrown);
    });
  }

	$(document).ready(function(){

		$(document).on("click",".addMoreObjective",function(e){
			e.preventDefault();
			$(`
			<div id="objective-container-field-gen">
			<div class="form-group">
            <label for="exampleInputEmail1">Objective</label>
            <div class="input-group">
              <input value="{{ old('project_objective.0') }}" class="form-control" type="text" name="project_objective[]">
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Objective (in Armenian)</label>
            <div class="input-group">
              <input value="{{ old('project_objective_am.0') }}" class="form-control" type="text" name="project_objective_am[]">
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Objective (in Russian)</label>
            <div class="input-group">
              <input value="{{ old('project_objective_ru.0') }}" class="form-control" type="text" name="project_objective_ru[]">
            </div>
          </div>
          <div class="form-group input-group-prepend">
             <button class="rmObjective btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
          </div></div>`).insertBefore("#objective-action");
		});

		$(document).on("click",".addMoreResult",function(e){
			e.preventDefault();
			$(`
			<div id="result-container-field-gen">
			<div class="form-group">
            <label for="exampleInputEmail1">Result</label>
            <div class="input-group">
              <input value="{{ old('project_result.0') }}" class="form-control" type="text" name="project_result[]">

            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Result(in Armenian)</label>
            <div class="input-group">
              <input value="{{ old('project_result_am.0') }}" class="form-control" type="text" name="project_result_am[]">

            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Result(in Russian)</label>
            <div class="input-group">
              <input value="{{ old('project_result_ru.0') }}" class="form-control" type="text" name="project_result_ru[]">

            </div>
          </div>
          <div class="form-group input-group-prepend">
             <button class="rmResult btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
          </div>
          </div>`).insertBefore("#result-action");
		});

		$(document).on("click",".addMoreTwu",function(e){
			e.preventDefault();
			$(`<div id="twu-container-field-gen">
          <div class="form-group">
            <label for="exampleInputEmail1">Logo</label>
             <input class="form-control" type="file" name="project_twu_logo[]">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
             <input class="form-control" value="{{ old('project_twu_name.0') }}" type="text" name="project_twu_name[]">
          </div></div>`).insertBefore("#twu-action");
		});

		$(document).on("click",".addMoreCF",function(e){
			e.preventDefault();
			$(`
        <div id="cf-container-gen">
			<hr>
      <div class="form-group">
            <label for="exampleInputEmail1">Client Feedback</label>
            <textarea class="form-control" name="project_cf_feedback[]"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Client Name</label>
            <input class="form-control" type="text" name="project_cf_name[]">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Client Photo</label>
             <input class="form-control" type="file" name="project_cf_photo[]">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Client Website</label>
            <input class="form-control" type="text" name="project_cf_website[]">
          </div></div>`).insertBefore("#cf-action");
		});

    $(document).on("click",".rmObjective",function(e){
      e.preventDefault();
      thisEl = $(this);

      con = $(".objective-container > div").length;
      if (con>2){
          deleteEntity($(this).data('id'), "objective", function(returnData){
            //if(returnData=="success"){
              thisEl.parent().parent().remove();
            //} else {

            //}
          });
      }
    });

    $(document).on("click",".rmResult",function(e){
      e.preventDefault();
      thisEl = $(this);

      con = $(".result-container > div").length;
      if (con>2){
          deleteEntity($(this).data('id'), "result", function(returnData){
            //if(returnData=="success"){
              thisEl.parent().parent().remove();
            //} else {

            //}
          });

      }
    });

    $(document).on("click",".rmTwu",function(e){
      e.preventDefault();
      deleteEntity($(this).data('id'), "tool", function(returnData){
        //if(returnData=="success"){
          $('.twu-container > #twu-container-field-gen:last').remove();
        //} else {

        //}
      });
    });

    $(document).on("click",".rmCf",function(e){
      e.preventDefault();
      deleteEntity($(this).data('id'), "cf", function(returnData){
        //if(returnData=="success"){
          $('.cf-container > #cf-container-gen:last').remove();
        //} else {

        //}
      });
    });



	});
</script>
