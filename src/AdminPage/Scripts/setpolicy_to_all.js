
function activate_setpolicy_to_all(){
    if (
        confirm("Warning: Activating this mode will unload all currently " + 
                "loaded policies from the ngac server.In this mode, the " +
                "composition of all subsequent loaded and relevant policies " +
                "will be applied during an access request.")
    ){
        //Unload all policies from the ngac server 
        set_policy_in_ngac_system("none"); 

        clear_loaded_policy_table_in_db();
        
        //Set policy to all in the ngac system 
        set_policy_in_ngac_system("all");

        //Update the show loaded policies table if the user is looking at it while starting the ngac server
        if (document.getElementById("show_all_policies_btn").style.backgroundColor != "rgb(0, 136, 169)") {
            get_loaded_policies();
        } 
    }

}


function deactivate_setpolicy_to_all(){
    if (
        confirm("Warning: Deactivating this mode will unload all currently " + 
                "loaded policies from the ngac server. The " +
                "composition of all subsequent loaded and relevant policies " +
                "would no longer be applied during an access request.")
    ){
        
        document.getElementById("setpol_all_btn").className = "setpol_all_btn_not_active";          
        document.getElementById("setpol_all_btn").setAttribute("onclick", "activate_setpolicy_to_all()");
        
        //Unload all policies from the ngac server 
        set_policy_in_ngac_system("none");

        clear_loaded_policy_table_in_db();

        //Unload the combined policy from the ngac server if it is loaded  
        if(is_combined_policy_loaded_into_nagc() == true){
            unload_policy("combined policy");
        }

        alert("Set all policies mode is now turned off");

        //Update the show loaded policies table if the user is looking at it while starting the ngac server.
        if (document.getElementById("show_all_policies_btn").style.backgroundColor != "rgb(0, 136, 169)") {
            get_loaded_policies();
        } 

    }
}

