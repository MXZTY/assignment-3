/*This function loads if the single-post or single-image page has the querystring 'added'
    It makes a div named "added-notice" visible with the text "Favorite added"  and then makes it inviible after 2 seconds (2000 miliseconds)*/
window.addEventListener("load", function(){
    let popup = document.getElementById("added-notice");
    popup.innerHTML = 'Added to favorites';
    popup.className = "visible alert alert-success";
    
    setTimeout(function(){
        let popup = document.getElementById("added-notice");
        popup.innerHTML = '';
        popup.className = "invisible";
    }, 2000)
});

