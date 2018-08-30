(function($){
    $.fn.carousel = function(options) {
        var setting = {
            'width': 1000,
            'height': 400,
            'tranSpeed':1000,
            //'i_width': 320,
            //'i_height': 200,
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
                this.fullsize = 0;
                this.i_hidden = 0;
                // Init
                this.init = function(){ 
                    slideFrame
                        .width(setting.width)
                        .height(setting.height);
                    
                    itemFrame.height(setting.height);
                   
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
                    });
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
                    
                    //clone items
                    var clone= $('.itemFrame').eq(this.i_hidden).clone();
                    clone.insertBefore($('.itemFrame').eq(this.i_hidden));
                    clone.css("position","absolute");
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
                            var overflowed = slider.fullsize - setting.width;
                            //new fullsize
                            slider.fullsize = 0;
                            itemFrame = $(".itemFrame");
                            for(let i=0; i<itemFrame.length; i++){
                                slider.fullsize += itemFrame[i].clientWidth + setting.padding;
                                if (slider.fullsize >= setting.width)
                                {
                                    slider.i_hidden = i;
                                    break;
                                }
                            }
                            //debugger;  
                            if (slide_width >= overflowed) {
                                $('.itemFrame').eq(slider.i_hidden-1).remove();
                                //clone new element
                                //find hidden index
                                slider.fullsize = 0;
                                itemFrame = $(".itemFrame");
                                for(let i=0; i<itemFrame.length; i++){
                                    slider.fullsize += itemFrame[i].clientWidth + setting.padding;
                                    if (slider.fullsize >= setting.width)
                                    {
                                        slider.i_hidden = i;
                                        break;
                                    }
                            }
                                //clone
                                var clone= $('.itemFrame').eq(slider.i_hidden).clone();
                                clone.insertBefore($('.itemFrame').eq(slider.i_hidden));
                                clone.css("position","absolute");
                                
                            }
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
                    var clone_end_width = itemFrame.eq(slider.i_hidden+1).width();
                    var slide_width = clone_width+ setting.padding;
                    //clone inside
                    /*var next_size = slider.fullsize + slide_width;
                    var not_ovf = setting.width - slide_width;
                    var temp_size = 0;
                    var i_clone =0;
                    while (temp_size < not_ovf) {
                        temp_size += itemFrame.eq(i_clone).width();
                        i_clone++;
                    }
                    i_clone--;
                    */
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
                        if(itemFrame.eq(slider.i_hidden).css("position")!=="absolute") {
                            
                            //delete old clone
                            $(".itemFrame[style*='absolute']").remove();
                            //clone new at end
                         
                            var clone_end = itemFrame.eq(slider.i_hidden).clone();
                            clone_end.insertBefore(itemFrame.eq(slider.i_hidden));
                            clone_end.css("position","absolute");
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