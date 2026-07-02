import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {

    // ===== Cadastro =====

    const form = document.getElementById("formCadastro");

    if (form) {

        const btnCuidador = document.getElementById("btnCuidador");
        const btnResponsavel = document.getElementById("btnResponsavel");
        const avisoCuidador = document.getElementById("avisoCuidador");

        const rotaCuidador = form.dataset.cuidador;
        const rotaResponsavel = form.dataset.responsavel;

        function setAtivo(ativo, inativo) {
            ativo.classList.add("border-emerald-500", "bg-emerald-50", "text-emerald-700");
            ativo.classList.remove("border-gray-200", "bg-white", "text-gray-500");

            inativo.classList.add("border-gray-200", "bg-white", "text-gray-500");
            inativo.classList.remove("border-emerald-500", "bg-emerald-50", "text-emerald-700");
        }

        btnCuidador.addEventListener("click", () => {
            form.action = rotaCuidador;
            avisoCuidador.classList.remove("hidden");
            setAtivo(btnCuidador, btnResponsavel);
        });

        btnResponsavel.addEventListener("click", () => {
            form.action = rotaResponsavel;
            avisoCuidador.classList.add("hidden");
            setAtivo(btnResponsavel, btnCuidador);
        });
    }

    // ===== CPF =====

    const cpf = document.getElementById("cpf");

    if (cpf) {
        cpf.addEventListener("input", () => {

            let valor = cpf.value.replace(/\D/g, "");

            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

            cpf.value = valor;
        });
    }

    // ===== Telefone =====

    const telefone = document.getElementById("telefone");

    if (telefone) {

        telefone.addEventListener("input", () => {

            let valor = telefone.value.replace(/\D/g, "");

            valor = valor.replace(/^(\d{2})(\d)/, "($1) $2");
            valor = valor.replace(/(\d)(\d{4})$/, "$1-$2");

            telefone.value = valor;
        });
    }

    // ===== Mostrar senha =====

    const senha = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");
    const eyeOpen = document.getElementById("eyeOpen");
    const eyeClosed = document.getElementById("eyeClosed");

    if (senha && togglePassword) {

        togglePassword.addEventListener("click", () => {

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

    }

});