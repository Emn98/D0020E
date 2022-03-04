class db_handler{

  translator;

    constructor(translator) {
      this.translator = translator;
    }

    load(policy_name){
      cy.elements().remove(); // Clear graph

      var policy_txt = "";

      $.ajax({//Retrive the policy from the database
        async: false,
        type: "POST",
        url:  "/AdminPage/LoadPolicy/get_policy_backend.php",
        data: {policy_name: policy_name
              },
        dataType: "text",

        success: function(response){
          policy_txt = response;
        },
        error: function(){
          alert("Failure");
        },
      });

      this.translator.make_graph(policy_txt);
    }

    save() {
      this.translator.save_pol();
    }


}
