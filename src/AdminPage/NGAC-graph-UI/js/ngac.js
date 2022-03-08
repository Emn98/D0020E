class NgacDoc {

	db_handler;
	promotionNode; // For storing potential promotion node during prompt-state

	constructor() {
		this.db_handler = new db_handler(new db_translator());
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
			var namefield = document.getElementById("namefield");
			var typefield = document.getElementById("typefield");
			namefield.disabled = false;
			typefield.disabled = false;
			namefield.value = "";
			typefield.selectedIndex = 0;
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

	// Toggle db ops menu
	dbOps(bool) {
		var menu = document.getElementById('db-options');
		this.promptOverlay(bool);
		if (bool) {
			this.loadTargets();
			menu.style.display = "block";
		} else {
			menu.style.display = "none";
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

	save_db(policy_name) {
		this.db_handler.save(policy_name);
	}

	load_db() {
		this.importSelectPrompt(false);
		var policy_name = document.getElementById('db-select-form').value;
		this.db_handler.load(policy_name);
	}

	load_db_direct(policy_name){
		this.db_handler.load(policy_name);
	}

	// Add node prompt when element is imported
	importNodePrompt(type) {
		this.importSelectPrompt(false);
		this.nodePrompt(true);
		var name = document.getElementById('db-select-form').value;
		// Set name field to imported element name and disable input field
		var namefield = document.getElementById("namefield");
		namefield.value = name;
		namefield.disabled = true;
		// Set type to imported element type and disable options field
		var typefield = document.getElementById("typefield");
		typefield.value = type;
		typefield.disabled = true;
		this.loadAttributes();

	}

	importSelectPrompt(bool) {
		this.dbOps(false);
		var selectList = document.getElementById("select-options");
		this.promptOverlay(bool);
		if (bool) {
			selectList.style.display = "block";
		} else {
			selectList.style.display = "none";
		}
	}

	// Generate select options list for importing an element
	selectImportedElement(elements, type) {
		this.importSelectPrompt(true);
		$("#db-select-form").empty();
		var selectOptions = document.getElementById("db-select-form");
		if (type == "user") {
			document.getElementById('import-title').innerText = "Select User";
			document.getElementById("select-button").innerText = "Add user";
		} else if (type == "object") {
			document.getElementById('import-title').innerText = "Select Object";
			document.getElementById("select-button").innerText = "Add object";
		}

		for (var i = 0; i < elements.length; i++) {
			var name = elements[i].full_name;
			if (!this.nameTaken(name)) {
				var option = document.createElement('option');
				option.text = name;
				selectOptions.add(option);
			}
		}
	}

	// Generate select options list for importing a policy
	selectImportedPolicy(elements) {
		this.importSelectPrompt(true);
		$("#db-select-form").empty();
		var selectOptions = document.getElementById("db-select-form");
		document.getElementById("select-button").innerText = "Import policy";
		document.getElementById('import-title').innerText = "Select Policy";
		for (var i = 0; i < elements.length; i++) {
			var option = document.createElement('option');
			option.text = elements[i].policy_name;
			selectOptions.add(option);
		}
	}

	// Prompt for duplicating an existing element to another attribute
	promote(node) {
		if(!node.isParent()) {
			this.promotionPrompt(true);
			this.promotionNode = node;
			var baseType = this.getPromoClass();
			var parent = node.parent().data('name');
			var nodeName = node.data('name');
			document.getElementById("promotion-node").value = nodeName;
			var attrs = document.getElementById("promotion-attributes");
			$("#promotion-attributes").empty();

			cy.nodes().forEach(function( ele ){
				var eleName = ele.data('name');
				if (ele.hasClass('attribute') && ele.hasClass(baseType) && eleName != parent) {
					var hasChild = false;
					ele.children().forEach(function( child ){
						if (child.data('name') == nodeName) {
							hasChild = true;
						}
					});
					if (!hasChild) {
						var option = document.createElement('option');
						option.text = eleName;
						attrs.add(option);
					}
				}
			});
		}
	}


	promotionPrompt(bool) {
		this.promptOverlay(bool);
		var promptdiv = document.getElementById("promotion-prompt");
		if (bool) {
			promptdiv.style.display = "block";
		} else {
			promptdiv.style.display = "none";
		}
	}

	promotionConfirm() {
		this.promotionPrompt(false);
		var attr = document.getElementById("promotion-attributes").value;
		if (attr != "") {
			var type = this.getPromoClass();
			var name = this.promotionNode.data('name');
			this.placeNode(name, type, attr);
		}
	}

	getPromoClass() {
		if (this.promotionNode.hasClass("User")) {
			return "User";
		} else if (this.promotionNode.hasClass("Object")) {
			return "Object";
		}
		return "TypeNotFound";
	}

}
