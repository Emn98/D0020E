<?php
    function add_policy_to_db($conn, $name, $class_name)
    {
        $date_time = date('Y-m-d H:i:s');

        $sql = "INSERT INTO Policies (policy_name, Policy_class_name, created_at) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "sss",  $name, $class_name, $date_time);

        if(!mysqli_stmt_execute($stmt))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_close($stmt);

        return true;
    }

    function add_user_to_db($conn, $full_name)
    {
        $sql = "INSERT INTO Users (full_name ) VALUES (?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "s",  $full_name);

        if(!mysqli_stmt_execute($stmt))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_close($stmt);

        return true;
    }

    function add_object_to_db($conn, $full_name)
    {
        $sql = "INSERT INTO Objects (full_name ) VALUES (?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "s",  $full_name);

        if(!mysqli_stmt_execute($stmt))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_close($stmt);

        return true;
    }

    function add_user_policy_conn_to_db($conn, $policy_name, $user_id, $assigned_attribute)
    {
        $sql = "INSERT INTO User_policy_conns (policy_name, user_id, assigned_attribute) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "sss",  $policy_name, $user_id, $assigned_attribute);

        if(!mysqli_stmt_execute($stmt))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_close($stmt);

        return true;
    }

    function add_object_policy_conn_to_db($conn, $policy_name, $object_id, $assigned_attribute)
    {
        $sql = "INSERT INTO Object_policy_conns (policy_name, object_id, assigned_attribute) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "sss",  $policy_name, $object_id, $assigned_attribute);

        if(!mysqli_stmt_execute($stmt))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_close($stmt);

        return true;
    }

    function add_User_attr_policy_conns_to_db($conn, $policy_name, $user_attr_name, $parent_attribute)
    {
        $sql = "INSERT INTO User_attr_policy_conns (policy_name, user_attr_name, parent_attribute) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "sss",  $policy_name, $user_attr_name, $parent_attribute);

        if(!mysqli_stmt_execute($stmt))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_close($stmt);

        return true;
    }

    function add_Object_attr_policy_conns_to_db($conn, $policy_name, $object_attr_name, $parent_attribute)
    {
        $sql = "INSERT INTO Object_attr_policy_conns (policy_name, object_attr_name, parent_attribute) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "sss",  $policy_name, $object_attr_name, $parent_attribute);

        if(!mysqli_stmt_execute($stmt))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_close($stmt);

        return true;
    }

    function add_Operations_to_db($conn,  $operation_name, $operation_2_field)
    {
        $sql = "INSERT INTO Operations (operation_name, operation_2_field) VALUES (?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "ss", $operation_name, $operation_2_field);

        if(!mysqli_stmt_execute($stmt))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_close($stmt);

        return true;
    }

    function add_Associations_to_db($conn, $policy_name ,$user_attribute, $operation_id, $object_attribute)
    {
        $sql = "INSERT INTO Associations (policy_name, user_attribute, operation_id, object_attribute) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "ssss", $policy_name, $user_attribute, $operation_id, $object_attribute);

        if(!mysqli_stmt_execute($stmt))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_close($stmt);

        return true;
    }

    function add_Assign_policy_classes_to_db($conn,  $policy_name, $user_attribute_ID, $object_attribute_ID)
    {
        $sql = "INSERT INTO Assign_policy_classes (policy_name, user_attribute_ID, object_attribute_ID) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "sss", $policy_name, $user_attribute_ID, $object_attribute_ID);

        if(!mysqli_stmt_execute($stmt))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_close($stmt);

        return true;
    }

    function add_Loaded_policies_to_db($conn, $policy_name, $loaded_at)
    {
        $sql = "INSERT INTO Loaded_policies (policy_name, loaded_at) VALUES (?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "ss", $policy_name, $loaded_at);

        if(!mysqli_stmt_execute($stmt))
        {
            echo(mysqli_error($conn));
            return false;
        }

        mysqli_stmt_close($stmt);

        return true;
    }
?>