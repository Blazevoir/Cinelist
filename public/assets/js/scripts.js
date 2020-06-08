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

$('.taparprofilepic').click(function(){
   $('.editasion').click(); 
});


/*
jQuery Redirect v1.1.3
Copyright (c) 2013-2018 Miguel Galante
Copyright (c) 2011-2013 Nemanja Avramovic, www.avramovic.info
Licensed under CC BY-SA 4.0 License: http://creativecommons.org/licenses/by-sa/4.0/
This means everyone is allowed to:
Share - copy and redistribute the material in any medium or format
Adapt - remix, transform, and build upon the material for any purpose, even commercially.
Under following conditions:
Attribution - You must give appropriate credit, provide a link to the license, and indicate if changes were made. You may do so in any reasonable manner, but not in any way that suggests the licensor endorses you or your use.
ShareAlike - If you remix, transform, or build upon the material, you must distribute your contributions under the same license as the original.
*/
;(function ($) {
  'use strict';

  //Defaults configuration
  var defaults = {
    url: null,
    values: null,
    method: "POST",
    target: null,
    traditional: false,
    redirectTop: false
  };

  /**
  * jQuery Redirect
  * @param {string} url - Url of the redirection
  * @param {Object} values - (optional) An object with the data to send. If not present will look for values as QueryString in the target url.
  * @param {string} method - (optional) The HTTP verb can be GET or POST (defaults to POST)
  * @param {string} target - (optional) The target of the form. "_blank" will open the url in a new window.
  * @param {boolean} traditional - (optional) This provides the same function as jquery's ajax function. The brackets are omitted on the field name if its an array.  This allows arrays to work with MVC.net among others.
  * @param {boolean} redirectTop - (optional) If its called from a iframe, force to navigate the top window. 
  *//**
  * jQuery Redirect
  * @param {string} opts - Options object
  * @param {string} opts.url - Url of the redirection
  * @param {Object} opts.values - (optional) An object with the data to send. If not present will look for values as QueryString in the target url.
  * @param {string} opts.method - (optional) The HTTP verb can be GET or POST (defaults to POST)
  * @param {string} opts.target - (optional) The target of the form. "_blank" will open the url in a new window.
  * @param {boolean} opts.traditional - (optional) This provides the same function as jquery's ajax function. The brackets are omitted on the field name if its an array.  This allows arrays to work with MVC.net among others.
  * @param {boolean} opts.redirectTop - (optional) If its called from a iframe, force to navigate the top window. 
  */
  $.redirect = function (url, values, method, target, traditional, redirectTop) {
    var opts = url;
    if (typeof url !== "object") {
      var opts = {
        url: url,
        values: values,
        method: method,
        target: target,
        traditional: traditional,
        redirectTop: redirectTop
      };
    }

    var config = $.extend({}, defaults, opts);
    var generatedForm = $.redirect.getForm(config.url, config.values, config.method, config.target, config.traditional);
    $('body', config.redirectTop ? window.top.document : undefined).append(generatedForm.form);
    generatedForm.submit();
    generatedForm.form.remove();
  };

  $.redirect.getForm = function (url, values, method, target, traditional) {
    method = (method && ["GET", "POST", "PUT", "DELETE"].indexOf(method.toUpperCase()) !== -1) ? method.toUpperCase() : 'POST';

    url = url.split("#");
    var hash = url[1] ? ("#" + url[1]) : "";
    url = url[0];

    if (!values) {
      var obj = $.parseUrl(url);
      url = obj.url;
      values = obj.params;
    }

    values = removeNulls(values);

    var form = $('<form>')
      .attr("method", method)
      .attr("action", url + hash);


    if (target) {
      form.attr("target", target);
    }

    var submit = form[0].submit;
    iterateValues(values, [], form, null, traditional);

    return { form: form, submit: function () { submit.call(form[0]); } };
  }

  //Utility Functions
	/**
	 * Url and QueryString Parser.
	 * @param {string} url - a Url to parse.
	 * @returns {object} an object with the parsed url with the following structure {url: URL, params:{ KEY: VALUE }}
	 */
  $.parseUrl = function (url) {

    if (url.indexOf('?') === -1) {
      return {
        url: url,
        params: {}
      };
    }
    var parts = url.split('?'),
      query_string = parts[1],
      elems = query_string.split('&');
    url = parts[0];

    var i, pair, obj = {};
    for (i = 0; i < elems.length; i += 1) {
      pair = elems[i].split('=');
      obj[pair[0]] = pair[1];
    }

    return {
      url: url,
      params: obj
    };
  };

  //Private Functions
  var getInput = function (name, value, parent, array, traditional) {
    var parentString;
    if (parent.length > 0) {
      parentString = parent[0];
      var i;
      for (i = 1; i < parent.length; i += 1) {
        parentString += "[" + parent[i] + "]";
      }

      if (array) {
        if (traditional)
          name = parentString;
        else
          name = parentString + "[" + name + "]";
      } else {
        name = parentString + "[" + name + "]";
      }
    }

    return $("<input>").attr("type", "hidden")
      .attr("name", name)
      .attr("value", value);
  };

  var iterateValues = function (values, parent, form, isArray, traditional) {
    var i, iterateParent = [];
    Object.keys(values).forEach(function (i) {
      if (typeof values[i] === "object") {
        iterateParent = parent.slice();
        iterateParent.push(i);
        iterateValues(values[i], iterateParent, form, Array.isArray(values[i]), traditional);
      } else {
        form.append(getInput(i, values[i], parent, isArray, traditional));
      }
    });
  };

  var removeNulls = function (values) {
    var propNames = Object.getOwnPropertyNames(values);
    for (var i = 0; i < propNames.length; i++) {
      var propName = propNames[i];
      if (values[propName] === null || values[propName] === undefined) {
        delete values[propName];
      } else if (typeof values[propName] === 'object') {
        values[propName] = removeNulls(values[propName]);
      } else if (values[propName].length < 1) {
        delete values[propName];
      }
    }
    return values;
  };
}(window.jQuery || window.Zepto || window.jqlite));

var rellenarHTML = function (array)
{
    for(var total = array.length; total < 4; total++){
        $('#search-total-'+total).removeClass('search-display-block');
        $('#search-total-'+total).addClass('search-display-none');
        $('#hr'+total).removeClass('search-display-block');
        $('#hr'+total).addClass('search-display-none');

    }
    array.forEach(function(item, index){
        var mediatype = item.media_type;
        
        $('#search-total-'+index).addClass('search-display-block');
        $('#search-total-'+index).removeClass('search-display-none');
        $('#hr'+index).removeClass('search-display-none');
        $('#hr'+index).addClass('search-display-block');

        $('#search-total-'+index).attr('media_type', mediatype);
        $('#search-total-'+index).attr('media_id', item.id);
        
        //nuevo para like y share
        var buttons = $('#search-total-'+index).children().children().children().children();

        buttons.children().first().empty();
        var share = buttons.children().children();
        share.attr('idmedia',item.id);
        share.attr('mediatype',mediatype);

        if(mediatype == 'movie')
        {
            $('#search-title-'+index).text(item.title);
            $('#search-single-'+index).attr("href", "http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/movie/"+item.id);
            $('#search-img-'+index).attr("src", "https://image.tmdb.org/t/p/original"+item.poster_path+"");
            $('#search-content-'+index).text('Movie | ' + item.release_date);
        }

        if(mediatype == 'tv') {
            $('#search-title-'+index).text(item.name);
            $('#search-single-'+index).attr("href", "http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/tv/"+item.id);
            $('#search-img-'+index).attr("src", "https://image.tmdb.org/t/p/original"+item.poster_path+"");
            $('#search-content-'+index).text('Tv show | ' + item.first_air_date);
        }
        if( mediatype == 'person') {
            $('#search-title-'+index).text(item.name);
            $('#search-single-'+index).attr("href", "http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/person/"+item.id);
            $('#search-img-'+index).attr("src", "https://image.tmdb.org/t/p/original"+item.profile_path+"");
            $('#search-content-'+index).text('Person | known for ' + item.known_for_department);
        }

    });
    
}


var filtrarbusqueda = function(array)
{
    var nuevoarray = [];
    var cont = 0;
    array.forEach(function(item, index){
        if(item.poster_path != null || item.profile_path != null)
        {

            nuevoarray.push(item);
            cont++;
        }
        
        if(cont>3){
            return nuevoarray;
        }
    });
    return nuevoarray;
    
}

setTimeout(function(){
    $('#alertfade').fadeTo('slow',1);    
}, 1500);


setTimeout(function(){
    $('#alertfade').fadeTo('slow',0);

}, 5000);

setTimeout(function(){
    $('#alertfade').css('display','none');
}, 6000);
    
$('#logout').click(function(){
    $('#formlogout').submit();
});

$('#search-keyword').keyup(function(){
    genericAjax("https://api.themoviedb.org/3/search/multi?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en&query=" + $('#search-keyword').val() + "&include_adult=false&page=1",null,'get',function(res){
        var busqueda = filtrarbusqueda(res.results);
        rellenarHTML(busqueda);
    });
});

$('.desplegable').keyup(function(){
    genericAjax("https://api.themoviedb.org/3/search/multi?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en&query=" + $('#search-keyword').val() + "&include_adult=false&page=1",null,'get',function(res){
        var busqueda = filtrarbusqueda(res.results);
        rellenarHTML(busqueda);
    });
});
$('.desplegable').focusin(function(){
    genericAjax("https://api.themoviedb.org/3/search/multi?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en&query=" + $('#search-keyword').val() + "&include_adult=false&page=1",null,'get',function(res){
        var busqueda = filtrarbusqueda(res.results);
        rellenarHTML(busqueda);
    });
});
$('.desplegable').focusout(function(){
    setTimeout(function(){ 
        $('.caja').removeClass('search-display-block');
        $('.hrbuscador').removeClass('search-display-block');
        $('.caja').addClass('search-display-none');
        $('.hrbuscador').addClass('search-display-none');   
    }, 200);
});

$('.desplegablefall').keyup(function(){
    genericAjax("https://api.themoviedb.org/3/search/multi?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en&query=" + $('#search-keyword').val() + "&include_adult=false&page=1",null,'get',function(res){
        var busqueda = filtrarbusqueda(res.results);
        rellenarHTML(busqueda);
    });
});

$('#deleteReviewForm').submit(function(e){
   e.preventDefault() ;
   var r = confirm('Are you sure you want to delete your review?');
   if(r){
       $('#deleteReviewForm').unbind().submit();
   }
});


var redirect = function(){
    window.location.href = "http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/redirect";

}

$('.searchenviar').click(function(){
    $('.class="searchformcine"').submit();
});

$('#viewMore').click(function(){
    $('.showMedia').addClass('displayMedia');
    $('.showMedia').removeClass('hiddenMedia');
    $('#DiviewMore').empty();
});

$('.fa-eye-slash').click(function(){
    

    $(this).toggleClass('fa-eye');
    $(this).toggleClass('fa-eye-slash');
    $(this).toggleClass('ojo-visto');
    $(this).toggleClass('ojo-no-visto');
    
    
});

$('.testimonial-slider').owlCarousel({
    items:1,
    margin:10,
    autoHeight:true
});

$('.owl-carousel-profile').owlCarousel({
    items:10,
    margin:10,
    rewind:true,
    // loop:true,
    dots:false,
    responsive:{
         0 : {
        items : 4,
        },
        // breakpoint from 480 up
        500 : {
            items : 3,
        },
        // breakpoint from 1000 up
        1000 : {
            items : 7,
        },
        // breakpoint from 1500 up
        1500 : {
            items : 9,
        }
    }
    
});

$('.pagination-discover').click(function(){
    var genre = $('#postpagination').attr('genre');
    var year = $('#postpagination').attr('year');
    var mediatype = $('#postpagination').attr('mediatype');
    
    if(typeof genre == typeof undefined && genre == ''){
      genre = null;
    }
    if(typeof year == typeof undefined && year == ''){
      year = null;
    }
    if(typeof mediatype == typeof undefined && mediatype == ''){
      mediatype = null;
    }
    $.redirect('http://informatica.ieszaidinvergeles.org:9021/Cinelist/public/discover', {
      'page':$(this).attr('page'),
      'genre':genre,
      'year':year,
      'mediatype':mediatype,
    }); 
});
  var hecho = false;

$('#advancedsearchbutton').click(function(){
  if(!hecho){
    $('#multidesaparece').css('height','240px');
    $('#multidesaparece').css('opacity','1');
    hecho = true;
  } else{
    $('#multidesaparece').css('height','0px');
    $('#multidesaparece').css('opacity','0');  
    hecho = false;
  }
});


