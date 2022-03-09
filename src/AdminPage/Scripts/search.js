const search_inp = document.querySelector("[policy-search]")

//Run this funtion everytime the user types in the search bar
search_inp.addEventListener("input", e => {
  const search_word = e.target.value
  let table;
  let search_by;

  /*Get the current table by determining which background color the... 
     "show all policies button" have */
     if (show_all_policies_btn.style.backgroundColor == "rgb(0, 136, 169)") {
      table = "all_policies";
    } else {
      table = "loaded_policies";
    }

    //Determine which checkbox have been checked
    if ($(".policy_name_check:checked").val() == "on") {
      search_by = "Policy_name";
    } else if ($(".user_check:checked").val() == "on") {
      search_by = "Users";
    } else {
      search_by = "Objects";
    }

    //Send search_word, search_by and table infor to the backend.
    $("#t_body_main_page").load("search_backend.php", {
      table: table,
      search_by: search_by,
      search_word: search_word,
    });
  

})


//If the users pressess enter 
$(document).ready(function () {
  $(".search_bar_form").on("submit", function (event) {
    event.preventDefault();

    var table;
    var search_by;
    var search_word;

    //Get value from search bar and then clear it
    var search_word = document.getElementById("myInput").value;
    document.getElementById("myInput").value = "";

    /*Get the current table by determining which background color the... 
     "show all policies button" have */
    if (show_all_policies_btn.style.backgroundColor == "rgb(0, 136, 169)") {
      table = "all_policies";
    } else {
      table = "loaded_policies";
    }

    //Determine which checkbox have been checked
    if ($(".policy_name_check:checked").val() == "on") {
      search_by = "Policy_name";
    } else if ($(".user_check:checked").val() == "on") {
      search_by = "Users";
    } else {
      search_by = "Objects";
    }

    //Send search_word, search_by and table infor to the backend.
    $("#t_body_main_page").load("search_backend.php", {
      table: table,
      search_by: search_by,
      search_word: search_word,
    });
  });
});
