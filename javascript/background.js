var currentEtat = 'small';

function changeStat(etat, checkBig) {
    if (checkBig && currentEtat == 'big' && etat == 'normal') {
        return;
    }

    if (etat == 'small') {
        getSmallPageState();
    } else if (etat == 'normal') {
        getNormalPageState();
    } else if (etat == 'big') {
        getBigPageState();
    }

    currentEtat = etat;
}

function getSmallPageState() {
    // header
    document.getElementById("widget").classList.remove("normal");
    document.getElementById("widget").classList.remove("big");
    document.getElementById("widget").classList.add("small");
    
    // body
    document.getElementById("body-display").classList.remove("normal-body");
    document.getElementById("body-display").classList.remove("big-body");
    document.getElementById("body-display").classList.add("small-body");

    // button
    document.getElementById("icon-close").classList.remove("icon-show");    
    document.getElementById("icon-openbig").classList.remove("icon-show");    
    document.getElementById("icon-closebig").classList.remove("icon-show");    
}

function getNormalPageState() {
    // header    
    document.getElementById("widget").classList.remove("big");
    document.getElementById("widget").classList.remove("small");
    document.getElementById("widget").classList.add("normal");

    // body
    document.getElementById("body-display").classList.remove("small-body");
    document.getElementById("body-display").classList.remove("big-body");
    document.getElementById("body-display").classList.add("normal-body");

    // button    
    document.getElementById("icon-close").classList.add("icon-show");
    document.getElementById("icon-openbig").classList.add("icon-show");    
    document.getElementById("icon-closebig").classList.remove("icon-show");
    
    getMessages(500);
}

function getBigPageState() {
    // header
    document.getElementById("widget").classList.remove("normal");
    document.getElementById("widget").classList.remove("small");
    document.getElementById("widget").classList.add("big");

    // body
    document.getElementById("body-display").classList.remove("normal-body");
    document.getElementById("body-display").classList.remove("bismallg-body");
    document.getElementById("body-display").classList.add("big-body");

    // button    
    document.getElementById("icon-close").classList.add("icon-show");
    document.getElementById("icon-openbig").classList.remove("icon-show");    
    document.getElementById("icon-closebig").classList.add("icon-show");

    getMessages(500);
}

/**
 * Il nous faut une fonction pour récupérer le JSON des
 * messages et les afficher correctement
 */
function getMessages(timeoutScroll){
  // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier backgroundhandler.php
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open("GET", "backgroundhandler.php");

  var userId = document.getElementById("idPhp").getAttribute("name");

  // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
  requeteAjax.onload = function(){
    const resultat = JSON.parse(requeteAjax.responseText);
    const html = resultat.reverse().map(function(message){
      var classMessage = message.id_joueur == userId ? 'message owner': 'message';

      const monthNames = ["janv.", "févr.", "mars", "avr.", "mai", "juin",
          "juill.", "août", "sept.", "oct.", "nov.", "déc."
      ];
      var day = message.created_at.substring(8, 10) + " " + monthNames[message.created_at.substring(6, 7) - 1];
      var bgColor = message.color;
      var color = pickTextColorBasedOnBgColorSimple(message.color, "#FFF", "#000");
      return `
        <div class="${classMessage}">
          <div class="message-photo">
              <img src=${message.image} style="width: 35px;height: 35px;border-radius: 20px; border: 2px solid ${bgColor};" />
          </div>
          <div class="message-content">
              <div class="author">${message.surnom}</div>
              <div class="content" style="background-color: ${bgColor};color:${color}">${message.content}</div>
          </div>
          <div class="message-date">
              <span class="date">${message.created_at.substring(11, 16)}</span>
              <span class="date">${day}</span>
          </div>
        </div>
      `
    }).join('');

    const messages = document.querySelector('.messages');

    messages.innerHTML = html;
    setTimeout(ResetScroll, timeoutScroll);
  }

  // 3. On envoie la requête
  requeteAjax.send();
}

function pickTextColorBasedOnBgColorSimple(bgColor, lightColor, darkColor) {
    var color = (bgColor.charAt(0) === '#') ? bgColor.substring(1, 7) : bgColor;
    var r = parseInt(color.substring(0, 2), 16); // hexToR
    var g = parseInt(color.substring(2, 4), 16); // hexToG
    var b = parseInt(color.substring(4, 6), 16); // hexToB
    return (((r * 0.299) + (g * 0.587) + (b * 0.114)) > 186) ?
      darkColor : lightColor;
}
  
function ResetScroll() {
    var divForScroll = document.querySelector(".messages");
    divForScroll.scrollTop = divForScroll.scrollHeight;
}

/**
 * Il nous faut une fonction pour envoyer le nouveau
 * message au serveur et rafraichir les messages
 */  
function postMessage(event){
  console.log("postMessage");
  // 1. Elle doit stoper le submit du formulaire
  event.preventDefault();

  // 2. Elle doit récupérer les données du formulaire
  const author = document.querySelector('#joueur_id');
  const content = document.querySelector('#content');
  $('#submit').attr('disabled', 'disabled');
  
  // 3. Elle doit conditionner les données
  const data = new FormData();
  data.append('joueur_id', author.value);
  data.append('content', content.value);

  // 4. Elle doit configurer une requête ajax en POST et envoyer les données
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open('POST', 'backgroundhandler.php?task=write');
  
  requeteAjax.onload = function(){
    content.value = '';
    content.focus();
    getMessages(0);
  }

  requeteAjax.send(data);
}
  
document.querySelector('form').addEventListener('submit', postMessage);
  
const interval = window.setInterval(getMessages, 20000);

$(document).ready(function() {
  $('#content').on('keyup', function() {
      let empty = false;

      $('#content').each(function() {
          empty = $(this).val().length == 0;
      });

      console.log(empty);
      if (empty)
      $('#submit').attr('disabled', 'disabled');
      else
      $('#submit').attr('disabled', false);
  });
});