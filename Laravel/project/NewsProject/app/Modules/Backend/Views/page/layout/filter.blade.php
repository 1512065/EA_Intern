<div name ="searcbar" style="width: 90%; margin: 0 auto; margin-top: 10px">
<div style="display: inline-block">
<label>Show 
    <select id='limit' onchange="limit();" style="width: 50px; height:30px">
    <option value="10">10</option>
    <option value="20">20</option>
    <option value="30">30</option>
    <option value="40">40</option>
    </select> 
entries</label>
</div>

<div style="display: inline-block; float: right">
    <label>Search:&nbsp;<input type="search" id='key'>
    </label> <i class="fa fa-search" onclick="filter();"></i>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>

    var param = {!! json_encode($_GET) !!};
    function filter(){
        var value = $('#key').val();
        if (param.length != 0) {
            param['key'] = value;
            var query = $.param(param);
            window.location.search = '?' + query;
        } else {
            window.location.href = window.location.href + '/filter?key=' + value;
        }
    }
   
    function limit() {
        var value = $('#limit').val();
        if (param.length != 0) {
            param['limit'] = value;
            var query = $.param(param);
            window.location.search = '?' + query;
        } else {
            window.location.href = window.location.href + '/filter?limit=' + value;
        }
    }

    if (typeof(param['limit']) !='undefined') {
        $('#limit').val(param['limit']);
    }
   
    $('#key').val(param['key']);
    
    function sort(field) {
        var param = {!! json_encode($_GET) !!};

        if (param.length != 0) {
            param['sortby'] = field;
            if (param['order']=='asc') {
                param['order']='desc';
            } else {
                param['order']='asc';
            }
            var query = $.param(param);
            window.location.search = '?' + query;
        } else {
            window.location.href = window.location.href + '/filter?sortby=' + field +"&order=asc";
        }
    }
    
</script>