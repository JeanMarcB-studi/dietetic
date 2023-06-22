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
const idReceipe = parseInt(document.querySelector("#numReceipe").textContent)
console.log("num : "+idReceipe)

const url="https://127.0.0.1:8000/note/"
const sendButton = document.querySelector("#send")
const adrNote = document.querySelector("#note")
const adrMess = document.querySelector("#message")
// const myData = document.querySelector("#myData")

// document.addEventListener('DOMContentLoaded', function() {
//   // get receipe details
//   receipe = JSON.parse(myData.dataset.receipe)
// })


sendButton.addEventListener('click', (e) => {
  console.log('click')
  // e.target.classList.add('btonQuarterSelected')
  
console.log (adrMess.value)

  let data = JSON.stringify({
    idReceipe: idReceipe,
    // receipe: receipe,
    note: valNote,
    message: adrMess.value
  })
console.log("idReceipe: " + idReceipe)

var request = new Request(url, {
  method: 'POST',
  body: data,
  headers: new Headers()
});

fetch(request)
.then(response => response.json())

// RETURN DATA IS OK
.then(response => {
  console.log(response.status + " " + response.message)
})

//IF ERROR
.catch(error => console.log("Erreur : " + error));
})


const adrStars = document.querySelectorAll(".star")
let valNote = 0

adrStars.forEach(star => {

  star.addEventListener('click', (e) => {
    console.log('star' + e.target.dataset.value)
    choiceNum = e.target.dataset.value
    valNote = choiceNum
    adrStars.forEach(star => {
      if (star.dataset.value <= choiceNum)
        { 
          star.classList.add('bi-star-fill','starSelected') 
          star.classList.remove('bi-star')
        }
        else
        {
          star.classList.add('bi-star') 
          star.classList.remove('bi-star-fill','starSelected')
        }
    })
  })

})
