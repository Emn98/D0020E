<?php
    function add_policy_to_db($conn, $name, $address_of_file)
    {
        $sql = $conn->prepare("INSERT INTO policies (name, address_of_file) VALUES (?, ?);");
        $sql->bind_param("ss", $name, $address_of_file);

        $sql->execute();

        $sql->close();
    }
?>