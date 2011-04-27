
    function toggleSection(){
      
      YUI({ filter: 'raw' }).use("node", function (Y) {
          id = '#'+this.get('id');
          className = '.fcontainer ';
          Display.toggle(id+' '+className);
          return;
          // toggle image
          img = Y.one(id+' .block-hider');
          if(Display.isVisible(id+' '+className)){
              img.set('src', 'http://cc5983.vledev2.open.ac.uk/vle/ou-moodle2/moodle/theme/image.php?theme=ou&amp;image=t/switch_minus&amp;rev=286');
              //img.addClass('block-hider-show');
              //img.removeClass('block-hider-hide');
              return;
          }
          
          img.set('src', 'http://cc5983.vledev2.open.ac.uk/vle/ou-moodle2/moodle/theme/image.php?theme=ou&amp;image=t/switch_plus&amp;rev=286');
          //img.addClass('block-hider-hide');
          //    img.removeClass('block-hider-show');
      });
    }
    
    function initialiseSectionToggles(){

        YUI({ filter: 'raw' }).use("node", function (Y) {
            //Y.on('click', toggleSection, '#generalheader');
            var sections = ['general', 'tags'];
            var section;
            var imgHTML = '<img class="block-hider-hide block-hider" alt="Hide" title="Hide" style="padding: 5px; display: inline"';
            imgHTML+='src="http://cc5983.vledev2.open.ac.uk/vle/ou-moodle2/moodle/theme/image.php?theme=ou&amp;image=t/switch_minus&amp;rev=286">';
            var sectionNode;
            var sectionTogglerNode;
            for(section in sections){
                Y.on('click', toggleSection, '#'+sections[section]+'header');
                
                sectionNode = Y.one('#'+sections[section]+'header');
                
                img = Y.Node.create(imgHTML);
                img.set('alt', 'Hide '+sections[section]+' section');
                img.set('title', 'Hide '+sections[section]+' section');
                sectionNode.insert(img, 2);
                
            
                sectionTogglerNode = Y.one('#'+sections[section]+'header .ftoggler');
                sectionTogglerNode.setStyle('float', 'left');
            }
        });
    }
    
     
