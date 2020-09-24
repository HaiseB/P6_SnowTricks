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

let Routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router')
let Routes = require('./js_routes.json')

Routing.setRoutingData(Routes)

let trick_id = document.getElementById('comment').dataset.commentId

document.addEventListener('DOMContentLoaded', function (event){
    let url = Routing.generate('app_comment_show', {trick : trick_id})
    console.log(url)
})