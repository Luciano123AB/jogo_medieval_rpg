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

    function limparCamposLogin() {
        document.getElementById("email").value = "";
        document.getElementById("senha").value = "";        
    }
</script>