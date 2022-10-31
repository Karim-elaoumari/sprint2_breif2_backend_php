<?php
    //INCLUDE DATABASE FILE
    include('database.php');
   
    //SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    session_start();

    //ROUTING
    if(isset($_POST['save']))        saveTask($conn);
    if(isset($_POST['update']))      updateTask($conn);
    if(isset($_POST['drop']))      updateTask($conn);
    if(isset($_POST['delete']))      deleteTask($conn);

    function get_post(){
        $title = filter_var($_POST['form_title'],FILTER_SANITIZE_STRING);
        $type=$_POST['form_type'];
        $priority = $_POST['form_options_priority'];
        $status = $_POST['form_options_status'];
        $date = $_POST['form_date'];
        $description = filter_var($_POST['form_description'],FILTER_SANITIZE_STRING);

        if($type =='Bug'){
            $type_id =1;	
        }
        else{
            $type_id =2;
        }
        if($priority=='High'){
            $priority_id =1;
        }
        else if($priority=='Medium'){
            $priority_id =2;
        }
        else{
            $priority_id =3;
        }
        if($status=='To Do'){
            $status_id =1;
        }
        else if($status=='In Progress'){
            $status_id = 2;
        }
        else{
            $status_id= 3;
        }
        $reqests=[$title,$type_id,$priority_id,$status_id,$date,$description];
        return $reqests;
    }
    function saveTask($conn)
    {
        //CODE HERE
        $requests = get_post();
         //SQL INSERT

        $sql = "INSERT INTO tasks (title, type_id, priority_id, status_id, task_datetime, description) VALUES ('$requests[0]', '$requests[1]', '$requests[2]', '$requests[3]', '$requests[4]', '$requests[5]')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "Task has been added successfully !";
		    header('location: index.php');
        } else {
            $_SESSION['danger'] = "Task didn't save retry again !";
		    header('location: index.php');
        }
    }
    function updateTask($conn)
    {
        //CODE HERE
        $requests = get_post();
        $task_id = $_POST['task_id'];
        //SQL UPDATE

        $sql = "UPDATE `tasks` SET 
        `title` = '$requests[0]', 
        `type_id` = '$requests[1]', 
        `priority_id` = '$requests[2]', 
        `status_id` = '$requests[3]', 
        `task_datetime` = '$requests[4]',
        `description` = '$requests[5]'
        where `id`= '$task_id'";

        if (mysqli_query($conn, $sql)) {
            if(isset($_POST['update'])){
                $_SESSION['message'] = "Task has been updated successfully !";
            }
            header('location: index.php');
        } else {
        echo "Error updating record: " . $conn->error;
        }
    }
    function deleteTask($conn)
    {
        $task_id=$_POST['task_id'];
        $sql = "DELETE FROM tasks WHERE id=$task_id";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "Task has been deleted successfully !";
            header('location: index.php');
        } else {
        echo "Error deleting record: " . $conn->error;
        }  
    }
    function getTasks($taskk,$conn){
            $sql = "SELECT  tasks.id as task_id, tasks.title, tasks.description, tasks.task_datetime, types.name AS type_name, priorities.name AS priority_name, statuses.name AS status_name FROM tasks inner join types on tasks.type_id = types.id  inner join statuses on tasks.status_id = statuses.id  inner join priorities on priorities.id= tasks.priority_id ";
            $result = $conn->query($sql);
            //$to_counter=0;
            $in_counter=0;
            $done_counter=0;
            $to_counter=0;
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {


                $title = $row["title"];
                $date = $row["task_datetime"];
                $description = $row["description"];
                $type = $row["type_name"];
                $priority = $row["priority_name"];
                $status = $row["status_name"];
                $task_id = $row["task_id"];


                if($status=='To Do' && $status==$taskk){
                    $to_counter++;
                    echo '<script>document.getElementById("to_do_tasks_count").innerHTML="'.$to_counter.'" </script>';
                    echo '
                    <button class="border border-white  rounded text-start border-secondary mb-3 w-100 d-flex item"   id="'.$task_id.'" onclick="show_form(this.id);"  style="background-color:#EDE7E7;"  draggable="true" ondrag="drag(event)">
        <div class="col-1 pt-2">
            <i class="fa fa-question-circle fs-3 text-green"></i> 
        </div>
        <div class="col-11 ps-1">
            <div data="'.$title.'" id="'.$task_id."t".'" class="fw-bold fs-5">'.$title.'</div>
            <div class="">
                 <input type="hidden" id="'.$task_id."s".'" data="'.$status.'">
                <div data="'.$date.'" id="'.$task_id."d".'" class="fw-fw-light text-muted" >#'.$task_id.' created in '.$date.'</div>
                <div data="'.$description.'" id="'.$task_id."de".'" class="" title="">'.substr($description,0,70)."...".'</div>
            </div>
            <div class="btn ps-0">
                <span data="'.$priority.'" id="'.$task_id."p".'" class="btn-primary btn-sm p-0.2 ps-2 pe-2">'.$priority.'</span>
                <span data="'.$type.'" id="'.$task_id."ty".'" class="btn-secondary btn-sm p-0.2	ps-2 pe-2">'.$type.'</span>
            </div>
        </div>
    </button>';
                }



                else if($status=='In Progress' && $status==$taskk){
                    
                   $in_counter++;
                   echo '<script>document.getElementById("in_progress_tasks_count").innerHTML="'.$in_counter.'" </script>';
                    echo '
                    <button class="border border-white   rounded text-start border-secondary mb-3 w-100 d-flex item" id="'.$task_id.'" onclick="show_form(this.id);"  style="background-color:#EDE7E7;"  draggable="true" ondrag="drag(event)">
        <div class="col-1 pt-2">
            <i class="spinner-border spinner-border-sm fs-2 text-green"></i>
        </div>
        <div class="col-11 ps-1">
            <div data="'.$title.'" id="'.$task_id."t".'" class="fw-bold fs-5">'.$title.'</div>
            <div class="">
                <input type="hidden" id="'.$task_id."s".'" data="'.$status.'">
                <div  data="'.$date.'" id="'.$task_id."d".'" class="fw-fw-light text-muted">#'.$task_id.' created in '.$date.'</div>

                <div data="'.$description.'" id="'.$task_id."de".'" class="" title="">'.substr($description,0,70)."...".'</div>
            </div>
            <div class="btn ps-0">
                <span  data="'.$priority.'" id="'.$task_id."p".'" class="btn-primary btn-sm p-0.2 ps-2 pe-2">'.$priority.'</span>
                <span data="'.$type.'" id="'.$task_id."ty".'" class="btn-secondary btn-sm p-0.2	ps-2 pe-2">'.$type.'</span>
            </div>
        </div>
    </button> ';
                }




                else if($status=='Done' && $status==$taskk){
                    $done_counter++;
                    echo '<script>document.getElementById("done_tasks_count").innerHTML="'.$done_counter.'" </script>';
                    echo '
                    <button class="border border-white  rounded text-start border-secondary mb-3 w-100 d-flex item" id="'.$task_id.'" onclick="show_form(this.id);" style="background-color:#EDE7E7;"   draggable="true" ondrag="drag(event)">
        <div class="col-1 pt-2">
            <i class="fa fa-check-circle fs-3 text-green"></i>
        </div>
        <div class="col-11 ps-1">
            <div data="'.$title.'" id="'.$task_id."t".'" class="fw-bold fs-5">'.$title.'</div>
            <div class="">
                <input type="hidden" id="'.$task_id."s".'" data="'.$status.'">
                <div data="'.$date.'" id="'.$task_id."d".'" class="fw-fw-light text-muted">#'.$task_id.' created in '.$date.'</div>
                <div data="'.$description.'" id="'.$task_id."de".'">'.substr($description,0,70)."...".'</div>
            </div>
            <div class="btn ps-0">
                <span data="'.$priority.'" id="'.$task_id."p".'" class="btn-primary btn-sm p-0.2 ps-2 pe-2">'.$priority.'</span>
                <span data="'.$type.'" id="'.$task_id."ty".'" class="btn-secondary btn-sm p-0.2	ps-2 pe-2">'.$type.'</span>
            </div>
        </div>
    </button> ';
                }
            }
        } 
    }

?>