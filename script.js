function toggleMenu() {
    var menu = document.querySelector('#conteudoMenuMobile');
    if (menu.style.display === 'none') {
      menu.style.display = 'flex';
    } else {
      menu.style.display = 'none';
    }
  }
  