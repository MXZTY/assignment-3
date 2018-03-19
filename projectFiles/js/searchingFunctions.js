window.addEventListener("load", function(){


var country = document.getElementById('country');
var continent = document.getElementById('continent');
var city = document.getElementById('city');
var title = document.getElementById('title');

function titleSearch(e){
    filterImages(e);    
}
$(title).val(title.value).focus(titleSearch(title));


title.addEventListener('keyup', function (e){
    filterImages(e);
    var panelhead = document.getElementById('query-string');
    panelhead.innerHTML = 'Images the match the title: ' + e.target.value;
    continent.value = 0;
    country.value = 0;
    city.value = 0;
});

 var querystring = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < querystring.length; i++)
    {
        var attr = querystring[i].split('=')[0]
        var value = querystring[i].split('=')[1];
        var select = document.getElementById(attr);
        console.log(attr + ' ' + value);
        select.value = value;
        filterImages(select);
    }


$('#searchingForm').change(function(e){
    filterImages(e);
    var value = e.target;
    var panelhead = document.getElementById('query-string');
    console.log(e.target.getAttribute('id'));
    panelhead.innerHTML = 'Images the match the ' + e.target.getAttribute('id') + ": " + value.value;
    
    //just added this here... checks the id to see if the country was e or ... and then sets the other values back to default
    if(value.value == 0){
        panelhead.innerHTML = 'All Images'
    }
    if(value.getAttribute('id').toLowerCase() == 'country'){
        continent.value = 0;
        title.value = '';
        city.value = 0;
        
    } else if (value.getAttribute('id').toLowerCase() == 'continent'){
        country.value = 0;
        title.value = '';
        city.value = 0
    } else if (value.getAttribute('id').toLowerCase() == 'city'){
        continent.value = 0;
        title.value = '';
        country.value = 0
    }
    
    
    
});


function filterImages(e){
    let value = e.target;
    if(value == undefined){
        value = e;
    }
    var imgs = document.getElementsByClassName('filteredImages');
        for(var i =0; i<imgs.length; i++){
         if(imgs[i].getAttribute(value.getAttribute('id')).toLowerCase().includes(value.value.toLowerCase()) || value.value == 0) {
             imgs[i].style.display = "block";
         } else {
             imgs[i].style.display = "none";
         }
    }
}

});


