<!doctype html>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>d0020e-prodject</title>
    <link rel="stylesheet" href="Styles/style.css">

</head>

<body>    

    <div class="center_div">
        <h1>Frontend for access test of data and attributes</h1>

        <form action="access_request.php" method="GET">
            <?php
                include($_SERVER['DOCUMENT_ROOT']."/AdminPage/db_conn/db_conn.php");
                include($_SERVER['DOCUMENT_ROOT']."/AdminPage/db_queries/select_queries.php");
                $users = get_users($conn);
            ?>
            <lable for="user<?php echo $i ?>">Select user</label>
                <select  id="user<?php echo $i ?>" name="user<?php echo $i ?>">
                    
                    <?php
                        for($num_user = 0; $num_user < sizeof($users); $num_user++)
                        {
                            ?>
                                <option value="<?php echo $users[$num_user]["full_name"]?>"><?php echo $users[$num_user]["full_name"]?></option>
                                
                            <?php
                        }
                    ?>
                </select>
            <?php
                $objects = get_objects($conn);
            ?>
            <lable for="object<?php echo $i ?>">Select object</label>
                <select id="object<?php echo $i ?>" name="object<?php echo $i ?>">
                    
                    <?php
                        for($num_object = 0; $num_object < sizeof($objects); $num_object++)
                        {
                            ?>
                                <option value="<?php echo $objects[$num_object]["full_name"] ?>"><?php echo $objects[$num_object]["full_name"]  ?></option>
                                
                            <?php
                        }
                    ?>
                </select>
            <button id="submit" name="submit" type="submit">Submit</button>
        </form>

        <?php
            if(isset($_COOKIE["acccess"]))
            {
                echo $_COOKIE["acccess"];
            }
        ?>
    </div>

</body>

</html>