//This function retrives all polices that is regarded as loaded in our database.
function get_loaded_policies() {
  document.getElementById("show_loaded_policies_btn").style.background =
    "#0088a9";
  document.getElementById("show_all_policies_btn").style.background = "grey";
  $("#t_head_main_page").load("load_policies_backend_main_page.php", {
    part: "head",
    table: "loaded",
  });
  $("#t_body_main_page").load("load_policies_backend_main_page.php", {
    part: "body",
    table: "loaded",
  });

  if(is_combined_policy_loaded_into_nagc() == true){
    var combined_policy_row = '<tr class="combined_policy_row">' +
                              '<td>Combined Policy</td>' +
                              '<td></td>' +
                              '<td><input type="button" value="Set" class="set_btn" onclick="set_policy('+"'"+'combined policy'+"'"+')"></td>' +
                              '<td><input type="button" value="Unload" class="table_btn" onclick="unload_policy('+"'"+'combined policy'+"'"+')" style="width: 50px;"></td>'+
                              '<td></td>'+
                              '</tr>';

    var txtvalue = $('#t_body_main_page').find("td").find("h1").html();
    if(txtvalue == "There are no loaded policies"){
      $('#t_body_main_page').empty();
      $("#t_body_main_page").append(combined_policy_row);
    }else{
      $("#t_body_main_page").append(combined_policy_row);
    }
   

    
  }
  
}

//This function retrives all policies stored in our database.
function get_all_policies() {
  document.getElementById("show_loaded_policies_btn").style.background = "grey";
  document.getElementById("show_all_policies_btn").style.background = "#0088a9";
  $("#t_head_main_page").load("load_policies_backend_main_page.php", {
    part: "head",
    table: "all",
  });
  $("#t_body_main_page").load("load_policies_backend_main_page.php", {
    part: "body",
    table: "all",
  });
  
}
