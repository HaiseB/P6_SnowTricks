let Routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router');
let Routes = require('./js_routes.json');

Routing.setRoutingData(Routes);

let trick_id = document.getElementById('comment').dataset.commentId;
let comment_list = document.getElementById('comment-list');
let picture_list = document.getElementById('picture-list');
//let video_list = document.getElementById('video-list')
let loadMoreButton = document.getElementById('load_more_button');
let numberOfComments = 0;

loadMoreButton.style.display = "none";

loadMoreButton.addEventListener('click', function (event)
{
    event.preventDefault();
    printComments()
})

$('#mytable').delegate('click', 'name^=["qty_"]', function() {
    console.log("you clicked cell #" . $(this).attr("name"));
});
document.addEventListener('DOMContentLoaded', function (event)
{
    printLinkedPictures();
    //printLinkedVideos();
    printComments()
});

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
            generatePictureTable()
            for (let index = 0; index < response.length; index++)
            {
                insertLinkedPictureToDom(response[index])
            }
            let delete_linked_pictures_button = document.getElementsByClassName('linked-picture');
            console.log(delete_linked_pictures_button)
        })
        .catch((error) => {
            alert("OUPS! Une erreur est survenue pendant le chargement des images liées | code = " + error)
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
                while (comment_list.firstChild) {
                    comment_list.removeChild(comment_list.lastChild);
                }
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

    let p = createElement('p');
    let pTextNode = document.createTextNode(data.content);
    p.appendChild(pTextNode);

    comment_list.appendChild(img);
    comment_list.appendChild($span_element);
    comment_list.appendChild(p);
}

function insertLinkedPictureToDom(data)
{
    let tr = createElement('tr');
    let th = createElement('td');
    let td = createElement('td');
    let td2 = createElement('td');
    let td3 = createElement('td');
    let a = createElement('a');
    let img = document.createElement('img');

    tr.classList.add("linked-picture");

    a.href = Routing.generate('app_trick_delete_linked_picture', {id : data.id})
    a.textContent = 'supprimer'

    img.src = '../../pictures/tricksPictures/linked/'+data.path;
    img.width = 80;
    img.height = 80;


    picture_list.firstChild.lastChild.appendChild(tr);
    th.appendChild(img)
    tr.appendChild(th);
    td.textContent = data.legend
    tr.appendChild(td);
    td2.textContent = data.createdAt
    tr.appendChild(td2);
    td3.appendChild(a)
    tr.appendChild(td3);
}

function generatePictureTable()
{
    let columns = ["apercu", "legende", "ajouté le", "supprimer"]
    generateTable(columns)
}

function generateTable(columns)
{
    let table = createElement('table');
    let thead = createElement('thead');
    let tr = createElement('tr');
    let tbody = createElement('tbody');

    table.classList.add("table");
    table.classList.add("table-hover");

    picture_list.appendChild(table);
    table.appendChild(thead);
    thead.appendChild(tr);
    for (let index = 0; index < columns.length; index++)
    {
        let th = createElement('th');
        th.textContent = columns[index]
        tr.appendChild(th);
    }
    table.appendChild(tbody);
}

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
