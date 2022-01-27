$(document).ready(function(){
  $(".search_bar_form").on("submit", function(event){
    event.preventDefault();
      
    var table;
    var table_id;
    var search_by;
    var search_word;

    //Get value from search bar
    var search_word = document.getElementById("myInput").value;
    
    //Select the table currently in view
    if(document.getElementById("table_all_policies").hidden == false){
      table = "all_policies";
      table_id = "#t_body_all"
    }else{
      table = "loaded_policies";
      table_id = "#t_body_loaded"
    }

    //Show all policies belonging to a specific table if empty string has been entered.
    if(table_id == "#t_body_all" && search_word==""){
      get_all_policies();
      return;
    }else if(table_id == "#t_body_loaded" && search_word==""){
      get_loaded_policies();
      return;
    }
      
    //Determine which checkbox have been checked
    if($('.policy_name_check:checked').val() == "on"){
      search_by = "Policy_name";
    }else if($('.user_check:checked').val() == "on"){
      search_by = "Users";
    }else{
      search_by = "Objects";
    }

    $(table_id).load("search_backend.php", {
      table: table, 
      search_by: search_by,
      search_word: search_word
      });
    });
});