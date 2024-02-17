/*

var produtos = document.querySelectorAll('.container');
var Lanches = document.querySelectorAll('.container2');
var Pasteis = document.querySelectorAll('.container3');
var Batatas = document.querySelectorAll('.container4');
var Doces = document.querySelectorAll('.container5');

function esconder(elemento){
  elemento.forEach(element => {

    element.style.display = 'none'
      
  });
}


document.getElementById('img5').addEventListener('click' , function(){
    
  
    produtos.forEach(function(element) {
    if(element.style.display == 'none'){
      element.style.display = 'inline-block'; 
    }else{
      element.style.display = 'none'; 
    }
   
    });

  esconder(Doces)
  esconder(Lanches)
  esconder(Pasteis)
  esconder(Batatas)
})




document.getElementById('img2').addEventListener('click' , function(){

    Lanches.forEach(function(element) {
    if(element.style.display == 'none'){
      element.style.display = 'inline-block'; 
    }else{
      element.style.display = 'none'; 
    }
   
    });

  esconder(produtos)
  esconder(Doces)
  esconder(Pasteis)
  esconder(Batatas)
})


document.getElementById('img3').addEventListener('click' , function(){

Pasteis.forEach(function(element) {
if(element.style.display == 'none'){
  element.style.display = 'inline-block'; 
}else{
  element.style.display = 'none'; 
}

});

  esconder(produtos)
  esconder(Lanches)
  esconder(Doces)
  esconder(Batatas)

})


document.getElementById('img1').addEventListener('click' , function(){

Batatas.forEach(function(element) {
if(element.style.display == 'none'){
  element.style.display = 'inline-block'; 
}else{
  element.style.display = 'none'; 
}

});

  esconder(produtos)
  esconder(Lanches)
  esconder(Pasteis)
  esconder(Doces)
})


document.getElementById('img4').addEventListener('click' , function(){

  Doces.forEach(function(element){
  if(element.style.display == 'none'){
    element.style.display = 'inline-block'; 
}else{
  element.style.display = 'none'; 
  
}


  })

  esconder(produtos)
  esconder(Lanches)
  esconder(Pasteis)
  esconder(Batatas)

 
}



)




 var btnCarrinho = document.querySelectorAll('.btn.btn-danger');
  var carrinho = document.getElementById('produtosNoCarrinho');
  var totalDoCarrinho = document.getElementById("totalCompra");
  var contador = 0;

 

  btnCarrinho.forEach(element => {
      element.addEventListener('click', function(){
        // Obtenha o ID do produto a partir do botão clicado
        var idDoProduto = element.getAttribute('data-id-produto');
        // Use o ID do produto para acessar o elemento correspondente
        var produtosDaLoja = document.getElementById("produto" + idDoProduto);
        
        var nomeDoProduto = produtosDaLoja.querySelector('.card-title').textContent;
        var imgDoProduto = produtosDaLoja.querySelector('.col-md-4 img').getAttribute('src');
        var precoDoProduto = parseFloat(produtosDaLoja.querySelector('.card-subtitle').textContent);
        var descricao = produtosDaLoja.querySelector('.card-text').textContent;


carrinho.innerHTML += `
        <li>
          <div class="card mb-3" style="max-width: 400px;" >
            <div class="row g-0">
              <div class="col-md-4">
                <img src="${imgDoProduto}" class="img-fluid rounded-start" alt="Product Image">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">${nomeDoProduto}</h5>
                  <p class="card-text">${descricao}</p>
                  <p class="card-subtitle"><small class="text-muted">${precoDoProduto}</small></p>
                  <p class="card-text"><button type="button" class="btn btn-danger" onclick="removerProduto()">Remover</button></p>
                </div>
              </div>
            </div>
          </div>
        </li>`;


alert("Produto adicionado no carrinho: " + nomeDoProduto);


contador+= precoDoProduto
console.log(contador)


totalDoCarrinho.textContent = "R$" + contador.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
  



 
      });

      
  });

  function removerProduto(){
    var produtosNoCarrinho = document.querySelectorAll('#produtosNoCarrinho li');

    // Verifique se há itens no carrinho antes de prosseguir
    if (produtosNoCarrinho.length === 0) {
        alert('Carrinho vazio!');
        return;
    }

    // Encontre o último item no carrinho e remova-o
    var ultimoItem = produtosNoCarrinho[produtosNoCarrinho.length - 1];
    var precoDoUltimoItem = parseFloat(ultimoItem.querySelector('.card-subtitle').textContent);

    // Atualize o total e remova o item do DOM
    contador -= precoDoUltimoItem;
    ultimoItem.remove();

    // Atualize o total do carrinho exibindo-o novamente na página
    totalDoCarrinho.textContent = "R$" + contador.toLocaleString('pt-BR', { minimumFractionDigits: 2 });

}


  btnComprar = document.querySelectorAll('li .btn.btn-danger').forEach(removerProduto)


  console.log(produtosNoCarrinho)

 


*/