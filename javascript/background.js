function openForm() {
    document.getElementById("myForm").classList.remove("small-popup");
    document.getElementById("myForm").classList.add("normal-popup");
  }
  
  function closeForm() {
    document.getElementById("myForm").classList.remove("normal-popup");
    document.getElementById("myForm").classList.add("small-popup");
  }

function changeStat(etat) {
    console.log(etat);
    if (etat == 'small') {
        getSmallPageState();
    } else if (etat == 'normal') {
        getNormalPageState();
    } else if (etat == 'big') {
        getBigPageState();
    }
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
}
