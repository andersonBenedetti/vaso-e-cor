document.addEventListener("DOMContentLoaded", function () {
  const botoes = document.querySelectorAll(".toggle-btn");

  botoes.forEach((botao) => {
    botao.addEventListener("click", () => {
      const targetId = botao.getAttribute("data-target");
      const conteudo = document.getElementById(targetId);

      botao.classList.toggle("ativo");
      conteudo.classList.toggle("ativo");
    });
  });
});
