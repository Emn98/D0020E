<?php 
    //This script will piece togheter the policy file given it's name. 

    if(isset($_POST["policy_name"])){

        //creates connection to database
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/AdminPage/db_conn/db_conn.php";
        include_once($path);

        require("../db_queries/select_queries_for_load_policy.php");

        if(isset($_POST["check_if_policy_already_loaded"])){
            //Check if the policy about to be loaded is already loaded
            require("../LoadPolicy/check_if_policy_already_loaded.php");
        }

        //Retrive the policy class name from the Policies table
        $policy_class = get_policy_class_name($conn, $_POST["policy_name"]);
        
        //Start the policy file
        $pol_text = "policy('".$_POST["policy_name"]."','".$policy_class."',[\n";
        
        //Retrive the user(s) associated with the current policy.
        $result = get_users_associated_with_policy($conn, $_POST["policy_name"]); 

        //Append users to the policy file
        while( $row = $result->fetch_assoc()){
            $user = $row["full_name"];
            $pol_text .= "user('" .$user. "'),\n";
        }

        //Retrive the user_attribute(s) associated with the current policy. 
        $result = get_user_attributes_associated_with_policy($conn, $_POST["policy_name"]);

        //Append user attributes to the policy file
        while( $row = $result->fetch_assoc()){
            $user_attr_name = $row["user_attr_name"];
            $pol_text .= "user_attribute('".$user_attr_name."'),\n";
        }

        //Retrive the object(s) associated with the policy
        $result = get_objects_associated_with_policy($conn,$_POST["policy_name"]);

        //Append objects to the policy file
        while( $row = $result->fetch_assoc()){
            $object = $row["full_name"];
            $pol_text .= "object('".$object."'),\n";
        }

        //Retrive the object_attribute(s) associated with the current policy.
        $result = get_object_attributes_associated_with_policy($conn, $_POST["policy_name"]);


        //Append object attributes to the policy file
        while( $row = $result->fetch_assoc()){
            $object_attr_name = $row["object_attr_name"];
            $pol_text .= "object_attribute('".$object_attr_name."'),\n";
        }

        //Declare the policy class and create the connector
        $pol_text .= "policy_class('$policy_class'),\n";
        $pol_text .= "connector('PM'),\n";

        //Retrive the user-user_attributes connections associated with the current policy.
        $result = get_user_id_and_assigned_attr($conn,$_POST["policy_name"]);

        while( $row = $result->fetch_assoc()){
            $user_id = $row["user_id"];
            $assigned_attribute_id = $row["assigned_attribute"];

            //Retrive the full_name of the user.
            $user = get_user_full_name($conn, $user_id);

            //Retrive the name of the attribute
            $attribute_name = get_user_attribute_name($conn, $assigned_attribute_id);

            //Append  user assignments to the policy file
            $pol_text .= "assign('".$user."','".$attribute_name."'),\n";

        }

        //assign user_attr -> user_attr
        $result = get_user_attr_and_parent_attr_id_associated_with_policy($conn, $_POST["policy_name"]);

        while( $row = $result->fetch_assoc()){
            $user_attr_name = $row["user_attr_name"];
            $parent_attr_id = $row["parent_attribute"];

            $parent_attribute_name = get_user_attribute_name($conn, $parent_attr_id);

            //Append user attribute assignments to the policy file
            $pol_text .= "assign('".$user_attr_name."','".$parent_attribute_name."'),\n";

        }

        //Retrive the object-object_attributes connections associated with the current policy.
        $result = get_object_id_assigned_attr($conn, $_POST["policy_name"]);

        while( $row = $result->fetch_assoc()){
            $object_id = $row["object_id"];
            $assigned_attribute_id = $row["assigned_attribute"];

            //Retrive the full_name of the object.
            $object = get_object_full_name($conn, $object_id);

            //Retrive the name of the object attribute
            $attribute_name = get_object_attribute_name($conn, $assigned_attribute_id);

            //Append object assignments to the policy file
            $pol_text .= "assign('".$object."','".$attribute_name."'),\n";

        }
        
        //assign object_attr -> object_attr
        $result = get_object_attr_and_parent_attr_id_associated_with_policy($conn, $_POST["policy_name"]);

        while( $row = $result->fetch_assoc()){
            $object_attr_name = $row["object_attr_name"];
            $parent_attr_id = $row["parent_attribute"];

            $parent_attribute_name = get_object_attribute_name($conn, $parent_attr_id);

            //Append object attribute assignments to the policy file
            $pol_text .= "assign('".$object_attr_name."','".$parent_attribute_name."'),\n";
        } 

        //assign object_attr/user_attr -> policy_class
        $result = get_obj_attr_user_attr_from_assign_policy_class($conn, $_POST["policy_name"]);
        
        while( $row = $result->fetch_assoc()){
            $object_attr_id = $row["object_attribute_ID"];
            $user_attr_id = $row["user_attribute_ID"];
    
            if($object_attr_id==""){

                $user_attr = get_user_attribute_name($conn, $user_attr_id);

                //Append policy classes assignments to the policy file
                $pol_text .= "assign('".$user_attr."','".$policy_class."'),\n";

            }else{

                $object_attr = get_object_attribute_name($conn, $object_attr_id);
                
                //Append policy classes assignments to the policy file
                $pol_text .= "assign('".$object_attr."','".$policy_class."'),\n";

            }
           
        } 

        $pol_text .= "assign('".$policy_class."','PM'),\n";

        //Retrice all associations belonging to the policy 
        $result = get_association_info($conn, $_POST["policy_name"]);

        while( $row = $result->fetch_assoc()){
            $user_attr_id = $row["user_attribute"];
            $object_attr_id = $row["object_attribute"];
            $operation_id = $row["operation_id"];

            $user_attr = get_user_attribute_name($conn, $user_attr_id);

            $object_attr = get_object_attribute_name($conn, $object_attr_id);

            $operation = get_operation($conn, $operation_id);

            //Append associations to the policy file
            $pol_text .= "associate('".$user_attr."',[".$operation."],'".$object_attr."'),\n";

        }
        
        $pol_text = substr_replace($pol_text ,"\n",-2);

        $pol_text .= "])";
        
        //Prints the dynamically built policy file. 
        echo $pol_text;

    }else{
        echo "Fail";
    }
    
?>