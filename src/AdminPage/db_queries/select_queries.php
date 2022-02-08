<?php
    function get_policy($conn, $name)
    {
        $sql = "SELECT * FROM Policies WHERE policy_name = '$name';";

        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            // output data of each row
            while($row = mysqli_fetch_row($result)) 
            {
                $data = $data + $row;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }

    function get_user($conn, $full_name)
    {
        $sql = "SELECT * FROM Users WHERE full_name = '$full_name';";

        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            // output data of each row
            while($row = mysqli_fetch_row($result)) 
            {
                $data = $data + $row;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }

    function get_users($conn)
    {
        $sql = "SELECT * FROM Users";

        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            $i = 0;
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) 
            {
                $data[$i] = $row;
                $i ++;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }

    function get_object($conn, $full_name)
    {
        $sql = "SELECT * FROM Objects WHERE full_name = '$full_name';";
        
        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            $i = 0;
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) 
            {
                $data[$i] = $row;
                $i ++;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }

    function get_objects($conn)
    {
        $sql = "SELECT * FROM Objects;";
        
        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            $i = 0;
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) 
            {
                $data[$i] = $row;
                $i ++;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }

    function get_user_policy_conn($conn, $policy_name, $user_id, $assigned_attribute)
    {
        $sql = "SELECT * FROM User_policy_conns WHERE policy_name = '$policy_name' AND user_id = $user_id AND assigned_attribute = $assigned_attribute;";
        
        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            // output data of each row
            while($row = mysqli_fetch_row($result)) 
            {
                $data = $data + $row;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }

    function get_object_policy_conn($conn, $policy_name, $object_id, $assigned_attribute)
    {
        $sql = "INSERT INTO Object_policy_conns policy_name = '$policy_name' AND object_id = $object_id AND assigned_attribute = $assigned_attribute;";
        
        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            // output data of each row
            while($row = mysqli_fetch_row($result)) 
            {
                $data = $data + $row;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }

    function get_User_attr_policy_conns($conn, $policy_name, $user_attr_name)
    {
        $sql = "SELECT * FROM User_attr_policy_conns WHERE policy_name = '$policy_name' AND user_attr_name = '$user_attr_name';";
        
        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            // output data of each row
            while($row = mysqli_fetch_row($result)) 
            {
                $data = $data + $row;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }

    function get_Object_attr_policy_conns($conn, $policy_name, $object_attr_name)
    {
        $sql = "SELECT * FROM Object_attr_policy_conns WHERE policy_name = '$policy_name' AND object_attr_name = '$object_attr_name';";
        
        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            // output data of each row
            while($row = mysqli_fetch_row($result)) 
            {
                $data = $data + $row;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }

    function get_Operations($conn, $operation_2_field)
    {
        $sql = "SELECT * FROM Operations WHERE operation_2_field = '$operation_2_field';";
        
        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            // output data of each row
            while($row = mysqli_fetch_row($result)) 
            {
                $data = $data + $row;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }

    function get_Associations($conn ,$user_attribute, $object_attribute)
    {
        $sql = "SELECT * FROM Associations WHERE user_attribute = $user_attribute AND object_attribute = $object_attribute;";
        
        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            // output data of each row
            while($row = mysqli_fetch_row($result)) 
            {
                $data = $data + $row;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }

    function get_Assign_policy_classes($conn, $policy_name)
    {
        $sql = "SELECT * FROM Assign_policy_classes WHERE policy_name = '$policy_name';";
        
        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            // output data of each row
            while($row = mysqli_fetch_row($result)) 
            {
                $data = $data + $row;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }

    function get_Loaded_policies($conn)
    {
        $sql = "SELECT * FROM Loaded_policies;";
        
        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);


        if ($num_rows == 1) 
        {
            return mysqli_fetch_assoc($result);
        }
        else if ($num_rows > 1)
        {
            $data = [];
            // output data of each row
            while($row = mysqli_fetch_row($result)) 
            {
                $data = $data + $row;
            }
            return $data;
        }
        else
        {
            return false;
        }

    }
?>