(function($){
    $.fn.autocomplete = function(options) {
        var setting = {
            'filter' : false,
            'frame_height': '400px',
            'source' : null,
            'min_char' : 1,
        };

        this.each(function() {
        //RENDER HTML
            if(options) {
                $.extend(setting, options);
            }
            $(this).css("display", "none");
           
            $("<div id='auto_cpl'>").insertBefore($(this));
            var auto_cpl = $(this).prev();
            auto_cpl.append("<input class='ip_key' type='text'>");
           
            var input_key = auto_cpl.find('.ip_key');
            //button
            var img = '<img id="auto_img" src="https://cdn4.iconfinder.com/data/icons/geomicons/32/672341-triangle-down-512.png" >';
            auto_cpl.append("<a id='auto_btn'>" + img + "</a>");    
            var auto_btn = auto_cpl.find('#auto_btn');
            
            // list item
            $("<div id='list_frame'><ul class='list'></ul></div>").insertAfter(auto_btn);
            auto_cpl.find('#list_frame').css({
                'height' : setting.frame_height,
                'width' : input_key.width(), 
            });
            $(this).css("width", input_key.width());
            $(this).css("height",input_key.height());
           
            var list = auto_cpl.find('.list');
            var select = auto_cpl.next();
           
        //RENDER LIST
            if(Array.isArray(setting.source)===true) {
                var len = setting.source.length;
                for (let i = 0; i < len; i++) {
                    $(this).append("<option value='" + setting.source[i].val +"'>" + setting.source[i].text + "</option>");
                    list.append("<li>" + setting.source[i].val + " - " + setting.source[i].text + "</li>");
                }
            } else {
                alert('Error render list');
            }
           
            auto_cpl.css("display", "inline-block");
            $(this).addClass('auto_select');
            $(this).find('option').addClass('auto_option');
        //BIND EVENT
            function bindEvent() {
               
                // keyup on input
                input_key.bind("keyup", function(){
                    var input = $(this).context.value;
                    var len = input.length;
                    if (len == 0 || len >= setting.min_char) {
                        if (setting.filter === false) {
                            // require new data
                            refreshData(this.parentElement.nextElementSibling, input);
                        } else {
                            // auto filter
                            var li = $(this).next().next().find("li");
                            var li_len = li.length;
                            if (len == 0) {
                            //back to default
                            for (let i = 0; i < li_len; i++) {
                                li.parent().parent().css("display","block");
                                li.parent().css("display","block");
                                li[i].style.display = "";
                            }
                            } else {
                            //filter
                            for (let i = 0; i < li_len; i++) {
                                if (li[i].innerText.indexOf(input) > -1) {
                                    li.parent().parent().css("display","block");
                                    li.parent().css("display","block");
                                } else {
                                    li[i].style.display = "none";
                                }
                            }
                            }
                        }
                    } else {
                        this.nextElementSibling.nextElementSibling.style.display = "none";
                    }

                });
                //input button
                auto_btn.bind("click", function(e){
                    if (list.css("display")==="none"){
                        list.show();
                        list.parent().show();
                    } else {
                        list.hide();
                        list.parent().hide();
                    }
                    e.stopPropagation();
                });
                /*
                select.bind("dblclick",function(){
                    select.css("display", "none");
                    auto_cpl.css("display", "inline-block");
                    input_key.val(this.options[this.selectedIndex].text);
                    input_key.focus();
                });  
                */
                var items = list.find('li');
                items.each(function(){
                   $(this).bind("click",function(){
                        var split = this.innerText.split(" - ");
                        var value = split[0]; 
                        var auto_cpl = this.parentElement.parentElement.parentElement;
                        var select = auto_cpl.nextElementSibling;
                        select.value = value;
                        this.parentElement.parentElement.previousSibling.previousSibling.value = split[1] ;
                        list.css("display","none");
                   }); 
                });
                //close list
                $(window).click(function() {
                    var list = $('.list');
                    list.each(function(){
                        if ($(this).css("display")==="block") {
                            $(this).css("display","none");
                        }
                    })
                });
            };
            bindEvent();
        })
    }

    $.fn.refresh = function(data) {
        //delete old options
        $(this).find('option').remove();
        //delete old list 
        var list =  $(this).prev().find('ul');
        list.find('li').remove();
        //render new options + list items
        var len = data.length;
        for (let i = 0; i < len; i++) {
            $(this).append("<option value='" + data[i].val +"'>" + data[i].text + "</option>");
            list.append("<li>" + data[i].val + " - " + data[i].text + "</li>");
        }
        //re-bind event
        var items = list.find('li');
        items.each(function(){
           $(this).bind("click",function(){
                var split = this.innerText.split(" - ");
                var value = split[0]; 
                var auto_cpl = this.parentElement.parentElement.parentElement;
                var select = auto_cpl.nextElementSibling;
                select.value = value;
                this.parentElement.parentElement.previousSibling.previousSibling.value = split[1] ;
                list.css("display","none");
           }); 
        });
            list.show();
            list.parent().show();
        
    }
})(jQuery);