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
    
    var iduser = $('#tvinfo').attr('userid');
    var idtv = $('#tvinfo').attr('mediaId');
    var mediatype = $('#tvinfo').attr('mediatype');

    if (typeof iduser !== typeof undefined && iduser !== null && mediatype == 'tv') {
        genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/checkEpisode', {iduserr:iduser, idtvr:idtv}, 'post', function( res ){
            //episodes
            var episodes = [];
            
            for(var i in res.episodes)
                episodes.push(res.episodes[i]);
                
            $('.ojo').each(function(){
                var episode = $(this).attr('idepisode');
                var temporal = $(this);
                    episodes.forEach(function(index, element){
                        if( episode == index)
                        {
                            temporal.attr('watched', true);
                            temporal.toggleClass('fa-eye');
                            temporal.toggleClass('fa-eye-slash');
                            temporal.toggleClass('ojo-visto');
                            temporal.toggleClass('ojo-no-visto');
                        }
                    });
            });
        });

        //seasons
        var seasons = $('.ver-season');
        $('.ver-season').each(function(){
            var temp = $(this);
            var idseason = $(this).attr('idseason');
                genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/checkSeason', {iduserr:iduser, idseasonr:idseason}, 'post', function( res ){
                    if(res.viewed == 'yes'){
                        temp.attr('watched', true);
                        temp.toggleClass('watchedSeason');
                    }else{
                        temp.attr('watched', false);
                        
                    } 
                }); 
        });
        

    }
            //favoritos
    genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/checkFavorite',{iduser:iduser,idmedia:idtv,mediatype:mediatype},'post',function( res ){
        if( res.Favorite == 'yes' ){
            $('#favorito').toggleClass('far');
            $('#favorito').toggleClass('fas');
            $('#favorito').attr('faved',true);
           
        }
    });
    
    //CHECK DE LISTAS WATCHING
    genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/checkSelect',{iduser:iduser,idmedia:idtv,mediatype:mediatype},'post',function( res ){
        $('option[value='+res.select+']').attr('selected','selected');
    });
    
    //check de votos de reviews
        
    genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/checkVotes', {idmedia:idtv, iduser:iduser,mediatype:mediatype}, 'post', function( res ){
        var votos = res.votos;
        votos.forEach(function(index, item){
            if(index.tipo =='1'){
                if(mediatype == 'tv')
                {
                    var temp = $('#upvote-' + index.idreviewtv);
                    temp.toggleClass('thumbs-purple');
                }else if(mediatype == 'movie'){
                    var temp = $('#upvote-' + index.idreviewmovie);
                    temp.toggleClass('thumbs-purple');
                }
            } else if(index.tipo == '0'){
                if(mediatype == 'tv')
                {
                    var temp = $('#downvote-' + index.idreviewtv);
                    temp.toggleClass('thumbs-purple');
                }else if(mediatype == 'movie'){
                    var temp = $('#downvote-' + index.idreviewmovie);
                    temp.toggleClass('thumbs-purple');
                }
            }
        });
    });
    
    //check nota
    genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/checkScore', {idmedia:idtv, iduser:iduser,mediatype:mediatype}, 'post', function( res ){
        if(res.score != -1){
            $('input[value=' + res.score + ']').click();
        }
        console.log(res);
    });
    //check de favorites en INDEX
    var index = $('#estoyindex');
    if(typeof index !== typeof undefined && index !== null){
        //CHECK DE favorites en trending de index
        var iduser = index.attr('iduser');
        genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/checkTrendingFavorites',{iduser:iduser},'post',function( res ){
            var favs = res.favs;
            favs.forEach(function(index, item){
                $('#favorite-index-'+index).toggleClass('thumbs-purple');
                $('#favorite-index-'+index).attr('faved',true);
                
            });
            
            console.log(res);
        });
    }
    

});


$('.reportReview').submit(function(e){
    e.preventDefault();
    var idreview = $(this).find('input[name="idreview"]').val();
    var content = $(this).find('input[name="content"]').val();
    var mediatype = $('#tvinfo').attr('mediaType');
    genericAjax('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/api/reportreview', {idreview:idreview,content:content,mediatype:mediatype} ,'post',function( res ){
        if(res.report == 'ok'){
            $('#tvinfo').append('<div id="alertfade" class="alert alert-success alert-dismissible fade show fixed-top" role="alert" style="z-index:9999; opacity:1">Review reported correctly<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }

    });
});


