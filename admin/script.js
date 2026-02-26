// -----------------------------------------------------------------
// Mini-builder – script principale (modificato, robusto)
// -----------------------------------------------------------------

document.addEventListener("DOMContentLoaded", () => {

    console.log("JS caricato");

    const sortable = document.getElementById("sortable");
    if (!sortable) {
        console.log("sortable non trovato");
        return;
    }

    // tema corrente (può essere definito in pagina da PHP come window.CURRENT_TEMA)
    const TEMA = typeof CURRENT_TEMA !== 'undefined' ? CURRENT_TEMA : (document.querySelector('.builder-container')?.dataset.tema || '');

    let dragged = null;

    // ===============================================================
    // CLICK HANDLER (DELETE + SELECT + ADD FROM LEFT)
    // ===============================================================
    sortable.addEventListener("click", e => {

        const addBtnInside = e.target.closest(".add-widget");
        if (addBtnInside) {
            e.preventDefault();
            e.stopPropagation();
            addWidget(addBtnInside.dataset.widget);
            return;
        }

        // ---------- DELETE ----------
        const delBtn = e.target.closest(".del");
        if (delBtn) {
            e.preventDefault();
            e.stopPropagation();

            if (!confirm("Eliminare questo widget?")) return;

            const li = delBtn.closest(".canvas-item");
            if (!li) return;

            const lid = li.dataset.lid;
            if (!lid) return;   

            console.log("Elimino lid:", lid);
  // disabilitiamo il pulsante per evitare doppie richieste
        delBtn.dataset.disabled = "1";
        delBtn.style.opacity = "0.5";
        delBtn.style.pointerEvents = "none";
 
         // Usiamo POST (più sicuro) e gestiamo la risposta in modo diagnostico
        fetch("delete-widget.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({ lid })
        })
        .then(r => r.text().then(text => ({ ok: r.ok, status: r.status, text })))
        .then(resp => {
            console.log("delete-widget-debug.php response status:", resp.status);
            console.log("delete-widget-debug    .php response text:", resp.text);
            const t = resp.text.trim();

            if (resp.ok && t === "OK") {
                li.classList.add("removing");
                setTimeout(() => li.remove(), 250);
            } else {
                alert("Errore eliminazione: " + (t || ("HTTP " + resp.status)));
            }
        })
        .catch(err => {
            console.error("Errore di rete delete-widget:", err);
            alert("Errore di rete durante eliminazione");
        })
        .finally(() => {
            // riabilitiamo il pulsante
            delBtn.dataset.disabled = "";
            delBtn.style.opacity = "";
            delBtn.style.pointerEvents = "";
        });

        return; // blocca SELECT
    }
        // ---------- SELECT ----------
const li = e.target.closest('.canvas-item');
if (!li) return;

// prendi l'id dal data-attribute in modo esplicito
const selectedLid = li.dataset.lid ?? li.getAttribute('data-lid') ?? null;
console.log('selectedLid (raw):', selectedLid, 'typeof:', typeof selectedLid);
if (!selectedLid) return;

const lidNum = parseInt(selectedLid, 10);
if (Number.isNaN(lidNum)) {
  console.warn('selectedLid non è un numero valido:', selectedLid);
  return;
}

// ora fai la fetch usando lidNum o selectedLid come stringa
// fetch robusto
fetch("get-details.php", {
  method: "POST",
  headers: { "Content-Type": "application/x-www-form-urlencoded" },
  body: new URLSearchParams({ lidNum })
})
.then(response => response.text().then(text => ({ status: response.status, text })))
.then(({ status, text }) => {
  console.log("HTTP status:", status);
  if (!text || text.trim() === "") {
    console.warn("get-details.php ha restituito body vuoto, status:", status);
    return;
  }

  let data;
  try {
    data = JSON.parse(text);
  } catch (err) {
    console.error("Impossibile parsare JSON da get-details.php:", err);
    console.log("Risposta grezza:", text);
    return;
  }

  if (data && data.error) {
    // gestisci errore server in modo pulito (mostra messaggio, non chiamare populateForm)
    console.error("Errore server:", data.error, data.message ?? '');
    // eventualmente mostra alert all'utente
    return;
  }

  // tutto ok: popola il form
  populateForm(data);
})
.catch(err => {
  console.error("Errore durante fetch/get-details.php:", err);
});
 });
    // ===============================================================
    // DRAG & DROP – RIORDINO CANVAS + ACCEPT EXTERNAL WIDGETS
    // ===============================================================
    sortable.addEventListener("dragstart", e => {
        const item = e.target.closest(".canvas-item");
        if (!item) {
            dragged = null;
            return;
        }

        if (e.target.closest(".del")) {
            e.preventDefault();
            return;
        }

        dragged = item;
        dragged.style.opacity = .5;
        try { e.dataTransfer.setData('text/plain', 'canvas-item'); } catch (ex) {}
        e.dataTransfer.effectAllowed = "move";
    });

    sortable.addEventListener("dragover", e => {
        e.preventDefault();
        try {
            e.dataTransfer.dropEffect = dragged ? 'move' : 'copy';
        } catch (ex) {}
    });

    sortable.addEventListener("drop", e => {
        e.preventDefault();

        // 1) riordino interno
        if (dragged) {
            const target = e.target.closest(".canvas-item");
            if (target && target !== dragged) {
                sortable.insertBefore(dragged, target);
            } else {
                sortable.appendChild(dragged);
            }
            saveOrder();
            return;
        }

        // 2) aggiunta da colonna sinistra tramite dataTransfer
        let widgetName = "";
        try {
            widgetName = e.dataTransfer.getData('text/plain') || e.dataTransfer.getData('widget') || '';
        } catch (ex) {
            console.error("Errore dataTransfer.getData:", ex);
        }

        if (widgetName) {
            const before = e.target.closest(".canvas-item");
            addWidget(widgetName, before);
            return;
        }

    });

    sortable.addEventListener("dragend", () => {
        if (dragged) dragged.style.opacity = "";
        dragged = null;
    });

    // ===============================================================
    // INIZIALIZZA .add-widget (draggable + click)
    // ===============================================================
    document.querySelectorAll(".add-widget").forEach(el => {
        el.setAttribute("draggable", "true");

        el.addEventListener("dragstart", e => {
            const widgetName = el.dataset.widget;
            try {
                e.dataTransfer.setData("text/plain", widgetName);
                e.dataTransfer.setData("widget", widgetName);
            } catch (ex) {
                console.warn("Impossibile impostare dataTransfer:", ex);
            }
            e.dataTransfer.effectAllowed = "copy";
            console.log("Drag widget:", widgetName);
        });

        el.addEventListener("click", e => {
            e.preventDefault();
            e.stopPropagation();
            addWidget(el.dataset.widget);
        });
    });

    // ===============================================================
    // FUNZIONE DI AGGIUNTA WIDGET (robusta e diagnostica)
    // ===============================================================
      function insertLiFromHtml(html, before) {
        const temp = document.createElement("div");
        temp.innerHTML = html.trim();
        const li = temp.querySelector(".canvas-item");
        if (!li) return false;
        if (before && before.classList.contains("canvas-item")) sortable.insertBefore(li, before);
        else sortable.appendChild(li);
        li.setAttribute("draggable", "true");
        return true;
    }

    function escapeHtml(s) {
        return String(s).replace(/[&<>"']/g, function(m){ return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[m]; });
    }
    function addWidget(widgetName, before = null) {
        console.log("Add widget:", widgetName);

        const tema = TEMA || '';

        fetch("add-widget.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({ widget: widgetName, tema })
        })
        .then(r => {
            // tieni sia il codice di stato che il testo per debug
            if (!r.ok) {
                return r.text().then(t => Promise.reject({ status: r.status, text: t }));
            }
            return r.text();
        })
        .then(text => {
            console.log("Risposta add-widget.php:", text);
            if (!text || text.trim() === "") {
                console.error("add-widget.php ha restituito testo vuoto");
                alert("Errore: risposta vuota da add-widget.php (vedi console/network).");
                return;
            }

            // se la risposta è JSON (es. { html: "...", lid: N }), proviamo a parsare
            const trimmed = text.trim();
            if (trimmed[0] === '{') {
                try {
                    const obj = JSON.parse(trimmed);
                    if (obj.html) {
                        insertLiFromHtml(obj.html, before);
                        saveOrder();
                        return;
                    }
                } catch (ex) {
                    console.warn("JSON parse fail", ex);
                }
            }

            // altrimenti proviamo a interpretare come HTML che contiene <li class="canvas-item">
            const temp = document.createElement("div");
            temp.innerHTML = trimmed;
            const li = temp.querySelector(".canvas-item");
            if (!li) {
                console.error("Risposta non contenente .canvas-item:", li);
                console.log("Contenuto completo risposta:", trimmed);
                // fallback: se la risposta contiene solo un numero (lid), creiamo un li client-side
                const onlyNumber = trimmed.match(/^\s*(\d+)\s*$/);
                if (onlyNumber) {
                    const lid = onlyNumber[1];
                    const created = document.createElement("li");
                    created.className = "canvas-item";
                    created.draggable = true;
                    created.dataset.lid = lid;
                    created.innerHTML = escapeHtml(widgetName.replace(/\.php$/i, '')) + ' <span class="del">✖</span>';
                    if (before && before.classList.contains("canvas-item")) sortable.insertBefore(created, before);
                    else sortable.appendChild(created);
                    created.setAttribute("draggable", "true");
                    saveOrder();
                    return;
                }

                alert("Risposta non valida da add-widget.php. Controlla console/Network per il testo completo.");
                return;
            }

            // inserisci il li restituito dal server
            if (before && before.classList.contains("canvas-item")) sortable.insertBefore(li, before);
            else sortable.appendChild(li);

            li.setAttribute("draggable", "true");
            saveOrder();
        })
        .catch(err => {
            console.error("Errore addWidget:", err);
            if (err && err.text) {
                console.error("Response text:", err.text);
                alert("Errore server: vedi console per dettagli.");
            } else {
                alert("Errore di rete o server (vedi console).");
            }
        });
    }

  

    // ---------------------------------------------------------------
    // saveOrder - mantiene la tua funzione esistente; se non esiste,
    // sostituisci con la tua implementazione che invia l'ordine a PHP.
    // ---------------------------------------------------------------
    function saveOrder() {
        const ids = Array.from(sortable.querySelectorAll(".canvas-item"))
            .map(li => li.dataset.lid)
            .filter(Boolean);
        console.log("Salvo ordine:", ids);
        fetch("save-order.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({ order: ids.join(",") })
        }).catch(console.error);
    }

});
