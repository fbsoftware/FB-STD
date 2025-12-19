// -----------------------------------------------------------------
// Mini-builder – script principale
// -----------------------------------------------------------------

document.addEventListener("DOMContentLoaded", () => {

    console.log("JS caricato");

    const sortable = document.getElementById("sortable");
    if (!sortable) {
        console.log("sortable non trovato");
        return;
    }

    let dragged = null;

    // ===============================================================
    // CLICK HANDLER (delete + select)
    // ===============================================================
    sortable.addEventListener("click", e => {
 console.log("JS cliccato delete");
        // --- DELETE WIDGET ---
        const delBtn = e.target.closest(".del");
        if (delBtn) {
            e.preventDefault();
            e.stopPropagation();

            const li = delBtn.closest(".canvas-item");
            if (!li) return;

            const lid = li.dataset.lid;
            if (!lid) return;

            console.log("Elimino lid:", lid);

            fetch(`delete-widget.php?lid=${lid}`)
                .then(r => r.text())
                .then(t => {
                    console.log("PHP:", t);
                    if (t.trim() === "OK") {
                    li.classList.add("removing");
                    if (!confirm("Eliminare questo widget?")) return;

    setTimeout(() => li.remove(), 250);
}

                })
                .catch(console.error);

            return; // IMPORTANTISSIMO: blocca il select
        }
});


        // --- SELECT WIDGET ---
        const li = e.target.closest(".canvas-item");
        if (!li) return;

        const lid = li.dataset.lid;
        if (!lid) return;


// Carica dettagli (POST)
fetch('get-details.php', {
  method: 'POST',
  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
  body: new URLSearchParams({ lid })
})
.then(r => r.text())   // <--- qui leggiamo come testo
.then(text => {
  console.log(text);    // vediamo cosa sta effettivamente arrivando
  return JSON.parse(text); // se sei sicuro che sia JSON
})

  .then(r => r.json())
  .then(data => populateForm(data));


// Carica anteprima (POST)
fetch('preview-widget.php', {
  method: 'POST',
  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
  body: new URLSearchParams({ lid })
})
  .then(r => r.text())
  .then(html => {
    const preview = document.getElementById("preview-box");
    if (preview) preview.innerHTML = html;
  });
    

    // ===============================================================
    // DRAG & DROP
    // ===============================================================
sortable.addEventListener("dragstart", e => {
    if (e.target.closest(".del")) {
        e.preventDefault();
        return;
    }
    dragged = e.target;
    e.target.style.opacity = .5;
});


    sortable.addEventListener("dragover", e => e.preventDefault());

    sortable.addEventListener("dragenter", e => {
        if (e.target.classList.contains("canvas-item")) {
            e.target.style.border = "2px dashed #999";
        }
    });

    sortable.addEventListener("dragleave", e => {
        if (e.target.classList.contains("canvas-item")) {
            e.target.style.border = "1px solid #ccc";
        }
    });

    sortable.addEventListener("drop", e => {
        e.preventDefault();
        if (e.target.classList.contains("canvas-item")) {
            e.target.style.border = "1px solid #ccc";
            sortable.insertBefore(dragged, e.target);
            saveOrder();
        }
    });

    sortable.addEventListener("dragend", e => {
        e.target.style.opacity = "";
    });

});
