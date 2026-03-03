// editor-core.js

editor.init = function () {

    editor.bindEvents();

    // Se non ci sono sezioni, creane una
    if (editor.state.sections.length === 0) {
        editor.createSection();
    }

    editor.render();
};
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
        editor.render();
    });

};