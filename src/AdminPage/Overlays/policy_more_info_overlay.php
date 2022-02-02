<!DOCTYPE html>
<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Styles/more_info_overlay.css">
</head>
<body>
<div id="overlay">
  <div id="popup_container">
    <p class="close_btn_more_info" onclick="closee()">X</p>
    <div id="graph_picture"></div>
    <div id="display_policy_info">
  
    </div>
  </div>
</div>  

<script>
function show_policy_info(policy_name) {
  document.getElementById("overlay").style.display = "grid";
  $("#display_policy_info").load("../AdminPage/Overlays/policy_more_info_overlay_backend.php", {
    policy_name: policy_name
  });
}

function closee() {
  document.getElementById("overlay").style.display = "none";
}
</script>
   
</body>
</html> 
