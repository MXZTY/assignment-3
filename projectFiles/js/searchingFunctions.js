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

// This will get the value of the title input element
// it will then focus the title element and when the focus happens, titleSearch is called with stored value.
if(title != null || title != undefined ){
    document.querySelector('#title').focus(titleSearch(title));
}

// add the event listener of KeyUp on the title input element so when the user inputs a character, 
// the list will be refined without needing to hit tab or the enter key. 
title.addEventListener('keyup', function (e){
    filterImages(e);
    var panelhead = document.getElementById('query-string');
    panelhead.innerHTML = 'Images that match the title: ' + e.target.value;
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

//this function will set an event listener for a change on the form. when the form is changed, 
// the value of the selected element is passed in to filter images. 
document.querySelector('#searchingForm').addEventListener('change', function(e){
    filterImages(e);
    var value = e.target;
    var panelhead = document.getElementById('query-string');
    console.log(value.options[value.selectedIndex].text);
    panelhead.innerHTML = 'Images matching ' + value.getAttribute('id') + ": " + value.options[value.selectedIndex].text;
    
    //checks the value to see if it is set to 0 and then sets the heading text to all images if so. 
    if(value.value == 0){
        panelhead.innerHTML = 'All Images'
    } else if(value.getAttribute('id').toLowerCase() == 'country'){
        // if it is country then set the others to their defaults. 
        continent.value = 0;
        title.value = '';
        city.value = 0;
        
    } else if (value.getAttribute('id').toLowerCase() == 'continent'){
        // if it is continent then set the others to their defaults. 
        country.value = 0;
        title.value = '';
        city.value = 0
    } else if (value.getAttribute('id').toLowerCase() == 'city'){
        // if it is city then set the others to their defaults. 
        continent.value = 0;
        title.value = '';
        country.value = 0
    }
});

// this funciton will filter the images based on the selection passed in. 
// it will take in either the select elements, or the input element for searching. 
function filterImages(e){
    let value = e.target;
    if(value == undefined){
        value = e;
    }
    var imgs = document.getElementsByClassName('filteredImages');
        //iterate and evaluate if the image matches query. 
        for(var i =0; i<imgs.length; i++){
         if(imgs[i].getAttribute(value.getAttribute('id')).toLowerCase().includes(value.value.toLowerCase()) || value.value == 0) {
             imgs[i].style.display = "block";
         } else {
             imgs[i].style.display = "none";
         }
    }
}

});


