let Routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router');
let Routes = require('./js_routes.json');

Routing.setRoutingData(Routes);

let trick_id = document.getElementById('comment').dataset.commentId;
let trick_slug = window.location.pathname.split('/')[2];
let comment_list = document.getElementById('comment-list');
let loadMoreButton = document.getElementById('load_more_button');
let numberOfComments = 0;
let comment_form = document.getElementsByName('comment_form');

loadMoreButton.style.display = "none";

loadMoreButton.addEventListener('click', function (event)
{
    event.preventDefault();
    printComments()
});

document.addEventListener('DOMContentLoaded', function (event)
{
    printComments()
});

function printComments()
{
    new Promise(function(resolve, reject)
    {
        let url = Routing.generate('app_comment_show', {trick : trick_id, offset : numberOfComments});
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
            if (numberOfComments === 0) {
                while (comment_list.firstChild) {
                    comment_list.removeChild(comment_list.lastChild);
                }
            }

            for (let index = 0; index < response.length; index++)
            {
                insertToDom(response[index])
            }
            numberOfComments = numberOfComments+response.length;

            if (response.length < 20 ){
                loadMoreButton.style.display = "none";
            } else {
                loadMoreButton.style.display = "block";
            }
        })
        .catch((error) => {
            alert('OUPS! Une erreur est survenue pendant le chargement des commentaires | code = ' + error)
        })
}

function insertToDom(data)
{
    let $span_element = createElement('span');
    let $strong_element = createElement('strong');
    let textNode = document.createTextNode(' ' + data.user.username + ' - ' + data.createdAt);
    //profil picture
    let img = getProfilPicture(data);

    $strong_element.appendChild(textNode);
    $span_element.appendChild($strong_element);

    //comment content
    let p = createElement('p');
    let pTextNode = document.createTextNode(data.content);
    p.appendChild(pTextNode);

    // add all elements to the comment_list
    comment_list.appendChild(img);
    comment_list.appendChild($span_element);
    comment_list.appendChild(p);
}

function createElement(name)
{
    return document.createElement(name)
}

function refreshCommentList()
{
    numberOfComments = 0;
    printComments()
}

comment_form[0].addEventListener('submit', function (event)
{
    event.preventDefault()
    new Promise( function (resolve, reject)
    {
        let url = Routing.generate('app_trick_show', {slug : trick_slug});
        let xhr = new XMLHttpRequest();
        let formData = new FormData(comment_form[0]);

        xhr.open('POST', url);
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
        xhr.send(formData)
    })
        .then ((response) => {
            comment_form[0].reset();
            refreshCommentList()
        })
        .catch((error) => {
            alert('OUPS! Une erreur est survenue pendant la création du commentaire || code => ' + error)
        })
});

function getStartPathProfilePicture()
{
    const url = window.location.href;
    const word = 'modify';

    return url.includes(word) ? '../../' : '../';
}

function getProfilPicture(data)
{
    let startPath = getStartPathProfilePicture();
    let img = document.createElement('img');

    if (data.user.picturePath === null){
        img.src = startPath+'pictures/profilPictures/defaultProfilPicture.png';
    } else {
        img.src = startPath+'pictures/profilPictures/'+data.user.picturePath;
    }

    img.width = 30;
    img.height = 30;
    img.classList.add("rounded-circle");

    return img
}
