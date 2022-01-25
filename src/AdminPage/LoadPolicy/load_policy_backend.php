<?php 
    if(isset($_POST["policy_name"])){

        $servername = "localhost";
        $username = "admin";
        $password = "Offbrand123$";
        $dbname = "website";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        
        //Retrive the policy class name from the Policies table
        $query = $conn->prepare("SELECT policy_class_name FROM Policies WHERE policy_name=?");
        $query->bind_param("s", $_POST["policy_name"]);
        $query->execute();
        $query->bind_result($policy_class);
        $query->fetch();
        $query->close();

        //Replace the spaces with "_" if spaces exists
        $policy_class = preg_replace('/\s+/', '_', $policy_class);
        
        //Start the policy file
        $pol_text = "policy('".$_POST["policy_name"]."','".$policy_class."',[\n";
        
        //Retrive the user(s) associated with the current policy. 
        $query = $conn->prepare("SELECT full_name FROM Users WHERE user_id IN (SELECT user_id FROM User_policy_conns WHERE policy_name=?)");  
        $query->bind_param("s", $_POST["policy_name"]);
        $query->execute();
        $result = $query->get_result();
        $query->fetch();
        $query->close();

        while( $row = $result->fetch_assoc()){
            $user = $row["full_name"];
            $pol_text .= "user(" .$user. "),\n";
        }

        //$pol_text .= "\n";

        //Retrive the user_attribute(s) associated with the current policy. 
        $query = $conn->prepare("SELECT user_attr_name FROM User_attr_policy_conns WHERE policy_name=?");  
        $query->bind_param("s", $_POST["policy_name"]);
        $query->execute();
        $result = $query->get_result();
        $query->fetch();
        $query->close();

        while( $row = $result->fetch_assoc()){
            $user_attr_name = $row["user_attr_name"];
            $pol_text .= "user_attribute(".$user_attr_name."),\n";
        }

        //$pol_text .= "\n";

        //Retrive the object(s) associated with the policy
        $query = $conn->prepare("SELECT full_name FROM Objects WHERE object_id IN (SELECT object_id FROM Object_policy_conns WHERE policy_name=?)");  
        $query->bind_param("s", $_POST["policy_name"]);
        $query->execute();
        $result = $query->get_result();
        $query->fetch();
        $query->close();

        while( $row = $result->fetch_assoc()){
            $object = $row["full_name"];
            $pol_text .= "object(".$object."),\n";
        }

        //$pol_text .= "\n";

        //Retrive the object_attribute(s) associated with the current policy. 
        $query = $conn->prepare("SELECT object_attr_name FROM Object_attr_policy_conns WHERE policy_name=?");  
        $query->bind_param("s", $_POST["policy_name"]);
        $query->execute();
        $result = $query->get_result();
        $query->fetch();
        $query->close();

        while( $row = $result->fetch_assoc()){
            $object_attr_name = $row["object_attr_name"];
            $pol_text .= "user_attribute(".$object_attr_name."),\n";
        }
        
        //$pol_text .= "\n";

        //Declare the policy class and create the connector
        $pol_text .= "policy_class($policy_class),\n";
        $pol_text .= "connector('PM'),\n";

        //$pol_text .= "\n";

        //Retrive the user-user_attributes connections associated with the current policy.
        $query = $conn->prepare("SELECT user_id, assigned_attribute FROM User_policy_conns WHERE policy_name=?"); 
        $query->bind_param("s", $_POST["policy_name"]);
        $query->execute();
        $result = $query->get_result();
        $query->fetch();
        $query->close();

        while( $row = $result->fetch_assoc()){
            $user_id = $row["user_id"];
            $assigned_attribute_id = $row["assigned_attribute"];

            //Retrive the full_name of the user.
            $query = $conn->prepare("SELECT full_name FROM Users WHERE user_id=?"); 
            $query->bind_param("i", $user_id);
            $query->execute();
            $query->bind_result($user);
            $query->fetch();
            $query->close();

            //Retrive the name of the attribute
            $query = $conn->prepare("SELECT user_attr_name FROM User_attr_policy_conns WHERE user_attribute_ID=?"); 
            $query->bind_param("i", $assigned_attribute_id);
            $query->execute();
            $query->bind_result($attribute_name);
            $query->fetch();
            $query->close();

            $pol_text .= "assign(".$user.",".$attribute_name."),\n";

        }

        //assign user_attr -> user_attr
        $query = $conn->prepare("SELECT user_attr_name, parent_attribute FROM User_attr_policy_conns WHERE policy_name=? AND parent_attribute IS NOT NULL"); 
        $query->bind_param("s", $_POST["policy_name"]);
        $query->execute();
        $result = $query->get_result();
        $query->fetch();
        $query->close();

        while( $row = $result->fetch_assoc()){
            $user_attr_name = $row["user_attr_name"];
            $parent_attr_id = $row["parent_attribute"];

            $query = $conn->prepare("SELECT user_attr_name FROM User_attr_policy_conns WHERE user_attribute_ID=?"); 
            $query->bind_param("i", $parent_attr_id);
            $query->execute();
            $query->bind_result($parent_attribute_name);
            $query->fetch();
            $query->close();

            $pol_text .= "assign(".$user_attr_name.",".$parent_attribute_name."),\n";

        }

        //Retrive the object-object_attributes connections associated with the current policy.
        $query = $conn->prepare("SELECT object_id, assigned_attribute FROM Object_policy_conns WHERE policy_name=?"); 
        $query->bind_param("s", $_POST["policy_name"]);
        $query->execute();
        $result = $query->get_result();
        $query->fetch();
        $query->close();

        while( $row = $result->fetch_assoc()){
            $object_id = $row["object_id"];
            $assigned_attribute_id = $row["assigned_attribute"];

            //Retrive the full_name of the object.
            $query = $conn->prepare("SELECT full_name FROM Objects WHERE object_id=?"); 
            $query->bind_param("i", $object_id);
            $query->execute();
            $query->bind_result($object);
            $query->fetch();
            $query->close();

            //Retrive the name of the object attribute
            $query = $conn->prepare("SELECT object_attr_name FROM Object_attr_policy_conns WHERE object_attribute_ID=?"); 
            $query->bind_param("i", $assigned_attribute_id);
            $query->execute();
            $query->bind_result($attribute_name);
            $query->fetch();
            $query->close();

            $pol_text .= "assign(".$object.",".$attribute_name."),\n";

        }
        
        //assign object_attr -> object_attr
        $query = $conn->prepare("SELECT object_attr_name, parent_attribute FROM Object_attr_policy_conns WHERE policy_name=? AND parent_attribute IS NOT NULL"); 
        $query->bind_param("s", $_POST["policy_name"]);
        $query->execute();
        $result = $query->get_result();
        $query->fetch();
        $query->close();

        while( $row = $result->fetch_assoc()){
            $object_attr_name = $row["object_attr_name"];
            $parent_attr_id = $row["parent_attribute"];

            $query = $conn->prepare("SELECT object_attr_name FROM Object_attr_policy_conns WHERE object_attribute_ID=?"); 
            $query->bind_param("i", $parent_attr_id);
            $query->execute();
            $query->bind_result($parent_attribute_name);
            $query->fetch();
            $query->close();

            $pol_text .= "assign(".$object_attr_name.",".$parent_attribute_name."),\n";
        } 

        //assign object_attr -> object_attr
        $query = $conn->prepare("SELECT user_attribute_ID, object_attribute_ID FROM Assign_policy_classes WHERE policy_name=?"); 
        $query->bind_param("s", $_POST["policy_name"]);
        $query->execute();
        $result = $query->get_result();
        $query->fetch();
        $query->close();
        
        while( $row = $result->fetch_assoc()){
            $object_attr_id = $row["object_attribute_ID"];
            $user_attr_id = $row["user_attribute_ID"];
    
            if($object_attr_id==""){
                $query = $conn->prepare("SELECT user_attr_name FROM User_attr_policy_conns WHERE user_attribute_ID=?"); 
                $query->bind_param("i", $user_attr_id);
                $query->execute();
                $query->bind_result($user_attr);
                $query->fetch();
                $query->close();

                $pol_text .= "assign(".$user_attr.",".$policy_class."),\n";

            }else{
                $query = $conn->prepare("SELECT object_attr_name FROM Object_attr_policy_conns WHERE object_attribute_ID=?"); 
                $query->bind_param("i", $object_attr_id);
                $query->execute();
                $query->bind_result($object_attr);
                $query->fetch();
                $query->close(); 
                
                $pol_text .= "assign(".$object_attr.",".$policy_class."),\n";

            }
           
        } 

        $pol_text .= "assign(".$policy_class.",'PM'),\n";

        //Retrice all associations belonging to the 
        $query = $conn->prepare("SELECT user_attribute, operation_id, object_attribute  FROM Associations WHERE policy_name=?"); 
        $query->bind_param("s", $_POST["policy_name"]);
        $query->execute();
        $result = $query->get_result();
        $query->fetch();
        $query->close();

        while( $row = $result->fetch_assoc()){
            $user_attr_id = $row["user_attribute"];
            $object_attr_id = $row["object_attribute"];
            $operation_id = $row["operation_id"];

            $query = $conn->prepare("SELECT user_attr_name FROM User_attr_policy_conns WHERE user_attribute_ID=?"); 
            $query->bind_param("i", $user_attr_id);
            $query->execute();
            $query->bind_result($user_attr);
            $query->fetch();
            $query->close();

            $query = $conn->prepare("SELECT object_attr_name FROM Object_attr_policy_conns WHERE object_attribute_ID=?"); 
            $query->bind_param("i", $object_attr_id);
            $query->execute();
            $query->bind_result($object_attr);
            $query->fetch();
            $query->close(); 

            $query = $conn->prepare("SELECT operation_name FROM Operations WHERE operation_id=?"); 
            $query->bind_param("i", $operation_id);
            $query->execute();
            $query->bind_result($operation);
            $query->fetch();
            $query->close(); 

            $pol_text .= "associate(".$user_attr.",[".$operation."],".$object_attr."),\n";

        }
        
        $pol_text = substr_replace($pol_text ,"\n",-2);

        $pol_text = $pol_text . "]).";

        $pol_query = "http://127.0.0.1:8001/paapi/loadi?";
        $pol_query .= "policyspec=".$pol_text;
        $pol_query .= "&token=admin_token";
        
        echo $pol_query;

    }else{
        echo "Fail";
    }
?>
