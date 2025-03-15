const abmod=document.querySelector("#ingmod");
const cemod=document.querySelector("#botsalir");
const modal=document.querySelector("#popup");

abmod.addEventListener("click",()=>{
    modal.showModal();
})
cemod.addEventListener("click",()=>{
    modal.close();
})