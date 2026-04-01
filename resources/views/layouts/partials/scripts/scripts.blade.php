<script>
    document.addEventListener("mousemove", (e) => {
        document.getElementById("fundo").style.transform = `translate(${(e.clientX / window.innerWidth - 0.5) * 40}px, ${(e.clientY / window.innerHeight - 0.5) * 40}px) scale(1.05)`;
    });

    document.addEventListener("click", function() {
        document.getElementById("click").play();
    });

    document.addEventListener("click", function(e) {

        const ripple = document.createElement("span");

        ripple.classList.add("ripple-rpg");
        ripple.style.left = (e.pageX - 10) + "px";
        ripple.style.top  = (e.pageY - 10) + "px";

        document.body.appendChild(ripple);

        setTimeout(() => ripple.remove(), 700);

        for (let i = 0; i < 8; i++) {

            const p = document.createElement("span");

            p.classList.add("particle");
            p.style.setProperty("--x", (Math.random() - 0.5) * 100 + "px");
            p.style.setProperty("--y", (Math.random() - 0.5) * 100 + "px");
            p.style.left = e.pageX + "px";
            p.style.top  = e.pageY + "px";

            document.body.appendChild(p);

            setTimeout(() => p.remove(), 700);
        }

        if(e.target && e.target.id === "ok") {
            Swal.close();
        }

        if (e.target && (e.target.id === "mostrar" || e.target.closest("#mostrar"))) {

            const senha = document.getElementById("senha");
            const olho = document.getElementById("mostrar").querySelector("i");

            if (senha.type === "password") {
                senha.type = "text";
                olho.classList.remove("bi-eye-slash-fill");
                olho.classList.add("bi-eye-fill");
            } else {
                senha.type = "password";
                olho.classList.remove("bi-eye-fill");
                olho.classList.add("bi-eye-slash-fill");
            }
        }

        if (e.target && (e.target.id === "mostrar_atual" || e.target.closest("#mostrar_atual"))) {

            const senha = document.getElementById("senha_atual");
            const olho = document.getElementById("mostrar_atual").querySelector("i");

            if (senha.type === "password") {
                senha.type = "text";
                olho.classList.remove("bi-eye-slash-fill");
                olho.classList.add("bi-eye-fill");
            } else {
                senha.type = "password";
                olho.classList.remove("bi-eye-fill");
                olho.classList.add("bi-eye-slash-fill");
            }
        }
    });

    function limparCampos() {
        document.getElementById("email").value = "";
        document.getElementById("senha").value = "";
        document.getElementById("novo_usuario").value = "";
        document.getElementById("novo_email").value = "";
        document.getElementById("nova_senha").value = "";
        document.getElementById("confirmar_nova_senha").value = "";
        document.getElementById("genero").selectedIndex = 0;
        document.getElementById("foto").value = "";
        document.querySelector("#pais").value = "";
        document.querySelector("#countrySelect .selected-option").innerHTML = "🌐 Selecione seu país...";

        const classe = document.getElementById("classe");
        const perfil_cadastro = document.querySelector(".perfil_cadastro");

        perfil_cadastro.src = "{{ asset('photos/vazio.png') }}";
        document.getElementById("foto_preview").src = "{{ asset('photos/vazio.png') }}";

        if (classe) {
            classe.selectedIndex = 0;
            perfil_cadastro.classList.remove("border-danger", "border-primary", "border-black");
            perfil_cadastro.classList.add("border-light");
        }
    }
</script>