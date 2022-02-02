//This function retrives all polices that is regarded as loaded in our database. 
function get_loaded_policies(){
    document.getElementById("show_loaded_policies_btn").style.background = "#0088a9";
    document.getElementById("show_all_policies_btn").style.background = "grey";
    $("#t_body_loaded").load("load_loaded_policies.php");
    document.getElementById("table_all_policies").hidden = true;
    document.getElementById("table_loaded_policies").hidden = false;
   

}

//This function retrives all policies stored in our database. 
function get_all_policies(){
      document.getElementById("show_loaded_policies_btn").style.background = "grey";
      document.getElementById("show_all_policies_btn").style.background = "#0088a9";
      $("#t_body_all").load("load_all_policies.php");
      document.getElementById("table_all_policies").hidden = false;
      document.getElementById("table_loaded_policies").hidden = true;
}
