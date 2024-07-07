document.addEventListener("DOMContentLoaded", (event) => {
    const firstSection = document.getElementById("firstSection");
    const secondSection = document.getElementById("secondSection");
    const thirdSection = document.getElementById("thirdSection");
    firstSection.classList.remove("hidden");
    secondSection.classList.remove("hidden");
    thirdSection.classList.remove("hidden");
    firstSection.classList.add("fadeIn");
    secondSection.classList.add("fadeIn");
    thirdSection.classList.add("fadeIn");
})

function showAlert(){
    alert("Click");
}

function ajaxReq(config){
    return new Promise ((resolve, reject) => {
        const req = new XMLHttpRequest;
        req.open(config.method, config.url);
        req.onload = () => {
            if(req.status === 200){
                resolve(req.responseText);
            }else{
                reject(new Error(req.statusText));
            }
        }
        req.send();
    })
}

function getChuck(){
    const quotesChuck = document.getElementById("quotesChuck");
    ajaxReq({
        method: "GET",
        url: "https://api.chucknorris.io/jokes/random"
    }).then(
        response => {
            const res = JSON.parse(response);
            quotesChuck.innerHTML = res.value;
        }
    ).catch(
        error => {
            quotesChuck.className = 'danger';
            quotesChuck.innerHTML = "A Ocurrido un Error";
    })
}

function getRepo(){
    const ulRepo = document.getElementById("listRepos");
    const input = document.getElementById("serchRepo");
    var urlRepo = "https://api.github.com/search/repositories?q=JavaScript";
    if(input.value){
        urlRepo = "https://api.github.com/search/repositories?q="+input.value;
    } 
    ajaxReq({
        method: "GET",
        url: urlRepo
    }).then(
        response => {
            const res = JSON.parse(response);
            ulRepo.innerHTML = "";
            res.items.map(function(item){
                const li = document.createElement('li');
                li.textContent = item.full_name;
                ulRepo.appendChild(li);
            }) 
            
        }
    ).catch(
        error => {
            console.log(error);
        }
    )
}

const peliculas = [
    ["nombre", "duracion", "fecha", "categoria"],
    ["mufassa", 108, "16/05/20204", "fantasia"],
    ["joker 2", 108, "16/05/20204", "accion"],
    ["deadpool", 108, "16/05/20204", "fantasia"],
    ["dune", 108, "16/05/20204", "fantasia"],
    ["furiosa", 108, "16/05/20204", "fantasia"]
]

function showTable(){
    const thirdSection = document.getElementById("thirdSection");

    const existTable = document.querySelector("table");
    if (existTable) {
        thirdSection.removeChild(existTable);
    }

    const table = document.createElement("table");
    const thead = document.createElement("thead");
    const tbody = document.createElement("tbody");
    const tr = document.createElement("tr");
    thirdSection.appendChild(table);
    table.setAttribute("border", "1")
    table.appendChild(thead);
    thead.appendChild(tr);
    peliculas[0].map(function(item){
        const th = document.createElement("th");
        th.textContent = item;
        tr.appendChild(th);
    }) 
    for (let i = 1; i < peliculas.length; i++) {
        const tr = document.createElement("tr");
        peliculas[i].map(function (item) {  
            const td = document.createElement("td");
            td.textContent = item;
            tr.appendChild(td);
        })
        tbody.appendChild(tr);
    }
    table.appendChild(tbody);
}