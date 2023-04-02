//Get the element using the element ID
var modal = document.getElementById('helpModal');
// Get open button
var modalBtn = document.getElementById('modalBtn');
//get close button
var closeBtn = document.getElementsByClassName('closeBtn')[0];

//listen for the open click
modalBtn.addEventListener('click', openModal);

//listen for  close click
closeBtn.addEventListener('click', closeModal);

//listen for outside click
window.addEventListener('click', outsideClick);


//creating a function to open a modal
function openModal(){
    modal.style.display = 'block';
}

//creating a function to close a modal
function closeModal(){
    modal.style.display = 'none'
}

//creating a function to close modal using the page
function outsideClick(x){
    if(x.target == modal){
        modal.style.display = 'none'
    }
}


