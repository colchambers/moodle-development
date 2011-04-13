	var task_id = '';
	function addSelectedItems(form, fieldAllName, fieldSelectedName) {
		var fieldAll = eval("form."+fieldAllName);
		var fieldSelected = eval("form."+fieldSelectedName);

		var at = fieldAll.length -1;
		var td = fieldSelected.length -1;
		var tasks = "x";

		//Check to see if None is currently in the dependencies list, and if so, remove it.

		if(td>=0 && fieldSelected.options[0].value==task_id){
			fieldSelected.options[0] = null;
			td = fieldSelected.length -1;
		}

		//build array of task dependencies
		for (td; td > -1; td--) {
			tasks = tasks + "," + fieldSelected.options[td].value + ","
		}

		//Pull selected resources and add them to list
		for (at; at > -1; at--) {
			if (fieldAll.options[at].selected && tasks.indexOf( "," + fieldAll.options[at].value + "," ) == -1) {
				t = fieldSelected.length
				opt = new Option( fieldAll.options[at].text, fieldAll.options[at].value );
				fieldSelected.options[t] = opt
			}
		}
		
	}

function removeSelectedItems(form, fieldAllName, fieldSelectedName) {
	var fieldSelected = eval("form."+fieldSelectedName);
	var td = fieldSelected.length -1;

	for (td; td > -1; td--) {
		if (fieldSelected.options[td].selected) {
			fieldSelected.options[td] = null;
		}
	}
	
}

function updateSelectedItems(action, form, fieldAllName, fieldSelectedName){

	if(form && fieldAllName && fieldSelectedName){
		switch(action){
			case "add":
				addSelectedItems(form, fieldAllName, fieldSelectedName);
				break;

			case "remove":
				removeSelectedItems(form, fieldAllName, fieldSelectedName);
				break;
		}
	}
	
}


function form_highlightInput(field, focus){
	if(!field){return false;}
	if(focus){
		if(field.defaultValue==field.value){
			field.value='';
		}
		field.className+=' user-input';
	}
	else {
		field.className=field.className.remove('user-input');
	}
	
}

String.prototype.remove = string_remove;
function string_remove(text){
	if(!text){ return null;}
	if(this.indexOf(text) != -1){
		return this.substr(0, this.indexOf(text)) + this.substr( ( this.indexOf(text)+text.length ), this.length);
	}
}

function form_checkGroup( formName, sGroup ) {

	var oForm;
	if(formName){
		oForm = document_getObject(formName)
	}
	if( !oForm ){
		oForm = document.DBAdminForm;
	}

	var e;
	for ( var i = 0; i < oForm.elements.length; i++ ) {
	
		e = oForm.elements[ i ];
		if ( e.name == sGroup ){
			e.checked = oForm[ sGroup + "All" ].checked;
		}
	}
}

function form_unCheckGroup(formName, sGroup) {

	var oForm;
	if(formName){
		oForm = document_getObject(formName)
	}

	if( !oForm ){
		oForm = document.DBAdminForm;
	}

	for ( var i = 0; i < oForm.elements.length; i++ ) {
		var e = oForm.elements[ i ];
		if ( e.name == sGroup ){
			e.checked = false;
		}
	}
	oForm[ sGroup + "All" ].checked = false;
}

function form_unCheckField(formName, sValue, sGroup){

	var oForm;
	if(formName){
		oForm = document_getObject(formName)
	}

	if( !oForm ){
		oForm = document.DBAdminForm;
	}
	for ( var i = 0; i < oForm.elements.length; i++ ) {
		var e = oForm.elements[ i ];
		if ( e.name == sGroup && e.value == sValue ){
			e.checked = false;
		}
	}
	oForm[ sGroup + "All" ].checked = false;
}

function document_getObject(name) {

  if (document.getElementById && document.getElementById(name)) {
  	return document.getElementById(name);
  }
  else if (document.all && document.all[name]) {
	return document.all[name];
  }
  else if (document.layers && document.layers[name]) {
   	return document.layers[name];
  }
  
}

