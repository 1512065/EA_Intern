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

            // add list number
            contain.append('<div class="num_list" />');
            var num_list = contain.find('.num_list');

            frame.find('img').each(function(i){
                
				i += 1; 
				if (setting.bullets === true) { 
                    num_list.append('<a href="#">'+ i +'</a>'); 
				}

				// Captions
				var title = $(this).attr('title');
				$(this).wrapAll('<div class="image" />');
				if (title !== undefined) {
						$(this).attr('title', '');
						$(this).after('<p>'+ title +'</p>');
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
                            console.log(index);
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
                
                /* Mouse Events
			-----------------------------------------------*/
			frame.hover(function(){ 
				slider.captions.stop(true, true).fadeToggle();
				slider.Next.stop(true, true).fadeToggle();
				slider.Prev.stop(true, true).fadeToggle();
			});
			slider.Next.click(function(){ 
                slider.next(); 
			});
			slider.Prev.click(function(){ 
				slider.prev();
			});
			slider.bullets.click(function(){  
                slider.captions.hide();
                slider.switchImg($(this).index());
                slider.changeIndex($(this).index());
			});
        })

    }

})(jQuery);