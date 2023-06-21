// //STICKY CURTAIN EFFECT -----------------------------

// //init necessary data
// const myHead = document.querySelector("header")
// let myHeadIsSticky = false;
// let startPos = document.documentElement.scrollTop
// let lastPos = startPos
// let y

// //survey for scrolling action
// window.onscroll = () =>
// {
//   // calculate Y position
//   y = document.documentElement.scrollTop
//   //console.log("Y: "+y)
//   if (((y - startPos) > 100) && (!myHeadIsSticky)){
//     console.log("on descend, afficher header")
//     // myHead.classList.add('fixed-top')
//     myHeadIsVisible = false;
//   } 

// }
console.log("start engine")

const url="https://127.0.0.1:8000/note/"
const bton = document.querySelector("#send")

bton.addEventListener('click', (e) => {
  console.log('click')
  // e.target.classList.add('btonQuarterSelected')
  
  let data = JSON.stringify({
    id: 'oss117',
    name:"yyY"
  })

var request = new Request(url, {
  method: 'POST',
  body: data,
  headers: new Headers()
});

fetch(request)
.then(response => response.json())

// RETURN DATA IS OK
.then(response => {
  console.log(response.id + " " + response.name)
})

//IF ERROR
.catch(error => console.log("Erreur : " + error));
})
