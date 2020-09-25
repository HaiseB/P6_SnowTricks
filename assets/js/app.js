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

console.log(comment_list);

document.addEventListener('DOMContentLoaded', function (event)
{
    new Promise(function(resolve, reject)
    {
        let url = Routing.generate('app_comment_show', {trick : trick_id});
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
            comment_list.children[0].remove();

            for (let index = 0; index < response.length; index++)
            {
                insertToDom(response[index])
            }
        })
        .catch((error) => {
            console.log('ERROR')
        })
});

function insertToDom(data)
{
    let $span_element = createElement('span')
    let $strong_element = createElement('strong')
    let textNode = document.createTextNode(data.user.username + ' - ' + data.createdAt)

    $strong_element.appendChild(textNode)
    $span_element.appendChild($strong_element)

    //message content
    let p = createElement('p')
    let pTextNode = document.createTextNode(data.content)
    p.appendChild(pTextNode)

    // add all elements to the comment_list in the right order
    comment_list.appendChild($span_element)
    comment_list.appendChild(p)
    comment_list.appendChild(createElement('hr'))
}

function createElement(name)
{
    return document.createElement(name)
}