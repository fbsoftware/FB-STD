//====================================
//  deseleziona se fuori sezione/inspector
//====================================
$(document).on("click", function(e){

    if(
        $(e.target).closest(".canvas-widget").length ||
        $(e.target).closest(".canvas-column").length ||
        $(e.target).closest(".canvas-section").length ||
        $(e.target).closest("#inspector").length
    ){
        return;
    }

    editor.clearSelection();
    editor.render();
});


//=================================
// Move section up
//=================================
$(document).on("click", ".move-up", function(e) {
    e.stopPropagation();

    const sectionId = $(this)
        .closest(".canvas-section")
        .data("id");

    editor.moveSection(sectionId, "up");

});

//=================================
// Move section down
//=================================
$(document).on("click", ".move-down", function(e) {

    e.stopPropagation();

    const sectionId = $(this)
        .closest(".canvas-section")
        .data("id");

    editor.moveSection(sectionId, "down");

});
//=================================
// Delete section
//=================================
$(document).on("click", ".delete-section", function(e){

    e.stopPropagation();

    const sectionId = $(this)
        .closest(".canvas-section")
        .data("id");

  editor.deleteSection(sectionId);

});

//=================================
// Duplicate section
//=================================
$(document).on("click", ".duplicate", function(e){

    e.stopPropagation();

    const sectionId = $(this)
        .closest(".canvas-section")
        .data("id");

     editor.duplicateSection(sectionId);

});

///================================
// SAVE / PUBBLICA
//================================
$(document).on("click", "#save-layout", function(){
if(!confirm("Vuoi Pubblicare il layout ?")) return;

    const data = editor.state;

    console.log("SALVATAGGIO:", data);

    fetch("save-layout.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data, null, 2)
    })
    .then(res => res.text())
    .then(res => {
        console.log("Risposta server:", res);
    });

});

//================================
// SAVE / PUBBLICA
//================================
$(document).on("click", "#save-HTML", function(){
if(!confirm("Vuoi creare HTML ?")) return;

editor.state.page = editor.state; // copia lo state corrente in page
const html = editor.renderPageHTML(editor.state.page);
downloadHTML(html);

})

//=================================
//  Load site config
//=================================
editor.loadSiteConfig = function() {

$("#saveSiteConfig").on("click", function(){

    const config = {

        colors: {
            primary: $("#color-primary").val(),
            secondary: $("#color-secondary").val(),
            accent: $("#color-accent").val(),
            text: $("#color-text").val(),
            bg: $("#color-bg").val()
        },

        typography: {

            heading: {
                fontFamily: $("#heading-family").val(),
                weight: parseInt($("#heading-weight").val())
            },

            body: {
                fontFamily: $("#body-family").val(),
                weight: parseInt($("#body-weight").val())
            },

            sizes: {
                h1: parseInt($("#font-h1").val()),
                h2: parseInt($("#font-h2").val()),
                h3: parseInt($("#font-h3").val()),
                body: parseInt($("#font-body").val()),
                small: parseInt($("#font-small").val())
            }

        }

    };

    fetch("save-site-config.php", {
        method: "POST",
        headers: {"Content-Type":"application/json"},
        body: JSON.stringify(config)
    })
    .then(res=>res.json())
    .then(res=>{

        if(res.ok){

            $("#siteConfigStatus").text("✔ Salvato");

            window.SITE_CONFIG = config;

            editor.loadSiteConfig();

            console.log("Configurazione aggiornata", config);

        }

    });

});
};

//=================================
//  + colonna
//=================================
editor.addColumn = function(sectionId){

    const section = editor.state.sections.find(s => s.id === sectionId);

    if(!section) return;

    section.columns.push({

        id: editor.generateId("col"),
        width: Math.floor(100 / section.columns.length),
        widgets: []

    });

    editor.render();

};
//=================================
// Selezione colonna
//=================================
$(document).on("click", ".canvas-column", function(e){
    e.stopPropagation();
console.log("CLICCATA COLONNA");
if($(e.target).closest(".canvas-widget").length) return;
    const id = $(this).data("id");

    editor.selectColumn(id);
});

//=================================
//  Aggiungi colonna, da sezione
//=================================
$(document).on("click", ".add-column", function(e){

    e.stopPropagation();

    const sectionId = $(this)
        .closest(".canvas-section")
        .data("id");

    const section = editor.state.sections.find(sec => sec.id === sectionId);

    if(!section){
        console.error("Sezione non trovata:", sectionId);
        return;
    }

    section.columns.push({
        id: editor.utils.uuid("col"),
        width: 100,
        widgets: []
    });

    const n = section.columns.length;

    section.columns.forEach(col => {
        col.width = 100 / n;
    });

    editor.render();

});

//=================================
//  Toolbar Cancella colonna
//=================================
$(document).on("click",".delete-column",function(e){

    e.stopPropagation();

    const colId = $(this)
        .closest(".canvas-column")
        .data("id");

    editor.deleteColumn(colId);

});
//=================================
//  Cancella colonna
//=================================
editor.deleteColumn = function(colId){

    editor.state.sections.forEach(section => {

        section.columns = section.columns.filter(
            col => col.id !== colId
        );

    });

    editor.render();

};

//=================================
//  Spostare colonna a sinistra
//=================================

$(document).on("click",".move-left",function(e){

    e.stopPropagation();

    const colId = $(this)
        .closest(".canvas-column")
        .data("id");

    editor.moveColumnLeft(colId);

});

//=================================
//  move column left
//=================================
editor.moveColumnLeft = function(colId){

    editor.state.sections.forEach(section => {

        const index = section.columns.findIndex(c => c.id === colId);

        if(index > 0){

            const temp = section.columns[index-1];
            section.columns[index-1] = section.columns[index];
            section.columns[index] = temp;

        }

    });

    editor.render();

};


//=================================
//  Spostare colonna a destra
//=================================
editor.moveColumnRight = function(colId){

    editor.state.sections.forEach(section => {

        const index = section.columns.findIndex(c => c.id === colId);

        if(index >= 0 && index < section.columns.length-1){

            const temp = section.columns[index+1];
            section.columns[index+1] = section.columns[index];
            section.columns[index] = temp;

        }

    });

    editor.render();

};

//=================================
//  Spostare colonna a destra
//=================================
editor.moveColumnRight = function(colId){

    editor.state.sections.forEach(section => {

        const index = section.columns.findIndex(c => c.id === colId);

        if(index >= 0 && index < section.columns.length-1){

            const temp = section.columns[index+1];
            section.columns[index+1] = section.columns[index];
            section.columns[index] = temp;

        }

    });

    editor.render();

};

//=================================
//  colonna a destra
//=================================
$(document).on("click",".move-right",function(e){

    e.stopPropagation();

    const colId = $(this)
        .closest(".canvas-column")
        .data("id");

    editor.moveColumnRight(colId);

});

//======================================
// clic-widget per selezione
//======================================
$(document).on("click", ".canvas-widget", function(e){
    e.stopPropagation();

    const id = $(this).data("id");

    editor.selectWidget(id);
});
//======================================
// Cancella widget 
//======================================
$(document).on("click", ".widget-delete", function(e){

    e.stopPropagation();

    const id = $(this).closest(".canvas-widget").data("id");

    editor.state.sections.forEach(section=>{
        section.columns.forEach(column=>{
            column.widgets = column.widgets.filter(w => w.id !== id);
        });
    });

    editor.render();

});

//===============================
//  3️⃣ Gestione modifica valori 
//===============================
$(document).on("input change", "#inspector [data-field]", function(){

    const field = $(this).data("field");
    const value = $(this).val();

    let item;

    if (editor.state.selectedType === "widget"){
        item = editor.findWidgetById(editor.state.selectedId);
    }

    if (editor.state.selectedType === "column"){
        item = editor.findColumnById(editor.state.selectedId);
    }

    if (!item) return;

    if (!item.props) item.props = {};

    item.props[field] = value;

    editor.render(); // refresh canvas
});

//=======================================
//  valori globali
//=======================================
editor.globals = {

    colors:{
        primary:"var(--color-primary)",
        secondary:"var(--color-secondary)",
        accent:"var(--color-accent)",
        bg:"var(--color-bg)",
        text:"var(--color-text)"
    },

    align:{
        left:"sinistra",
        center:"centro",
        justify:"giustificato",
        right:"destra"
    }

};

//=============================================
//  SELEZIONE/DESELEZIONE CENTRALIZZATA
//=============================================
$(document).on("click", ".canvas-section", function(e){
    e.stopPropagation();

  if($(e.target).closest(".canvas-column").length) return;

    const id = $(this).data("id");
    editor.selectSection(id);
 
});

//=============================================
//  BLOCCHI VARI
//=============================================
$(document).on("click", "#editor-tabs, #tab-details, #inspector", function(e){
    e.stopPropagation();
});


$(document).on("mousedown click input change", "#editor-tabs input, #editor-tabs select, #editor-tabs textarea, #editor-tabs button",
    function(e){
        e.stopPropagation();
    }
);

//========================================
//  Blocca direttamente l'input inspector
//========================================
$(document).on("mousedown click", "#inspector, #inspector *",
    function(e){
        e.stopPropagation();
    }
);

//=================================
// ➕ SEZIONE
//=================================
$(document).on("click", "#add-section", function(){
    editor.createSection();
});

//=============================================
// SELEZIONE / DESELEZIONE CENTRALIZZATA
//=============================================
editor.clearSelection = function(){
    editor.state.selectedType = null;
    editor.state.selectedId = null;
};

editor.selectSection = function(id){
    editor.clearSelection();
    editor.state.selectedType = "section";
    editor.state.selectedId = id;
    editor.render();
};

editor.selectColumn = function(id){
    editor.clearSelection();
    editor.state.selectedType = "column";
    editor.state.selectedId = id;
    editor.render();
    editor.openColumnInspector(id);
};

editor.selectWidget = function(id){
    editor.clearSelection();
    editor.state.selectedType = "widget";
    editor.state.selectedId = id;
    editor.render();
    editor.openWidgetInspector(id);
};

//========================================
//  larghezza colonna
//========================================
$(document).on(
    "input change", '#inspector [data-column-field="width"]',
    function(){

        const value = parseInt($(this).val(), 10);
console.log("col-input modificato" , value);
        if(isNaN(value)) return;

        const columnId = editor.state.selectedId;
        const column = editor.findColumnById(columnId);

        if(!column) return;

        column.width = value;

        $('#inspector [data-column-field="width"]').val(value);

        editor.render();
        editor.openColumnInspector(columnId);
    }
);
$(document).on("input change", "#inspector [data-column-field]",
    function(){

        const field = $(this).data("column-field");
        const value = parseInt($(this).val(), 10);

        const columnId = editor.state.selectedId;
        const column = editor.findColumnById(columnId);

        if(!column) return;

        column[field] = value;

        editor.render();
        editor.openColumnInspector(columnId);
    }
);
