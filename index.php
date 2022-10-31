

<?php
    include('scripts.php');
?>
 
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8" />
	<title>YouCode | Scrum Board</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN core-css ================== -->
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/css/vendor.min.css" rel="stylesheet" />
	<link href="assets/css/default/app.min.css" rel="stylesheet" />
	<link href="assets/css/style.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js" integrity="sha512-Eezs+g9Lq4TCCq0wae01s9PuNWzHYoCMkE97e2qdkYthpI0pzC3UGB03lgEHn2XM85hDOUF6qgqqszs+iXU4UA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
	
	<!-- ================== END core-css ================== -->
</head>
<body>



  
	<!-- BEGIN #app -->
	<div id="app" class="app-without-sidebar bg-gray-200">
	<div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div>
	<!-- END #loader -->


		<!-- BEGIN #content -->
		<div id="content" class="app-content" style="min-height: 100vh; background: url(assets/img/cover/cover-scrum-board.png) no-repeat fixed; background-size: 360px; background-position: right bottom;">
		
			
			<div class="navbar">
				
				<div class="">
					
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
						<li class="breadcrumb-item active">Scrum Board</li>
					</ol>
					<!-- BEGIN page-header -->
					<h1 class="page-header">
						Scrum Board
					</h1>
					
					<!-- END page-header -->
				</div>
				
				<div class="">
				
					<button type="button" class=" btn btn-outline-primary rounded-pill"   id="click" onclick="clear_form();" ><i class="fa fa-plus pe-2"> </i>Add Task</button>
					<button type="button" style="display:none"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="clicked"></button>
					<img src="https://youcode.ma/images/logo.png" style="width:150px;padding-left:20px">
				</div>
				
			</div>
			
		
			<div class=" row justify-content-around " >
				
				<?php if (isset($_SESSION['message'])): ?>
				<div class="alert alert-green alert-dismissible fade show">
				<strong>Success!</strong>
					<?php 
						echo $_SESSION['message']; 
						unset($_SESSION['message']);
					?>
					<button type="button" class="btn-close" data-bs-dismiss="alert"></span>
				</div>
			    <?php endif ?>


				<?php if (isset($_SESSION['danger'])): ?>
				<div class="alert alert-danger alert-dismissible fade show">
				<strong>Failed!</strong>
					<?php 
						echo $_SESSION['danger']; 
						unset($_SESSION['danger']);
					?>
					<button type="button" class="btn-close" data-bs-dismiss="alert"></span>
				</div>
			    <?php endif ?>
				<!-- <div class="card w-25 shadow p-2 mb-5" style="min-width: 18rem;"> -->
				<div class=" card col-lg-3 col-sm-6 mb-3"style="min-width:300px;">
					<div class="card-body p-0">
						<div class="">
							<h4 class="p-2">To do(<span id="to_do_tasks_count"></span>)</h4>

						</div>
						<div id="to_do_tasks" class="wrappere"  ondragover="allowDrop(event)" ondrop="dropedToDo(event)">
							<!-- TO DO TASKS HERE -->
							<?php
							    
								getTasks("To Do",$conn);
								
                            ?>

						</div>
					</div>
				</div>
				<div class="card col-lg-3 col-sm-6 mb-3" style="min-width:300px;">
					<div class="card-body p-0">
						<div class="">
							<h4 class="p-2">In Progress (<span id="in_progress_tasks_count"></span>)</h4>

						</div>
						<div  id="in_progress_tasks" class="wrapper" ondragover="allowDrop(event)" ondrop="dropedInProgress(event)">
							<!-- IN PROGRESS TASKS HERE -->


							<?php
								getTasks("In Progress",$conn);
                            ?>

						</div>
					</div>
				</div>
				<div class=" card col-lg-3 col-sm-12 mb-3 me-2 ms-2" style="max-width:100%;min-width:300px;" >
					<div class="card-body p-0">
						<div class="">
							<h4 class="p-2">Done (<span id="done_tasks_count"></span>)</h4>

						</div>
						
						
						<div id="done_tasks" class="wrapperr" ondragover="allowDrop(event)" ondrop="dropedDone(event)">
							<!-- DONE TASKS HERE -->


							<?php
							    
								getTasks("Done",$conn);
								
                            ?>


							
				        </div>
						
					</div>
				</div>
			</div>
		</div>
		<!-- END #content -->

		
		
		<!-- BEGIN scroll-top-btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
		<!-- END scroll-top-btn -->
	</div>
	<!-- END #app -->
	
	<!-- TASK MODAL -->
	

	<form  class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" action="scripts.php" method="POST">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Task</h1>
			  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="modal_body">
				<input type="hidden" name="task_id" id="task_Id" >
				<div class="mb-3 pt-2">
					<label for="exampleFormControlInput1" class="form-label">Title</label>
					<input type="text" class="form-control" id="form_title" name="form_title" placeholder="Type Task Title Here" required minlength="3" maxlength="60" size="60" required>
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
					<select name="form_options_priority" id="form_options_priority" class="form-select " required>
					<option value="">Please select</option>
					<option value="High">High</option>
					<option value="Medium">Medium</option>
					<option value="Low">Low</option>
					</select>
				</div>
			  
				<div class="col-md-4 w-100 mb-4">
					<label for="inputState" class="form-label">Status</label>
					<select name="form_options_status" id="form_options_status" class="form-select" required>
					  <option value="">Please select</option>
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
			  <button type="submit" name="delete" class="btn btn-danger task-action-btn" id="task-delete-btn">Delete</button>
			  <button type="submit" name="update" class="btn btn-warning task-action-btn" id="task-update-btn">Update</button>
			  <button type="submit" name="drop" style="display:none" id="task_button"></button>
			  <button type="submit" name="save" class="btn btn-primary task-action-btn" id="task-save-btn">Save</button>
			</div>
		  </div>
		</div>
	</form> 

	

	

	
	<!-- ================== BEGIN core-js ================== -->
    
	<script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>
	<script src="scripts.js"></script>
    
	<!-- ================== END core-js ================== -->
</body>
</html>