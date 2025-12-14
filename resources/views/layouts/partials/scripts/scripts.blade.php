<script>

    const fundo = document.getElementById("fundo");
    const audio = document.getElementById("trilha_sonora");
    const som_resultado = document.getElementById("som_final");
    const click = document.getElementById("click");

    @if(session("musica") != "Desativado")
        audio.muted = false;
        audio.play().catch(error => {
            console.error("Erro ao reproduzir a trilha sonora:", error);
        });
    @else
        audio.muted = true;
    @endif

    @if(session()->has("vitoria") || session()->has("derrota"))
        audio.muted = true;
        som_resultado.muted = false;
        som_resultado.play().catch(error => {
            console.error("Erro ao reproduzir o som de final da batalha:", error);
        });

        let tempo = 0;

        @if(session()->has("vitoria"))
            tempo = 4300;
        @else
            tempo = 1500;
        @endif

        {{ session()->forget(["vitoria", "derrota"]) }}

        setTimeout(() => {
            som_resultado.muted = true;
            @if(session("musica") == "Ativado")
                audio.muted = false;
            @endif
        }, tempo);
    @else
        som_resultado.muted = true;
    @endif

    document.addEventListener("DOMContentLoaded", function () {
        
        const sem_foto = document.getElementById("sem_foto");
        const foto = document.getElementById("foto");

        sem_foto.addEventListener("change", function () {
            if (this.checked) {
                foto.disabled = true;
                foto.value = "";
            } else {
                foto.disabled = false;
            }
        });
    });

    document.addEventListener("mousemove", (e) => {

        const x = (e.clientX / window.innerWidth - 0.5) * 40;
        const y = (e.clientY / window.innerHeight - 0.5) * 40;

        fundo.style.transform = `translate(${x}px, ${y}px) scale(1.05)`;
    });

    document.addEventListener("click", function() {
        click.play();
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

            const x = (Math.random() - 0.5) * 100;
            const y = (Math.random() - 0.5) * 100;

            p.style.setProperty("--x", x + "px");
            p.style.setProperty("--y", y + "px");
            p.style.left = e.pageX + "px";
            p.style.top  = e.pageY + "px";

            document.body.appendChild(p);

            setTimeout(() => p.remove(), 700);
        }

        if(e.target && e.target.id === "ok") {
            Swal.close();
        }

        if (e.target && (e.target.id === "mostrar_novo" || e.target.closest("#mostrar_novo"))) {

            const senha = document.getElementById("nova_senha");
            const botao = document.getElementById("mostrar_novo");
            const olho = botao.querySelector("i");

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

        if (e.target && (e.target.id === "mostrar_confirmar_novo" || e.target.closest("#mostrar_confirmar_novo"))) {

            const senha = document.getElementById("confirmar_nova_senha");
            const botao = document.getElementById("mostrar_confirmar_novo");
            const olho = botao.querySelector("i");

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

        if (e.target && (e.target.id === "mostrar" || e.target.closest("#mostrar"))) {

            const senha = document.getElementById("senha");
            const botao = document.getElementById("mostrar");
            const olho = botao.querySelector("i");

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

    document.addEventListener("change", function(e) {
        if (e.target && e.target.id === "classe") {

            const perfil = document.querySelector(".perfil_cadastro");
            const classeSelecionada = e.target.value;
            const basePath = "{{ asset('assets/images/perfils') }}/";

            perfil.classList.remove("border-light", "border-danger", "border-primary", "border-dark");
            perfil.classList.remove("bg-danger", "bg-primary", "bg-dark");

            switch (classeSelecionada) {
                case "Guerreiro":
                    perfil.src = basePath + "guerreiro.png";
                    perfil.classList.add("bg-danger", "border-danger");
                break;

                case "Mago":
                    perfil.src = basePath + "mago.png";
                    perfil.classList.add("bg-primary", "border-primary");
                break;

                case "Assassino":
                    perfil.src = basePath + "assassino.png";
                    perfil.classList.add("bg-dark", "border-dark");
                break;

                default:
                    perfil.src = basePath + "vazio.png";
                    perfil.classList.add("border-light");
                break;
            }
        }
    });

    function fotoPreview(input) {
        if (input.files && input.files[0]) {
            
            var r = new FileReader();

            r.onload = function(e) {
                $("#foto_preview").show();
                $("#foto_preview").attr("src", e.target.result);
            }

            r.readAsDataURL(input.files[0]);
        }
    }

    $().ready(function() {

        hide_empty_image = false;
        set_blank_to_empty_image = false;
        set_image_border = true;

        if (hide_empty_image)
            $("#foto_preview").hide();
        if (set_blank_to_empty_image)
            $("#foto_preview").attr("src","data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=");

        $("#foto").change(function(){
            fotoPreview(this);
        });
    });

    document.querySelector("#countrySelect").addEventListener("click", function(e) {

        const box = this.querySelector(".options");

        box.style.display = box.style.display === "block" ? "none" : "block";
    });

    document.querySelectorAll("#countrySelect .option").forEach(option => {
        option.addEventListener("click", function(e) {

            const countrySelect = document.querySelector("#countrySelect");
            const selected = countrySelect.querySelector(".selected-option");
            const pais = document.querySelector("#pais");

            selected.innerHTML = this.innerHTML;
            pais.value = this.dataset.value;

            countrySelect.querySelector(".options").style.display = "none";

            e.stopPropagation();
        });
    });

    function limparCamposCadastro() {
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
        const foto = document.getElementById("foto_preview");

        perfil_cadastro.src = "{{ asset('assets/images/perfils/vazio.png') }}";
        foto.src = "{{ asset('assets/images/perfils/vazio.png') }}";

        if (classe) {
            classe.selectedIndex = 0;
            perfil_cadastro.classList.remove("border-danger", "border-primary", "border-dark");
            perfil_cadastro.classList.add("border-light");
        }
    }

    function limparCamposLogin() {
        document.getElementById("email").value = "";
        document.getElementById("senha").value = "";
    }
</script>