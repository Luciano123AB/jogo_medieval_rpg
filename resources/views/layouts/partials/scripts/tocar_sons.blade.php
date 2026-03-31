<script>
    document.addEventListener("DOMContentLoaded", () => {

        const audio = document.getElementById("trilha_sonora");
        const icone = document.getElementById("icone_musica");
        let tocando = sessionStorage.getItem("musica_tocando") === "true";
        let tempo_salvo = sessionStorage.getItem("musica_tempo");

        function atualizarIcone(tocando) {
            if (tocando) {
                icone.classList.remove("bi-volume-mute-fill");
                icone.classList.add("bi-volume-up-fill");
            } else {
                icone.classList.remove("bi-volume-up-fill");
                icone.classList.add("bi-volume-mute-fill");
            }
        }

        if (tempo_salvo) {
            audio.currentTime = parseFloat(tempo_salvo);
        }

        if (tocando) {
            audio.play().catch(() => {});
            icone.classList.replace("bi-volume-up-fill", "bi-volume-mute-fill");
        }

        document.getElementById("botao_musica").addEventListener("click", () => {
            tocando = !tocando;

            if (tocando) {
                audio.play();
            } else {
                audio.pause();
            }

            sessionStorage.setItem("musica_tocando", tocando);
            atualizarIcone(tocando);
        });

        atualizarIcone(tocando);

        const trilhaEstavaTocando = tocando && !audio.paused;

        @if (session()->has("vitoria") || session()->has("derrota"))

            const som_resultado = document.getElementById("som_final");            

            audio.pause();
            som_resultado.currentTime = 0;
            som_resultado.play().catch(() => {});

            setTimeout(() => {
                som_resultado.pause();

                if (trilhaEstavaTocando) {
                    audio.play().catch(() => {});
                }
            }, {{ session()->has("vitoria") ? 4300 : 1500 }});
        @endif

        @if (session()->has("level_up"))

            const som_level = document.getElementById("level_up");

            audio.pause();
            som_level.currentTime = 0;
            som_level.play().catch(() => {});

            setTimeout(() => {
                som_level.pause();

                if (trilhaEstavaTocando) {
                    audio.play().catch(() => {});
                }
            }, 2000);
        @endif

        window.addEventListener("beforeunload", () => {
            sessionStorage.setItem("musica_tempo", audio.currentTime);
        });
    });
</script>