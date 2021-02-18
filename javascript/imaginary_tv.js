// Elements du dom
let Tv = document.querySelector("#TV");
let blockTime = document.querySelector("#block-time");
let bouton = document.querySelector(".press-time");
let zapButton = document.querySelector("#bouton-zap");

/**
 * Fonction qui affiche la sequence avec l'ange
 */
function angelSequence() {
  let time = document.querySelector("#time");
  let enregistrement = document.querySelector(".enregistrement");

  blockTime.style.display = "block";
  enregistrement.style.display = "block";
  let i = 0;
  // Numero de la photo de l'ange
  let angelImageIteration = 1;

  let game = setInterval(function () {
    time.textContent = i++;

    zapButton.style.display = "none";

    if (i <= 10) {
      Tv.className = "angel" + angelImageIteration;
    } else if (
      i === 12 ||
      i === 22 ||
      i === 32 ||
      i === 42 ||
      i === 52 ||
      i === 62
    ) {
      time.style.color = "white";
    } else if (
      i === 11 ||
      i === 21 ||
      i === 31 ||
      i === 41 ||
      i === 51 ||
      i === 61
    ) {
      angelImageIteration++;
      Tv.className = "angel" + angelImageIteration;
      time.style.color = "red";
      // si l'image de l'ange et a 7 alors on reset l'ange
      if (angelImageIteration > 7) angelImageIteration = 1;
    } else if (i === 72) {
      time.style.color = "white";
      blockTime.style.display = "none";
      Tv.className = "game-over";
    }
    if (i > 76) {
      Tv.className = "chain-tv";
      time.style.display = "none";
      zapButton.style.display = "block";
      enregistrement.style.display ="none";
      clearInterval(game);
    }

  }, 1000);

  bouton.addEventListener("click", function (e) {
    e.preventDefault();

    if (i == 11 || i == 21 || i == 31 || i == 41 || i == 51 || i == 61) {
      clearInterval(game);
      blockTime.style.display = "none";
      Tv.className = "chain-tv";
      time.style.display = "none";
      zapButton.style.display = "block";
      enregistrement.style.display = "none";
    } else {
      time.textContent = i++;
    }
  });

}

zap = 0;

zapButton.addEventListener("click", function (e) {
  e.preventDefault();
  zap++;

  if (zap == 1) {
    Tv.className = "escalier";
  }
  if (zap == 2) {
    Tv.className = "noel";
  }
  if (zap == 3) {
    Tv.className = "niancat";
  }
  if (zap == 4) {
    Tv.className = "montana";
    
  }
  if(zap == 5){
     Tv.className = "trump";
  }
  if(zap == 6){
     Tv.className = "biden";
  }if(zap == 7) {
     zap = 0;
  }
});

let useAngel = 0;
zapButton.addEventListener("dblclick", function (e) {
  e.preventDefault();
  useAngel++;
  if (useAngel == 1) {
    angelSequence();
  }
});
