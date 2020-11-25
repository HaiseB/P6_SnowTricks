let Routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router');
let Routes = require('./js_routes.json');

Routing.setRoutingData(Routes);

let tricks_list = document.getElementById('tricks');
let numberOfTricks = 0;
let loadMoreButton = document.getElementById('load_more_button');
let btnScrollToTricks = document.getElementById('scroll-to-tricks');
let btnScrollToHeader = document.getElementById('scroll-to-header');
let myProfilLink = document.getElementById('myProfilLink');

loadMoreButton.style.display = "none";

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        btnScrollToHeader.style.display = "block";
        btnScrollToTricks.style.display = "none";
    } else {
        btnScrollToTricks.style.display = "block";
        btnScrollToHeader.style.display = "none";
    }
}

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
                if (index % 2 === 0) {
                    row = createRow()
                }
                insertToDom(response[index], row)
            }
            numberOfTricks = numberOfTricks+response.length;

            if (response.length < 15 ){
                loadMoreButton.style.display = "none";
            } else {
                loadMoreButton.style.display = "block";
            }
        })
        .catch((error) => {
            alert('OUPS! Une erreur est survenue pendant le chargement des tricks | code = ' + error)
        })
}

function insertToDom(data, row)
{
    let div = createElement('div');
    let a = createElement('a');
    let span = createElement('span');
    let pSpan = document.createTextNode(data.tag);
    let h2 = createElement('h2');
    let pTextNode = document.createTextNode(data.name);

    div.classList.add("card");
    div.classList.add("m-3");
    div.classList.add("p-1");
    div.classList.add("col-md");

    a.classList.add("homepage-trick-picture");
    a.classList.add("p-5");
    a.classList.add("btn");
    a.classList.add("btn-primary");
    a.href = Routing.generate('app_trick_show', {slug : data.slug})
    a.style.background = "#f3f3f3 url('pictures/tricksPictures/mains/"+data.path+"') no-repeat center center";

    span.classList.add("badge");
    span.classList.add("badge-primary");

    span.appendChild(pSpan);
    h2.appendChild(pTextNode);
    row.appendChild(div);
    div.appendChild(a);
    a.appendChild(h2);
    a.appendChild(span);

    //If the user is logged print link
    if (myProfilLink != null) {
        let divUserAction = createElement('div');
        let aDelete = createElement('a');
        let aModify = createElement('a');
        let iDelete = createElement('i');
        let iModify = createElement('i');

        divUserAction.classList.add("d-flex");
        divUserAction.classList.add("flex-row-reverse");

        aDelete.classList.add("btn");
        aDelete.classList.add("btn-danger");
        aDelete.classList.add("m-2");
        aDelete.classList.add("delete");
        iDelete.classList.add("fas");
        iDelete.classList.add("fa-trash-alt");

        aDelete.href = Routing.generate('app_trick_delete', {id : data.id})

        aModify.classList.add("btn");
        aModify.classList.add("btn-success");
        aModify.classList.add("m-2");
        iModify.classList.add("fas");
        iModify.classList.add("fa-pen");

        aModify.href = Routing.generate('app_trick_modify', {slug : data.slug})

        a.appendChild(divUserAction);
        divUserAction.appendChild(aDelete);
        divUserAction.appendChild(aModify);
        aDelete.appendChild(iDelete);
        aModify.appendChild(iModify);
    }
}

function createRow(data)
{
    let row = createElement('div')

    row.classList.add("row");

    tricks_list.appendChild(row);

    return row;
}

function createElement(name)
{
    return document.createElement(name)
}
