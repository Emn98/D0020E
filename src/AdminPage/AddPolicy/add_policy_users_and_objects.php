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
            <form class="user_and_object_form" method="POST" action="add_policy_attr_conns.php" id="add_policy_form">
                <h1>Choose names</h1>

                <div class="float-container">
                
                    <div class="float-child-4">
                        <label>User names</label>
                        
                        <?php
                            for($i = 0; $i < $_POST["number_users"]; $i++)
                            {
                                if($i < $_POST["number_users"])
                                {
                                    ?>
                                        <input type="text" id="user<?php echo $i ?>" name="user<?php echo $i ?>" class="policy_input" required>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="float-child-4">
                        <label >Object names</label>

                        <?php
                            for($i = 0; $i < $_POST["number_objects"]; $i++)
                            {
                                if($i < $_POST["number_objects"])
                                {
                                    ?>
                                        <input type="text" id="object<?php echo $i ?>" name="object<?php echo $i ?>" class="policy_input" required>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="float-child-4">
                        <label>User attribute names</label>
                        
                        <?php
                            for($i = 0; $i < $_POST["number_users_attr"]; $i++)
                            {
                                if($i < $_POST["number_users_attr"])
                                {
                                    ?>
                                        <input type="text" id="user_attr<?php echo $i ?>" name="user_attr<?php echo $i ?>" class="policy_input" required>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="float-child-4">
                        <label >Object attribute names</label>

                        <?php
                            for($i = 0; $i < $_POST["number_objects_attr"]; $i++)
                            {
                                if($i < $_POST["number_objects_attr"])
                                {
                                    ?>
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

                <input type="submit" class="form_button" value="Next">
            </form>
        </body>
        </html>

        <?php
    }

?>

