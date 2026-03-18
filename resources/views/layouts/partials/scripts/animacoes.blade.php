<script>

    const magia_player = document.getElementById("magia_player");
    const magia_oponente = document.getElementById("magia_oponente");

    const efeito01_player = document.getElementById("efeito01_player");
    const efeito02_player = document.getElementById("efeito02_player");
    const efeito03_player = document.getElementById("efeito03_player");

    const efeito01_oponente = document.getElementById("efeito01_oponente");
    const efeito02_oponente = document.getElementById("efeito02_oponente");
    const efeito03_oponente = document.getElementById("efeito03_oponente");
    
    const gtl = gsap.timeline();

    @if(session("dano_desferido_player"))
        document.getElementById("player").src = "{{ asset('assets/images/personagens_ataque/' . strtolower(session('player.personagem.classe')) . '.png') }}";

        @if(session("player.personagem.classe") == "Mago")
            magia_player.hidden = false;
            magia_player.style.display = "block";

            gsap.set("#magia_player", {x: 0, y: 0});
            gtl.to("#magia_player", {
                x: distanciaRealX - 90,
                y: distanciaRealY,
                duration: 0.5,
                ease: "power1.inOut"
            });

            setTimeout(() => {
                magia_player.hidden = true;
            }, 1200);
        @endif
        
        @if(session()->has("ultimate_player"))
            gtl.to("#player", {
                duration: 0.9,
                ease: "power1.inOut",
                motionPath: {
                    path: [
                        {x: 0, y: 0},
                        {x: distancia_player[0], y: -250},
                        {x: distancia_player[1], y: 0}
                    ],
                    curviness: 1.5
                }
            })
            .to("#player", {
                x: 0,
                y: 0,
                duration: 0.7,
                ease: "power2.in"
            });

            setTimeout(() => {
                efeito03_oponente.hidden = false;
            }, 900);
            setTimeout(() => {
                efeito03_oponente.hidden = true;
            }, 1500);

            setTimeout(() => {
                oponente.classList.add("animate__rubberBand");
                oponente.src = "{{ asset('assets/images/personagens_dano/' . strtolower($oponente->classe) . '_reverso.png') }}";
            }, 900);
        @elseif(session()->has("forte_player"))
            gtl.to("#player", {
                duration: 0.9,
                ease: "power1.inOut",
                motionPath: {
                    path: [
                        {x: 250, y: 0},
                        {x: distancia_player[0], y: -250},
                        {x: distancia_player[1], y: 0}
                    ],
                    curviness: 1.5
                }
            })
            .to("#player", {
                x: 0,
                y: 0,
                duration: 0.7,
                ease: "power2.in"
            });

            setTimeout(() => {
                efeito02_oponente.hidden = false;
            }, 900);
            setTimeout(() => {
                efeito02_oponente.hidden = true;
            }, 1200);

            setTimeout(() => {
                oponente.classList.add("animate__shakeX");
                oponente.src = "{{ asset('assets/images/personagens_dano/' . strtolower($oponente->classe) . '_reverso.png') }}";
            }, 900);
        @else
            setTimeout(() => {
                oponente.src = "{{ asset('assets/images/personagens_dano/' . strtolower($oponente->classe) . '_reverso.png') }}";
            }, 900);

            gtl.fromTo("#player", {
                x: 0,
                y: 0
            }, {
                x: distancia_player[1],
                y: 0,
                duration: 0.5,
                ease: "power2.in"
            })
            .fromTo("#oponente", {
                x: 0,
                y: 0
            }, {
                x: 150,
                y: 0,
                duration: 0.5
            })
            .to("#player", {
                x: 0,
                y: 0,
                duration: 0.7,
                ease: "power2.in"
            })
            .to("#oponente", {
                x: 0,
                y: 0,
                duration: 0.7,
                ease: "power1.in"
            });

            setTimeout(() => {
                efeito01_oponente.hidden = false;
            }, 500);
            setTimeout(() => {
                efeito01_oponente.hidden = true;
            }, 1100);
        @endif
    @endif

    @if(session("dano_desferido_oponente"))
        oponente.src = "{{ asset('assets/images/personagens_ataque/' . strtolower($oponente->classe) . '_reverso.png') }}";

        @if($oponente->classe == "Mago")
            magia_oponente.hidden = false;
            magia_oponente.style.display = "block";

            gsap.set("#magia_oponente", {x: 0, y: 0});
            gsap.to("#magia_oponente", {
                x: -distanciaRealX + 90,
                y: -distanciaRealY,
                duration: 0.5,
                ease: "power1.inOut"
            });

            setTimeout(() => {
                magia_oponente.hidden = true;
            }, 1200);
        @endif

        @if(session()->has("ultimate_oponente"))
            gtl.to("#oponente", {
                duration: 0.9,
                ease: "power1.inOut",
                motionPath: {
                    path: [
                        {x: 0, y: 0},
                        {x: -distancia_oponente[0], y: -250},
                        {x: -distancia_oponente[1], y: 0}
                    ],
                    curviness: 1.5
                }
            })
            .to("#oponente", {
                x: 0,
                y: 0,
                duration: 0.7,
                ease: "power2.in"
            });

            setTimeout(() => {
                efeito03_player.hidden = false;
            }, 900);
            setTimeout(() => {
                efeito03_player.hidden = true;
            }, 1500);

            setTimeout(() => {
                player.classList.add("animate__rubberBand");
                player.src = "{{ asset('assets/images/personagens_dano/' . strtolower(session('player.personagem.classe')) . '.png') }}";
            }, 900);

            setTimeout(() => {
                oponente.src = "{{ asset('assets/images/personagens/' . strtolower($oponente->classe) . '_reverso.png') }}";
                player.src = "{{ asset('assets/images/personagens/' . strtolower(session('player.personagem.classe')) . '.png') }}";
            }, 1600);
        @elseif(session()->has("forte_oponente"))
            gtl.to("#oponente", {
                duration: 0.9,
                ease: "power1.inOut",
                motionPath: {
                    path: [
                        {x: -250, y: 0},
                        {x: -distancia_oponente[0], y: -250},
                        {x: -distancia_oponente[1], y: 0}
                    ],
                    curviness: 1.5
                }
            })
            .to("#oponente", {
                x: 0,
                y: 0,
                duration: 0.7,
                ease: "power2.in"
            });

            setTimeout(() => {
                efeito02_player.hidden = false;
            }, 900);
            setTimeout(() => {
                efeito02_player.hidden = true;
            }, 1200);

            setTimeout(() => {
                player.classList.add("animate__shakeX");
                player.src = "{{ asset('assets/images/personagens_dano/' . strtolower(session('player.personagem.classe')) . '.png') }}";
            }, 900);

            setTimeout(() => {
                oponente.src = "{{ asset('assets/images/personagens/' . strtolower($oponente->classe) . '_reverso.png') }}";
                player.src = "{{ asset('assets/images/personagens/' . strtolower(session('player.personagem.classe')) . '.png') }}";
            }, 1600);
        @else
            setTimeout(() => {
                player.src = "{{ asset('assets/images/personagens_dano/' . strtolower(session('player.personagem.classe')) . '.png') }}";
            }, 900);

            gtl.fromTo("#oponente", {
                x: 0,
                y: 0
            }, {
                x: -distancia_oponente[1],
                y: 0,
                duration: 0.5,
                ease: "power2.in"
            })
            .fromTo("#player", {
                x: 0,
                y: 0
            }, {
                x: -150,
                y: 0,
                duration: 0.5
            })
            .to("#oponente", {
                x: 0,
                y: 0,
                duration: 0.7,
                ease: "power2.in"
            })
            .to("#player", {
                x: 0,
                y: 0,
                duration: 0.7,
                ease: "power1.in"
            });

            setTimeout(() => {
                efeito01_player.hidden = false;
            }, 500);
            setTimeout(() => {
                efeito01_player.hidden = true;
            }, 1100);

            setTimeout(() => {
                oponente.src = "{{ asset('assets/images/personagens/' . strtolower($oponente->classe) . '_reverso.png') }}";
                player.src = "{{ asset('assets/images/personagens/' . strtolower(session('player.personagem.classe')) . '.png') }}";
            }, 2500);
        @endif
    @endif
</script>