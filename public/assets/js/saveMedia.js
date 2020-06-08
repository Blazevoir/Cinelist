var genericAjax = function (url, data, type, callBack) {
    jQuery.ajax({
        url: url,
        data: data,
        type: type,
        dataType : 'json', // fuerza que la devolución no sea en texto sino json
    })
    .done(function( res ) {   // Suele ser texto, pero carmelo ha hecho que la llamada te devuelva un 
                              // json(variable con formato json).
        // console.log('ajax done');
        // console.log( res );
        callBack( res );
    })
    .fail(function( xhr, status, errorThrown ) {
        // console.log('ajax fail');
        // console.log(xhr.responseJSON.message);
    })
    .always(function( xhr, status ) {
        // console.log('ajax always');
    });
};

$( document ).ready(function(){
    if($('#estoyensingle').length){
        var id = $('.movie-detail-intro2').attr('mediaId');
        var media_type = $('.movie-detail-intro2').attr('mediatype');
        genericAjax("https://api.themoviedb.org/3/"+media_type+"/"+id+"?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US", null, 'get', function( res ){
            
            res.media_type = media_type;
            
            genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/saveSingle', {query:res}, 'post', function( res ){
                console.log(res);
            });
        });
    }
});

//Ver capitulo individual
$('.ojo').click(function(){
   
    //contenido
    var temporal = $(this);
    var iduser = temporal.attr('iduser');
    var idepisode = temporal.attr('idepisode');
    var idseason = temporal.attr('idseason');
    var idtv = $('#tvinfo').attr('mediaId');
    
    if( temporal.attr('watched') == 'false')
    {
        genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/saveEpisode', {iduser:iduser, idepisode:idepisode, idtv:idtv, idseason:idseason}, 'post', function( res ){
            $(this).attr('watched', true);
            $(this).toggleClass('fa-eye');
            $(this).toggleClass('fa-eye-slash');
            $(this).toggleClass('ojo-visto');
            $(this).toggleClass('ojo-no-visto');
        });  
    } else {
        genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/deleteEpisode', {iduser:iduser, idepisoder:idepisode}, 'post', function( res ){
            $(this).attr('watched',false);
            $(this).toggleClass('fa-eye');
            $(this).toggleClass('fa-eye-slash');
            $(this).toggleClass('ojo-visto');
            $(this).toggleClass('ojo-no-visto');
        }); 
    }

});

//Ver temporada completa
$('.ver-season').click(function(){
    var temporal = $(this);
    var iduser = temporal.attr('iduser');
    var idseason = temporal.attr('idseason');
    
    if( temporal.attr('watched') == 'false')
    {
        genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/saveSeason', {iduser:iduser, idseason:idseason}, 'post', function( res ){
            temporal.attr('watched',true);
            temporal.toggleClass('watchedSeason');
            var ojos = $('.ojo[idseason = ' +idseason+']');
            
            ojos.each(function(index,element){

                $('.ojo[idseason = ' +idseason+']').attr('watched',true);
                $('.ojo[idseason = ' +idseason+']').addClass('ojo-visto');
                $('.ojo[idseason = ' +idseason+']').removeClass('ojo-no-visto');
                $('.ojo[idseason = ' +idseason+']').removeClass('fa-eye-slash');
                $('.ojo[idseason = ' +idseason+']').addClass('fa-eye');

            });
            console.log(res);
            
        });  
    } else {
        genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/deleteSeason', {iduser:iduser, idseason:idseason}, 'post', function( res ){
            temporal.attr('watched',false);
            temporal.toggleClass('watchedSeason');
            var ojos = $('.ojo[idseason = ' +idseason+']');
            ojos.each(function(index,element){
            
                $('.ojo[idseason = ' +idseason+']').attr('watched',true);
                $('.ojo[idseason = ' +idseason+']').addClass('ojo-no-visto');
                $('.ojo[idseason = ' +idseason+']').removeClass('ojo-visto');
                $('.ojo[idseason = ' +idseason+']').removeClass('fa-eye');
                $('.ojo[idseason = ' +idseason+']').addClass('fa-eye-slash');
               

            });
            console.log(res);
        }); 
    }
});

//Añadir media a planned o watching
$(document).on('change','#list-media',function(){
    
    var temporal = $(this);
    var iduser = temporal.attr('iduser');
    var idmedia = temporal.attr('idmedia');
    var list = temporal.val();
    var mediatype = temporal.attr('mediatype');
    
    genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/addMediaToList', {iduser:iduser, idmedia:idmedia, mediatype:mediatype, list:list}, 'post', function( res ){
   
        console.log(res);
        
    });

});

$('#favorito').click(function(){
    var iduser = $('#favorito').attr('iduser');
    var idmedia = $('#favorito').attr('idmedia');
    var mediatype = $('#favorito').attr('mediatype');
    if( $('#favorito').attr('faved') == 'false')
    {
        genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/addFavorite', {iduser:iduser, idmedia:idmedia, mediatype:mediatype}, 'post', function( res ){
            $('#favorito').toggleClass('far');
            $('#favorito').toggleClass('fas');
            $('#favorito').attr('faved',true);
        });
    
    }else{
         genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/deleteFavorite', {iduser:iduser, idmedia:idmedia, mediatype:mediatype}, 'post', function( res ){
            $('#favorito').toggleClass('far');
            $('#favorito').toggleClass('fas');
            $('#favorito').attr('faved',false);
        });
    }

});


$('.fa-thumbs-up').click(function(){
    
    var id = $(this).parent().parent().parent().parent().attr('reviewid');
    var mediatype = $('#tvinfo').attr('mediatype');
    var mano = $(this);
    var userid = $('#tvinfo').attr('userid');
    var mediaid = $('#tvinfo').attr('mediaId');
    
    if($(this).hasClass('fa-hetero')){
        
        if($(this).next().hasClass('thumbs-purple')){
            $(this).next().toggleClass('thumbs-purple');
            genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/removeNegative', {id:id, mediatype:mediatype, userid:userid, mediaid:mediaid}, 'post', function( res ){});
        }
        
        if( mano.hasClass('thumbs-purple') ){
            mano.toggleClass('thumbs-purple');
            genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/removePositive', {id:id, mediatype:mediatype, userid:userid, mediaid:mediaid}, 'post', function( res ){});
        } else {
            genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/positiveVote', {id:id, mediatype:mediatype, userid:userid, mediaid:mediaid}, 'post', function( res ){
                if(res.upvote == 'ok'){
                    mano.toggleClass('thumbs-purple');
                }
            });
        }
        
    } else if($(this).hasClass('fa-invertido')){
        
        if($(this).prev().hasClass('thumbs-purple')){
            $(this).prev().toggleClass('thumbs-purple');
            genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/removePositive', {id:id, mediatype:mediatype, userid:userid, mediaid:mediaid}, 'post', function( res ){});
        }

        if( mano.hasClass('thumbs-purple') ){
            mano.toggleClass('thumbs-purple');
            genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/removeNegative', {id:id, mediatype:mediatype, userid:userid, mediaid:mediaid}, 'post', function( res ){
            });
        } else {
           genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/negativeVote', {id:id, mediatype:mediatype, userid:userid, mediaid:mediaid}, 'post', function( res ){
                if(res.downvote == 'ok'){
                    mano.toggleClass('thumbs-purple');
                }
            }); 
        }
        
    }
});

$('.sharereview').click(function(){
    var userid = $('#tvinfo').attr('userid');
    var boton = $(this);
    genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/checkUserLogin',{userid:userid},'post',function(res){
        if(res.login == 'twitter'){
            var r = confirm('Do you want to share this review in Twitter? We can post a tweet for you.');
            var auth = boton.attr('auth');
            var mediaid = $('#tvinfo').attr('mediaId');
            var mediatype = $('#tvinfo').attr('mediaType');
            var url = window.location.href;
            var reviewid = boton.attr('reviewid');
            if(r){
              genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/tuitVago', {userid:userid, url:url, reviewid:reviewid, mediaid:mediaid, mediatype:mediatype, auth:auth}, 'post', function( res ){
                console.log(res);
              });
        
            }
        } else {
            $('#tvinfo').append('<div id="alertfade" class="alert alert-warning alert-dismissible fade show fixed-top" role="alert" style="z-index:9999; opacity:1">Login with Twitter to use this feature!!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    });
});

$('#reviewform').submit(function(e){
    e.preventDefault();
    var userid = $('#tvinfo').attr('userid');
    var boton = $(this);
    genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/checkUserLogin',{userid:userid},'post',function(res){
        if(res.login == 'twitter'){
            var r = confirm('Do you want to share this review in Twitter? We can post a tweet for you.');
            var auth = boton.attr('auth');
            var mediaid = $('#tvinfo').attr('mediaId');
            var mediatype = $('#tvinfo').attr('mediaType');
            var url = window.location.href;
            var content = $('.ckeditor').val();
            if(r){
                genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/tuitVago', {userid:userid, url:url, mediaid:mediaid, mediatype:mediatype, auth:auth, content:content}, 'post', function( res ){});
            }
        } 
        
        setTimeout(function(){ 
            $('#reviewform').unbind().submit();
        }, 500);
        
        
        
    });
    
});

$('.estrella-single').click(function(){
    var star = $(this);
    var score = star.prev().val();
    var iduser = $('#tvinfo').attr('userid');
    var idmedia = $('#tvinfo').attr('mediaId');
    var mediatype = $('#tvinfo').attr('mediaType');

    genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/setScore', {score:score,iduser:iduser,idmedia:idmedia, mediatype:mediatype}, 'post', function( res ){
        console.log(res);
    });

});


$('.favorite-index').click(function(){
    
    var fav = $(this);
    var iduser = fav.attr('iduser');
    var idmedia = fav.attr('idmedia');
    var mediatype = fav.attr('mediatype');
    
    if( fav.attr('faved') == 'false')
    {
        genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/addFavorite', {iduser:iduser, idmedia:idmedia, mediatype:mediatype}, 'post', function( res ){
            fav.toggleClass('thumbs-purple');
            fav.attr('faved',true);
        });
    
    }else{
         genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/deleteFavorite', {iduser:iduser, idmedia:idmedia, mediatype:mediatype}, 'post', function( res ){
            fav.toggleClass('thumbs-purple');
            fav.attr('faved',false);
        });
    }

});

var index = $('#estoyindex');
if(typeof index !== typeof undefined && index !== null){

    $('.share-index').click(function(e){
        
        var iduser = index.attr('iduser');
        var boton = $(this);
        
        genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/checkUserLogin',{userid:iduser},'post',function(res){
            if(res.login == 'twitter'){
                var r = confirm('Do you want to share this content in Twitter? We are going to post a tweet for you.');
                var url = window.location.href;
                var idmedia = boton.attr('idmedia');
                var mediatype = boton.attr('mediatype');
                
                if(r){
                  genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/tuitMedia', {userid:iduser, url:url, idmedia:idmedia, mediatype:mediatype }, 'post', function( res ){
                    console.log(res);
                    
                  });
            
                }
            } else {
                $('body').append('<div id="" class="alert alert-warning alert-dismissible fade show fixed-top" role="alert" style="z-index:9999; opacity:1">Login with Twitter to use this feature!!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
        });
        
    });
    
}