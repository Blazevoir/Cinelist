<!DOCTYPE html>
<html>
    <head>
        <title>Search</title>
        <style>
            body{
                background:crimsom;
                display:flex;
                align-items:center;
                justify-content:center;
                font-family: "Montserrat";
            }
            input{
                margin-top:100px;
                height:20px;
                width:400px;
                padding:30px;
                border:2px solid black;
            }
        </style>
    </head>
    
    <body>
        <input type="search" placeholder="Search" name="searchmovies" id="searchmovies">
    </body>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>  
        var genericAjax = function (url, data, type, callBack) {
            $.ajax({
                url: url,
                data: data,
                type: type,
                dataType : 'json', // fuerza que la devolución no sea en texto sino json
            })
            .done(function( res ) {   // Suele ser texto, pero carmelo ha hecho que la llamada te devuelva un 
                                      // json(variable con formato json).
                console.log('ajax done');
                console.log( res );
                callBack( res );
            })
            .fail(function( xhr, status, errorThrown ) {
                console.log('ajax fail');
                console.log(xhr.responseJSON.message);
            })
            .always(function( xhr, status ) {
                console.log('ajax always');
            });
        };
    
    
        $("input[name = 'searchmovies']").on('keyup',function(){
           genericAjax('/Cinelist/public/api/getmovies',{query:$(this).val()},'post',function(res){
               
           });
        });
        
    </script>
</html>