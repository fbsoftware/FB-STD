<?php

class PopupImmaginePlus {

    private $id;
    private $titolo;
    private $descrizione;
    private $nomeImg;
    private $urlImg;

    public function __construct($id, $titolo, $descrizione, $nomeImg, $urlImg) {
        $this->id = $id;
        $this->titolo = $titolo;
        $this->descrizione = $descrizione;
        $this->nomeImg = $nomeImg;
        $this->urlImg = $urlImg;
    }

    public function render() {
        return '
        <!-- Pulsante apertura -->
        <button class="btn-open" id="open-'.$this->id.'">Apri '.$this->titolo.'</button>

        <!-- Modale -->
        <div id="'.$this->id.'" class="modal">
            <div class="modal-content animate-pop">
                <span class="close">&times;</span>

                <h2>'.$this->titolo.'</h2>
                <p>'.$this->descrizione.'</p>

                <div class="img-container">
                    <img id="img-'.$this->id.'" 
                         src="'.$this->urlImg.'" 
                         alt="'.$this->nomeImg.'" 
                         class="popup-img">

                    <!-- Icona Zoom -->
                    <button class="zoom-icon enlargeBtn" data-img="img-'.$this->id.'">
                        🔍
                    </button>
                </div>

            </div>
        </div>

        <!-- LIGHTBOX full screen -->
        <div id="lightbox-'.$this->id.'" class="lightbox">
            <img src="'.$this->urlImg.'" class="lightbox-img">
        </div>
        ';
    }

    public static function scripts() {
        return '
        <style>
            /* --- MODALE BASE --- */
            .modal {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.65);
                animation: fadeIn 0.3s;
            }
            .modal-content {
                background: #fff;
                padding: 20px;
                margin: 7% auto;
                width: 400px;
                border-radius: 12px;
                position: relative;
                text-align: center;
                box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            }

            /* --- ANIMAZIONE POP --- */
            @keyframes popIn {
                0% { transform: scale(0.75); opacity: 0; }
                100% { transform: scale(1); opacity: 1; }
            }
            .animate-pop {
                animation: popIn 0.25s ease-out;
            }

            /* --- ANIMAZIONE FADE --- */
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            .close {
                position: absolute;
                right: 15px;
                top: 10px;
                font-size: 26px;
                cursor: pointer;
            }

            /* --- IMMAGINE --- */
            .img-container {
                position: relative;
                display: inline-block;
            }
            .popup-img {
                width: 300px;
                border-radius: 6px;
                transition: transform 0.25s;
                cursor: pointer;
            }
            .popup-img.zoom {
                transform: scale(1.8);
            }

            /* --- ICONA ZOOM --- */
            .zoom-icon {
                position: absolute;
                right: 10px;
                bottom: 10px;
                padding: 8px;
                font-size: 18px;
                background: rgba(255,255,255,0.8);
                border-radius: 100%;
                border: none;
                cursor: pointer;
            }

            /* --- LIGHTBOX --- */
            .lightbox {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.9);
                justify-content: center;
                align-items: center;
                animation: fadeIn 0.3s;
            }
            .lightbox-img {
                width: 80%;
                max-width: 900px;
                border-radius: 10px;
                cursor: pointer;
                animation: popIn 0.3s;
            }
        </style>

        <script>
        document.addEventListener("DOMContentLoaded", () => {

            /* --- APRI MODALE --- */
            document.querySelectorAll("[id^=open-]").forEach(btn => {
                btn.addEventListener("click", () => {
                    const id = btn.id.replace("open-", "");
                    document.getElementById(id).style.display = "flex";
                });
            });

            /* --- CHIUDI MODALE --- */
            document.querySelectorAll(".modal .close").forEach(btn => {
                btn.addEventListener("click", () => {
                    btn.closest(".modal").style.display = "none";
                });
            });

            /* --- ZOOM ICON (toggle classe) --- */
            document.querySelectorAll(".enlargeBtn").forEach(btn => {
                btn.addEventListener("click", e => {
                    e.stopPropagation();
                    const img = document.getElementById(btn.dataset.img);
                    img.classList.toggle("zoom");
                });
            });

            /* --- CLIC SULL’IMMAGINE → LIGHTBOX --- */
            document.querySelectorAll(".popup-img").forEach(img => {
                img.addEventListener("click", () => {
                    const id = img.id.replace("img-", "");
                    const lb = document.getElementById("lightbox-" + id);
                    lb.style.display = "flex";
                });
            });

            /* --- CHIUDI LIGHTBOX CON CLICK --- */
            document.querySelectorAll(".lightbox").forEach(lb => {
                lb.addEventListener("click", () => {
                    lb.style.display = "none";
                });
            });

            /* --- ESC per chiudere lightbox --- */
            document.addEventListener("keyup", e => {
                if (e.key === "Escape") {
                    document.querySelectorAll(".lightbox").forEach(lb => lb.style.display = "none");
                }
            });

        });
        </script>
        ';
    }
}
