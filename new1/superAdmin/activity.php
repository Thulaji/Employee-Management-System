<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "project";
  
  // Create a database connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  $query="SELECT * FROM task";
  $result_set= mysqli_query($conn,$query);

  $TId_list="";
  while ($result=mysqli_fetch_assoc($result_set,)){
    $TId_list .="<option value='{$result['TId']}'>{$result['TId']}</option>";
  }
?>
<html>  
    <head>  
        <title>Activities</title>  
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
        <link rel="stylesheet" href="bootstrap.min.css" />  
        <link rel="stylesheet" href="style3.css">

        
    
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  -->
 <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
    </head>  
    <body> 
      
        <section>
        <div class="container">
        <div class="form-value">
   
        <form method="post" id="user_form">
  
        <h3>Activities</a></h3>
    
        <div id="user_dialog" title="Add Data">
        <div class="form-group">

            <label>Task ID</label>
            <select type="text" name="TId_name" id="TId_name" class="form-control">
                <option value="" selected="selected">Select TID</option>
                <?php echo $TId_list;?>
              <span id="error_TId_name" class="text-danger"></span>
                
            </select>
         </div>

        <div class="form-group">
            <label>Activity Name</label>
            <input type="text" name="Activity_name" id="Activity_name" class="form-control" />
            <span id="error_Activity_name" class="text-danger"></span>
        </div>

        <center><div class="btn">
            <input type="hidden" name="row_id" id="hidden_row_id" />
            <button type="button" name="save" id="save" class="btn btn-info">Save</button>
        </div></center>
   
        </div>
         <div class="table-responsive" style="color: #fff;">
            <table class="table table-striped table-bordered" id="user_data" style="color: #fff;">
            <tr>
                <th>TASK ID</th>
                <th>Activityt Name</th>
                <th>Remove</th>
            </tr>
            </table>
        </div>
        <center><div class="btn">
     
        <input type="submit" name="insert" id="insert" class="btn btn-primary" value="Insert"  />
        </div>
        </form>

        <br />
        </div></center>

        <div id="action_alert" title="Action">

        </div>

        </div>
        </section> 
    </body>  
</html> 

<script>  
$(document).ready(function(){ 
 
 var count = 0;


 $('#save').click(function(){
  var error_TId_name = '';
  var error_Activity_name = '';
  var TId_name = '';
  var Activity_name = '';
  if($('#TId_name').val() == '')
  {
   error_TId_name = 'TId Name is required';
   $('#error_TId_name').text(error_TId_name);
   $('#TId_name').css('border-color', '#cc0000');
   TId_name = '';
  }
  else
  {
   error_TId_name = '';
   $('#error_TId_name').text(error_TId_name);
   $('#TId_name').css('border-color', '');
   TId_name = $('#TId_name').val();
  } 
  if($('#Activity_name').val() == '')
  {
   error_Activity_name = 'Activity Name is required';
   $('#error_Activity_name').text(error_Activity_name);
   $('#Activity_name').css('border-color', '#cc0000');
   Activity_name = '';
  }
  else
  {
   error_Activity_name = '';
   $('#error_Activity_name').text(error_Activity_name);
   $('#Activity_name').css('border-color', '');
   Activity_name = $('#Activity_name').val();
  }
  if(error_TId_name != '' || error_Activity_name != '')
  {
   return false;
  }
  else
  {
   if($('#save').text() == 'Save')
   {
    count = count + 1;
    output = '<tr id="row_'+count+'">';
    output += '<td>'+TId_name+' <input type="hidden" name="hidden_TId_name[]" id="TId_name'+count+'" class="TId_name" value="'+TId_name+'" /></td>';
    output += '<td>'+Activity_name+' <input type="hidden" name="hidden_Activity_name[]" id="Activity_name'+count+'" value="'+Activity_name+'" /></td>';
    //output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+count+'">View</button></td>';
    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Remove</button></td>';
    output += '</tr>';
    $('#user_data').append(output);
   }
   else
   {
    var row_id = $('#hidden_row_id').val();
    output = '<td>'+TId_name+' <input type="hidden" name="hidden_TId_name[]" id="TId_name'+row_id+'" class="TId_name" value="'+TId_name+'" /></td>';
    output += '<td>'+Activity_name+' <input type="hidden" name="hidden_Activity_name[]" id="Activity_name'+row_id+'" value="'+Activity_name+'" /></td>';
    //output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+row_id+'">View</button></td>';
    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+row_id+'">Remove</button></td>';
    $('#row_'+row_id+'').html(output);
   }

   $('#user_dialog').dialog('close');
  }
 });

// $(document).on('click', '.view_details', function(){
//   var row_id = $(this).attr("id");
//   var TId_name = $('#TId_name'+row_id+'').val();
//   var Activity_name = $('#Activity_name'+row_id+'').val();
//   $('#TId_name').val(TId_name);
//   $('#Activityt_name').val(Activity_name);
//   $('#save').text('Edit');
//   $('#hidden_row_id').val(row_id);
//   $('#user_dialog').dialog('option', 'title', 'Edit Data');
//   $('#user_dialog').dialog('open');
//  });

 $(document).on('click', '.remove_details', function(){
  var row_id = $(this).attr("id");
  if(confirm("Are you sure you want to remove this row data?"))
  {
   $('#row_'+row_id+'').remove();
  }
  else
  {
   return false;
  }
 });

 $('#action_alert').dialog({
  autoOpen:false
 });

 $('#user_form').on('submit', function(event){
  event.preventDefault();
  var count_data = 0;
  $('.TId_name').each(function(){
   count_data = count_data + 1;
  });
  if(count_data > 0)
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"assigntask.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#user_data').find("tr:gt(0)").remove();
     $('#action_alert').html('<p>' + data + '</p>');
     $('#action_alert').dialog('open');
    }
   })
  }
  else
  {
   $('#action_alert').html('<p>Please Add at least one data</p>');
   $('#action_alert').dialog('open');
  }
 });
});  
</script>