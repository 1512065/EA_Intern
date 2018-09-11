var depart_cache = {};
var arrival_cache = {};
function getCache(cache, term) {
    for (let key in cache) {
        if (key === term) {
            return cache[term];
        }
    }
    return -1;
}

//get default data
$.ajax({
    type:"GET",
    url:"http://airdev.local/airport_list",
    dataType: 'json',
    //data: {sort: 'desc'}
})
.done(function(data){
    //data-mapping
    var n = data.length;
    for (let i=0; i < n; i++) {
        data[i]["val"] = data[i]["three_letter_code"];
        data[i]["text"] = data[i]["airport_name"];
        delete data[i]["three_letter_code"];
        delete data[i]["airport_name"];
    } 
    //store in cache
    depart_cache[""] = data;
    arrival_cache[""] = data;
    //init plugin
    jQuery(function($){
        $('#depart_airport').autocomplete({
            source : data
        });
        $('#arrival_airport').autocomplete({
            source : data,
            frame_height : '300px',
            min_char : 2,
            filter : true,
        });
    });
});
// refresh data for auto complete plugin
function refreshData(element, input) {
    switch(element.id) {
        case 'depart_airport': 
            //check cache
            var cache = getCache(depart_cache, input);
            if(cache != -1) {
                $('#depart_airport').refresh(cache);
            } else {
                //not in cache
                $.ajax({
                type:"GET",
                url:"http://airdev.local/airport_list",
                dataType: 'json',
                data: {term: input},
                success: function(data){
                    //data-mapping
                    var n = data.length;
                    for (let i=0; i < n; i++) {
                        data[i]["val"] = data[i]["three_letter_code"];
                        data[i]["text"] = data[i]["airport_name"];
                        delete data[i]["three_letter_code"];
                        delete data[i]["airport_name"];
                    }
                    depart_cache[input] = data;
                    $('#depart_airport').refresh(data);
                }
                });
            }
            break;
        
        case 'arrival_airport':
            //check cache
            var cache = getCache(arrival_cache, input);
            if(cache != -1) {
                $('#arrival_airport').refresh(cache);
            } else {
                //not in cache
                $.ajax({
                type:"GET",
                url:"http://airdev.local/airport_list",
                dataType: 'json',
                data: {term: input},
                success: function(data){
                    //data-mapping
                    var n = data.length;
                    for (let i=0; i < n; i++) {
                        data[i]["val"] = data[i]["three_letter_code"];
                        data[i]["text"] = data[i]["airport_name"];
                        delete data[i]["three_letter_code"];
                        delete data[i]["airport_name"];
                    }
                    arrival_cache[input] = data;
                    $('#arrival_airport').refresh(data);
                }
                });
            }
            break;
    }
}