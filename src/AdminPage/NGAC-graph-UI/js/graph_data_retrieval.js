class Graph_data_retrieval
{
    
    get_data()
    {
        var nodes = cy.json().elements.nodes;
        var edges = cy.json().elements.edges;

        var users = this.find_nodes(nodes, "User");

        var objects = this.find_nodes(nodes, "Object");

        var user_attributes = this.find_nodes(nodes, "User attribute");

        var object_attributes = this.find_nodes(nodes, "Object attribute");

        var user_attributes_conns = this.find_nodes_with_conn(nodes, "User");

        var object_attributes_conns = this.find_nodes_with_conn(nodes, "Object");

        var attribute_conns = Object.assign({},this.find_nodes_with_conn(nodes, "User attribute"), (this.find_nodes_with_conn(nodes, "Object attribute")) );
        
        var associations = this.find_edges(edges);

        /*
        console.log(users);
        console.log(objects);
        console.log(user_attributes);
        console.log(object_attributes);
        console.log(user_attributes_conns);
        console.log(object_attributes_conns);
        console.log(attribute_conns);
        console.log(associations);
        */

        $.ajax({
            data: {
                users:users,
                objects:objects,
                user_attributes:user_attributes,
                object_attributes:object_attributes,
                user_attributes_conns:user_attributes_conns,
                object_attributes_conns:object_attributes_conns,
                attribute_conns:attribute_conns,
                associations:associations
            },
            type: "post",
            url: "../AddPolicy/save_graph_to_DB.php",
            success: function(data){
                alert(data);
            }
        });
    }

    // finde nodes that match the classes string
    find_nodes(nodes_json, classes)
    {
        var nodes = [];
        for(var i in nodes_json)
        {
            if(nodes_json[i].classes == classes)
            {
                nodes.push(nodes_json[i].data.name);
            }
        }
        return nodes;
    }

    find_nodes_with_conn(nodes_json, classes)
    {
        var nodes = {};
        for(var i in nodes_json)
        {
            if(nodes_json[i].classes == classes)
            {
                nodes[nodes_json[i].data.name] = nodes_json[i].data.parent;
            }
        }
        return nodes;
    }

    find_edges(edges_json)
    {
        var source_target = {};
        for(var i in edges_json)
        {
            if(source_target[edges_json[i].data.source] == null)
            {
                var target_operation = {};
                var operations = []

                operations.push(edges_json[i].data.name);

                target_operation[edges_json[i].data.target] = operations;

                source_target[edges_json[i].data.source] = target_operation;
            }
            else if( source_target[edges_json[i].data.source][edges_json[i].data.target] == null)
            {
                var operations = []

                operations.push(edges_json[i].data.name);

                source_target[edges_json[i].data.source][edges_json[i].data.target] = operations;
            }
            else
            {
                source_target[edges_json[i].data.source][edges_json[i].data.target].push(edges_json[i].data.name);    

            }

        }
        return source_target;
    }

    
}