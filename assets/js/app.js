/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

let Routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router');
let Routes = require('./js_routes.json');

Routing.setRoutingData(Routes);

let trick_id = document.getElementById('comment').dataset.commentId;
let comment_list = document.getElementById('comment-list');
let comment_form = document.getElementsByName('comment_form');
let loadMoreButton = document.getElementById('load_more_button');
let numberOfComments = 0;

loadMoreButton.style.display = "none";

comment_form[0].addEventListener('submit', function (event)
{
    event.preventDefault()
    new Promise( function (resolve, reject)
    {
        let url = Routing.generate('app_trick_show', {id : trick_id});
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
        })
        .catch((error) => {
            alert('OUPS! Une erreur est survenue pendant la création du commentaire | code = ' + error)
        })
});

loadMoreButton.addEventListener('click', function (event)
{
    event.preventDefault()
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
                comment_list.children[0].remove();
            }

            loadMoreButton.style.display = "block";

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
    let textNode = document.createTextNode(data.user.username + ' - ' + data.createdAt);

    $strong_element.appendChild(textNode);
    $span_element.appendChild($strong_element);

    //message content
    let p = createElement('p');
    let pTextNode = document.createTextNode(data.content);
    p.appendChild(pTextNode);

    // add all elements to the comment_list in the right order
    comment_list.appendChild($span_element);
    comment_list.appendChild(p);
    comment_list.appendChild(createElement('hr'))
}

function createElement(name)
{
    return document.createElement(name)
}