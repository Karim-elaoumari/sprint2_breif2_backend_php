

function clear_form(){
    staticBackdrop.reset();
    document.getElementById("clicked").click();
}



function fill_form(id){
  let task_title = document.getElementById(id+'t');
  
  let task_type = document.getElementById(id+'ty');
  
  let task_priority = document.getElementById(id+'p');

  let task_status = document.getElementById(id+'s');
  
  let task_description = document.getElementById(id+'de');
  
  let task_date = document.getElementById(id+'d');
  task_Id.value=id;

  staticBackdropLabel.innerHTML= "Edit Task";
  form_title.value=task_title.getAttribute("data");
  form_date.value=task_date.getAttribute("data");
  form_description.value = task_description.getAttribute("data");
  
  if(task_type.getAttribute("data")=="Bug"){
  form_Bug.checked = true;
  }
  else {
  form_Feature.checked =true;
  }
  form_options_priority.value=task_priority.getAttribute("data");
}

function show_form(id){
  let task_title = document.getElementById(id+'t');
  
  let task_type = document.getElementById(id+'ty');
  
  let task_priority = document.getElementById(id+'p');

  let task_status = document.getElementById(id+'s');
  
  let task_description = document.getElementById(id+'de');
  
  let task_date = document.getElementById(id+'d');
  task_Id.value=id;

  staticBackdropLabel.innerHTML= "Edit Task";
  form_title.value=task_title.getAttribute("data");
  form_date.value=task_date.getAttribute("data");
  form_description.value = task_description.getAttribute("data");
  
  if(task_type.getAttribute("data")=="Bug"){
  form_Bug.checked = true;
  }
  else {
  form_Feature.checked =true;
  }
  form_options_priority.value=task_priority.getAttribute("data");
    form_options_status.value=task_status.getAttribute("data");
    
    document.getElementById("clicked").click();	
}


function allowDrop(e){
    e.preventDefault();
  }
 
  
  // Global Variable: 
  let indexToMove;
  // GETS THE ID OF THE DRAGED ELEMENT
  function drag(e)
  {
    e.preventDefault();
    indexToMove= e.target.id;
  }
  
  // THIS Fct GETS TRIG IF THE ELEMENT CALLED IN WAS THE DROP TARGET
  function dropedInProgress(e)
  {
    
    fill_form(indexToMove);
    form_options_status.value="In Progress";
    
    document.getElementById('task_button').click();
    }
  
  // THIS Fct GETS TRIG IF THE ELEMENT CALLED IN WAS THE DROP TARGET
  function dropedToDo(e)
  {
    fill_form(indexToMove);
    form_options_status.value="To Do";
   
    document.getElementById('task_button').click();
  }
  
  // THIS Fct GETS TRIG IF THE ELEMENT CALLED IN WAS THE DROP TARGET
  function dropedDone(e)
  {
    fill_form(indexToMove);
    form_options_status.value="Done";
   
    document.getElementById('task_button').click();
  }
  
  // THIS Fct GETS TRIG IF THE ELEMENT CALLED IN WAS THE DROP TARGET
  