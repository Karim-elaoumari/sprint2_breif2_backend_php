<!-- <div class="modal fade" id="update_modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="update_query.php">
        <div class="modal-header">
          <h3 class="modal-title">Update User</h3>
        </div>
        <div class="modal-body">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Firstname</label>
              <input type="hidden" name="user_id" value=""/>
              <input type="text" name="firstname" value="" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>Lastname</label>
              <input type="text" name="lastname" value="" class="form-control" required="required" />
            </div>
            <div class="form-group">
              <label>Address</label>
              <input type="text" name="address" value="" class="form-control" required="required"/>
            </div>
          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="modal-footer">
          <button name="update" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Update</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
        </div>
        </div>
      </form>
    </div>
  </div>
</div> -->


<form  class="modal fade" id="<?php echo $row['task_id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" action="scripts.php" method="POST">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <h1 class="modal-title fs-5" id="staticBackdropLabel">Task</h1>
			  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="modal_body">
				<div class="mb-3 pt-2">
					<label for="exampleFormControlInput1" class="form-label">Title</label>
					<input type="text" class="form-control" id="form_title" name="form_title" placeholder=""value required minlength="3" maxlength="60" size="60" required>
				</div>
				<label for="exampleFormControlInput1" class="form-label">Type</label>
				<div class="form-check mt-2 ms-2">
				  
				  <input type="radio" class="form-check-input" name="form_type" id="form_Bug" value="Bug">
				  <label class="form-check-label" for="validationFormCheck2">Bug</label>
				</div>
				<div class="form-check mb-4 ms-2">
				  <input type="radio" class="form-check-input" name="form_type" id="form_Feature" value="Feature">
				  <label class="form-check-label" for="validationFormCheck3">Feature</label>
				</div>
				<div class="col-md-4 w-100 mb-4">
					<label for="inputState" class="form-label">Priority</label>
					<select name="form_options_priority" id="form_options_priority" class="form-select " >
					<option selected>Please select</option>
					<option value="High">High</option>
					<option value="Medium">Medium</option>
					<option value="Low">Low</option>
					</select>
				</div>
			  
				<div class="col-md-4 w-100 mb-4">
					<label for="inputState" class="form-label">Status</label>
					<select name="form_options_status" id="form_options_status" class="form-select " required>
					  <option selected>Please select</option>
					  <option value="To Do">To Do</option>
					  <option value="In Progress">In Progress</option>
					  <option value="Done">Done</option>
					</select>
				</div>
			  
				<div class="md-form md-outline input-with-post-icon datepicker mb-4">
					<label for="inputState" class="form-label">Date</label>
					<input placeholder="Select date" type="date" name="form_date" id="form_date" class="form-control" required>
				</div>
				<div class="form-group mb-4">
					<label for="inputState" class="form-label">Description</label>
					<textarea class="form-control" name="form_description" id="form_description" rows="3" required></textarea>
				  </div>
			</div>
			<div class="modal-footer" id="modal_footer">
			  <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Cancel</button>
			  <button type="submit" name="delete" class="btn btn-danger task-action-btn" id="task-delete-btn">Delete</a>
			  <button type="submit" name="update" class="btn btn-warning task-action-btn" id="task-update-btn">Update</a>
			  <button type="submit" name="save" class="btn btn-primary task-action-btn" id="task-save-btn">Save</button>
			</div>
		  </div>
		</div>
	</form> 