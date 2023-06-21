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

// /note/{idRecette}{note}{message}'

// const url="http://localhost/PHP/symfo_diete/note/"
// const url="https://127.0.0.1:8000/note2/"
const url="https://127.0.0.1:8000/tata/"

const bton = document.querySelector("#send")

bton.addEventListener('click', (e) => {
  console.log('click')
  // e.target.classList.add('btonQuarterSelected')
  console.log('URL: '+url)
  
  
  // ----------------------------------------- FETCH POST QUI FONCTIONNE ? --------
  
  let hh = new Headers();
  
  let data = JSON.stringify({
    id: '117',
    name:"yy"
  //   idRec: '1',
  //   note: '3',
  //  message: 'coucou',
  })

//POST

var request = new Request(url, {
  method: 'POST',
  body: data,
  headers: hh
});

fetch(request)
.then(response => response.json())
.then(response => console.log(JSON.stringify(response)))
.catch(error => console.log("Erreur : " + error));

})
