/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
import '../css/bootstrap.min.css';
import '../css/trick_show.css';
import '../css/homepage.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

$(document).ready(function(){
    $("a.delete").click(function(e){
        if(!confirm('Voulez-vous confirmer la suppression?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});

$('.custom-file-input').on('change', function(event) {
    var inputFile = event.currentTarget;
    $(inputFile).parent()
        .find('.custom-file-label')
        .html(inputFile.files[0].name);
});