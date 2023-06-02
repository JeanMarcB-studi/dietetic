//STICKY CURTAIN EFFECT -----------------------------

//init necessary data
const myHead = document.querySelector("header")
let myHeadIsSticky = false;
let startPos = document.documentElement.scrollTop
let lastPos = startPos
let y

//survey for scrolling action
window.onscroll = () =>
{
  // calculate Y position
  y = document.documentElement.scrollTop
  //console.log("Y: "+y)
  if (((y - startPos) > 100) && (!myHeadIsSticky)){
    console.log("on descend, afficher header")
    // myHead.classList.add('fixed-top')
    myHeadIsVisible = false;
  } 

}