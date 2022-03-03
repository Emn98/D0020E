<?php
    if(isset($_POST["policy_name"]))
    {
        ?>
        <!DOCTYPE html5>
        <html lang="en">
        <head>
            <title>Admin NGAC</title>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="policy_style.css">
            <link rel="stylesheet" href="/AdminPage/Styles/header.css">
            <link rel="stylesheet" href="/AdminPage/Styles/admin_main_page.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="/AdminPage/Scripts/go_to_choose_frontend.js"></script>
            <script src="/AdminPage/Scripts/check_ngac_server_conn.js"></script>
            <script src="/AdminPage/Scripts/go_to_admin_page.js"></script>
            <script>
                $(document).ready(function(){
          
                    //Retrives the active policy from NGAC server upon page load. 
                    check_ngac_server_conn();

                });
            </script>
        </head>
        <body>
            <div class="header">
                <h2 class="choose_frontend_txt" onclick="go_to_choose_frontend()" style='cursor: pointer;'>Choose Frontend</h2>
                <h2 class="choose_admin_page_txt" onclick="go_to_admin_page()" style='cursor: pointer; margin-left: 12.8rem; position:absolute;'>Admin page</h2>
                <div class="server_status">
                    <h3 style="display:inline;float:left">NGAC Server Status: </h3>
                    <h3 class="server_status_response" id="server_status_response" style="display:inline;float:right;margin-right: -3.8rem;"></h3>
                </div>
            </div>
                
            <div class="form-cont">
                    
                <form class="dynamic_form" id="attr_conns" method="POST" action="add_policy_connections.php" id="add_policy_form">
                
                    <div class="float-container">
                    
                        <div class="float-child-2">
                            
                            <?php
                                for($num_user = 0; $num_user < $_POST["number_users"]; $num_user++)
                                {
                                    if($num_user < $_POST["number_users"])
                                    {
                                        ?>
                                            <h1>Choose user attribute for</h1>
                                            <h1><?php echo $_POST["user".$num_user] ?></h1>

                                            <div class="float-container">

                                                <div class="float-child-2">
                                                    <br>
                                                    <?php
                                                    
                                                        for($num_user_attr = 0; $num_user_attr < $_POST["number_users_attr"]; $num_user_attr++)
                                                        {
                                                            if($num_user_attr < $_POST["number_users_attr"])
                                                            {
                                                                ?>
                                                                    <div class="border">
                                                                    <lable style="font-size: 18px;"><?php echo $_POST["user_attr".$num_user_attr] ?></lable>
                                                                    </div>
                                                                <?php
                                                            }
                                                        }
                                                    ?>

                                                </div>

                                                <div class="float-child-2">
                                                    <label style="height: 10px;">Connection</label>
                                                    <br>
                                                    <?php
                                                    
                                                        for($num_user_attr = 0; $num_user_attr < $_POST["number_users_attr"]; $num_user_attr++)
                                                        {
                                                            if($num_user_attr < $_POST["number_users_attr"])
                                                            {
                                                                ?>
                                                                    <div class="border">
                                                                    <input type="checkbox" id="user_attr_conn_<?php echo $_POST["user".$num_user] ?>_<?php echo $_POST["user_attr".$num_user_attr] ?>" name="user_attr_conn <?php echo $_POST["user".$num_user] ?>_<?php echo $_POST["user_attr".$num_user_attr] ?>" >
                                                                    </div>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                    
                                                </div>
                                            </div>

                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <div class="float-child-2">

                            <?php
                                for($num_object = 0; $num_object < $_POST["number_objects"]; $num_object++)
                                {
                                    if($num_object < $_POST["number_objects"])
                                    {
                                        ?>
                                            <h1>Choose object attribute for</h1>
                                            <h1><?php echo $_POST["object".$num_object] ?></h1>

                                            <div class="float-container">

                                                <div class="float-child-2">
                                                    <br>
                                                    <?php
                                                    
                                                        for($num_object_attr = 0; $num_object_attr < $_POST["number_objects_attr"]; $num_object_attr++)
                                                        {
                                                            if($num_object_attr < $_POST["number_objects_attr"])
                                                            {
                                                                ?>
                                                                    <div class="border">
                                                                    <lable style="font-size: 18px;"><?php echo $_POST["object_attr".$num_object_attr] ?></lable>
                                                                    </div>
                                                                <?php
                                                            }
                                                        }
                                                    ?>

                                                </div>

                                                <div class="float-child-2">
                                                    <label style="height: 10px;">Connection</label>
                                                    <br>
                                                    <div required>
                                                    <?php
                                                    
                                                        for($num_object_attr = 0; $num_object_attr < $_POST["number_objects_attr"]; $num_object_attr++)
                                                        {
                                                            if($num_object_attr < $_POST["number_objects_attr"])
                                                            {
                                                                ?>
                                                                    <div class="border">
                                                                    <input type="checkbox" id="object_attr_conn_<?php echo $_POST["object".$num_object] ?>_<?php echo $_POST["object_attr".$num_object_attr] ?>" name="object_attr_conn_<?php echo $_POST["object".$num_object] ?>_<?php echo $_POST["object_attr".$num_object_attr] ?>" >
                                                                    </div>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                    </div>
                                                </div>
                                            </div>

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

                            
                    <?php
                        for($i = 0; $i < $_POST["number_users"]; $i++)
                        {
                            if($i < $_POST["number_users"])
                            {
                                ?>
                                    <input type="text" id="user<?php echo $i ?>" name="user<?php echo $i ?>" class="policy_input" required hidden value="<?php echo $_POST["user".$i] ?>">
                                <?php
                            }
                        }
                    ?>

                    <?php
                        for($i = 0; $i < $_POST["number_objects"]; $i++)
                        {
                            if($i < $_POST["number_objects"])
                            {
                                ?>
                                    <input type="text" id="object<?php echo $i ?>" name="object<?php echo $i ?>" class="policy_input" required hidden value="<?php echo $_POST["object".$i] ?>">
                                <?php
                            }
                        }
                    ?>

                    <?php
                        for($i = 0; $i < $_POST["number_users_attr"]; $i++)
                        {
                            if($i < $_POST["number_users_attr"])
                            {
                                ?>
                                    <input type="text" id="user_attr<?php echo $i ?>" name="user_attr<?php echo $i ?>" class="policy_input" required hidden value="<?php echo $_POST["user_attr".$i] ?>">
                                <?php
                            }
                        }
                    ?>

                    <?php
                        for($i = 0; $i < $_POST["number_objects_attr"]; $i++)
                        {
                            if($i < $_POST["number_objects_attr"])
                            {
                                ?>
                                    <input type="text" id="object_attr<?php echo $i ?>" name="object_attr<?php echo $i ?>" class="policy_input" required hidden value="<?php echo $_POST["object_attr".$i] ?>">
                                <?php
                            }
                        }
                    ?>

                    <button class="input_button" type="submit" class="form_button">Next</button>
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