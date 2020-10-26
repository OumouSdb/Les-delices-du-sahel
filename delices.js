let presentation = document.getElementById('presentation');
  let plats = document.getElementById('plats');
  let dessert = document.getElementById('dessert');
  let cocktail = document.getElementById('cocktail');
  let nav = document.getElementsByClassName('navbar-collapse.in');
  
  function introduction(){
  presentation.textContent = "Ce blog de cuisine vous fera voyager à travers l'Afrique de l'Ouest";
  
  }
  
  setTimeout('introduction()', 3000);
  
  function plat(){
  presentation.textContent = " Nous vous proposons plusieurs recettes, des bons petits plats tel que le Tieb et plus encore";
  plats.className = 'animate__animated animate__flash';
  }
  setTimeout('plat()', 6000);
  
  function desserts(){
  presentation.textContent = " Nos desserts ! Même pour les yeux, c'est un régal, essayez vous succomberez";
  dessert.className = 'animate__animated animate__flash';
  }
  setTimeout('desserts()', 9000);
  
  function cocktails(){
  presentation.textContent = "Ici on ne boit pas, on savoure !";
  cocktail.className = 'animate__animated animate__flash';
  }
  setTimeout('cocktails()', 12000);
  
  function fin(){
   presentation.textContent = 'Quand y\'en a plus, y\'en a encore, suivez moi sur Youtube pour encore plus de recettes !';
  }
  setTimeout('fin()', 14000);