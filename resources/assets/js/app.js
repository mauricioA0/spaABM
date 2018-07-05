
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function () {

    $.ajaxSetup({
        cache: false
    });

    $('#page_holder').pagify({
        pages: ['_home', '_add'],
        'default': '_home'
    });

    $(window).bind('hashchange', function() {
        $('.navbar-collapse').collapse('hide'); 
        validateURL(window.location.hash);
    });

    $(document).ready(function() {
        validateURL(window.location.hash);
    });

});

function validateURL(url) {
    if (!url) {
        getAllPhotos();
    }
}

function updateCounter(elementLength) {
    $('#counter').text(elementLength);
}

function createElement(element) {
    $('#photos')
        .append(`<li id='photo-${element.id}'>
                    <img src='${element.file_path}' class='col-md-4 mt-5'>
                    ${element.description}
                    <button onclick='editPhoto(${element.id})' type='button'>Edit</button>
                    <button onclick='deletePhoto(${element.id})' type='button'>Delete</button>
                </li>`);
}

function getAllPhotos() {
    $.get(`http://${window.location.host}/api/photos/`, function (response) {
        $('#photos').empty();
        $.each(response, function (index, value) {
            createElement(value);
        });
        updateCounter(response.length);
    });
}
