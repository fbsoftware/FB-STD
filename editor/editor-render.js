//=================================
//  Editor Render
//================================= 
editor.render = function() {

    const $canvas = $("#canvas");
    $canvas.empty();

    editor.state.sections.forEach(function(section) {

        const $section = editor.renderSection(section);

        $canvas.append($section);

    });

};
//================================
//  Render section
//================================
editor.renderSection = function(section) {

    const $section = $("<div>")
        .addClass("canvas-section")
        .attr("data-id", section.id);

    if (
        editor.state.selected.type === "section" &&
        editor.state.selected.id === section.id
    ) 
    {
        $section.addClass("selected");

        const $toolbar = $("<div>")
            .addClass("section-toolbar")
            .html(`
                <button class="move-up">⬆</button>
                <button class="move-down">⬇</button>
                <button class="duplicate">📄</button>
                <button class="delete">🗑</button>
            `);

        $section.prepend($toolbar);
    }

    // RENDER COLONNE
    section.columns.forEach(function(column) {

section.columns.forEach(function(column) {

    const $column = $("<div>")
        .addClass("canvas-column")
        .attr("data-id", column.id);

    column.widgets.forEach(function(widget) {

        const $widget = $("<div>")
            .addClass("canvas-widget")
            .attr("data-id", widget.id)
            .text(widget.type);

        $column.append($widget);

    });

    $section.append($column);

});

    });

    return $section;
};