const PHOTOS = document.querySelectorAll(".photo img");
var myModal = new bootstrap.Modal(document.getElementById('dupcia'), {
    keyboard: false
})

PHOTOS.forEach((photo)=>{
    photo.addEventListener("click",()=>{
        myModal.show();
    })
})