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
        req.send()
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

