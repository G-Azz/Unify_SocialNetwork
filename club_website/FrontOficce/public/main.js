const divcontainer=document.querySelector('.about-product');
let cond=false;
let elementId;
let hide=function(){
divcontainer.style.display="none"
cond=true;
elementId.scrollIntoView();
}
function loadHtml(id,filename,boxid, club){
    if(cond){
        divcontainer.style.display="flex"
    }
    divcontainer.scrollIntoView();
     console.log(`div id: ${id}, filename: ${filename}`);

     let xhttp;
     let element = document.getElementById(id);
     elementId=document.querySelector(`#${boxid}`);
     let file =filename;
     if (file){
        xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState==4){
                if(this.status==200){element.innerHTML=this.responseText;}
                if(this.status==400){element.innerHTML="<h1>Page not found.</h1>"}
            }
        }
     }
     xhttp.open("GET",`templates/${file}`,true);
     xhttp.send();
     console.log(club)

     return;
}