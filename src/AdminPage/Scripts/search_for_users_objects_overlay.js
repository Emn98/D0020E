const search_input = document.querySelector("[data-search]")

/*Run this funtion everytime the user types in the search bar associated with
  the users and objects overlay */
search_input.addEventListener("input", e => {
  const search_word = e.target.value;
  
  //Retrive which table the user is looking at(i.e Users or Objects)
  const current_table = document.getElementById("admin_man_title").innerHTML;

  //Update the table
  $("#admin_man_table_body").load("/AdminPage/Overlays/UsersAndObjectsOverlay/search_users_objects_overlay.php",
    {
      current_table: current_table,
      search_word: search_word
    }
  );

})

//If the user pressess enter when searcing after users/objects. 
$(document).ready(function () {
  $("#admin_man_search_form").on("submit", function (event) {
    event.preventDefault();

    var current_table;
    var search_word;

    //Retrive which table the user is looking at(i.e Users or Objects)
    current_table = document.getElementById("admin_man_title").innerHTML;

    //Retrive the search_word
    search_word = document.getElementById("admin_man_search_inp").value;
    document.getElementById("admin_man_search_inp").value = "";

    $("#admin_man_table_body").load("/AdminPage/Overlays/UsersAndObjectsOverlay/search_users_objects_overlay.php",
      {
        current_table: current_table,
        search_word: search_word,
      }
    );
  });
});
