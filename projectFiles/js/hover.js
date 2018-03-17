/*Simple functionality for image hovering*/

window.addEventListener("load", function(){
    let thumbnail = document.getElementsByClassName("single-image");
    
    for(let i =0; i < thumbnail.length; i++) {
         thumbnail[i].addEventListener("mousemove", hover);
        thumbnail[i].addEventListener("mouseout", unhover);
    }
});

function unhover(e){
    let hovered = document.getElementById("hover");
    hovered.innerHTML = "";
}

function hover(e){
    let hovered = document.getElementById("hover");
    let src = e.target.src.split('images/square-small/')[1]
    hovered.innerHTML = "<img src=images/square-medium/" +src +"> <div class='caption'> <p>"+e.target.alt +"</p><div>";
    hovered.style.left = e.pageX + 10;
    hovered.style.top = e.pageY + 10;
}