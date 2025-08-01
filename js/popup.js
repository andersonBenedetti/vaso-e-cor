document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".abrir-popup").forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const imgUrl = this.dataset.img;
      const popup = document.getElementById("popup-imagem");
      const img = document.getElementById("imagem-popup");
      img.src = imgUrl;
      popup.style.display = "flex";
    });
  });

  document.querySelectorAll(".popup .fechar").forEach((btn) => {
    btn.addEventListener("click", function () {
      const popup = this.closest(".popup");
      popup.style.display = "none";
      document.getElementById("imagem-popup").src = "";
    });
  });

  document.querySelectorAll(".popup").forEach((popup) => {
    popup.addEventListener("click", function (e) {
      if (e.target === this) {
        popup.style.display = "none";
        document.getElementById("imagem-popup").src = "";
      }
    });
  });
});
