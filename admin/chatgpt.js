// Click handler (parte DELETE migliorata)
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
            console.log("delete-widget.php response status:", resp.status);
            console.log("delete-widget.php response text:", resp.text);
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

    // ... resto del click handler (SELECT ecc.)
});