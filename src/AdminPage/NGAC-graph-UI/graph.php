<?php
  // windows filepaths, to be changed
  //include($_SERVER['DOCUMENT_ROOT']."/AdminPage/db_conn/db_conn.php");
  //include($_SERVER['DOCUMENT_ROOT']."/AdminPage/db_queries/select_queries.php");

  // linux file paths... I think
  include("../AdminPage/db_queries/select_queries.php");
  include("../AdminPage/db_queries/select_queries.php");
?>

<!DOCTYPE html>

<html>

  <head>
    <title>NGAC Policy Tool</title>

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="cytoscape/css/cytoscape.js-panzoom.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="cytoscape/js/dependencies.js"></script>
    <script src="cytoscape/js/cytoscape.min.js"></script>
		<script src="cytoscape/js/cytoscape-extensions.js"></script>
    <script src="js/ngac.js"></script>
    <script src="js/db_handler.js"></script>
    <script src="js/db_translator.js"></script>
    <script src="/AdminPage/Scripts/go_to_admin_page.js"></script>


    <script>

      var ngacJS = new NgacDoc();

      document.addEventListener('DOMContentLoaded', function(){

        var cy = window.cy = cytoscape({
          container: document.getElementById('cy'),

          style: [
            {
              selector: 'node[name]',
              style: {
                'content': 'data(name)'
              }
            },

            {
              selector: 'edge',
              style: {
                'curve-style': 'bezier',
                'target-arrow-shape': 'triangle',
                'content': 'data(name)'
              }
            },

            {
              selector: '.Object',
              style: {
                'shape': 'rectangle',
                'width': '50px'
              }
            },

            {
              selector: '.attribute:childless',
              style: {
                'background-color' : '#DCDCDC',
                'border-color' : '#D3D3D3',
                'border-width' : '1px',
                'border-style' : 'solid'
              }
            },

            {
              "selector": ".edgelabel",
              "style": {
                "color": "#fff",
                "text-outline-color": "#888",
                "text-outline-width": 2,
                'font-size': '12px'
              }
            },

            {
              selector: '.attribute',
              style: {
                'shape': 'round-rectangle',
                'border-width': '2px',
                'border-style' : 'solid'
              }
            },

            {
              selector: '.attribute.Object',
              style: {
                'border-color' : '#ED2939'
              }
            },

            {
              selector: '.attribute.User',
              style: {
                'border-color' : '#318CE7'
              }
            }



          ]
        });


        document.querySelector('#new-edge').addEventListener('click', function() {
          ngacJS.edgePrompt(true);
        });

        document.querySelector('#delete-element').addEventListener('click', function() {
          ngacJS.deleteElement();
        });

        document.querySelector('#new-node').addEventListener('click', function() {
          ngacJS.nodePrompt(true);
        });

        document.querySelector('#add-edge').addEventListener('click', function() {
          ngacJS.addEdge();
        });

        document.querySelector('#typefield').addEventListener('change', function() {
          ngacJS.loadAttributes();
        });

        document.querySelector('#node-prompt-close').addEventListener('click', function() {
          ngacJS.nodePrompt(false);
        });

        document.querySelector('#edge-prompt-close').addEventListener('click', function() {
          ngacJS.edgePrompt(false);
        });

        document.querySelector('#layout').addEventListener('click', function() {
          ngacJS.renderLayout();
        });

        document.querySelector('#save-policy').addEventListener('click', function() {
          ngacJS.save_db();
        });

        document.querySelector('#dbops').addEventListener('click', function() {
          ngacJS.dbOps(true);
        });

        document.querySelector('#dbops-close').addEventListener('click', function() {
          ngacJS.dbOps(false);
        });

        document.querySelector('#import-policy').addEventListener('click', function() {
          ngacJS.selectImportedPolicy( <?php echo json_encode(get_policies($conn)); ?> );
        });

        document.querySelector('#import-user').addEventListener('click', function() {
          ngacJS.selectImportedElement( <?php echo json_encode(get_users($conn)); ?>, "user" );
        });

        document.querySelector('#import-object').addEventListener('click', function() {
          ngacJS.selectImportedElement( <?php echo json_encode(get_objects($conn)); ?>, "object" );
        });

        document.querySelector('#import-close').addEventListener('click', function() {
          ngacJS.importSelectPrompt(false);
        });

        document.querySelector('#promotion-close').addEventListener('click', function() {
          ngacJS.promotionPrompt(false);
        });

        document.querySelector('#promote-button').addEventListener('click', function() {
          ngacJS.promotionConfirm();
        });

        document.querySelector('#select-button').addEventListener('click', function() {
          console.log(document.getElementById("import-title").innerText);
          switch (document.getElementById("import-title").innerText) {
            case "Select Policy":
              ngacJS.load_db();
              break;
            case "Select User":
              ngacJS.importNodePrompt("User");
            break;
            case "Select Object":
              ngacJS.importNodePrompt("Object");
            break;
          }
        });

        cy.panzoom({
					// options here...
				});

        ngacJS.loadAttributes(); // First iteration since event is onChange

        cy.on('dbltap', "node", function(event) { ngacJS.promote(this) });

      });

    </script>
  </head>

  <body>

    <div id="cy"></div>

    <div id="buttons" class="cy-panzoom">

      <button id="new-node" title="Add a new element">
        <i class="fas fa-plus"></i>
      </button>
      <button id="delete-element" title="Delete selected element">
        <i class="fas fa-trash-alt"></i>
      </button>
      <button id="new-edge" title="Add a new relation">
        <i class="fas fa-draw-polygon"></i>
      </button>
      <button id="dbops" title="Database options">
        <i class="fas fa-database"></i>
      </button>
      <button id="layout" title="Optimize layout">
        <i class="fas fa-bezier-curve"></i>
      </button>

    </div>

    <div id = "Loader">
      <div id = "message">
        Saving to DB...
      </div>
    </div>

    <div id="prompt-overlay"></div>


    <!-- Add menu div -->
    <div class="add-menu" style="display: block;">


      <!-- Add element prompt div -->
      <div id="add-element" class="add-element" style="display: none;">

        <div class="close-button">
          <button type="button" id="node-prompt-close" class="btn-close"></button>
        </div>

        <h2>New element</h2>


        <div class="mb-3">
          <label for="namefield" class="form-label">Name</label>
          <input type="text" class="form-control" id="namefield" />
        </div>

        <div class="mb-3">
          <label for="typefield" class="form-label">Type</label>
          <select class="form-select" id="typefield">
            <option selected>User</option>
            <option>Object</option>
            <option>User attribute</option>
            <option>Object attribute</option>
            <option>Policy class</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="attributefield" class="form-label">Attribute</label>
          <select class="form-select" id="attributefield">
            <option selected>None</option>
          </select>
        </div>

        <div class="add-button">
          <input type="submit" class="btn btn-primary" value="Add element" onclick="ngacJS.addNode()">
        </div>


        <div class="ngac-bottom-tag">
          <h1>NGAC Policy Tool</h1>
        </div>


      </div>
      <!-- -->



      <!-- Add relation prompt div -->
      <div id="add-relation" class="add-relation" style="display: none;">

        <div class="close-button">
          <button type="button" id="edge-prompt-close" class="btn-close"></button>
        </div>

        <h2>New relation</h2>

        <div class="mb-3">
          <label for="sourcefield" class="form-label">Source</label>
          <select class="form-select" id="sourcefield">
          </select>
        </div>

        <div class="mb-3">
          <label for="targetfield" class="form-label">Target</label>
          <select class="form-select" id="targetfield">
          </select>
        </div>

        <div class="mb-3">
          <label for="relationfield" class="form-label">Access privilege</label>
          <select class="form-select" id="relationfield">
            <option selected>Read</option>
            <option>Write</option>
          </select>
        </div>

        <div class="add-button">
          <input type="button" id="add-edge" class="btn btn-primary" value="Add relation">
        </div>

        <div class="ngac-bottom-tag">
          <h1>NGAC Policy Tool</h1>
        </div>

      </div>
      <!-- -->



    </div>
    <!-- Add menu div stop -->


    <!-- DB options div -->
    <div  id= "db-options" class="db-options" style="display: none;">

      <div class="close-button">
        <button type="button" id="dbops-close" class="btn-close"></button>
      </div>

      <h2>Database options</h2>

      <div class="db-button-group">
        <button type="button" id="import-user" class="btn btn-primary">
          <i class="fas fa-user-plus"></i><br>
          Import User
        </button>

        <button type="button" id="import-object" class="btn btn-primary">
          <i class="fas fa-folder-plus"></i><br>
          Import Object
        </button>

        <button type="button" id="import-policy" class="btn btn-primary">
          <i class="fas fa-file-import"></i><br>
          Import Policy
        </button>

        <button type="button" id="save-policy"class="btn btn-primary">
          <i class="fas fa-file-export"></i><br>
          Save Policy
        </button>

      </div>

      <div class="ngac-bottom-tag">
        <h1>NGAC Policy Tool</h1>
      </div>

      </div>
      <!-- DB options div stop -->


      <!-- Select import div -->
      <div class="select-options" id="select-options" style="display: none;">

        <div class="close-button">
          <button type="button" id="import-close" class="btn-close"></button>
        </div>

          <h4 id="import-title"></h4>

          <div class="mb-3">
            <select class="form-select" id="db-select-form" aria-label="Default select example">
            </select>
          </div>

          <div class="select-button">
            <button type="button" id="select-button" class="btn btn-primary"></button>
          </div>

          <div class="ngac-bottom-tag">
            <h1>NGAC Policy Tool</h1>
          </div>
      </div>
      <!-- Select import div stop-->



      <!-- Promotion prompt div -->
      <div class="promotion-prompt" id="promotion-prompt" style="display: none;">

        <div class="close-button">
          <button type="button" id="promotion-close" class="btn-close"></button>
        </div>

        <div class="promotion-header">
          <h3>Assign attribute</h3>
        </div>

        <div class="mb-3">
          <label for="promotion-node" class="form-label">Element</label>
          <input class="form-control" id="promotion-node" type="text" disabled readonly>
        </div>

        <div class="mb-3">
          <label for="promotion-attributes" class="form-label">Attribute</label>
          <select class="form-select" id="promotion-attributes">
          </select>
        </div>

        <div class="promote-button">
          <button type="button" id="promote-button" class="btn btn-primary">Assign</button>
        </div>

        <div class="ngac-bottom-tag">
          <h1>NGAC Policy Tool</h1>
        </div>


      </div>
      <!-- Promotion prompt div end-->

  </body>

</html>
