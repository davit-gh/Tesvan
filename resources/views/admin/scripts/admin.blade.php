<script type="text/javascript">

	$(document).ready(function(){

		$(document).on("click",".addMoreObjective",function(e){
			e.preventDefault();
			$(`
			<div class="form-group" id="objectiveGenerated">
            	<label for="exampleInputEmail1">Objective</label>
             	<input class="form-control" type="text" name="project_objective[]">
          	</div>`).insertBefore("#objective-action");
		});

		$(document).on("click",".addMoreResult",function(e){
			e.preventDefault();
			$(`
			<div class="form-group">
            <label for="exampleInputEmail1">Result</label>
             <input class="form-control" type="text" name="project_result[]">
          </div>`).insertBefore("#result-action");
		});

		$(document).on("click",".addMoreTwu",function(e){
			e.preventDefault();
			$(`
			<div class="form-group">
            <label for="exampleInputEmail1">Name</label>
             <input class="form-control" type="text" name="project_twu_name[]">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Logo</label>
             <input class="form-control" type="file" name="project_twu_logo[]">
          </div>`).insertBefore("#twu-action");
		});

		$(document).on("click",".addMoreCF",function(e){
			e.preventDefault();
			$(`<hr>
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
          </div>`).insertBefore("#cf-action");
		});

	});

</script>
