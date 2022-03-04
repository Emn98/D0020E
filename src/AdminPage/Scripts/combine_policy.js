function combine_policies(policy1, policy2){
  var url =
  "http://127.0.0.1:8001/paapi/combinepol?policy1=" +
   policy1 + "&policy2=" + policy2 + "&combined=" + "combined policy" +
  "&token=admin_token";

  $.ajax({
    async: false,
    url: url,
    type: "POST",
    dataType: "json",

    complete: function (data) {
      const obj = data.responseJSON;

      if (typeof obj == "undefined") {
        alert("Connection Error: Can't connect to the NGAC server.");
      } else {
        if (obj.respStatus != "success") {
          alert(JSON.stringify(data.responseJSON));
        } else {
          get_active_policy();
        }
      }
    },
  });

}