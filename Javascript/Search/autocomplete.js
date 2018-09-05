        $(document).ready(function(){
           // $('#ID_F1Departure').css("display","none");
           
            var input_box = "<input class='slt_m jQselectable leaveBox' id='depart_ip' style='height:43px; padding: 6px; font-size: 1.2em;margin-right: 14px;'>";
            var img = '<img src="https://cdn4.iconfinder.com/data/icons/geomicons/32/672341-triangle-down-512.png" style="width:10px; height:10px; margin-left: 25px;margin-top: 17px;">';
            var dep_btn = "<a id='dep_btn' style='border:none;margin-left: -55px;height: 42px;width: 40px;display:inline-block; position:absolute'>" + img +"</a>";
            var list_frame = "<div id='list_frame' style='width: 230px; height: 350px; overflow-x: hidden; position:absolute;'>"
            $("<div id='auto_cpl' style='display:none'>" + input_box + dep_btn + list_frame+ "<ul id='list'></ul>" + "</div>")
            .insertBefore($('#ID_F1Departure'));
            $('#list').css({
                "list-style-type": "none",
                "height": "0px",
                "width": "230px",
               "overflow": "visible",
                "display":"none",
                "border-bottom": "0.1px solid gainsboro"
            });
           //style edit
                $('#auto_cpl').parent().css({
                    "position" : "relative",
                    "z-index" : "99"
                });
           //get data
            $.ajax({
                    type:"GET",
                    url:"https://apidev.evolableasia.net/airtrip/member/v1/airport_list",
                    success: function(data) {
                        airport_list = data["airports"];
                    },
                    dataType: 'json',              
            })
            .done(function(data){
                //generate options
                var len = airport_list.length;
                for (let i = 0; i < len; i++){
                    $('#list').append('<li>'+ airport_list[i].airport_name +'</li>');
                }
                $('#list li').css({
                    "margin" :"unset",
                    "height": "30px",
                    "width": "230px",
                    "border": "0.2px solid grey",
                    "padding": "5px",
                    "border-top":"none",
                    "font-size": "1.2em",
                    "background-color": "white"
                    
                });
                $('#list li').hover(function(){
                    $(this).css({"background-color" : "lightblue"});
                });
                $('#list li').mouseleave(function(){
                    $(this).css({"background-color" : "white"});
                })
                $('#list li').on('click',function(){
                    $('#depart_ip').val($(this).context.innerText);
                    $('#list').css("display","none");
                    //pass value
                    var key = $(this).context.innerText;
                    for (let i=0 ; i < len ; i++)
                    {
                        if (airport_list[i].airport_name == key) {
                            $('#ID_F1Departure').val(airport_list[i].three_letter_code);
                        }
                    }
                    $('#ID_F1Departure').css("display","block");
                    $('#auto_cpl').css("display","none");
                });

            });
            //click event
            $('#dep_btn').click(function(e){
                if ($('#list').css("display")==="none"){
                    $('#list').css("display","block");
                   
                } else {
                    $('#list').css("display","none");
                }
                e.stopPropagation();
            });
            $('#ID_F1Departure').dblclick(function(){
                $('#ID_F1Departure').css("display","none");
                $('#auto_cpl').css("display","");
                $('#depart_ip').focus();
                $('#depart_ip').val($('#ID_F1Departure option[value="' + $('#ID_F1Departure').val()+ '"]').text());

            });
            //key up
            $('#depart_ip').keyup(function(){
                var input = $(this).context.value;
                var li = $("#list li");
                for (let i=0; i< li.length; i++) {
                    if (li[i].innerHTML.indexOf(input) > -1) {
                        $('#list').css("display","block");
                        li[i].style.display ="";
                    } else {
                        li[i].style.display ="none";
                    }
                }
            });
           
            $(window).click(function() {
                if ($('#list').css("display")==="block") {
                    $('#list').css("display","none");
                    $('#auto_cpl').css("display","none");
                    $('#ID_F1Departure').css("display","block");
                }
                    
            });
        })

