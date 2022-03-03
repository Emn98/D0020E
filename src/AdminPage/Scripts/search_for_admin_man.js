$(document).ready(function () {
  $("#admin_man_search_form").on("submit", function (event) {
    event.preventDefault();

    var current_table;
    var search_word;

    //Retrive which table the user is looking at(i.e Users, Objects or Operations)
    current_table = document.getElementById("admin_man_title").innerHTML;

    //Retrive the search_word
    search_word = document.getElementById("admin_man_search_inp").value;
    document.getElementById("admin_man_search_inp").value = "";

    $("#admin_man_table_body").load(
      "/AdminPage/Overlays/search_admin_man_backend.php",
      {
        current_table: current_table,
        search_word: search_word,
      }
    );
  });
});
