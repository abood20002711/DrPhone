// Visable passwords in input fields
function visibili(){
    var hidden=document.getElementById("password");
    if(hidden.getAttribute("type") === "password"){
        hidden.setAttribute("type", "text");
        document.getElementById("hide").classList.remove("fa-eye");
        document.getElementById("hide").classList.add("fa-eye-slash");
    } 
    else {
        hidden.setAttribute("type", "password");
        document.getElementById("hide").classList.remove("fa-eye-slash");
        document.getElementById("hide").classList.add("fa-eye");
    }
};

// form registertions
function validateForm(){
    var paw1=document.getElementById("password").value;
    var paw2=document.getElementById("Confirm").value;

//minimum password length validation  

if (paw1.length < 8 ){
    document.getElementById("msg1").innerHTML="password must be at least 8";
    return false;
}
if (paw1 != paw2){
    document.getElementById("msg2").innerHTML="password not same";
    return false;
}
}


// ============ clrear filed ==============
function clear_fild(){
    var fid=document.getElementById("search").value;
    if (fid != ""){
        document.getElementById("search").value="";
    }
}

// ============ Hamburger =============
let hamburger = document.getElementById("hamburger");

function active(){
    if (hamburger.classList.contains("is-active")){
        hamburger.classList.remove("is-active");
    }
    else{
        hamburger.classList.add("is-active");
    }
}

// ============ = Sub Menu =============
let Menu=document.querySelector(".menu-main");
let title=document.querySelector(".currnet-menu-title");
let back=document.querySelector(".go-back");
let close=document.querySelector(".close-menu");
let opnebar=document.querySelector(".hamburger");
let SubMenu;
Menu.addEventListener("click", e => {
    if(e.target.closest(".has-children")){
        const hasChild=e.target.closest(".has-children");
        ShowSubMenu(hasChild);
    }
});
function ShowSubMenu(hasChild){
    SubMenu=hasChild.querySelector(".sub-menu");
    SubMenu.classList.add("active");
    // SubMenu.style.animation = "slideLeft 0.5s ease forwards";
    let MenuTitle=hasChild.querySelector("a").textContent;
    title.textContent=MenuTitle;
    document.querySelector(".mobile-menu-head").classList.add("active");
}
back.addEventListener("click", (e)=> {
    HideSubMenu();
}) 
function HideSubMenu(){
    // SubMenu.style.animation = "slide  0.5s ease forwards";
    // setTimeout(()=>{
        SubMenu.classList.remove("active");
    // },300)
    title.textContent="Shop";
    document.querySelector(".mobile-menu-head").classList.remove("active");
}
window.onresize=function(){
    if(this.innerWidth > 950){
        if (Menu.classList.contains("active")){
            togglemenu();
        }
    }
}
opnebar.addEventListener("click", (e)=>{
    togglemenu();
})
close.addEventListener("click", (e)=>{
    togglemenu();
})
document.querySelector(".overlay").addEventListener("click", (e)=>{
togglemenu();
})
function togglemenu(){
    Menu.classList.toggle("active");
    document.querySelector(".overlay").classList.toggle("active");
}
// ============ Show Drop Down =============
let dropDown= document.querySelector(".dropdown");
function shoowDropDown(){
    if(dropDown.classList.contains("active")){
        dropDown.classList.remove("active");
    }
    else{
        dropDown.classList.add("active");
    }
}
// ============ slider =============
const dots=document.querySelectorAll(".dot");
console.log(dots);
window.addEventListener("load",()=>{
autoSlide();
})

function autoSlide(){
    setInterval (()=>{
        slide(getItemsActiveIndex() + 1);
    },2500);
}

function slide(toIndex){
        const itemArray=Array.from(document.querySelectorAll(".slider-item"));
        const itemActive=document.querySelector(".item-active");

        if(toIndex >= itemArray.length){
            toIndex = 0;
        }
        const newItemActive=itemArray[toIndex];
        newItemActive.classList.add("item-active-pos-next");
        setTimeout ( () => {
            newItemActive.classList.add("item-active-next");
            itemActive.classList.add("item-active-next");
            
      
        },20);

        newItemActive.addEventListener("transitionend",()=>{
            itemActive.className="slider-item";
            newItemActive.className="slider-item item-active";
            dots[toIndex].classList=" dot dot-active"
            
        },{
            once:true
        });
         slideIndicator(toIndex);
}
function getItemsActiveIndex(){
    const itemArray=Array.from(document.querySelectorAll(".slider-item"));
    const itemActive=document.querySelector(".item-active");
    const itemActiveInedx=itemArray.indexOf(itemActive);
    return itemActiveInedx;
}


function slideIndicator(toIndex) {
   const dots = document.querySelectorAll(".dot");
   const dotActive = document.querySelector(".dot-active");
   const newDotActive = dots[toIndex];

   dotActive.classList.remove("dot-active");
   newDotActive.classList.add("dot-active");
}


// ================== Show profile menu =================


// ================== Show profile menu in Dashborad =================
    