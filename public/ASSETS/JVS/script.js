
console.log("start engine")

const idReceipe = parseInt(document.querySelector("#numReceipe").textContent)

const url="https://127.0.0.1:8000/note/"
const adrNote = document.querySelector("#note")
const adrMess = document.querySelector("#message")
const adrErr  = document.querySelector("#msgErr")
const adrIngr = document.querySelector("#ingredients")
const adrPrep = document.querySelector("#preparation")
const adrStars = document.querySelectorAll(".star")

const myData = document.querySelector("#myData")
let sendButton

function handleClick() {
  sendNote();
}


document.addEventListener('DOMContentLoaded', function() {
  //  notenote = JSON.parse(myData.dataset.receipe)
  valNote = myData.dataset.note
  console.log("note: "+valNote)

  ingredients = JSON.parse(myData.dataset.ingredients)
  details = ingredients.split("\r\n")
  for (elt of details){
    let li = document.createElement('li') 
    li.append(elt.trim())
    adrIngr.append(li)    
  }
  
  preparation = JSON.parse(myData.dataset.preparation)
  details = preparation.split("\r\n")
  for (elt of details){
    let li = document.createElement('li') 
    li.append(elt.trim())
    adrPrep.append(li)    
  }


  
  if (valNote == 0){
    // NO NOTE HAVE BEEN CREATED BY THE USER
    starsPrepare()
    sendButton = document.querySelector("#send")
    sendButton.addEventListener('click', handleClick)
  }
  else
  {
    // A NOTE ALREADY EXISTS
    console.log("starsShow" );
    starsShow()
  }
})



// ..... SEND A NOTE FOR RECORDING IT .........................................
// sendButton.addEventListener('click', (e) => {
//   sendNote()
// })

let sendNote = () => {
  //Suppress the button action
  sendButton.classList.add("hidden")
  sendButton.removeEventListener('click', handleClick)
  console.log('click ENVOI')
  
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

  // RETURN DATA IS OK?
  .then(response => {
    console.log(response.status + " " + response.message)
    if (response.status != false){
      
      // It's OK
      adrErr.textContent = "Note enregistrée : merci !"
    } else {

      // We've got an error
      adrErr.textContent = response.message
      sendButton.addEventListener('click', handleClick)
      sendButton.classList.remove("hidden")
    } 
})

//IF ERROR
.catch(error => console.log("Erreur : " + error));
}



//..... MANAGE STARS CHOICE .................................................

let starsPrepare = () => {

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
}

let starsShow = () => {
  console.log("afficher note : "+valNote)
  adrStars.forEach(star => {
    if (star.dataset.value <= valNote)
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
}