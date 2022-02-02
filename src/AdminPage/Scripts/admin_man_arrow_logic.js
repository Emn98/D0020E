//This script handles the logic of a user pressing the "go right"...
//and "go left" buttons when the admin managin overlay is visible. 

function pressed_right_arrow(){
    var current_table = document.getElementById("admin_man_title").innerHTML;

    //If current table is user then show objects table. 
    if(current_table == "Users"){
        $("#admin_man_title").html("Objects");
        $("#admin_man_create_btn").html("Create New Object");
        document.getElementById("admin_man_create_btn").setAttribute('onclick','create_new_object()')
        document.getElementById("left_arrow").hidden = false;
        $("#admin_man_table_head").load("/AdminPage/Overlays/load_objects_for_admin_man.php", {
            head: "set"
        }); 
        $("#admin_man_table_body").load("/AdminPage/Overlays/load_objects_for_admin_man.php", {
            body: "set"
        });                                                                      
    }

    //If current table is objects then show operations table. 
    if(current_table == "Objects"){
        $("#admin_man_title").html("Operations");
        $("#admin_man_create_btn").html("Create New Operation");
        document.getElementById("admin_man_create_btn").setAttribute('onclick','create_new_operation()')
        document.getElementById("right_arrow").hidden = true;
        $("#admin_man_table_head").load("/AdminPage/Overlays/load_operations_for_admin_man.php", {
            head: "set"
        }); 
        $("#admin_man_table_body").load("/AdminPage/Overlays/load_operations_for_admin_man.php", {
            body: "set"
        });                                                                      
    }
}

function pressed_left_arrow(){
    var current_table = document.getElementById("admin_man_title").innerHTML;

    //If current table is objects then show users table. 
    if(current_table == "Objects"){
        console.log("Test");
        $("#admin_man_title").html("Users");
        $("#admin_man_create_btn").html("Create New User");
        document.getElementById("admin_man_create_btn").setAttribute('onclick','create_new_user()')
        document.getElementById("left_arrow").hidden = true;
        $("#admin_man_table_head").load("/AdminPage/Overlays/load_users_for_admin_man.php", {
            head: "set"
        }); 
        $("#admin_man_table_body").load("/AdminPage/Overlays/load_users_for_admin_man.php", {
            body: "set"
        });                                                                       
    }

    //If current table is operations then show objects table.
    if(current_table == "Operations"){
        $("#admin_man_title").html("Objects");
        $("#admin_man_create_btn").html("Create New Object");
        document.getElementById("admin_man_create_btn").setAttribute('onclick','create_new_object()')
        document.getElementById("right_arrow").hidden = false;
        $("#admin_man_table_head").load("/AdminPage/Overlays/load_objects_for_admin_man.php", {
            head: "set"
        }); 
        $("#admin_man_table_body").load("/AdminPage/Overlays/load_objects_for_admin_man.php", {
            body: "set"
        });                                                                       
    }
}