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
