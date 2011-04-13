// getCallerFromBody: body (string)
function getCallerFromBody(body){
	if(body && String(body).indexOf("function") != -1){
		body = String(body);
		return body.substring("function".length+1,body.indexOf("(") ).trim();
	}
	else {
		return null;
	}
}

// getCaller: depth (int)
function getCaller(depth){
	
	if(!depth || isNaN(depth)){ //Must ensure depth is set
		depth = 1;	
	}
	else {
		depth = depth +1;
	}
	
	var callers = "";
	for(var i=0; i<depth;i++){
		callers += ".caller";
	}
	
	var caller = null;
	try{
		caller = getCallerFromBody(eval("getCaller" + callers));
	}
	catch (e){
		// Do nothing
		throw(e);
	}

	caller = caller == null ? "" : caller;
	return caller;
}
// output: output (string), caller (string), (int)
function output(output, caller, depth){
	if(!depth || isNaN(depth)){ //Must ensure depth is set
		depth = 1;	
	}

	caller = caller == null ? getCaller(depth) : caller;
	output = output == null ? "" : output;
	document.write(caller + ": " + output +"<br />");
}

// getCurrentPath: 
function getCurrentPath(){
	var path = location.href;
	if(path.indexOf("file") != -1){
		path = path.substring(path.indexOf("/")+3, path.lastIndexOf("/")+1);
	}

	path = path.substring(0, path.lastIndexOf("/")+1).replace(/\//g, "\\");
	return path;
}


