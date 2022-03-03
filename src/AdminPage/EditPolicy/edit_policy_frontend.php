<!DOCTYPE html>
<html>
  <head>
    <title>NGAC Policy Tool</title>
 
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="cytoscape/css/cytoscape.js-panzoom.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link href="../NGAC-graph-UI/css/style.css" rel="stylesheet" type="text/css"/>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/AdminPage/Scripts/go_to_choose_frontend.js"></script>
    <script src="/AdminPage/Scripts/check_ngac_server_conn.js"></script>
    <script src="/AdminPage/Scripts/go_to_admin_page.js"></script>
    <script>
      $(document).ready(function(){
            
        //Check NGAC connection upon load
        check_ngac_server_conn();

      });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="../NGAC-graph-UI/cytoscape/css/cytoscape.js-panzoom.css" rel="stylesheet" type="text/css" />
    <link href="../NGAC-graph-UI/css/style.css" rel="stylesheet" type="text/css" />
    <script src="../NGAC-graph-UI/cytoscape/js/dependencies.js"></script>
    <script src="../NGAC-graph-UI/cytoscape/js/cytoscape.min.js"></script>
    <script src="../NGAC-graph-UI/cytoscape/js/cytoscape-extensions.js"></script>
    <script src="../NGAC-graph-UI/js/ngac.js"></script>
    <script src="../NGAC-graph-UI/js/filehandler.js"></script>
    <script src="../NGAC-graph-UI/js/db_handler.js"></script>
    <script src="../NGAC-graph-UI/js/graph_data_retrieval.js"></script>
    <script src="../Scripts/delete_policy.js"></script>
    <script>
      var ngacJS = new NgacDoc();
      document.addEventListener('DOMContentLoaded', function(){
        var cy = window.cy = cytoscape({
          container: document.getElementById('cy'),

          ready: function() {
            this.layout({
              name: 'cose-bilkent',
              animationDuration: 1250
            }).run();
          },

          style: [{
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
              'background-color': '#DCDCDC',
              'border-color': '#D3D3D3',
              'border-width': '1px',
              'border-style': 'solid'
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
              'border-style': 'solid'
            }
          },

          {
            selector: '.attribute.Object',
            style: {
              'border-color': '#ED2939'
            }
          },

          {
            selector: '.attribute.User',
            style: {
              'border-color': '#318CE7'
            }
          }
          ],
        /* Test case
        elements: {
          nodes: [

            // Attributes
            { data: { id: 'Books', name: 'Books' }, classes: 'Object attribute' },
            { data: { id: 'Documents', name: 'Documents' }, classes: 'Object attribute'  },
            { data: { id: 'Team', name: 'Team' }, classes: 'User attribute'  },
            { data: { id: 'Team2', name: 'Team2' }, classes: 'User attribute'  },
            { data: { id: 'Lord of the rings', name: 'Lord of the rings', parent: 'Books' }, classes: 'Object attribute'  },

            // Objects
            { data: { name: 'The Hobbit', parent: 'Books' }, classes: 'Object' },
            { data: { name: 'Fellowship of the ring', parent: 'Lord of the rings' }, classes: 'Object' },
            { data: { name: 'The Two Towers', parent: 'Lord of the rings' }, classes: 'Object' },
            { data: { name: 'Return of the king', parent: 'Lord of the rings' }, classes: 'Object' },
            { data: { name: 'Secret Document', parent: 'Documents' }, classes: 'Object' },

            // Users
            { data: { name: 'Ilaman', parent: 'Team' }, classes: 'User' },
            { data: { name: 'Jesper', parent: 'Team' }, classes: 'User' },
            { data: { name: 'Emil', parent: 'Team' }, classes: 'User' },
            { data: { name: 'Birger', parent: 'Team' }, classes: 'User' }
          ],
            // Associations
          edges: [
            { data: { name: 'Write', source: 'Team', target: 'Books' }, classes: 'edgelabel' },
            { data: { name: 'Read', source: 'Team', target: 'Documents' }, classes: 'edgelabel' },
            { data: { name: 'Write', source: 'Team', target: 'Lord of the rings' }, classes: 'edgelabel' },
            { data: { name: 'Read', source: 'Team', target: 'Lord of the rings' }, classes: 'edgelabel' },
            { data: { name: 'Write', source: 'Team2', target: 'Documents' }, classes: 'edgelabel' },
          ]
        }
        */
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


      document.querySelector('#get_data_from_graph').addEventListener('click', function() {
        ngacJS.retrive_data(null);
      });

      document.querySelector('#get_data_from_graph_overwrite').addEventListener('click', function() {
        <?php
          echo "var policy_name ='".$_POST['policy_name']."';";
        ?>
        if(confirm("Warning: Are you sure you want to overwrite policy '" +policy_name+"'?")){
          delete_policy(policy_name);
          ngacJS.retrive_data(policy_name);
        }
      });

      cy.panzoom({
        // options here...
      });

      //Render the graph
      <?php
        if(isset($_POST['policy_name'])){
          $policy_name = $_POST['policy_name'];
          echo "ngacJS.load_db('".$policy_name."');";
        }
      ?>

    });
  </script>
  </head>
  <body>

  <div class="header_div">
        <h2 class="choose_frontend_txt_graph" onclick="go_to_choose_frontend()" style='cursor: pointer;'>Choose Frontend</h2>
        <h2 class="choose_admin_page_txt_graph" onclick="go_to_admin_page()" style='cursor: pointer; margin-left: 12.8rem; position:absolute;'>Admin page</h2>
        <div class="server_status_graph">
            <h3 style="display:inline;float:left">NGAC Server Status: </h3>
            <h3 class="server_status_response" id="server_status_response" style="display:inline;float:right;margin-right: -3.8rem;"></h3>
        </div>
    </div>

    
    <div class="header">
      <h1>NGAC Policy Tool - Edit</h1>
    </div>

    <div id="cy"></div>

    <div id="buttons" class="cy-panzoom">

      <button id="new-node" title="Add a new element">
        <i class="fas fa-plus"></i>
      </button>
      <button id="new-edge" title="Add a new relation">
        <i class="fas fa-draw-polygon"></i>
      </button>
      <button id="delete-element" title="Delete selected element">
        <i class="fas fa-trash-alt"></i>
      </button>
      <button id="layout" title="Optimize layout">
        <i class="fas fa-bezier-curve"></i>
      </button>

    </div>

  

    <div class="retrive_data_button">
      <button id="get_data_from_graph" title="Save">Save as new policy</button>
    </div>

    <div class="retrive_data_button_overwrite">
      <button id="get_data_from_graph_overwrite" title="Save">Save policy</button>
    </div>

    <div id = "Loader">
      <div id = "message">
        Saving to DB...
      </div>
    </div>

    <div id="prompt-overlay"></div>

    <div class="add-menu" style="display: block;">


      <!-- Add element prompt div -->
      <div id="add-element" class="add-element" style="display: none;">

        <div class="close-button">
          <button type="button" id="node-prompt-close" class="btn-close" aria-label="Close"></button>
        </div>

        <h2>New element</h2>


        <div class="mb-3">
          <label for="namefield" class="form-label">Name</label>
          <input type="text" class="form-control" id="namefield" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="typefield" class="form-label">Type</label>
          <select class="form-select" id="typefield" aria-label="Default select example">
            <option selected>User</option>
            <option>Object</option>
            <option>User attribute</option>
            <option>Object attribute</option>
            <option>Policy class</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="attributefield" class="form-label">Attribute</label>
          <select class="form-select" id="attributefield" aria-label="Default select example">
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
          <button type="button" id="edge-prompt-close" class="btn-close" aria-label="Close"></button>
        </div>

        <h2>New relation</h2>

        <div class="mb-3">
          <label for="sourcefield" class="form-label">Source</label>
          <select class="form-select" id="sourcefield" aria-label="Default select example">
          </select>
        </div>

        <div class="mb-3">
          <label for="targetfield" class="form-label">Target</label>
          <select class="form-select" id="targetfield" aria-label="Default select example">
          </select>
        </div>

        <div class="mb-3">
          <label for="relationfield" class="form-label">Access privilege</label>
          <select class="form-select" id="relationfield" aria-label="Default select example">
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

  </body>

</html>