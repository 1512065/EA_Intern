(function($){
    $.fn.carousel = function(options) {
        var setting = {
            'width': 1000,
            'height': 300,
            'tranSpeed':1000,
            'i_width': 320,
            'i_height': 200,
            'padding': 10
        };

        this.each(function() {
            if(options) {
                $.extend(setting, options);
            }
            // add class
            $(this).children().wrapAll('<div class="carousel" />');
           
            var contain = $(this).find('.carousel');
            
            contain.find('li').wrapAll('<div class="slideFrame" />');
            var slideFrame = contain.find('.slideFrame');

            // add button next, prev
            slideFrame.append('<div class="slideBtn"><a href="#" class="prev">&lt;</a> <a href="#" class="next">&gt;</a></div>');
           
            $('<div style="margin: 0 auto; width:'+ setting.width + 'px"><button class="play">AUTO</button> <button class="stop">STOP</button></div>')
            .insertBefore(slideFrame);
            $('li').wrap('<div class="itemFrame" />');
            var itemFrame = contain.find('.itemFrame');

            itemFrame.find('p').each(function() {
                $(this).wrap('<div class="details" />');
            });
            itemFrame.find('img').each(function(){
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
                this.imgs = slideFrame.find('div.image');
                this.imgCount = (this.imgs.length) - 1; 
                this.captions = this.imgs.find('p');
                this.details = slideFrame.find('.details');
               
                // Init
                this.init = function(){ 
                    slideFrame
                        //.width((setting.i_width + setting.padding) * (this.imgCount+1))
                        .width(setting.width)
                        .height(setting.height);
                    this.imgs
                        .width(setting.i_width)
                        .height(setting.i_height);
                    itemFrame.height(setting.height);
                    this.imgs.find('img').height(setting.i_height);
                    // captions
                    this.captions.width(setting.i_width + 'px');
                    //details
                    this.details
                        .width(setting.i_width)
                        .height(setting.height - setting.i_height-30);
                    $('.slideBtn').css("width", setting.width +"px");
                    
                };
            };
               
            var slider = new Slider();
            slider.init();		
            var auto;
            var auto_flag;
            // get number of item displaying 
            var num = Math.floor(setting.width/(setting.i_width + setting.padding));
            
            
            $(document).ready(function(e) {
                //next button
                $('.next').bind("click", function nextImg(){
                    clearInterval(auto);
                    $(".next").unbind("click");
                    //clone
                    var clone= $('.itemFrame').eq(num).clone();
                    clone.insertBefore($('.itemFrame').eq(num));
                    clone.css("position","absolute");
                    //animate
                    $('.itemFrame:first').animate({
                        marginLeft: '-='+ (setting.i_width+ setting.padding)
                      }, setting.tranSpeed, function() {
                            $('.itemFrame:first').css("marginLeft",setting.padding);
                            $('.itemFrame:first').insertAfter($('.itemFrame:last'));
                            $(".next").bind("click", nextImg);
                            clone.remove();
                    });
                    //continue auto play
                    if (auto_flag == 1) {
                        auto = setInterval(auto_change, 5000);
                    }
                    
                });
                //prev button
                $('.prev').bind("click", function prevImg(){
                    $(".prev").unbind("click");
                    //clone end slide
                    var clone_end= $('.itemFrame').eq(num-1).clone();
                    clone_end.insertBefore($('.itemFrame').eq(num-1));
                    clone_end.css("position","absolute");
                    //clone before slide
                    var clone_start = $('.itemFrame:last').clone();
                    clone_start.css("margin-left", -(setting.i_width+ setting.padding));
                    clone_start.insertBefore($('.itemFrame:first'));
                    //debugger;
                    //animate
                    $('.itemFrame:first').animate({
                        marginLeft: '+='+ (setting.i_width+ setting.padding*2)
                      }, setting.tranSpeed, function() {
                           // $('.itemFrame:first').css("marginLeft",setting.padding);
                            $('.itemFrame:last').insertBefore($('.itemFrame:first')); 
                            $(".prev").bind("click", prevImg);
                            clone_end.remove();
                            clone_start.remove();
                    });
                });

                //auto button
                function auto_change(){
                    $('.next').click();
                }
                $(".play").click(
                    function() {
                        auto_flag = 1;
                        auto = setInterval(auto_change, 3000);
                        $(this).css("background-color","black");
                        $(this).attr("disabled",true);
                        $(".stop").css("background-color","");
                      
                    }
                );
                $(".stop").click(
                    function () {
                        clearInterval(auto);
                        $(".play").css("background-color","");
                        $(this).css("background-color","black");
                        $(".play").removeAttr("disabled");
                    }
                );
                $(".stop").click();
            });
            

        })

    }

})(jQuery);