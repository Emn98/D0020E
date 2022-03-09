
function get_loaded_policies() {

  /*Change the background color of the show loaded policies button to blue to
    indicate that it is the loaded policies which is currently being displayed */
  document.getElementById("show_loaded_policies_btn").style.background ="#0088a9";
  document.getElementById("show_all_policies_btn").style.background = "grey";
  
  //Load all policies which is regarded as loaded in our database 
  $("#t_head_main_page").load("load_policies_backend_main_page.php", 
  {
    part: "head",
    table: "loaded",
  });
  $("#t_body_main_page").load("load_policies_backend_main_page.php", 
  {
    part: "body",
    table: "loaded",
  });

  //Check if the "combined policy" is loaded into the ngac system
  if(is_combined_policy_loaded_into_nagc() == true){
    var combined_policy_row = '<tr class="combined_policy_row">' +
                              '<td>Combined Policy</td>' +
                              '<td></td>' +
                              '<td><input type="button" value="Set" class="set_btn" onclick="set_policy('+"'"+'combined policy'+"'"+')"></td>' +
                              '<td><input type="button" value="Unload" class="table_btn" onclick="unload_policy('+"'"+'combined policy'+"'"+')" style="width: 50px;"></td>'+
                              '<td></td>'+
                              '</tr>';

    //Append the row for the combined policy onto the table
    var txtvalue = $('#t_body_main_page').find("td").find("h1").html();
    if(txtvalue == "There are no loaded policies"){
      $('#t_body_main_page').empty();
      $("#t_body_main_page").append(combined_policy_row);
    }else{
      $("#t_body_main_page").append(combined_policy_row);
    }    
  }
}

function get_all_policies() {
   /*Change the background color of the show all policies button to blue to
    indicate that all policies is currently being displayed */
  document.getElementById("show_loaded_policies_btn").style.background = "grey";
  document.getElementById("show_all_policies_btn").style.background = "#0088a9";

  //Load all stored policies from the database
  $("#t_head_main_page").load("load_policies_backend_main_page.php", {
    part: "head",
    table: "all",
  });
  $("#t_body_main_page").load("load_policies_backend_main_page.php", {
    part: "body",
    table: "all",
  });
  
}
