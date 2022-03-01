<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<body style="background-color:#435165">
<?php 
    if(isset($_POST["SUCCESS"]))
    {
        ?>
            <script>
                swal({
                    title:<?php echo json_encode($_POST["SUCCESS"]) ?>,
                    icon: "success",
                    button: "OK",
                })
                .then((value)=>{
                    window.location = "/AdminPage/admin_main_page.php";
                });
                
            </script>
        <?php
    }
    else if(isset($_POST["ERROR"]))
    {
        ?>
            <script>
                swal({
                    title:<?php echo json_encode($_POST["ERROR"]) ?>,
                    icon: "error",
                    button: "OK",
                })
                .then((value)=>{
                    window.location = "/AdminPage/admin_main_page.php";
                });
            </script>
        <?php
    }
    else
    {
        echo "no";
    }
?>