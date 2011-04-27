var Display = {
    toggle: function (id, style){
        YUI().use('node', function(Y) {
            var node = Y.one(id);
            style = style?style:'block';
            if(style == node.getStyle('display')){        
               if(!node.hide){// is new hide method implemented
                    node.setStyle('display', 'none');
                    return;
                }
                
                node.hide();
                return;
            }
            
            // show element
            if(!node.show){// is new show method implemented    
                node.setStyle('display', style);
                return;
            }
                
            node.show();
        })
    },
    
    isVisible: function(id){
        YUI().use('node', function(Y) {
            visible = Y.one(id).getStyle('display')=='none'?false:true;
        })
        
        return visible;
      
    }
}