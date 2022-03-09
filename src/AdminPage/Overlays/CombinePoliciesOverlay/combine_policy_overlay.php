<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/AdminPage/Styles/combine_policies_overlay_styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="Scripts/combine_policy.js"></script>
</head>
<body>
<div id="combine_policy_overlay">
  <div id="popup_container_combine_policy">
    <p class="close_btn" onclick="close_comb_pol()">&#x2715</p>
    <h2>Policies with conditions</h2>
    <div id="show_comb_policies_container">
        <table id="table_cond_policies">
            <thead id="t_head_cond_policies">
              <tr>
                <th></th>
                <th>Policy name</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="t_body_cond_policies">
              <script>
                //Load in user table on first page load
                $(document).ready(function(){
                  $("#t_body_cond_policies").load("/AdminPage/Overlays/CombinePoliciesOverlay/get_policies_for_combine_policies_overlay.php", {
                  table: "cond_policy"
                  }); 
                });
              </script>    
            </tbody>
        </table>
    </div>
    <h2>Policies without conditions</h2>
    <div id="show_non_comb_policies_container">
        <table id="table_non_cond_policies">
            <thead id="t_head_non_cond_policies">
              <tr>
                <th></th>
                <th>Policy name</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="t_body_non_cond_policies">
              <script>
                $(document).ready(function(){
                  $("#t_body_non_cond_policies").load("/AdminPage/Overlays/CombinePoliciesOverlay/get_policies_for_combine_policies_overlay.php", {
                  table: "non_cond_policy"
                  }); 
                });
              </script>   
            </tbody>
        </table>
    </div>
    <button class="comb_select_pol_disabled" id="combine_selected_policies_btn" onclick="combine_selected_policies()" disabled>Combine Selected Policies</button>
  </div>
</div>  

<script>
function combine_pol_overlay() {
  document.getElementById("combine_policy_overlay").style.display = "grid";
}

function close_comb_pol() {
  document.getElementById("combine_policy_overlay").style.display = "none";
}

//Keeps track of which policies have been checked
const checked_policies = [];

//Add or remove a policy from the condition table based on check status
function check_con_policy(checked_policy,policy_name){
  if(checked_policy.checked){
    checked_policies.push(policy_name);
    let rates = document.getElementsByName('policy_con_checkbox');
          rates.forEach((rate) => {
              if (!rate.checked) {
                  rate.disabled = "disabled";
                  rate.style.opacity = 0.2;
                  rate.style.cursor = "not-allowed";
                }
    });
    check_comb_btn();
  }else{
    var index = checked_policies.indexOf(policy_name);
    if (index !== -1) {
      checked_policies.splice(index, 1);
    }
    let rates = document.getElementsByName('policy_con_checkbox');
    rates.forEach((rate) => {
      rate.disabled = "";
      rate.style.opacity = 1;
      rate.style.cursor = "pointer";
    });
    check_comb_btn();
  }

}

//Add or remove a policy from the non condition table based on check status. 
function check_non_con_policy(checked_policy, policy_name){
  if(checked_policy.checked){
    checked_policies.push(policy_name);
    check_comb_btn();
  }else{
    var index = checked_policies.indexOf(policy_name);
    if (index !== -1) {
      checked_policies.splice(index, 1);
    }
    check_comb_btn();
  }

}

//Enable the combine policy button if atlest 2 different policies have been checked
function check_comb_btn(){
  if(checked_policies.length > 1){
    document.getElementById("combine_selected_policies_btn").className = "comb_select_pol";
    document.getElementById("combine_selected_policies_btn").disabled = "";
  }else{
    document.getElementById("combine_selected_policies_btn").className = "comb_select_pol_disabled";
    document.getElementById("combine_selected_policies_btn").disabled = "disabled";
  }
}

function combine_selected_policies(){
  policies_text = "";
  checked_policies.forEach((policy) => {
    policies_text += policy + ", ";
  });
  policies_text = policies_text.slice(0, -2);
  
  if(confirm("Are you sure you want to merge and load the following policies? " + policies_text)){
    merge_policies();
    alert("Combined policy loaded successfully");

  }
  
  function merge_policies(){
    //Keep track off which policies needs to be unloaded after merge
    const polcies_to_unload = [];

    var  need_db_access = "check";

    checked_policies.forEach((policy) => {
      $.ajax({
        async: false,
        type: "POST",
        url: "/AdminPage/LoadPolicy/check_if_policy_already_loaded.php",
        data: {
          policy_name: policy,
          need_db_access: need_db_access
        },
        dataType: "text",
        success: function (response) {
          if (response != 1) {
            polcies_to_unload.push(policy);
          }
        } 
      });
    });

    polcies_to_unload.forEach((policy) => {
      load_policy(policy, "False");
    });

    //Merge all the policies via the ngag function.
    for (let i = 0; i < checked_policies.length;) {
      if(i==0){
        combine_policies(checked_policies[0], checked_policies[1]);
        i += 2;
      }else{
        combine_policies(checked_policies[i], "combined policy");
        i += 1;
      }
    }

    //Unload the policies which wasen't loaded before the merge.
    polcies_to_unload.forEach((policy) => {
      unload_policy(policy);
    });

  }

}


</script>
   
</body>
</html> 