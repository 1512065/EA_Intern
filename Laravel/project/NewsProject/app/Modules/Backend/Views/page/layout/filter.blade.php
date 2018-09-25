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
    function filter(){
        var value = $('#key').val();
        recent_uri = document.location.search;
        if (recent_uri.search(/key=/)==-1) {
            new_uri = recent_uri + '&key=' +value;
        } else {
            new_uri = recent_uri.replace(/key=[a-zA-Z0-9]+/,'key='+value);
        }
        if (recent_uri=='') {
            window.location.href = window.location.href + '/filter?' + new_uri;
        } else {
            window.location.href = ( window.location.origin+ window.location.pathname + new_uri);        
        }
    }
    function limit() {
        var value = $('#limit').val();
        recent_uri = document.location.search;
        if (recent_uri.search(/limit=[0-9]+/)==-1) {
            new_uri = recent_uri + '&limit=' +value;
        } else {
            new_uri = recent_uri.replace(/limit=[0-9]+/,'limit='+value);
        }
        if (recent_uri=='') {
            window.location.href = window.location.href + '/filter?' + new_uri;
        } else {
            window.location.href = ( window.location.origin+ window.location.pathname + new_uri);        
        }
    }
    
        var pos = document.location.search.search(/limit=[0-9]+/);
        if ( pos!=-1) {
           str = document.location.search;
           len = str.length;
           var i = pos+6; //6 for 'limit='
           var limit ='';
           while (str[i]!='&' && i!=len) {
               limit += str[i];
               i++;
           }
           $('#limit').val(limit);
        }
        var pos = document.location.search.search(/key=/);
        if ( pos!=-1) {
           str = document.location.search;
           len = str.length;
           var i = pos + 4; //4 for 'key='
           var key ='';
           while (str[i]!='&' && i!=len) {
            key += str[i];
               i++;
           }
           $('#key').val(key);
        }
    
</script>