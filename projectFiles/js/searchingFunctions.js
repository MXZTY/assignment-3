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
    continent.value = 0;
    country.value = 0;
    city.value = 0;
});


$('#searchingForm').change(function(e){
    filterImages(e);
    if(country.value !== e.target.value) country.value = 0;
    if(continent.value !== e.target.value) continent.value = 0;
    if(city.value !== e.target.value) city.value = 0;
    if(title.value !== e.target.value) title.value = '';
    
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


