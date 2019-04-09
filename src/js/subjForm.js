var newSubj = document.querySelector('.start');
var subjForm = document.querySelector('.formSend');

newSubj.addEventListener('click' , function () {
    subjForm.classList.toggle('formOpen');
})