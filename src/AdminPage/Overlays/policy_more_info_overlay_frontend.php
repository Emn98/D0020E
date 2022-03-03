<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Styles/more_info_overlay_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
  <link href="NGAC-graph-UI/cytoscape/css/cytoscape.js-panzoom.css" rel="stylesheet" type="text/css" />
  <link href="NGAC-graph-UI/css/style.css" rel="stylesheet" type="text/css" />
  <script src="NGAC-graph-UI/cytoscape/js/dependencies.js"></script>
  <script src="NGAC-graph-UI/cytoscape/js/cytoscape.min.js"></script>
  <script src="NGAC-graph-UI/cytoscape/js/cytoscape-extensions.js"></script>
  <script src="NGAC-graph-UI/js/ngac.js"></script>
  <script src="NGAC-graph-UI/js/filehandler.js"></script>
  <script src="NGAC-graph-UI/js/db_handler.js"></script>
  <script src="NGAC-graph-UI/js/graph_data_retrieval.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script>
    function activate_graph_gen(policy_name) {
      var ngac_js = new NgacDoc();

      var cy = window.cy = cytoscape({
        container: document.getElementById('graph_div'),

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

      cy.panzoom({
        // options here...
      });

      ngac_js.load_db(policy_name);
    }
  </script>
</head>

<body>
  <div id="overlay2">
    <!-- the darker overlay over the whole screen -->
    <p class="close_btn_more_info" onclick="closee()">&#x2715</p><!-- Close button -->
    <div id="graph_div"></div><!-- graph overlay -->
    <div id="display_policy_info"></div><!-- ploicy info overlay -->
  </div>
  <script>
    function show_policy_info(policy_name) {

      //Set display style to block making the overlay visible. 
      document.getElementById("overlay2").style.display = "block";

      //Load all the the information about the policy and display it on the overlay.
      $("#display_policy_info").load("../AdminPage/Overlays/policy_more_info_overlay_backend.php", {
        policy_name: policy_name
      });

      //Generate the graph
      activate_graph_gen(policy_name);
    }

    function closee() {
      document.getElementById("overlay2").style.display = "none";
    }
  </script>
</body>

</html>