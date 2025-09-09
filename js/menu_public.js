  // Espera o carregamento da página
  document.addEventListener('DOMContentLoaded', function () {
    // Pega todos os links dentro do menu colapsável
    var navLinks = document.querySelectorAll('#menupublico .nav a');
    var navbarCollapse = document.querySelector('#menupublico');

    // Para cada link, adiciona o evento de clique
    navLinks.forEach(function (link) {
      link.addEventListener('click', function () {
        // Se o menu estiver visível, fecha
        if (navbarCollapse.classList.contains('in')) {
          // Remove a classe 'in' para fechar o menu
          navbarCollapse.classList.remove('in');
          navbarCollapse.classList.add('collapse');
          navbarCollapse.style.height = '0px'; // Força o colapso
        }
      });
    });
  });