var editor = editor || {};

editor.init = function () {

editor.bindEvents();
editor.renderWidgetPalette();   // ← QUESTO CARICA I WIDGET NELLA PALETTE
// Carica layout iniziale
         if (window.INITIAL_LAYOUT && window.INITIAL_LAYOUT.sections) {
        editor.state = window.INITIAL_LAYOUT;
console.log("Layout caricato:", editor.state);
    } else {
// Se non c'è un layout iniziale, creane uno di default
        console.log("Nuovo layout");
        editor.createSection();
    }
 // Popolo i dati globali da site-config.json
    if(window.SITE_CONFIG){
        editor.state.global.colors = window.SITE_CONFIG.colors || {};
        editor.state.global.typography = window.SITE_CONFIG.typography || {};
        editor.state.global.fonts  = window.SITE_CONFIG.fonts || {};
console.log("Configurazione globale caricata:", editor.state.global);    
        }

    // Aggiorno updated_at
    editor.state.meta.updated_at = new Date().toISOString();

    editor.render();
};
//=================================
// Move section
//=================================
editor.moveSection = function(sectionId, direction) {

    const sections = editor.state.sections;

    const index = sections.findIndex(sec => sec.id === sectionId);

    if (index === -1) return;

    if (direction === "up" && index > 0) {

        [sections[index - 1], sections[index]] =
        [sections[index], sections[index - 1]];

    }

    if (direction === "down" && index < sections.length - 1) {

        [sections[index + 1], sections[index]] =
        [sections[index], sections[index + 1]];

    }

    editor.render();
};
//=================================
// Delete section
//=================================
editor.deleteSection = function(sectionId){

    if(!confirm("Eliminare questa sezione?")) return;

    editor.state.sections = editor.state.sections.filter(
        s => s.id !== sectionId
    );

    editor.render();
    
};

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
$(document).ready(function () {
  editor.init();
});