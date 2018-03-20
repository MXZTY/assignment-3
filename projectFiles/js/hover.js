/*Simple functionality for image hovering*/

window.addEventListener("load", function(){
    let thumbnail = document.querySelectorAll(".single-image");
    
    for(let i =0; i < thumbnail.length; i++) {
        thumbnail[i].addEventListener("mousemove", hover);
        /*When mouse leaves the div, make the hoving image a hidden*/
        thumbnail[i].addEventListener("mouseout", function unhover(e){
                let hovered = document.querySelector("#hover");
                hovered.innerHTML = "";
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
    hovered.innerHTML = "<img src=images/square-medium/" +src +" class='img-rounded img-thumbnail'><div  class='body caption'><p>"+e.target.alt +"</p></div>";
    hovered.style.left = e.pageX + 10;
    hovered.style.top = e.pageY + 10;
}