let Routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router');
let Routes = require('./js_routes.json');

Routing.setRoutingData(Routes);

let tricks_list = document.getElementById('tricks');
let numberOfTricks = 0;
let loadMoreButton = document.getElementById('load_more_button');

loadMoreButton.style.display = "none";

$(document).ready(function() {
    $('.js-scrollTo').on('click', function() {
        var page = $(this).attr('href');
        var speed = 750;
        $('html, body').animate( { scrollTop: $(page).offset().top }, speed );
        return false;
    });
});

document.addEventListener('DOMContentLoaded', function (event)
{
    printTricks()
});

loadMoreButton.addEventListener('click', function (event)
{
    printTricks()
});

function printTricks()
{
    new Promise(function(resolve, reject)
    {
        let url = Routing.generate('app_trick_all_show', {offset : numberOfTricks});
        let xhr = new XMLHttpRequest();

        xhr.open('GET', url);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.addEventListener('load', function(event)
        {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    resolve(JSON.parse(this.responseText))
                } else {
                    reject(JSON.parse(this.responseText))
                }
            }
        });
        xhr.send()
    })
        .then ((response) => {
            if (numberOfTricks === 0) {
                while (tricks_list.firstChild) {
                    tricks_list.removeChild(tricks_list.lastChild);
                }
            }

            for (let index = 0; index < response.length; index++)
            {
                insertToDom(response[index])
            }
            numberOfTricks = numberOfTricks+response.length;

            if (response.length < 1 ){
                loadMoreButton.style.display = "none";
            } else {
                loadMoreButton.style.display = "block";
            }
        })
        .catch((error) => {
            alert('OUPS! Une erreur est survenue pendant le chargement des tricks | code = ' + error)
        })
}

function insertToDom(data)
{
    let div = createElement('div');
    let a = createElement('a');
    let span = createElement('span');
    let pSpan = document.createTextNode(data.tag.name);
    let p = createElement('p');
    let pTextNode = document.createTextNode(data.name);

    div.classList.add("card");
    div.classList.add("m-3");
    div.classList.add("p-1");
    //div.classList.add("col-12");
    div.classList.add("col-sm");
    a.classList.add("badge-primary");
    a.href = Routing.generate('app_trick_show', {id : data.name})
    a.style.background = "#f3f3f3 url('../pictures/tricksPictures/main/"+data.picture+"') no-repeat right top";

    span.classList.add("badge");
    span.classList.add("badge-primary");

    span.appendChild(pSpan);
    p.appendChild(pTextNode);
    tricks_list.appendChild(div);
    div.appendChild(a);
    a.appendChild(p);
    a.appendChild(span);
}

function createElement(name)
{
    return document.createElement(name)
}
