<?php     
    //Check if the policy is already loaded
    $query = $conn->prepare("SELECT policy_name FROM Loaded_policies WHERE policy_name=?");
    $query->bind_param("s", $_POST["policy_name"]);
    $query->execute();
    $query->bind_result($policy_name_check);
    $query->fetch();
    $query->close();

    if($policy_name_check != ""){
        echo "1";
        exit;
    }
?>