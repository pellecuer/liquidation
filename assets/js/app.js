// loads the jquery package from node_modules
//var $ = require('jquery');
import $ from 'jquery';
import '../css/app.scss';

// import the function from greet.js (the .js extension is optional)
// ./ (or ../) means to look for a local file
var greet = require('./greet');

$(document).ready(function() {
    $('body').prepend('<p>'+greet('David')+'</p>');
});