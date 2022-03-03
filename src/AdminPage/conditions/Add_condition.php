<?php
    require_once "condition.php";

    require_once "../db_conn/db_conn.php";

    require_once "../db_queries/select_queries_for_load_policy.php";

    if(isset($_POST["policy_name"]))
    {
        $policy_name = $_POST["policy_name"];
    }
    else
    {
        ?>
            <script>
                window.location.href = "choose_policy.php";
            </script>
        <?php
    }

?>
        <!DOCTYPE html5>
        <html lang="en">
        <head>
            <title>Admin NGAC</title>
            <meta charset="UTF-8">
            <link href="style.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="/AdminPage/Styles/admin_main_page.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="/AdminPage/Scripts/go_to_admin_page.js"></script>
            <script src="/AdminPage/Scripts/get_active_policy.js"></script>
            <script src="/AdminPage/Scripts/go_to_choose_frontend.js"></script>
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
                <h2 onclick="go_to_admin_page()" style='cursor: pointer; padding-left:4rem;'>Admin page</h2>
                <div class="server_status">
                    <h3 style="display:inline;float:left">NGAC Server Status: </h3>
                    <h3 class="server_status_response" id="server_status_response" style="display:inline;float:right;margin-right: -3.8rem;"></h3>
                </div>
            </div>
            
            <form class="dynamic_form" method="POST" action="Create_condition.php">
                <h1>Add conditions for policy: <?php echo $policy_name ?></h1>
                <?php

                    //Retrive all associations belonging to the policy 
                    $result = get_association_info($conn, $policy_name);
                    $num_associationID = 0;
                    while( $row = $result->fetch_assoc()){
                        $associationID = $row["association_id"];
                        $user_attr_id = $row["user_attribute"];
                        $object_attr_id = $row["object_attribute"];
                        $operation_id = $row["operation_id"];

                        $user_attr = get_user_attribute_name($conn, $user_attr_id);

                        $object_attr = get_object_attribute_name($conn, $object_attr_id);

                        $operation = get_operation($conn, $operation_id);


                        ?>
                            <div class="form_elements">
                                <input class="checkbox" type="checkbox" id="<?php echo "association_id_".$num_associationID ?>" name="<?php echo "association_id_".$num_associationID ?>" value="<?php echo $associationID ?>">
                                <label class="input" for="<?php echo 'associate('.$user_attr.',['.$operation.'],'.$object_attr.')' ?>"><?php echo 'associate('.$user_attr.',['.$operation.'],'.$object_attr.')'?></label>
                                <br>
                            </div>
                            
                        <?php

                        $num_associationID++;
                    }
                    
                ?>
                <input class="input" id="num_associationID" name="num_associationID" value="<?php echo $num_associationID ?>" hidden>

                <lable for="conditions">Select condition</label>
                <select  id="condition" name="condition">
                    
                    <?php
                        for($num_cond = 0; $num_cond < sizeof($defined_conditions); $num_cond++)
                        {
                            ?>
                                <option value="<?php echo $defined_conditions[$num_cond]?>"><?php echo $defined_conditions[$num_cond]?></option>
                                
                            <?php
                        }
                    ?>

                </select>
                <button class="input_button" type="submit" >Use condition</button>
                
            </form>
        </body>
    </html>