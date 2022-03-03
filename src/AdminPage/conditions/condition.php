<script>
    class Condition
    {
        constructor(association_ids)
        {
            this.association_ids = association_ids;
        }

        get_association_ids()
        {
            return this.association_ids;
        }

        /**
         * Implementation is required
         * 
         * The method should return the text of how the condition is writen in a ngac policy
         * 
         * For example time_in_range returns time_in_range(earliestTime, time_now,latestTime)
         * where earliestTime and latestTime are the int values given to this instance.
         */
        get_condition_definition()
        {
            throw new Error("You have to implement the get_condition_definition method");
        }

    }
</script>

<link href="style.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Include all defined conditions here !-->
<script src="/AdminPage/conditions/def_conds/Time_in_range.js"></script>
<script src="/AdminPage/conditions/def_conds/IS_weekday.js"></script>
<body style="background-color:#435165">

<div  id = "Loader1">
    <div id = "message1">
        Saving to DB...
    </div>
</div>

<div  id = "Loader2">
    <div id = "message2">
        Deleting from DB...
    </div>
</div>

<?php
    function header_and_style()
    {
        ?>

            <!DOCTYPE html5>
                    <html lang="en">
                    <head>
                        <title>Admin NGAC</title>
                        <meta charset="UTF-8">
                        
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
                        

        <?php
    }

    function footer()
    {
        ?>
            </body>
        </html>
        <?php
    }

    // List definitions of conditions here!
    $defined_conditions = ["Time_in_range", "IS_weekday"];

    /**
     * Make a function that sets up a condition of that type for each condition definition 
     */
    function Time_in_range()
    {
        global $associations;
        header_and_style()
        ?>
            <div class="Time_in_range">
                <h1>Create the time_in_range condition</h1>
                
                <div class="Time_in_range_row">
                    <label >Input earliest time</label>
                    <br>
                </div>

                <div class="Time_in_range_row">
                    <label class="input" for="earliestTime_hour">Hour</label>
                    <input type="number" id="earliestTime_hour" name="earliestTime_hour">
                    <label class="input" for="earliestTime_min">Min</label>
                    <input type="number" id="earliestTime_min" name="earliestTime_min">
                    <label class="input" for="earliestTime_sec">Sec</label>
                    <input type="number" id="earliestTime_sec" name="earliestTime_sec">
                    <br>
                </div>
                
                <div class="Time_in_range_row">
                    <label>Input latest time</label>
                    <br>
                </div>
                
                <div class="Time_in_range_row">
                    <label class="input" for="latestTime_hour">Hour</label>
                    <input type="number" id="latestTime_hour" name="latestTime_hour">
                    <label class="input" for="latestTime_min">Min</label>
                    <input type="number" id="latestTime_min" name="latestTime_min">
                    <label class="input" for="latestTime_sec">Sec</label>
                    <input type="number" id="latestTime_sec" name="latestTime_sec">
                    <br>
                </div>
                

                <button class="input_button" onclick="time_in_range_submit(<?php echo json_encode($associations) ?>,)">Submit</button>

                <br>
                
                <b id="error" style="visibility:hidden;">Invalid number</b>
             </div>
        <?php
        footer();
    }

    function IS_weekday()
    {
        global $associations;
        ?>
            <script>
                IS_weekday.create_IS_weekday(<?php echo json_encode($associations) ?>);
            </script>
        <?php
        
    }

    ?>
    <script>
        function time_in_range_submit(associations)
        {
            try
            {
                earliestTime = new Time(document.getElementById('earliestTime_hour').value, document.getElementById('earliestTime_min').value, document.getElementById('earliestTime_sec').value);
                latestTime = new Time(document.getElementById('latestTime_hour').value, document.getElementById('latestTime_min').value, document.getElementById('latestTime_sec').value)
                Time_in_range.create_time_in_range(associations, earliestTime, latestTime);
            }
            catch(error)
            {
                document.getElementById("error").style="color:red; visibility:visible;";
            }   
            
            //<button onclick="Time_in_range.create_time_in_range(<?php echo json_encode($associations) ?>, new Time(document.getElementById('earliestTime_hour').value, document.getElementById('earliestTime_min').value, document.getElementById('earliestTime_sec').value), new Time(document.getElementById('latestTime_hour').value, document.getElementById('latestTime_min').value, document.getElementById('latestTime_sec').value))">Submit</button>
            
        }

        function IS_weekday_submit(associations)
        {
            IS_weekday.create_IS_weekday(<?php echo json_encode($associations) ?>);
        }

        function send_values_with_post(cond_def, associations)
        {
            $("#Loader1").show();
           
            window.setTimeout( function(){
                $.ajax({
                        
                    data: {
                        associations:associations
                    },
                    type: "post",
                    url: "Check_for_old_cond_in_DB.php",
                    
                    success: function(response)
                    {
                        $('#Loader1').hide();
                        
                        data = $.parseJSON(response);

                        if(data.result === ("SUCCESS"))
                        {
                            update_DB(cond_def, associations);
                        }
                        else
                        {
                            swal({
                                title: "Do you want to delete the old condition?",
                                icon: "warning",
                                buttons: {
                                    ok: {
                                        text:"OK",
                                        value: "true",
                                    },
                                    cancel: "cancel"
                                },
                                
                            })
                            .then((value)=>{
                                switch(value){
                                    case "true":
                                        delet_cond(data.cond_ID);
                                        update_DB(cond_def, associations);
                                        break;

                                    default:
                                        window.location.href = "/AdminPage/conditions/Add_condition.php";
                                        break;

                                }
                                
                            });

                        }
                    }
                    
                    

                });
            }, 1000 );
        }

        function update_DB(cond_def, associations)
        {
            $("#Loader1").show();
        
            window.setTimeout( function(){
                $.ajax({
                        
                    data: {
                        cond_def:cond_def,
                        associations:associations
                    },
                    type: "post",
                    url: "Add_cond_to_DB.php",
                    
                    success: function(data)
                    {
                        $('#Loader1').hide();
                        
                        $.ajax({
                        
                            data: {
                                SUCCESS:"Condition successfully created!"
                            },
                            type: "post",
                            url: "/AdminPage/alert_message.php",
                            
                            success: function(data){
                                document.write(data);
                            }
                            
                            

                        });
                    }
                    
                    

                });
            }, 1000 );
        }

        function delet_cond(cond_ID)
        {
            $("#Loader2").show();
            window.setTimeout( function(){
                $.ajax({
                        
                    data: {
                        cond_ID:cond_ID
                    },
                    type: "post",
                    url: "Delete_old_cond.php",
                    
                    success: function(data)
                    {
                        $('#Loader2').hide();
                    }
                    
                    

                });
            }, 1000 );
        }


        
    </script>
    <?php

    function cond_def_switch_case($cond_name)
    {
        global $defined_conditions;

        for($num_cond = 0; $num_cond < sizeof($defined_conditions); $num_cond ++)
        {
            if($cond_name == $defined_conditions[$num_cond])
            {
                call_user_func($cond_name);
            }
        }
    }

    
?>
       