class FileHandler {

  load(){
    cy.elements().remove(); // Clear graph
    this.makeGraph();
  }

  // Parse through selected file and translate to cytoscape graph
  makeGraph(){

    var newGraph = [];

    var fr=new FileReader();
      fr.onload=function(){
          var lineArray = fr.result.split('\n');

          for (let i in lineArray){

            // Prolog code string filtering
            var filteredString = lineArray[i].replace(/\W/g, ' ');
            var cmds = filteredString.split(' ');
            var filteredCmds = cmds.filter(function(str) { return /\S/.test(str);});

            switch (filteredCmds[0]) {

              case 'user':
                newGraph.push(
                  {
                    group: 'nodes',
                    data: { name: filteredCmds[1] },
                    classes: 'User'
                  });
                break;

              case 'user_attribute':
                var nameid = filteredCmds[1];
                newGraph.push(
                  {
                    group: 'nodes',
                    data: { id: nameid, name: nameid },
                    classes: 'User attribute'
                  });
                break;

              case 'assign':
                for (let i in newGraph) {
                  if (newGraph[i].data.name == filteredCmds[1]) {
                    var type = newGraph[i].classes;
                    /*
                     If node already has a parent, create a new node and assign
                     to attribute. Cytoscape js elements are limited to one parent
                    */
                    if (!newGraph[i].data.parent) {
                      newGraph[i].data.parent = filteredCmds[2];
                    } else {
                      newGraph.push(
                        {
                          group: 'nodes',
                          data: { name: filteredCmds[1],
                          parent: filteredCmds[2] },
                          classes: type
                        });
                    }
                  }
                }
                break;

              case 'object':
                newGraph.push(
                  {
                    group: 'nodes',
                    data: { name: filteredCmds[1] },
                    classes: 'Object' });
                break;

              case 'object_attribute':
                var nameid = filteredCmds[1];
                newGraph.push(
                  {
                    group: 'nodes',
                    data: { id: nameid, name: nameid },
                    classes: 'Object attribute'
                  });
                break;

              case 'associate':
                var final = filteredCmds.length - 1;
                // In case of multiple access right ops
                for (var j = 2; j < final; j++) {
                  newGraph.push(
                    {
                      data: { name: filteredCmds[j],
                      source: filteredCmds[1],
                      target: filteredCmds[final] },
                      classes: 'edgelabel'
                    });
                }
                break;
            }
          }

          cy.add(newGraph);
          cy.layout({name: 'cose-bilkent', animationDuration: 1250}).run();

      }

      fr.readAsText(event.target.files[0]);

  }

}
