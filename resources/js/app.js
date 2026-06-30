import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const avisoCuidador = document.getElementById("avisoCuidador");
btnCuidador.onclick = function () {

    form.action = "{{ route('cuidador.store') }}";

    avisoCuidador.classList.remove("hidden");

    setAtivo(btnCuidador, btnResponsavel);

};

btnResponsavel.onclick = function () {

    form.action = "{{ route('responsavel.store') }}";

    avisoCuidador.classList.add("hidden");

    setAtivo(btnResponsavel, btnCuidador);

};
    // --cpf--
const cpf = document.getElementById("cpf");

cpf.addEventListener("input", function () {

    let valor = cpf.value.replace(/\D/g, "");

    valor = valor.replace(/(\d{3})(\d)/, "$1.$2");

    valor = valor.replace(/(\d{3})(\d)/, "$1.$2");

    valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

    cpf.value = valor;

});
    // --telefone--
const telefone = document.getElementById("telefone");

telefone.addEventListener("input", function () {

    let valor = telefone.value.replace(/\D/g, "");

    valor = valor.replace(/^(\d{2})(\d)/g, "($1) $2");
    valor = valor.replace(/(\d)(\d{4})$/, "$1-$2");

    telefone.value = valor;

});

    // --password--
const senha = document.getElementById("password");

const togglePassword = document.getElementById("togglePassword");

const eyeOpen = document.getElementById("eyeOpen");

const eyeClosed = document.getElementById("eyeClosed");

togglePassword.addEventListener("click", function () {

    if (senha.type === "password") {

        senha.type = "text";

        eyeOpen.classList.add("hidden");

        eyeClosed.classList.remove("hidden");

    } else {

        senha.type = "password";

        eyeClosed.classList.add("hidden");

        eyeOpen.classList.remove("hidden");

    }

});
