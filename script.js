function toggleMenu() {
    var menu = document.querySelector('#conteudoMenuMobile');
    if (menu.style.display === 'none') {
      menu.style.display = 'flex';
    } else {
      menu.style.display = 'none';
    }
  }

 
  var imagem1 = document.getElementById('img1')
  var imagem2 = document.getElementById('img2')
  var imagem3 = document.getElementById('img3')
  var imagem4 = document.getElementById('img4')
  var imagem5 = document.getElementById('img5')
  

  imagem1.addEventListener('click' , function(){
 
    imagem1.style.opacity = '0.3'
    imagem2.style.opacity = '1'
    imagem3.style.opacity = '1'
    imagem4.style.opacity = '1'
    imagem5.style.opacity = '1'

  })


  imagem2.addEventListener('click' , function(){
 
    imagem1.style.opacity = '1'
    imagem2.style.opacity = '0.3'
    imagem3.style.opacity = '1'
    imagem4.style.opacity = '1'
    imagem5.style.opacity = '1'

  })


  
  imagem3.addEventListener('click' , function(){
 
    imagem1.style.opacity = '1'
    imagem2.style.opacity = '1'
    imagem3.style.opacity = '0.3'
    imagem4.style.opacity = '1'
    imagem5.style.opacity = '1'

  })


  
  imagem4.addEventListener('click' , function(){
 
    imagem1.style.opacity = '1'
    imagem2.style.opacity = '1'
    imagem3.style.opacity = '1'
    imagem4.style.opacity = '0.3'
    imagem5.style.opacity = '1'

  })

 
  imagem5.addEventListener('click' , function(){
 
    imagem1.style.opacity = '1'
    imagem2.style.opacity = '1'
    imagem3.style.opacity = '1'
    imagem4.style.opacity = '1'
    imagem5.style.opacity = '0.3'

    


  })


  
  
  