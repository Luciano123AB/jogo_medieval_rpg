<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        const foto = document.getElementById("foto");

        document.getElementById("sem_foto").addEventListener("change", function () {
            if (this.checked) {
                foto.disabled = true;
                foto.value = "";
                foto.classList.remove("cursor");
            } else {
                foto.disabled = false;
                foto.classList.add("cursor");
            }
        });
    });

    document.addEventListener("click", function(e) {
        if (e.target && (e.target.id === "mostrar_novo" || e.target.closest("#mostrar_novo"))) {

            const senha = document.getElementById("nova_senha");
            const olho = document.getElementById("mostrar_novo").querySelector("i");

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
            const olho = document.getElementById("mostrar_confirmar_novo").querySelector("i");

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
            const basePath = "{{ asset('assets/images/perfils') }}/";

            perfil.classList.remove("border-light", "border-danger", "border-primary", "border-black");
            perfil.classList.remove("bg-danger", "bg-primary", "bg-black");

            switch (e.target.value) {
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
                    perfil.classList.add("bg-black", "border-black");
                break;

                default:
                    perfil.src = "{{ asset('photos/vazio.png') }}";
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

            countrySelect.querySelector(".selected-option").innerHTML = this.innerHTML;
            document.querySelector("#pais").value = this.dataset.value;

            countrySelect.querySelector(".options").style.display = "none";

            e.stopPropagation();
        });
    });

    function limparCampos() {
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