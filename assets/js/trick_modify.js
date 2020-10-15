let Routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router');
let Routes = require('./js_routes.json');

Routing.setRoutingData(Routes);

let trick_id = document.getElementById('comment').dataset.commentId;
let comment_list = document.getElementById('comment-list');
let main_picture = document.getElementById('main-picture');
let picture_list = document.getElementById('picture-list');
let video_list = document.getElementById('picture-list');
let loadMoreButton = document.getElementById('load_more_button');
let numberOfComments = 0;

loadMoreButton.style.display = "none";

loadMoreButton.addEventListener('click', function (event)
{
    event.preventDefault();
    printComments()
});

document.addEventListener('DOMContentLoaded', function (event)
{
    printMainPicture();
    printLinkedPictures();
    printLinkedVideos();
    printComments()
});

function printLinkedVideos()
{

}

function printLinkedPictures()
{
    new Promise(function(resolve, reject)
    {
        let url = Routing.generate('app_pictures_show', {trick : trick_id});
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
            completeRemove(picture_list);
            for (let index = 0; index < response.length; index++)
            {
                //insertLinkedPictureToDom(response[index])
            }
        })
        .catch((error) => {
            alert("OUPS! Une erreur est survenue pendant le chargement des images liées | code = " + error)
        })
}

function printMainPicture()
{
    new Promise(function(resolve, reject)
    {
        let url = Routing.generate('app_main_picture_show', {trick : trick_id});
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
            completeRemove(main_picture);
            //insertMainPictureToDom(response[0])
        })
        .catch((error) => {
            alert("OUPS! Une erreur est survenue pendant le chargement de l'image principale | code = " + error)
        })
}

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
                completeRemove(numberOfComments);
            }

            for (let index = 0; index < response.length; index++)
            {
                insertCommentsToDom(response[index])
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

function insertCommentsToDom(data)
{
    let $span_element = createElement('span');
    let $strong_element = createElement('strong');
    let textNode = document.createTextNode(' ' + data.user.username + ' - ' + data.createdAt);
    //profil picture
    let img = document.createElement('img');
    if (data.user.picturePath === null){
        img.src = '../../pictures/profilPictures/defaultProfilPicture.png';
    } else {
        img.src = '../../pictures/profilPictures/'+data.user.picturePath;
    }
    img.width = 30;
    img.height = 30;
    img.classList.add("rounded-circle");

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

/*function insertMainPictureToDom(data)
{
    let img = document.createElement('img');
    let $span_element = createElement('span');
    let textNode = document.createTextNode('data.legend');

    img.src = '../../pictures/tricksPictures/mains/'+data.path;
    img.width = 700;
    img.height = 600;

    main_picture.appendChild(img);
    comment_list.appendChild($span_element);
}*/

/*function insertLinkedPictureToDom(data)
{
    let p = createElement('p');
    let $span_element = createElement('span');
    let textNode = document.createTextNode('data.legend');

    let img = document.createElement('img');

    img.src = '../../pictures/tricksPictures/linked/'+data.path;
    img.width = 80;
    img.height = 80;

    main_picture.appendChild(img);
    comment_list.appendChild(p);

    let p = createElement('p');
    let pTextNode = document.createTextNode(data.content);
    p.appendChild(pTextNode);

    comment_list.appendChild($span_element);
    comment_list.appendChild(p);
}*/

function createElement(name)
{
    return document.createElement(name)
}

function completeRemove(element)
{
    while (element.firstChild) {
        element.removeChild(element.lastChild);
    }
}
