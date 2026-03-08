//================================
//  Bind global events
//================================  
editor.bindEvents = function() {

    // CLICK SEZIONE (delegato)
    $(document).on("click", ".canvas-section", function(e) {
        e.stopPropagation();
        const id = $(this).data("id");
        editor.select("section", id);
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