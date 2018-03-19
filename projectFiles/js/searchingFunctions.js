window.addEventListener("load", function(){
    
// set values for the country, continent, and city select options, and the title input.     
var country = document.getElementById('country');
var continent = document.getElementById('continent');
var city = document.getElementById('city');
var title = document.getElementById('title');

// this function is used to search for a title when the title is set through the query string
// this method will be called when the user searches for an image using the header search bar. 
function titleSearch(e){
    filterImages(e);    
}

// This JQuery call will get the value of the title input element
// it will then focus the title element and when the focus happens, titleSearch is called with stored value.
$(title).val(title.value).focus(titleSearch(title));


// add the event listener of KeyUp on the title input element so when the user inputs a character, 
// the list will be refined without needing to hit tab or the enter key. 
title.addEventListener('keyup', function (e){
    filterImages(e);
    var panelhead = document.getElementById('query-string');
    panelhead.innerHTML = 'Images the match the title: ' + e.target.value;
    continent.value = 0;
    country.value = 0;
    city.value = 0;
});

// This will handle any incoming select values passed in through the query string. 
// The panel of popular, and countries will set the query string value and this will parse the query strings parameters
 var querystring = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    
    if( querystring != undefined || querystring != null ){
        for(var i = 0; i < querystring.length; i++) {
            var attr = querystring[i].split('=')[0]
            var value = querystring[i].split('=')[1];
       
            if (attr == 'country' || attr == 'city' || attr == 'continent'){
                var select = document.getElementById(attr);
                select.value = value;
                filterImages(select);
            }
            
        }
    }

document.querySelector('#searchingForm').addEventListener('change', function(e){
    filterImages(e);
    var value = e.target;
    var panelhead = document.getElementById('query-string');
    console.log(value.options[value.selectedIndex].text);
    panelhead.innerHTML = 'Images Matching ' + value.getAttribute('id').charAt(0).toUpperCase() + value.getAttribute('id').split(1) + ": " + value.options[value.selectedIndex].text;
    
    //just added this here... checks the id to see if the country was e or ... and then sets the other values back to default
    if(value.value == 0){
        panelhead.innerHTML = 'All Images'
    } else if(value.getAttribute('id').toLowerCase() == 'country'){
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


