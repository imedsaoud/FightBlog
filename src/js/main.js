var newCom = document.querySelector('.reply');
var formCom = document.querySelector('.comSend');

newCom.addEventListener('click', function () {
    formCom.classList.toggle('formOpen');
    console.log('hello');
})

var newSubj = document.querySelector('.start');
var subjform = document.querySelector('.formSend');

newSubj.addEventListener('click' , function () {
    subjform.classList.toggle('formOpen');
})


