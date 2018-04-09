

/*Simple functionality for image hovering*/

window.addEventListener("load", function(){
    let thumbnail = document.querySelectorAll(".single-image");
    
    for(let i =0; i < thumbnail.length; i++) {
        thumbnail[i].addEventListener("mousemove", hover);
        
        thumbnail[i].addEventListener("mouseover", setBorder);
        /*When mouse leaves the div, make the hoving image a hidden*/
        thumbnail[i].addEventListener("mouseout", function unhover(e){
                let hovered = document.querySelector("#hover");
                hovered.innerHTML = "";
                hovered.style.visibility = 'hidden'
                hovered.style.borderWidth = '0px';
                e.target.style.outline = 'none';
        });
        
    }
});

/*When mouse hovers over the div, make the hovering image div visible and following the mouse*/
function hover(e){
    let hovered = document.querySelector("#hover");
    //Get the image file name to be from the small img so we can use it in the medium folder.
    let src = e.target.src.split('images/square-small/')[1]

    e.target.style.outline = 'solid';
    hovered.style.visibility = 'visible';
    hovered.innerHTML = "<img src=images/square-medium/" + src +" class='hoveredImg'>";
    if(e.target.alt != '' && e.target.alt != undefined && e.target.alt != null){
        $('<div class="body caption"><p>'+e.target.alt+'</p></div>').appendTo(hovered);
        $(`.hoveredImg`).addClass('img-rounded')
    } else {
        console.log('TESTING');
        $(`hoveredImg`).removeClass('img-rounded');
    }
    hovered.style.left = e.pageX + 10;
    hovered.style.top = e.pageY + 10;
    

}

function setBorder(e){
        var grandparent = (e.target.parentElement.parentElement);
    if($(grandparent).attr('id') == `lineItem`){
        var key = e.target.getAttribute('id').replace('image', 'frame');
        var selectedId= $('#'+key + ' option:selected').attr('value'); 
        getBgColor(selectedId);
        
        
    }
    
}

function getBgColor(id){
        var url = `print-services.php`;
        var color = '';
        //perform ajax request on the url with the provided data
        $.get(url).done(function(data){
            let hovered = document.querySelector("#hover");
            hovered.style.border = 'solid';
            hovered.style.borderWidth = (data.frame[id].border);
            hovered.style.borderColor = (data.frame[id].color);
            
        }).fail(function(xhr, status, error){
            alert(`Failed loading data! Status = ` + status + ` Error =` + error);
        }).always(function(data){});
        
        return color;
}
