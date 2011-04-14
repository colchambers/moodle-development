 
 var Out = {
    initialiseConsole: function (){
     // Create console
        // Create a YUI instance and request the console module and its dependencies
        YUI({ filter: 'raw' }).use("console", "console-filters", "dd-plugin", function (Y) {
         
            console = new Y.Console({
            	strings: {
                    logSource: Y.Global,
        			title : 'Draggable Console with filters!',
        			pause : 'Wait',
        			clear : 'Flush',
        			collapse : 'Shrink',
        			expand : 'Grow'
        		},
                logSouorce: Y.Global
        	}).plug(Y.Plugin.ConsoleFilters)
        	  .plug(Y.Plugin.Drag, { handles: ['.yui3-console-hd'] })
        	  .render();
        	 
        });
     },
     debug: function (message, filter){
        YUI({ filter: 'raw' }).use("node", function (Y) {
                Y.log(message, filter);
        });
    }
    
}