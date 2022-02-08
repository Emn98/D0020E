<?php
    if(isset($_POST["policy_name"]))
    {
        include($_SERVER['DOCUMENT_ROOT']."/AdminPage/Overlays/admin_management_overlay.php");
        include($_SERVER['DOCUMENT_ROOT']."/AdminPage/db_conn/db_conn.php");
        include($_SERVER['DOCUMENT_ROOT']."/AdminPage/db_queries/select_queries.php");
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>Admin NGAC</title>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="policy_style.css">
            <link rel="stylesheet" href="/AdminPage/Styles/admin_main_page.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="/AdminPage/Scripts/go_to_choose_frontend.js"></script>
            <script src="/AdminPage/Scripts/get_active_policy.js"></script>
            <script src="/AdminPage/Scripts/go_to_admin_page.js"></script>
            <script>
            $(document).ready(function(){
                
                //Retrives the active policy from NGAC server upon page load. 
                get_active_policy();

            });
            </script>
        </head>
        <body>
            <div class="header">
                <h2 onclick="go_to_choose_frontend()" style='cursor: pointer;'>Choose Frontend</h2>
                <h2 onclick="go_to_admin_page()" style='cursor: pointer;'>Admin page</h2>
                <div class="server_status">
                    <h3 style="display:inline;float:left">NGAC Server Status: </h3>
                    <h3 class="server_status_response" id="server_status_response" style="display:inline;float:right;margin-right: -3.8rem;"></h3>
                </div>
            </div>
                
            
            <div class="form_cont">
                <button class="edit_button" onclick="test()">EDIT USERS AND OBJECTS</button>
                <form class="dynamic_form" id="user_object" method="POST" action="add_policy_attr_conns.php" id="add_policy_form">
                    
                    <h1>Choose names</h1>

                    <div class="float-container">
                    
                        <div class="float-child-4">
                            <?php

                                $users = get_users($conn);
                                for($i = 0; $i < $_POST["number_users"]; $i++)
                                {
                                    if($i < $_POST["number_users"])
                                    {
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
                                            <br>
                                            <!--<input type="text" id="user<?php echo $i ?>" name="user<?php echo $i ?>" class="policy_input" required> !-->
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <div class="float-child-4">
                            <?php

                                $objects = get_objects($conn);
                                for($i = 0; $i < $_POST["number_objects"]; $i++)
                                {
                                    if($i < $_POST["number_objects"])
                                    {
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
                                            <br>
                                            <!--<input type="text" id="object<?php echo $i ?>" name="object<?php echo $i ?>" class="policy_input" required> !-->
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <div class="float-child-4">
                            
                            
                            <?php
                                for($i = 0; $i < $_POST["number_users_attr"]; $i++)
                                {
                                    if($i < $_POST["number_users_attr"])
                                    {
                                        ?>
                                            <label for="user_attr<?php echo $i ?>" >User attribute name</label>
                                            <input  type="text" id="user_attr<?php echo $i ?>" name="user_attr<?php echo $i ?>" class="policy_input" required>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <div class="float-child-4">
                            <?php
                                for($i = 0; $i < $_POST["number_objects_attr"]; $i++)
                                {
                                    if($i < $_POST["number_objects_attr"])
                                    {
                                        ?>
                                            <label for="user_attr<?php echo $i ?>" >Object attribute name</label>
                                            <input type="text" id="object_attr<?php echo $i ?>" name="object_attr<?php echo $i ?>" class="policy_input" required>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    
                    <input type="text" id="policy_name" name="policy_name" class="policy_input" required hidden value="<?php echo $_POST["policy_name"] ?>">
                    <input type="number" id="number_users" name="number_users" class="policy_input" required hidden value="<?php echo $_POST["number_users"] ?>">
                    <input type="number" id="number_objects" name="number_objects" class="policy_input" required hidden value="<?php echo $_POST["number_objects"] ?>">
                    <input type="number" id="number_users_attr" name="number_users_attr" class="policy_input" required hidden value="<?php echo $_POST["number_users_attr"] ?>">
                    <input type="number" id="number_objects_attr" name="number_objects_attr" class="policy_input" required hidden value="<?php echo $_POST["number_objects_attr"] ?>">

                    <button class="input_button" type="submit" >Next</button>
                    
                </form>
            </div>
            
        </body>
        </html>

        <?php
    }
    else
    {
        header('Location: ../admin_main_page.php');
        exit();

    }

?>

