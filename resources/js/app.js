require('./bootstrap');


document.addEventListener('DOMContentLoaded', function () {
    // your code goes here
    var form = document.querySelectorAll('form');
    form.forEach(disbaleSubmitButton);
}, false);

function disbaleSubmitButton(item, index) {
    item.addEventListener('submit', () => {
        const button = item.querySelector('button[type=submit]');
        button.disabled = true;
    });
}
