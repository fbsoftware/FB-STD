// -----------------------------------------------------------------
//  Scripts per la gestione del pannello mini-builder
//    --------------------------------------------------------------

// Event delegation per la X
document.getElementById("sortable").addEventListener("click", e => {
    if (e.target.classList.contains("del")) {
        let li = e.target.closest(".canvas-item");
        let lid = li.dataset.lid;

        fetch("delete-widget.php?lid=" + lid)
            .then(() => location.reload());
    }
});

// Drag & drop: salva ordine dopo trascinamento
let sortable = document.getElementById("sortable");
let dragged = null;

// Quando inizi a trascinare
sortable.addEventListener("dragstart", e => {
    dragged = e.target;
    e.target.style.opacity = .5;
});

// Necessario per permettere il drop
sortable.addEventListener("dragover", e => {
    e.preventDefault();
});

// Quando entri sopra un altro widget
sortable.addEventListener("dragenter", e => {
    if (e.target.classList.contains("canvas-item")) {
        e.target.style.border = "2px dashed #999";
    }
});

// Quando esci
sortable.addEventListener("dragleave", e => {
    if (e.target.classList.contains("canvas-item")) {
        e.target.style.border = "1px solid #ccc";
    }
});

// Quando rilasci il widget
sortable.addEventListener("drop", e => {
    e.preventDefault();
    if (e.target.classList.contains("canvas-item")) {
        e.target.style.border = "1px solid #ccc";
        sortable.insertBefore(dragged, e.target);
        saveOrder(); // Salva subito sul DB
    }
});

// Fine trascinamento
sortable.addEventListener("dragend", e => {
    e.target.style.opacity = "";
});


sortable.addEventListener("dragend", () => {
    let order = [];
    document.querySelectorAll("#sortable .canvas-item").forEach((el, index) => {
        order.push({
            lid: el.dataset.lid,
            pos: index + 1
        });
    });

    fetch("update-order.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(order)
    }).then(() => console.log("Ordine salvato"));
});

// Aggiungere un widget dal pannello
document.querySelectorAll(".add-widget").forEach(btn => {
    btn.addEventListener("click", () => {
        fetch("get-widgets.php?name=" + btn.dataset.widget)
        .then(() => location.reload());
    });
});
// funzione per popolare dati
function populateForm(data) {
    document.getElementById('lid').value = data.lid;
    document.getElementById('lstat').value = data.lstat;
    document.getElementById('ltmp').value = data.ltmp;
    document.getElementById('lpage').value = data.lpage;
    document.getElementById('lcod').value = data.lcod;
    document.getElementById('ltipo').value = data.ltipo;
    document.getElementById('ldesc').value = data.ldesc;
}
// LOGICA JS PER SALVA
document.getElementById('save-details').addEventListener('click', ()=>{
    let fd = new FormData(document.getElementById('details-form'));
    fetch('update-details.php', {
        method: 'POST',
        body: fd
    })
    .then(r => r.text())
    .then(t => {
        if (t === "OK") {
            alert("Salvato!");
        }
    });
});
// CLICK SU UN WIDGET DEL LAYOUT CENTRALE
document.getElementById('sortable').addEventListener('click', e => {
    let li = e.target.closest('.canvas-item');
    if (!li) return;

    const lid = li.dataset.lid;   // <--- Manca questa riga!
    
            // CARICA I DETTAGLI DEL RECORD
    fetch('widgets/get-details.php?lid=' + lid)
        .then(r => r.json())
        .then(data => {
            document.getElementById('lid').value = data.lid;
            document.getElementById('lstat').value = data.lstat;
            document.getElementById('ltmp').value = data.ltmp;
            document.getElementById('lpage').value = data.lpage;
            document.getElementById('lcod').value = data.lcod;
            document.getElementById('ltipo').value = data.ltipo;
            document.getElementById('ldesc').value = data.ldesc;
        });

    // CARICA L'ANTEPRIMA
    fetch('preview-widget.php?lid=' + lid)
        .then(r => r.text())
        .then(html => {
            document.getElementById('preview-box').innerHTML = html;
        });
  //      console.log("FETCHING URL:", 'preview-widget.php?lid=' + lid);
});
