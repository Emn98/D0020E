<!doctype html>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>d0020e-prodject</title>
    <link rel="stylesheet" href="Styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../AdminPage/Scripts/go_to_choose_frontend.js"></script>
    <script src="../AdminPage/Scripts/check_ngac_server_conn.js"></script>
    <script src="../AdminPage/Scripts/go_to_admin_page.js"></script>
    <script>
        $(document).ready(function(){
          
            //Retrives the active policy from NGAC server upon page load. 
            check_ngac_server_conn();

        });
    </script>

</head>

<body> 
    <div class="header" style="width: 100vw; background:white;">
        <h2 class="choose_frontend_txt" onclick="go_to_choose_frontend()" style='cursor: pointer;'>Choose Frontend</h2>
        <h2 class="choose_admin_page_txt" onclick="go_to_admin_page()" style='cursor: pointer; margin-left: 12.8rem; position:absolute;'>Admin page</h2>
        <div class="server_status">
            <h3 style="display:inline;float:left; margin-right:0.4rem;">NGAC Server Status: </h3>
            <h3 class="server_status_response" id="server_status_response" style="display:inline;float:right;margin-right: 1.2rem;"></h3>
        </div>
    </div>   
    
    <div class="container">
    <div class="center_div">
        <h1>Frontend for access test of data and attributes</h1>

        <form action="access_request.php" method="GET">
            <?php
                include($_SERVER['DOCUMENT_ROOT']."/AdminPage/db_conn/db_conn.php");
                include($_SERVER['DOCUMENT_ROOT']."/AdminPage/db_queries/select_queries.php");
                $users = get_users($conn);
            ?>
            <lable for="user">Select user</label>
                <select  id="user" name="user">
                    
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
            <lable for="object">Select object</label>
                <select id="object" name="object">
                    
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
    </div>

</body>

</html>