<?php
    require_once "condition.php";

    require_once "../db_conn/db_conn.php";

    require_once "../db_queries/select_queries.php";

    $policies = get_policies($conn);

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
            
            <form class="choose_pol_form" method="POST" action="Add_condition.php">
            <lable for="policy_name">Select policy</label>
                <select  id="policy_name" name="policy_name">
                    
                    <?php
                        for($num_policy = 0; $num_policy < sizeof($policies); $num_policy++)
                        {
                            ?>
                                <option value="<?php echo $policies[$num_policy]["policy_name"]?>"><?php echo $policies[$num_policy]["policy_name"]?></option>
                                
                            <?php
                        }
                    ?>

                </select>
                <b id="error" style="visibility:hidden;">Choose atleast one accossiaion</b>
                <button class="input_button" type="submit" >Continue</button>
                
            </form>
        </body>
    </html>
<?php
    if(isset($_GET["NO_Association"]))
    {
        ?>
            <script>
                document.getElementById("error").style="color:red; visibility:visible;";
            </script>
        <?php
    }
?>