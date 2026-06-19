<script>
    gsap.registerPlugin(MotionPathPlugin);

    const player = document.getElementById("player");
    const oponente = document.getElementById("oponente");

    function getCentroElemento(el) {

        const rect = el.getBoundingClientRect();

        return {
            x: rect.left + rect.width / 2,
            y: rect.top + rect.height / 2
        };
    }

    let distancia_player = [50, 100];
    let distancia_oponente = [50, 100];
    let distancia_real_x = 0;
    let distancia_real_y = 0;

    function atualizarDistancias() {
        
        const centro_player = getCentroElemento(player);
        const centro_oponente = getCentroElemento(oponente);

        distancia_real_x = centro_oponente.x - centro_player.x;
        distancia_real_y = centro_oponente.y - centro_player.y;

        const distancia_x = Math.abs(distancia_real_x) * 0.8;

        if ("{{ auth()->user()->personagem->classe }}" !== "Mago") {
            distancia_player = [250, distancia_x];
        }

        if ("{{ $oponente->classe }}" !== "Mago") {
            distancia_oponente = [250, distancia_x];
        }
    };

    window.addEventListener("load", atualizarDistancias);
    window.addEventListener("resize", atualizarDistancias);

    function resetarAnimacoes() {
        gsap.killTweensOf([player, oponente]);
        gsap.set([player, oponente], { x: 0, y: 0 });
    }

    const magia_player = document.getElementById("magia_player");
    const efeito01_player = document.getElementById("efeito01_player");
    const efeito02_player = document.getElementById("efeito02_player");
    const efeito03_player = document.getElementById("efeito03_player");
    
    const magia_oponente = document.getElementById("magia_oponente");
    const efeito01_oponente = document.getElementById("efeito01_oponente");
    const efeito02_oponente = document.getElementById("efeito02_oponente");
    const efeito03_oponente = document.getElementById("efeito03_oponente");

    function ataquePlayer(index) {
        atualizarDistancias();
        resetarAnimacoes();

        const gtl = gsap.timeline();

        switch (index) {
            case 0:
                gtl.fromTo(player, {
                    x: 0,
                    y: 0
                }, {
                    x: distancia_player[1],
                    y: 0,
                    duration: 0.5,
                    ease: "power2.in"
                })
                .fromTo(oponente, {
                    x: 0,
                    y: 0
                }, {
                    x: 150,
                    y: 0,
                    duration: 0.5
                })
                .to(player, {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power2.in"
                })
                .to(oponente, {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power1.in"
                });

                gtl.add(() => {
                    efeito01_oponente.hidden = false;
                }, 0.5);
                
                gtl.add(() => {
                    efeito01_oponente.hidden = true;
                }, 1.1);

                gtl.add(() => {
                    oponente.src = "{{ asset('assets/images/personagens_dano/' . strtolower($oponente->classe) . '_reverso.png') }}";
                }, 0.9);

                break;
            case 1:
                gtl.to(player, {
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
                .to(player, {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power2.in"
                });

                gtl.add(() => {
                    efeito02_oponente.hidden = false;
                    oponente.classList.remove("animate__shakeX");
                    void oponente.offsetWidth;
                    oponente.classList.add("animate__shakeX");
                    oponente.src = "{{ asset('assets/images/personagens_dano/' . strtolower($oponente->classe) . '_reverso.png') }}";
                }, 0.9);

                gtl.add(() => {
                    efeito02_oponente.hidden = true;
                }, 1.2);

                break;
            case 2:
                gtl.to(player, {
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
                .to(player, {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power2.in"
                });

                gtl.add(() => {
                    efeito03_oponente.hidden = false;
                    oponente.classList.remove("animate__rubberBand");
                    void oponente.offsetWidth;
                    oponente.classList.add("animate__rubberBand");
                    oponente.src = "{{ asset('assets/images/personagens_dano/' . strtolower($oponente->classe) . '_reverso.png') }}";
                }, 0.9);

                gtl.add(() => {
                    efeito03_oponente.hidden = true;
                }, 1.5);

                break;
            default:
                break;
        }
    }

    function ataqueOponente(tipo) {
        atualizarDistancias();
        resetarAnimacoes();
        
        const gtl = gsap.timeline();

        switch (tipo) {
            case "normal":
                gtl.fromTo(oponente, {
                    x: 0,
                    y: 0
                }, {
                    x: -distancia_oponente[1],
                    y: 0,
                    duration: 0.5,
                    ease: "power2.in"
                })
                .fromTo(player, {
                    x: 0,
                    y: 0
                }, {
                    x: -150,
                    y: 0,
                    duration: 0.5
                })
                .to(oponente, {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power2.in"
                })
                .to(player, {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power1.in"
                });

                gtl.add(() => {
                    efeito01_player.hidden = false;
                }, 0.5);

                gtl.add(() => {
                    efeito01_player.hidden = true;
                }, 1.1);

                gtl.add(() => {
                    player.src = "{{ asset('assets/images/personagens_dano/' . strtolower(auth()->user()->personagem->classe) . '.png') }}";
                }, 0.9);

                gtl.add(() => {
                    oponente.src = "{{ asset('assets/images/personagens/' . strtolower($oponente->classe) . '_reverso.png') }}";
                    player.src = "{{ asset('assets/images/personagens/' . strtolower(auth()->user()->personagem->classe) . '.png') }}";
                }, 2.5);

                break;
            case "forte":
                gtl.to(oponente, {
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
                .to(oponente, {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power2.in"
                });

                gtl.add(() => {
                    efeito02_player.hidden = false;
                }, 0.9);

                gtl.add(() => {
                    efeito02_player.hidden = true;
                }, 1.2);

                gtl.add(() => {
                    player.classList.remove("animate__shakeX");
                    void player.offsetWidth;
                    player.classList.add("animate__shakeX");
                    player.src = "{{ asset('assets/images/personagens_dano/' . strtolower(auth()->user()->personagem->classe) . '.png') }}";
                }, 0.9);

                gtl.add(() => {
                    oponente.src = "{{ asset('assets/images/personagens/' . strtolower($oponente->classe) . '_reverso.png') }}";
                    player.src = "{{ asset('assets/images/personagens/' . strtolower(auth()->user()->personagem->classe) . '.png') }}";
                }, 1.6);

                break;
            case "ultimate":
                gtl.to(oponente, {
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
                .to(oponente, {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power2.in"
                });

                gtl.add(() => {
                    efeito03_player.hidden = false;
                }, 0.9);

                gtl.add(() => {
                    efeito03_player.hidden = true;
                }, 1.5);

                gtl.add(() => {
                    player.classList.remove("animate__rubberBand");
                    void player.offsetWidth;
                    player.classList.add("animate__rubberBand");
                    player.src = "{{ asset('assets/images/personagens_dano/' . strtolower(auth()->user()->personagem->classe) . '.png') }}";
                }, 0.9);

                gtl.add(() => {
                    oponente.src = "{{ asset('assets/images/personagens/' . strtolower($oponente->classe) . '_reverso.png') }}";
                    player.src = "{{ asset('assets/images/personagens/' . strtolower(auth()->user()->personagem->classe) . '.png') }}";
                }, 1.6);

                break;
            default:
                break;
        }
    }

    function magiaPlayer() {

        const gtl = gsap.timeline();

        magia_player.hidden = false;

        gsap.set("#magia_player", {x: 0, y: 0});
        gtl.to("#magia_player", {
            x: distancia_real_x - 90,
            y: distancia_real_y,
            duration: 0.5,
            ease: "power1.inOut"
        });

        gtl.add(() => {
            magia_player.hidden = true;
        }, 1.2);
    }

    function magiaOponente() {
        
        const gtl = gsap.timeline();

        magia_oponente.hidden = false;

        gsap.set("#magia_oponente", {x: 0, y: 0});
        gtl.to("#magia_oponente", {
            x: -distancia_real_x + 90,
            y: -distancia_real_y,
            duration: 0.5,
            ease: "power1.inOut"
        });

        gtl.add(() => {
            magia_oponente.hidden = true;
        }, 1.2);
    }
</script>