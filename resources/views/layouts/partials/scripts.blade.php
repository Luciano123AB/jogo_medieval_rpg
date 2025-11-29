<script>

    const fundo = document.getElementById("fundo");
    const audio = document.getElementById("trilha_sonora");

    @if(session("musica") === "Desativado")
        audio.muted = true;
    @else
        audio.muted = false;
        audio.play().catch(error => {
            console.error("Erro ao reproduzir a trilha sonora:", error);
        });
    @endif

    document.addEventListener("mousemove", (e) => {

        const x = (e.clientX / window.innerWidth - 0.5) * 40;
        const y = (e.clientY / window.innerHeight - 0.5) * 40;

        fundo.style.transform = `translate(${x}px, ${y}px) scale(1.05)`;
    });

    document.addEventListener("click", function(e) {
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
                    perfil.src = basePath + "guerreiro_perfil.png";
                    perfil.classList.add("bg-danger", "border-danger");
                break;

                case "Mago":
                    perfil.src = basePath + "mago_perfil.png";
                    perfil.classList.add("bg-primary", "border-primary");
                break;

                case "Assassino":
                    perfil.src = basePath + "assassino_perfil.png";
                    perfil.classList.add("bg-dark", "border-dark");
                break;

                default:
                    perfil.src = basePath + "vazio_perfil.png";
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

    document.querySelector('#countrySelect').addEventListener('click', function(e) {
        const box = this.querySelector('.options');
        box.style.display = box.style.display === 'block' ? 'none' : 'block';
    });

    document.querySelectorAll('#countrySelect .option').forEach(option => {
        option.addEventListener('click', function(e) {
            const countrySelect = document.querySelector('#countrySelect');
            const selected = countrySelect.querySelector('.selected-option');
            const hiddenInput = document.querySelector('#countryInput');

            selected.innerHTML = this.innerHTML;
            hiddenInput.value = this.dataset.value;

            countrySelect.querySelector('.options').style.display = 'none';

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

        const classe = document.getElementById("classe");
        const perfil_cadastro = document.querySelector(".perfil_cadastro");
        const foto = document.getElementById("foto_preview");

        perfil_cadastro.src = "{{ asset('assets/images/perfils/vazio_perfil.png') }}";
        foto.src = "{{ asset('assets/images/perfils/vazio_perfil.png') }}";

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