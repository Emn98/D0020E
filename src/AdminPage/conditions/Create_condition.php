<?php
    require_once "condition.php";

    if(isset($_POST["condition"]))
    {
        $associations = [];
    
        $index = 0;
        if(isset($_POST["num_associationID"]))
        {
            for($num_associationID = 0; $num_associationID < $_POST["num_associationID"]; $num_associationID ++)
            {
                if(isset($_POST["association_id_".$num_associationID]) )
                {
                    $associations[$index] = (int)$_POST["association_id_".$num_associationID];
                    $index ++;
                }
            }
        }
        
        cond_def_switch_case($_POST["condition"]);
        header("Location: Add_condition.php"); 
        exit();
    }
    else
    {
        header("Location: Add_condition.php"); 
        exit();
    }
?>