var els = document.getElementsByClassName("trigger");
var idBug = document.getElementsByClassName("idBug");

var xhr = new XMLHttpRequest();
Array.from(els).forEach(el =>{
    el.addEventListener("click", MakeRequest);
});

function MakeRequest(e){
    e.preventDefault();
    idBug = ((this.parentElement.parentElement).id).substring(4);

    let url = "updt/" + idBug;
    let params = "statut=" + 1;
    // console.log(idBug);

    xhr.onreadystatechange = AlertContent;

    xhr.open('POST', url);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(params);
}

function AlertContent(){
    if (xhr.readyState === XMLHttpRequest.DONE) {
        // console.log(xhr.responseText);
        let obj = JSON.parse(xhr.responseText);
          
        let string = [];
        let i = 0;
        Object.keys(obj).forEach(function (k) {
            string[i] =  obj[k] ;
            i++
        });
        
        if (string[0] = "true") {
            let td = document.getElementById("td_" + string[1]);  
             let tdchild = td.querySelector("a");
             tdchild.innerHTML = "Résolut";
             tdchild.classList.remove("badge-warning");
             tdchild.classList.add("badge-primary");
        }
    }
};

var checkbox = document.getElementById("customCheck1");
checkbox.addEventListener("change", GestFiltre);
var xhrCheck = new XMLHttpRequest();

function GestFiltre(e){
    e.preventDefault();
    
    let url = "list/";
    let filter;
    if (checkbox.checked == true) { 
        filter = true; 
    }
    else{ 
        filter = false;
    }

    let params = "filter=" + filter;
    console.log(params);

    xhrCheck.onreadystatechange = BugsFilter;

    xhrCheck.open('POST', url);
    xhrCheck.setRequestHeader("xhr", true);
    xhrCheck.send(params);

}

function BugsFilter(){
    
}

//Requete api (postman)

// GET
// fetch('https://jsonplaceholder.typicode.com/posts/1',
// {method:'GET'})
//     .then(response => response.json())
//     .then(json => console.log(json))

//DELETE
// fetch('https://jsonplaceholder.typicode.com/posts/1',
// {method:'DELETE'})
//     .then(response => response.json())
//     .then(json => console.log(json))

//POST
// fetch('https://jsonplaceholder.typicode.com/posts', {
// method: 'POST',
// body: JSON.stringify({
// title: 'foo',
// body: 'bar',
// userId: 1
// }),
// headers: {
// "Content-type": "application/json; charset=UTF-8"
// }
// })
// .then(response => response.json())
// .then(json => console.log(json))

//PATCH
// fetch('https://jsonplaceholder.typicode.com/posts/1', {
// method: 'PATCH',
// body: JSON.stringify({
// title: 'foo',
// }),
// headers: {
// "Content-type": "application/json; charset=UTF-8"
// }
// })
// .then(response => response.json())
// .then(json => console.log(json))

//