// script.js

alert('Welcome to Strathmore');
document.addEventListener('DOMContentLoaded', function () {
    // DOMContentLoaded event ensures that the script runs after the HTML has been completely loaded

    // Select the header element
    var header = document.querySelector('header h1');

    // Change the color of the header to red
    header.style.color = 'red';
});