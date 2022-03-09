//This script handles the logic of a user pressing the "go right"...
//and "go left" buttons when the manage users/objects overlay is visible.

function pressed_right_arrow() {
  var current_table = document.getElementById("admin_man_title").innerHTML;

  //If current table is user then show objects table.
  if (current_table == "Users") {
    $("#admin_man_title").html("Objects");
    $("#admin_man_create_btn").html("Create New Object");
    document
      .getElementById("admin_man_create_btn")
      .setAttribute("onclick", "create_new_object()");
    document.getElementById("left_arrow").hidden = false;
    document.getElementById("right_arrow").hidden = true;
    document.getElementById("admin_man_search_inp").placeholder =
      "Search object by name or id...";
    $("#admin_man_table_head").load(
      "/AdminPage/Overlays/UsersAndObjectsOverlay/load_users_and_objects.php",
      {
        part: "head",
        table: "objects",
      }
    );
    $("#admin_man_table_body").load(
      "/AdminPage/Overlays/UsersAndObjectsOverlay/load_users_and_objects.php",
      {
        part: "body",
        table: "objects",
      }
    );
  }

}

function pressed_left_arrow() {
  var current_table = document.getElementById("admin_man_title").innerHTML;

  //If current table is objects then show users table.
  if (current_table == "Objects") {
    $("#admin_man_title").html("Users");
    $("#admin_man_create_btn").html("Create New User");
    document
      .getElementById("admin_man_create_btn")
      .setAttribute("onclick", "create_new_user()");
    document.getElementById("left_arrow").hidden = true;
    document.getElementById("right_arrow").hidden = false;
    document.getElementById("admin_man_search_inp").placeholder =
      "Search user by name or id...";
    $("#admin_man_table_head").load(
      "/AdminPage/Overlays/UsersAndObjectsOverlay/load_users_and_objects.php",
      {
        part: "head",
        table: "users",
      }
    );
    $("#admin_man_table_body").load(
      "/AdminPage/Overlays/UsersAndObjectsOverlay/load_users_and_objects.php",
      {
        part: "body",
        table: "users",
      }
    );
  }

}
