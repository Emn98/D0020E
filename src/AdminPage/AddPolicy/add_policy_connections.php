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
        </head>
        <body>
            <form class="association_form" method="POST" action="create_policy.php" id="add_policy_form">
                <?php

                    for($num_user = 0; $num_user < $_POST["number_users_attr"]; $num_user++)
                    {
                        ?>
                            <h1>Make connections for <?php echo $_POST["user_attr".$num_user] ?></h1>

                            <div class="float-container">

                                <div class="float-child-3">
                                    <br>
                                    <?php
                                    
                                        for($i = 0; $i < $_POST["number_objects_attr"]; $i++)
                                        {
                                            if($i < $_POST["number_objects_attr"])
                                            {
                                                ?>
                                                    <div class="border">
                                                    <lable><?php echo $_POST["object_attr".$i] ?></lable>
                                                    </div>
                                                <?php
                                            }
                                        }
                                    ?>

                                </div>

                                <div class="float-child-3">
                                    <label style="height: 10px;">read</label>
                                    <br>
                                    <?php
                                    
                                        for($i = 0; $i < $_POST["number_objects_attr"]; $i++)
                                        {
                                            if($i < $_POST["number_objects_attr"])
                                            {
                                                ?>
                                                    <div class="border">
                                                    <input type="checkbox" id="read_<?php echo $_POST["user_attr".$num_user] ?>_<?php echo $_POST["object_attr".$i] ?>" name="read_<?php echo $_POST["user_attr".$num_user] ?>_<?php echo $_POST["object_attr".$i] ?>">
                                                    </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                    
                                </div>

                                <div class="float-child-3">
                                    <label style="height: 10px;" >write</label>
                                    <br>
                                    <?php
                                    
                                        for($i = 0; $i < $_POST["number_objects_attr"]; $i++)
                                        {
                                            if($i < $_POST["number_objects_attr"])
                                            {
                                                ?>
                                                    <div class="border">
                                                    <input type="checkbox" id="write_<?php echo $_POST["user_attr".$num_user] ?>_<?php echo $_POST["object_attr".$i] ?>" name="write_<?php echo $_POST["user_attr".$num_user] ?>_<?php echo $_POST["object_attr".$i] ?>">
                                                    </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                        <?php
                    }
                ?>
                
                
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
                                <input type="text" id="user_attr_conn_<?php echo $_POST["user".$i]?>" name="user_attr_conn_<?php echo $_POST["user".$i]?>" required hidden value="<?php echo $_POST["user_attr_conn_".$_POST["user".$i]] ?>">
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
                                <input type="text" id="object_attr_conn_<?php echo $_POST["object".$i]?>" name="object_attr_conn_<?php echo $_POST["object".$i]?>" required hidden value="<?php echo $_POST["object_attr_conn_".$_POST["object".$i]] ?>">
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



                <input type="submit" class="form_button" value="Finish Policy">
            </form>
        </body>
        </html>

        <?php
    }

?>