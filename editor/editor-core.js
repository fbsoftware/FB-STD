//================================
//  Bind global events
//================================  
editor.bindEvents = function() {

    // CLICK SEZIONE (delegato)
    $(document).on("click", ".canvas-section", function(e){
        // è clic su colonna e non sezione
        if($(e.target).closest(".canvas-column").length){
        return;
    }
    e.stopPropagation();

    const id = $(this).data("id");
    editor.state.selected = {
        type: "section",
        id: id
    };

    editor.render();

});
    // CLICK +SEZIONE (diretto, perché è statico nel DOM)
    $("#add-section").on("click", function() {
        editor.createSection();
        console.log("Sezione aggiunta");
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
    editor.state.selected = null;

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
    editor.state.selected = null;

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
    editor.state.selected = null;

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
    editor.state.selected = null;

});

///================================
// SAVE / PUBBLICA
//================================
$(document).on("click", "#save-layout", function(){
alert("Vuoi Pubblicare il layout?");
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
}

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

    const id = $(this).data("id");

    editor.state.selected = {
        type:"column",
        id:id
    };

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
//  seleziona widget
//=================================
$(document).on("click", ".widget", function(e){
    e.stopPropagation();

    const id = $(this).data("id");

    editor.state.selected = {
        type: "widget",
        id: id
    };

    editor.render();
    editor.renderProperties();

});

//=================================
// clic su canvas vuoto = deselect
$(document).on("click", "#canvas", function(){

    if(editor.state.selected){

        editor.state.selected = null;
        editor.render();

    }

});

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

    const id = $(this).data("id");

    editor.state.selectedWidgetId = id;

    $(".canvas-widget").removeClass("selected");
    $(this).addClass("selected");

    editor.openWidgetInspector(id);

    e.stopPropagation();

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