function get_loaded_policies(){
    document.getElementById("table_all_policies").hidden = true;
    document.getElementById("table_loaded_policies").hidden = false;
    document.getElementById("show_loaded_policies_btn").style.background = "#0088a9";
    document.getElementById("show_all_policies_btn").style.background = "grey";
    $("#t_body_loaded").load("load_loaded_policies.php")
}

function get_all_policies(){
      document.getElementById("table_all_policies").hidden = false;
      document.getElementById("table_loaded_policies").hidden = true;
      document.getElementById("show_loaded_policies_btn").style.background = "grey";
      document.getElementById("show_all_policies_btn").style.background = "#0088a9";
      $("#t_body_all").load("load_all_policies.php");
}
