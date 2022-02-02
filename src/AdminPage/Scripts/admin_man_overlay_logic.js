
//This function will create and add a new user to the database
function create_new_user(){

    var full_name = window.prompt("Enter the new user's full name: ");
    var func = "Create user";

    if(full_name == ""){
        alert("Error: You need to enter a name");
        return;
    }
    if(full_name==null){
        return;
    }

    $.ajax({
        async: false,
        type: "POST",
        url:  "/AdminPage/Overlays/admin_man_overlay_logic_backend.php", 
        data: {full_name: full_name,
               func: func
        },
        error: function(){
            alert("failure");
        }
    });

    $("#admin_man_table_body").load("/AdminPage/Overlays/load_users_for_admin_man.php", {
        body: "set"
    });     
    
}

//This function will create and add a new object to the database
function create_new_object(){
    
    var full_name = window.prompt("Enter the name of the new object: ");
    var func = "Create object";

    if(full_name == ""){
        alert("Error: You need to enter a name");
        return;
    }
    if(full_name==null){
        return;
    }

    $.ajax({
        async: false,
        type: "POST",
        url:  "/AdminPage/Overlays/admin_man_overlay_logic_backend.php", 
        data: {full_name: full_name,
               func: func
        },
        error: function(){
            alert("failure");
        }
    });

    $("#admin_man_table_body").load("/AdminPage/Overlays/load_objects_for_admin_man.php", {
        body: "set"
    }); 
}


function create_new_operation(){
    var func = "Create operation";
    var operation_2_field = null;
    
    var operation_name = window.prompt("Enter the name of the new operation: ");
    
    if(operation_name == ""){
        alert("Error: You need to enter a name");
        return;
    }
    if(operation_name==null){
        return;
    }

    operation_2_field = window.prompt("Enter the second field of the operation: ");

    if(operation_2_field == ""){
        alert("Error: You need to enter something in the second field");
        return;
    }
    if(operation_2_field == null){
        return;
    }

    $.ajax({
        async: false,
        type: "POST",
        url:  "/AdminPage/Overlays/admin_man_overlay_logic_backend.php", 
        data: {operation_name: operation_name,
               operation_2_field: operation_2_field,
               func: func
        },
        error: function(){
            alert("failure");
        }
    });

    $("#admin_man_table_body").load("/AdminPage/Overlays/load_operations_for_admin_man.php", {
        body: "set"
    });     
}


function edit_user(user_id){
    var full_name = window.prompt("Enter a new name for the user: ");
    var func = "Edit user";

    if(full_name == ""){
        alert("Error: You need to enter a name");
        return;
    }
    if(full_name==null){
        return;
    }

    $.ajax({
        async: false,
        type: "POST",
        url:  "/AdminPage/Overlays/admin_man_overlay_logic_backend.php", 
        data: {full_name: full_name,
               user_id: user_id,
               func: func
        },
        error: function(){
            alert("failure");
        }
    });

    $("#admin_man_table_body").load("/AdminPage/Overlays/load_users_for_admin_man.php", {
        body: "set"
    });  
}

function edit_object(object_id){
    var full_name = window.prompt("Enter a new name for the object: ");
    var func = "Edit object";

    if(full_name == ""){
        alert("Error: You need to enter a name");
        return;
    }
    if(full_name==null){
        return;
    }

    $.ajax({
        async: false,
        type: "POST",
        url:  "/AdminPage/Overlays/admin_man_overlay_logic_backend.php", 
        data: {full_name: full_name,
               object_id: object_id,
               func: func
        },
        error: function(){
            alert("failure");
        }
    });

    $("#admin_man_table_body").load("/AdminPage/Overlays/load_objects_for_admin_man.php", {
        body: "set"
    }); 
}

function edit_operation(operation_id){
    var func = "Edit operation";
    var operation_2_field = null;

    var operation_name = window.prompt("Enter a new name for the operation: ");

    if(operation_name == ""){
        alert("Error: You need to enter a name");
        return;
    }
    if(operation_name==null){
        return;
    }

    if(confirm("Do you want to change the second field aswell?")){
        operation_2_field = window.prompt("Enter new second field: ");
        if(operation_2_field == ""){
            alert("Error: You need to enter a second field");
            return;
        }
        if(operation_2_field==null){
            return;
        }
    }

    $.ajax({
        async: false,
        type: "POST",
        url:  "/AdminPage/Overlays/admin_man_overlay_logic_backend.php", 
        data: {operation_name: operation_name,
               operation_id: operation_id,
               operation_2_field: operation_2_field,
               func: func
        },
        error: function(){
            alert("failure");
        }
    });

    $("#admin_man_table_body").load("/AdminPage/Overlays/load_operations_for_admin_man.php", {
        body: "set"
    });  
}

function delete_user(user_id){
    if(confirm("Do you really want to delete this user?")){
        var func = "Delete user";

        $.ajax({
            async: false,
            type: "POST",
            url:  "/AdminPage/Overlays/admin_man_overlay_logic_backend.php", 
            data: {user_id: user_id,
                   func: func
            },
            error: function(){
                alert("failure");
            }
        });

        $("#admin_man_table_body").load("/AdminPage/Overlays/load_users_for_admin_man.php", {
        body: "set"
        });
    }
}

function delete_object(object_id){
    if(confirm("Do you really want to delete this object?")){
        var func = "Delete object";

        $.ajax({
            async: false,
            type: "POST",
            url:  "/AdminPage/Overlays/admin_man_overlay_logic_backend.php", 
            data: {object_id: object_id,
                   func: func
            },
            error: function(){
                alert("failure");
            }
        });

        $("#admin_man_table_body").load("/AdminPage/Overlays/load_objects_for_admin_man.php", {
            body: "set"
        }); 

    }
}

function delete_operation(operation_id){
    if(confirm("Do you really want to delete this operation?")){
        var func = "Delete operation";

        $.ajax({
            async: false,
            type: "POST",
            url:  "/AdminPage/Overlays/admin_man_overlay_logic_backend.php", 
            data: {operation_id: operation_id,
                   func: func
            },
            error: function(){
                alert("failure");
            }
        });

        $("#admin_man_table_body").load("/AdminPage/Overlays/load_operations_for_admin_man.php", {
            body: "set"
        });  
    }
}




