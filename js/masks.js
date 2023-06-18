$(document).ready(function () {
  $("#cep").on("input", function () {
    var value = $(this).val().replace(/\D/g, ""); // Remove caracteres não numéricos
    $(this).mask("00000-000"); // Remove a máscara atual e aplica a máscara de CNPJ
  });
});
