(function($){
    $.fn.autocomplete = function(options) {
        var setting = {
            'cache' : true,
            'frame_height': '400px',
            'source' : null
        };

        this.each(function() {
            if(options) {
                $.extend(setting, options);
            }
            
            $("<div id='auto_cpl'>").insertBefore($(this));
            var auto_cpl = $(this).prev();
            auto_cpl.append("<input id='ip_key' type='text'>");
            var input_key = auto_cpl.find('#ip_key');
            //button
            var img = '<img id="auto_img" src="https://cdn4.iconfinder.com/data/icons/geomicons/32/672341-triangle-down-512.png" >';
            auto_cpl.append("<a id='auto_btn'>" + img + "</a>");    
            var auto_btn = auto_cpl.find('#auto_btn');
            
            // list item
            $("<div id='list_frame'><ul id='list'></ul></div>").insertAfter(auto_btn);
            auto_cpl.find('#list_frame').css({
                'height' : setting.frame_height,
                'width' : input_key.width() + 4, //4 for 2 border-width of input
            });

            // get source 
            /*if(Array.isArray(setting.source)===true) {
                console.log('array source');
            } else {
            }*/

            // generate list
            input_key.keyup(function(){
                // ajax
                
            });
        })

    }

})(jQuery);