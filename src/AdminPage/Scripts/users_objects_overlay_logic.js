
function create_new_user() {
  var full_name = window.prompt("Enter the new user's full name: ");
  var func = "Create user";

  //Check for appropriate name
  if (full_name == "" || full_name.trim() == 0 || full_name == null)  {
    alert("Error: You need to enter a name");
    return;
  }

  //Send the name for the new user to the backend for insert
  $.ajax({
    async: false,
    type: "POST",
    url: "/AdminPage/Overlays/UsersAndObjectsOverlay/users_and_objects_overlay_backend_logic.php",
    data: { full_name: full_name, func: func },
    error: function () {
      alert("failure");
    },
  });

  //Update the users table
  $("#admin_man_table_body").load("/AdminPage/Overlays/UsersAndObjectsOverlay/load_users_and_objects.php",
    {
      part: "body",
      table: "users",
    }
  );
}

function create_new_object() {
  var full_name = window.prompt("Enter the name of the new object: ");
  var func = "Create object";

  //Check for appropriate name
  if (full_name == "" || full_name.trim() == 0 || full_name == null) {
    alert("Error: You need to enter a name");
    return;
  }

  //Send the name of the new object to the backend for insert
  $.ajax({
    async: false,
    type: "POST",
    url: "/AdminPage/Overlays/UsersAndObjectsOverlay/users_and_objects_overlay_backend_logic.php",
    data: { full_name: full_name, func: func },
    error: function () {
      alert("failure");
    },
  });

  //Update objects table
  $("#admin_man_table_body").load("/AdminPage/Overlays/UsersAndObjectsOverlay/load_users_and_objects.php",
    {
      part: "body",
      table: "objects",
    }
  );
}

function edit_user(user_id) {
  var full_name = window.prompt("Enter a new name for the user: ");
  var func = "Edit user";

  //Check for appropriate name
  if (full_name == "" || full_name.trim() == 0 || full_name == null)  {
    alert("Error: You need to enter a name");
    return;
  }

  //Send the new name of the user to the backend for name change
  $.ajax({
    async: false,
    type: "POST",
    url: "/AdminPage/Overlays/UsersAndObjectsOverlay/users_and_objects_overlay_backend_logic.php",
    data: { full_name: full_name, user_id: user_id, func: func },
    error: function () {
      alert("failure");
    },
  });

  //Update users table
  $("#admin_man_table_body").load("/AdminPage/Overlays/UsersAndObjectsOverlay/load_users_and_objects.php",
    {
      part: "body",
      table: "users",
    }
  );
}

function edit_object(object_id) {
  var full_name = window.prompt("Enter a new name for the object: ");
  var func = "Edit object";

  //Check for appropriate name
  if (full_name == "" || full_name.trim() == 0 || full_name == null)  {
    alert("Error: You need to enter a name");
    return;
  }

//Send the new name of the object to the backend for name change
  $.ajax({
    async: false,
    type: "POST",
    url: "/AdminPage/Overlays/UsersAndObjectsOverlay/users_and_objects_overlay_backend_logic.php",
    data: { full_name: full_name, object_id: object_id, func: func },
    error: function () {
      alert("failure");
    },
  });

  //update objects table
  $("#admin_man_table_body").load("/AdminPage/Overlays/UsersAndObjectsOverlay/load_users_and_objects.php",
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
      url: "/AdminPage/Overlays/UsersAndObjectsOverlay/users_and_objects_overlay_backend_logic.php",
      data: { user_id: user_id, func: func },
      dataType: "text",

      success: function(response){
        //deletion could not happen
        if(response==-1){
          alert("Warning: Can not delete users which currently is in a policy/policies!");
        }
      },

      error: function () {
        alert("failure");
      },
    });

    //update users table
    $("#admin_man_table_body").load("/AdminPage/Overlays/UsersAndObjectsOverlay/load_users_and_objects.php",
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
      url: "/AdminPage/Overlays/UsersAndObjectsOverlay/users_and_objects_overlay_backend_logic.php",
      data: { object_id: object_id, func: func },
      dataType: "text",

      success: function(response){
        //deleteion could not happen
        if(response==-1){
          alert("Warning: Can not delete objects which currently is in a policy/policies!")
        }
      },

      error: function () {
        alert("failure");
      },
    });

    //update objects table. 
    $("#admin_man_table_body").load("/AdminPage/Overlays/UsersAndObjectsOverlay/load_users_and_objects.php",
      {
        part: "body",
        table: "objects",
      }
    );
  }
}