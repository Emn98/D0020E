class NgacDoc {

	fileHandler;

	graph_data_retrieval;

	constructor() {
		this.fileHandler = new FileHandler();
		this.graph_data_retrieval = new Graph_data_retrieval();
	}

	addNode() {
		var ele_name = document.getElementById('namefield').value;
		if (this.nameTaken(ele_name)) {
			window.alert('Name is already taken');
		} else {
			var attr = document.getElementById('attributefield').value;
			var type = document.getElementById('typefield').value;

			this.nodePrompt(false);

			this.placeNode(ele_name, type, attr);

		}
	}

	// User is in new node placement mode
	placeNode(name, type, attr) {
		var nodeData = (type.includes('attribute')) ? { id: name, name: name, parent: attr } : { name: name, parent: attr };
		document.body.style.cursor='crosshair';
		// Register one time click event to place new node
		cy.one("tap", function(e) {
		    cy.add({
		        group: "nodes",
		        data: nodeData,
		        renderedPosition: {
		            x: e.renderedPosition.x,
		            y: e.renderedPosition.y,
						},
						classes: type
					});
					document.body.style.cursor='auto';
		});

	}

	// Delete selected graph element
	deleteElement() {
		var element = cy.$(':selected');
		element.remove();
	}

	addEdge() {
		var source = document.getElementById('sourcefield').value;
		var target = document.getElementById('targetfield').value;
		var relation = document.getElementById('relationfield').value;

		cy.add({
			group: 'edges',
			data: { name: relation, source: source, target: target },
			classes: 'edgelabel'
		});

		this.edgePrompt(false);

	}

	renderLayout(){
		var layout = cy.layout({
			name: 'cose-bilkent',
			animate: 'end',
			animationEasing: 'ease-out',
			animationDuration: 2000,
			randomize: true
		});

		layout.run();
	}

	// Load all parents to the attribute field in add element prompt
	loadAttributes(){
		var attrfield = document.getElementById('attributefield');
		this.clearAttrField(attrfield);
		var fieldText = $('#typefield').find(":selected").text();
		var baseType = this.filterBaseType(fieldText);
		cy.nodes().forEach(function( ele ){
			if (ele.hasClass('attribute') && ele.hasClass(baseType)) {
				var option = document.createElement('option');
				var name = ele.data('name');
				option.text = name;
				attrfield.add(option);
			}
		});
	}

	// Filter base type (User/Object) from typefield text
	filterBaseType(typefield){
		if (typefield.includes('Object')){
			return 'Object';
		} else if (typefield.includes('User')) {
			return 'User';
		}
	}

	// Clear typefield text and add None option
	clearAttrField(attrfield){
		$("#attributefield").empty();
		var none = document.createElement('option');
		none.text = 'None';
		attrfield.add(none);
	}

	// Check if name is taken by another user/object
	nameTaken(name){
		var isTaken = false; // cy.nodes has its own return clause
		cy.nodes().forEach(function( ele ){
			if (ele.data('name') == name) {
				isTaken = true;
			}
		});
		return isTaken;
	}

	// Toggle full-screen div overlay to halt graph manipulation
	promptOverlay(bool) {
		var overlay = document.getElementById('prompt-overlay');
		if (bool) {
			var winH = window.innerHeight;
			overlay.style.height = winH+'px';
			overlay.style.display = "block";
		} else {
			overlay.style.display = "none";
		}
	}

	// Toggle prompt for adding new node
	nodePrompt(bool){
		var prompt = document.getElementById('add-element');
		this.promptOverlay(bool);
		if (bool) {
			this.loadAttributes();
			prompt.style.display = "block";
		} else {
			prompt.style.display = "none";
		}
	}

	// Toggle prompt for adding new edge
	edgePrompt(bool){
		var prompt = document.getElementById('add-relation');
		this.promptOverlay(bool);
		if (bool) {
			this.loadTargets();
			prompt.style.display = "block";
		} else {
			prompt.style.display = "none";
		}
	}

	// Load target & source data to edge prompt fields
	loadTargets(){
		var sourcefield = document.getElementById('sourcefield');
		var targetfield = document.getElementById('targetfield');
		$("#sourcefield").empty();
		$("#targetfield").empty();
		cy.nodes().forEach(function( ele ){

			if (ele.hasClass('attribute')){
				var option = document.createElement('option');
				var name = ele.data('name');
				option.text = name;
				if (ele.hasClass('User')) {
					sourcefield.add(option);
				} else if (ele.hasClass('Object')) {
					targetfield.add(option);
				}

			}
		});
	}

	// To avoid api and cytoscape id whitespace error
	getById(id){
		return cy.$("[id='" + id + "']");
	}

	loadFile(){
		this.fileHandler.load();
	}

	retrive_data()
	{
		this.graph_data_retrieval.get_data();
	}

}
