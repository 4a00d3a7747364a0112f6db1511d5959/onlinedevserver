(function() {
    tinymce.create('tinymce.plugins.WPTuts', {
        init : function(ed, url) {
            ed.addCommand('animatedcounter', function() {
				ed.windowManager.open({
					title: 'Animated Counter shortcode generator',
					body: [
						{type: 'textbox', name: 'countto', label  : 'Count to (required)'},
						{type: 'textbox', name: 'duration', label  : 'Duration', placeholder : '1000 by default'},
						{type: 'textbox', name: 'color', label  : 'Color', placeholder : 'examples: red or #000000'},
						{type: 'textbox', name: 'size', label  : 'Size', placeholder: 'example: 14px'},
						{type: 'textbox', name: 'customcss', label  : 'Custom CSS classes'},
						{type: 'textbox', name: 'customid', label  : 'Custom ID'}
						
					],
					onsubmit: function(e) {
						countto=e.data.countto;
						duration=e.data.duration;
						color=e.data.color;
						size=e.data.size;
						customcss=e.data.customcss;
						customid=e.data.customid;
						if (countto=="") {
							alert("\"Count to\" is a required value.");
							e.preventDefault();
						}
						else {
							tmp_val="count=\""+countto+"\"";
							if (duration!="") { tmp_val+=" duration=\""+duration+"\""; }
							if (color!="") { tmp_val+=" color=\""+color+"\""; }
							if (size!="") { tmp_val+=" size=\""+size+"\""; }
							if (customcss!="") { tmp_val+=" css=\""+customcss+"\""; }
							if (customid!="") { tmp_val+=" id=\""+customid+"\""; }
							ed.execCommand("mceInsertContent", 0, "[animatedcounter "+tmp_val+"]");
						}
					}
				});
            });
            
            ed.addButton('animatedcounter', {
                title : 'Animated Counter',
                cmd : 'animatedcounter',
                image : url + '/../img/animatedcounters.png'
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                    longname : 'Animated Counters Button',
                    author : 'ERALION.com',
                    authorurl : 'https://eralion.com',
                    infourl : 'https://eralion.com',
                    version : "0.1"
            };
        }
    });
    tinymce.PluginManager.add('wptuts', tinymce.plugins.WPTuts);
})();