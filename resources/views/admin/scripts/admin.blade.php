<script type="text/javascript">

	$(document).ready(function(){

		$(document).on("click",".addMoreObjective",function(e){
			e.preventDefault();
			$(`
			<div class="form-group">
            <label for="exampleInputEmail1">Objective</label>
            <div class="input-group">
              <input value="{{ old('project_objective.0') }}" class="form-control" type="text" name="project_objective[]">
              <div class="input-group-prepend">
                <button class="rmObjective btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>`).insertBefore("#objective-action");
		});

		$(document).on("click",".addMoreResult",function(e){
			e.preventDefault();
			$(`
			<div class="form-group">
            <label for="exampleInputEmail1">Result</label>
            <div class="input-group">
              <input value="{{ old('project_result.0') }}" class="form-control" type="text" name="project_result[]">
              <div class="input-group-prepend">
                <button class="rmResult btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>`).insertBefore("#result-action");
		});

		$(document).on("click",".addMoreTwu",function(e){
			e.preventDefault();
			$(`<div id="twu-container-field-gen">
			<div class="form-group">
            <label for="exampleInputEmail1">Name</label>
             <input class="form-control" type="text" name="project_twu_name[]">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Logo</label>
             <input class="form-control" type="file" name="project_twu_logo[]">
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
      
      con = $(".objective-container > div").length;
      if (con>2){
          $(this).parent().parent().parent().remove();
      }
    });

    $(document).on("click",".rmResult",function(e){
      e.preventDefault();
      
      con = $(".objective-container > div").length;
      if (con>2){
          $(this).parent().parent().parent().remove();
      }
    });

    $(document).on("click",".rmTwu",function(e){
      e.preventDefault();  
      $('.twu-container > #twu-container-field-gen:last').remove();
    });

    $(document).on("click",".rmCf",function(e){
      e.preventDefault();  
      $('.cf-container > #cf-container-gen:last').remove();
    });

	});

</script>
