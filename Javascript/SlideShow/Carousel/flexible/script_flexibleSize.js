(function($){
    $.fn.carousel = function(options) {
        var setting = {
            'width': 1000,
            'height': 400,
            'tranSpeed':500,

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
            $('.slideFrame').wrap('<div class="displayFrame" />');
            var slideFrame = contain.find('.slideFrame');
            
            // add button next, prev
            slideFrame.append('<div class="slideBtn"><a href="#" class="prev">&lt;</a> <a href="#" class="next">&gt;</a></div>');
           
            $('<div style="margin: 0 auto; width:'+ setting.width + 'px"><button class="play">AUTO</button> <button class="stop">STOP</button></div>')
            .insertBefore($('.displayFrame'));
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
           var displayFrame = $('.displayFrame');
            //slide show
            var Slider = function(){
                this.imgs = slideFrame.find('div.image');
                this.fullsize = 0;
                this.i_hidden = 0;
                // Init
                this.init = function(){ 
                    displayFrame
                    .width(setting.width)
                    .height(setting.height);
                    displayFrame.css("overflow","hidden");
                    itemFrame.height(setting.height);
                    var max_length = 0;
                    // edit item
                    itemFrame.each(function(){
                        // captions
                        let i_height = $(this).find('img').prop("naturalHeight");
                        let i_width = $(this).find('img').prop("naturalWidth");
                        $(this).find('.image p').width(i_width);
                        //details
                        $(this).find('.details')
                            .height(setting.height - i_height - setting.padding * 2)
                            .width(i_width);
                        max_length += i_width + setting.padding;
                    });
                    slideFrame
                        .width(max_length)
                        .height(setting.height);
                    
                    // next + prev button
                    $('.slideBtn').css("width", setting.width +"px");

                    //first hidden item's index
                    for(let i=0; i<itemFrame.length; i++){
                        this.fullsize += itemFrame[i].clientWidth + setting.padding;
                        if (this.fullsize >= setting.width)
                        {
                            this.i_hidden = i;
                            break;
                        }
                    }
                };   
            };
               
            var slider = new Slider();
            slider.init();		
            var auto;
            var auto_flag=0;
            
            $(document).ready(function() {
                //next button
                $('.next').bind("click", function nextImg(){
                    clearInterval(auto);
                    $(".next").unbind("click");
                    //animate
                    var slide_width =  $('.itemFrame:first').width() + setting.padding;
                    
                    $('.itemFrame:first').animate({
                        marginLeft: '-=' + slide_width
                      }, setting.tranSpeed, function() {
                            $('.itemFrame:first').css("marginLeft",setting.padding);
                            $('.itemFrame:first').insertAfter($('.itemFrame:last'));
                            
                            $(".next").bind("click", nextImg);
                    });
                    //continue auto play
                    if (auto_flag == 1) {
                        auto = setInterval(auto_change, 5000);
                    }
                    
                });

                //prev
                $('.prev').bind("click", function prevImg(){
                    //$(".prev").unbind("click");

                    //clone before
                    var clone_start = $('.itemFrame:last').clone();
                    var clone_width = $('.itemFrame:last').width();
                    clone_start.css("margin-left", -(clone_width));
                    clone_start.insertBefore($('.itemFrame:first'));
                    //right clone
                    itemFrame = $(".itemFrame");
                    //var clone_end_width = itemFrame.eq(slider.i_hidden+1).width();
                    var slide_width = clone_width+ setting.padding;
               
                    //animate
                    $('.itemFrame:first').animate({
                        marginLeft: '+=' + (slide_width)
                    }, setting.tranSpeed, function() {
                        $('.itemFrame:last').remove();
                        itemFrame = $(".itemFrame");
                        // new size calculate
                        slider.fullsize =0;
                        for(let i=0; i<itemFrame.length; i++){
                            slider.fullsize += itemFrame[i].clientWidth + setting.padding;
                            if (slider.fullsize >= setting.width)
                            {
                                slider.i_hidden = i;
                                break;
                            }
                         }
                       
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