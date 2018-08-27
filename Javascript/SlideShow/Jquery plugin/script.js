(function($){
    $.fn.slideShow = function(options) {
        var setting = {
            'width': 900,
            'height': 600,
            'bullets': true,
            'tranSpeed':1000
        };

        this.each(function() {
            if(options) {
                $.extend(setting, options);
            }
            // add class
            $(this).children().wrapAll('<div class="slideShow" />');
           
            var contain = $(this).find('.slideShow');
            
            contain.find('li').wrapAll('<div class="frame" />');
            var frame = contain.find('.frame');

            // add button next, prev
            frame.append('<a href="#" class="prev">&lt;</a> <a href="#" class="next">&gt;</a>');
            $('<div style="margin: 0 auto; width:'+ setting.width + 'px"><button class="play">PLAY</button> <button class="stop">STOP</button></div>')
            .insertBefore(frame);
            // add list number
            contain.append('<div class="num_list" />');
            var num_list = contain.find('.num_list');

            frame.find('img').each(function(i){
                
				i += 1; 
				if (setting.bullets === true) { 
                    num_list.append('<a href="#">'+ i +'</a>'); 
				}

				// Caption
				var title = $(this).attr('title');
				$(this).wrapAll('<div class="image" />');
				if (title !== undefined) {
						$(this).attr('title', '');
						$(this).after('<p>' + title + '</p>');
				}
			});			
            
            
            //slide show
            var Slider = function(){
                this.imgs = frame.find('div.image');
                this.imgCount = (this.imgs.length) - 1; 
                this.Prev = frame.find('a.prev');
                this.Next = frame.find('a.next');
                this.bullets = contain.find('.num_list a');
                this.captions = this.imgs.find('p');
                var index=0;
                var auto_flag =0;
                this.switchImg = function(index){ // change image
                        this.imgs
                            .removeClass('curr')
                            .fadeOut(setting.fadeSpeed)
                            .eq(index)
                            .fadeIn(setting.fadeSpeed)
                            .addClass('curr');
                        this.bullets
                            .removeClass('curr')
                            .eq(index)
                            .addClass('curr');

                };
                this.changeIndex = function(newval){ // change index
                        index=newval;
                };
                this.next = function(){
                        if (index < this.imgCount) {
                           index = (index + 1); 
                        } else {
                           index = 0;
                        }
                        this.switchImg(index);
                };
        
                this.prev = function(){
                        if (index > 0) {
                            index = (index - 1); 
                        } else {
                            index = this.imgCount;
                        }
                        this.switchImg(index);
                };	

                 // Init
                this.init = function(){ 
                    frame
                        .width(setting.width)
                        .height(setting.height);
                    
                    this.imgs.hide().first().addClass('curr').show(); 
                    this.bullets.first().addClass('curr');
                    
                    num_list.css('width', setting.width);
                   
                    this.captions // captions
                        .width(setting.width + 'px');
                };
            };
               
            var slider = new Slider();
            slider.init();		
                
			frame.hover(function(){ 
				slider.captions.stop(true, true).fadeToggle();
				slider.Next.stop(true, true).fadeToggle();
				slider.Prev.stop(true, true).fadeToggle();
			});
			slider.Next.click(function(){ 
                clearInterval(auto);
                slider.next(); 
                if (auto_flag == 1) {
                    auto = setInterval(auto_change, 5000);
                }
			});
			slider.Prev.click(function(){ 
				slider.prev();
			});
			slider.bullets.click(function(){  
                slider.captions.hide();
                slider.switchImg($(this).index());
                slider.changeIndex($(this).index());
            });

            //autoplay 
            var auto;
            function auto_change(){
                slider.Next.click();
            }
            $(".play").click(
                function() {
                    auto_flag = 1;
                    auto = setInterval(auto_change, 3000);
                    $(this).css("background-color","gray");
                    $(this).attr("disabled",true);
                    $(".stop").css("background-color","");
                }
            );
            $(".stop").click(
                function () {
                    clearInterval(auto);
                    $(".play").css("background-color","");
                    $(this).css("background-color","gray");
                    $(".play").removeAttr("disabled")
                }
            );
            $(".stop").click();
        })

    }

})(jQuery);