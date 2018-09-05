(function($){
    $.fn.autocomplete = function(options) {
        var setting = {
            'cache' : true,
            'url' : '#',
            'sort': 'asc',
            'frame_height': '400px'

        };

        this.each(function() {
            if(options) {
                $.extend(setting, options);
            }
            
            $(this).wrapAll("<div id='auto_cpl'>");

            var contain = $(this).parent();
            contain.css({
                'width' : $(this).width() + $(this).css('border-width') * 2,
                'display' : 'inline-block'
            });
            //button
            var img = '<img id="auto_img" src="https://cdn4.iconfinder.com/data/icons/geomicons/32/672341-triangle-down-512.png" style="width:10px; height:10px; margin:10px 15px;">';
            $("<a id='auto_btn'>").insertAfter($(this));
            var auto_btn = contain.find("#auto_btn");
            auto_btn.css({
                'display' : 'inline-block',
                'position' : 'absolute',
                'width' : '40px',
                'height' : $(this).height() + $(this).css('border-width') * 2,
                'margin-left': '-30px'
            });
            auto_btn.append(img);
            // list item
            $("<div id='list_frame'><ul id='list'></ul></div>").insertAfter(auto_btn);
            contain.find('#list_frame').css({
                'width' :contain.width(),
                'height' : setting.frame_height,
                'overflow-x':'hidden',
                'position' : 'absolute'
            });
            contain.find('#list').css({
                "list-style-type": "none",
                "height": "0px",
                'width' :contain.width(),
                "overflow": "visible",
                "display":"none",
                "border-bottom": "0.1px solid gainsboro",
                'padding' :0
            });
            //ajax    
            
            $.ajax({
            type:"GET",
            url: setting.url,
            dataType: 'json',              
            })
            .done(function(data){
                //generate list
                var list = contain.find('#list');
                len = data.length;
                for (let i = 0; i < len; i++){
                    list.append('<li>'+ data[i]["three_letter_code"] + ' - ' + data[i]["airport_name"]+'</li>')
                }
                list.find('li').css({
                   'background-color' : 'white'
                });
                debugger;
            });
            
               
            $(document).ready(function() {
               
            });
        })

    }

})(jQuery);