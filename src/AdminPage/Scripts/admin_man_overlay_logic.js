//This function will create and add a new user to the database
function create_new_user() {
  var full_name = window.prompt("Enter the new user's full name: ");
  var func = "Create user";

  //Control so the does not enter empty string or just a load of spaces
  if (full_name == "" || full_name.trim() == 0) {
    alert("Error: You need to enter a name");
    return;
  }
  if (full_name == null) {
    return;
  }

  $.ajax({
    async: false,
    type: "POST",
    url: "/AdminPage/Overlays/admin_man_overlay_logic_backend.php",
    data: { full_name: full_name, func: func },
    error: function () {
      alert("failure");
    },
  });

  $("#admin_man_table_body").load(
    "/AdminPage/Overlays/load_for_admin_man_overlay.php",
    {
      part: "body",
      table: "users",
    }
  );
}

//This function will create and add a new object to the database
function create_new_object() {
  var full_name = window.prompt("Enter the name of the new object: ");
  var func = "Create object";

  if (full_name == "" || full_name.trim() == 0) {
    alert("Error: You need to enter a name");
    return;
  }
  if (full_name == null) {
    return;
  }

  $.ajax({
    async: false,
    type: "POST",
    url: "/AdminPage/Overlays/admin_man_overlay_logic_backend.php",
    data: { full_name: full_name, func: func },
    error: function () {
      alert("failure");
    },
  });

  $("#admin_man_table_body").load(
    "/AdminPage/Overlays/load_for_admin_man_overlay.php",
    {
      part: "body",
      table: "objects",
    }
  );
}

function edit_user(user_id) {
  var full_name = window.prompt("Enter a new name for the user: ");
  var func = "Edit user";

  if (full_name == "" || full_name.trim() == 0) {
    alert("Error: You need to enter a name");
    return;
  }
  if (full_name == null) {
    return;
  }

  $.ajax({
    async: false,
    type: "POST",
    url: "/AdminPage/Overlays/admin_man_overlay_logic_backend.php",
    data: { full_name: full_name, user_id: user_id, func: func },
    error: function () {
      alert("failure");
    },
  });

  $("#admin_man_table_body").load(
    "/AdminPage/Overlays/load_for_admin_man_overlay.php",
    {
      part: "body",
      table: "users",
    }
  );
}

function edit_object(object_id) {
  var full_name = window.prompt("Enter a new name for the object: ");
  var func = "Edit object";

  if (full_name == "" || full_name.trim() == 0) {
    alert("Error: You need to enter a name");
    return;
  }
  if (full_name == null) {
    return;
  }

  $.ajax({
    async: false,
    type: "POST",
    url: "/AdminPage/Overlays/admin_man_overlay_logic_backend.php",
    data: { full_name: full_name, object_id: object_id, func: func },
    error: function () {
      alert("failure");
    },
  });

  $("#admin_man_table_body").load(
    "/AdminPage/Overlays/load_for_admin_man_overlay.php",
    {
      part: "body",
      table: "objects",
    }
  );
}

function delete_user(user_id) {
  if (confirm("Do you really want to delete this user?")) {
    var func = "Delete user";

    $.ajax({
      async: false,
      type: "POST",
      url: "/AdminPage/Overlays/admin_man_overlay_logic_backend.php",
      data: { user_id: user_id, func: func },
      dataType: "text",

      success: function(response){
        if(response==-1){
          alert("Warning: Can not delete users which currently is in a policy/policies!");
        }
      },

      error: function () {
        alert("failure");
      },
    });

    $("#admin_man_table_body").load(
      "/AdminPage/Overlays/load_for_admin_man_overlay.php",
      {
        part: "body",
        table: "users",
      }
    );
  }
}

function delete_object(object_id) {
  if (confirm("Do you really want to delete this object?")) {
    var func = "Delete object";

    $.ajax({
      async: false,
      type: "POST",
      url: "/AdminPage/Overlays/admin_man_overlay_logic_backend.php",
      data: { object_id: object_id, func: func },
      dataType: "text",

      success: function(response){
        if(response==-1){
          alert("Warning: Can not delete objects which currently is in a policy/policies!")
        }
      },

      error: function () {
        alert("failure");
      },
    });

    $("#admin_man_table_body").load(
      "/AdminPage/Overlays/load_for_admin_man_overlay.php",
      {
        part: "body",
        table: "objects",
      }
    );
  }
}