const search_input = document.querySelector("[data-search]")

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
