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

    editor.initSortableWidgets();
};

//=================================
// Render section
//=================================
editor.renderSection = function(section){

    const selected =
        editor.state.selectedType === "section" &&
        section.id === editor.state.selectedId
        ? "selected"
        : "";

    const $section = $("<div>")
        .addClass(`canvas-section ${selected}`)
        .attr("data-id", section.id);

    const $toolbar = $("<div>")
        .addClass("section-toolbar")
        .html(`
            <button class="move-up button">
                <span class="material-symbols-outlined">arrow_upward</span>
            </button>

            <button class="move-down button">
                <span class="material-symbols-outlined">arrow_downward</span>
            </button>

            <button class="duplicate button">
                <span class="material-symbols-outlined">content_copy</span>
            </button>

            <button class="delete-section button">
                <span class="material-symbols-outlined">delete</span>
            </button>

            <button class="add-column button">
               <span class="material-symbols-outlined">add_column_right</span>
            </button>
        `);

    $section.prepend($toolbar);

    const $columns = $("<div>").addClass("section-columns");

    if(section.columns){
        section.columns.forEach(col => {
            $columns.append(editor.renderColumn(col));
        });
    }

    $section.append($columns);

    return $section;
};

//=================================
// cerco la colonna selezionata
//=================================
editor.findColumnById = function(columnId){

    let found = null;

    editor.state.sections.forEach(section => {
        section.columns.forEach(column => {
            if(column.id === columnId){
                found = column;
            }
        });
    });

    return found;
};

//=================================
// colonna selezionata
//=================================
editor.selectColumn = function(id){
    editor.clearSelection();
    editor.state.selectedType = "column";
    editor.state.selectedId = id;
    editor.render();
    editor.openColumnInspector(id);
};

//=================================
// apre inspector colonna
//=================================
editor.openColumnInspector = function(columnId){

    const column = editor.findColumnById(columnId);

    if(!column){
        console.error("Colonna non trovata:", columnId);
        return;
    }
console.log("COLONNA TROVATA");
    editor.renderColumnInspector(column);
};

//=================================
// Render column in inspector
//=================================
editor.renderColumnInspector = function(column){

    const $panel = $("#inspector");
    $panel.empty();

    const html = `
        <div class="inspector-group">
            <div class="inspector-title">Colonna</div>

            <label for="col-width-range">Larghezza (%)</label>

            <input
                id="col-width-range"
                type="range"
                min="10"
                max="100"
                step="5"
                value="${column.width}"
                data-column-field="width"
                data-column-input="range"
            >

            <input
                id="col-width-number"
                type="number"
                min="10"
                max="100"
                step="5"
                value="${column.width}"
                data-column-field="width"
                data-column-input="number"
            >
        </div>
    `;

    $panel.html(html);
};

//=================================
// Render column
//=================================
editor.renderColumn = function(column){

    const selected =
        editor.state.selectedType === "column" &&
        column.id === editor.state.selectedId
        ? "selected"
        : "";

    const $column = $("<div>")
        .addClass(`canvas-column ${selected}`)
        .attr("data-id", column.id)
        .css("width", column.width + "%");

    const $toolbar = $("<div>")
        .addClass("column-toolbar")
        .html(`
            <button class="move-left button">
                <span class="material-symbols-outlined">arrow_back</span>
            </button>

            <button class="move-right button">
                <span class="material-symbols-outlined">arrow_forward</span>
            </button>

            <button class="delete-column button">
                <span class="material-symbols-outlined">delete</span>
            </button>
        `);

    $column.prepend($toolbar);

    column.widgets.forEach(widget => {
        $column.append(editor.renderWidget(widget));
    });

    return $column;
};

//=================================
// Render widget
//================================= 
editor.renderWidget = function(widget){

    const def = editor.widgets[widget.type];

     const selected =
        editor.state.selectedType === "widget" &&
        widget.id === editor.state.selectedId
        ? "selected"
        : ""; 

    const content = def.render(widget);

    return `
        <div class="canvas-widget ${selected}" data-id="${widget.id}">
            <div class="widget-toolbar">
                <button class="widget-delete button">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            </div>

            ${content}
        </div>
    `;
};
//=================================     
//  colonne sortable
//================================= 
editor.initSortableColumns = function(){

    $(".canvas-column").sortable({
        items: ".canvas-column",
        axis: "x",

        stop: function(){
            editor.syncColumnsState();
        }

    });

};

//=================================
//  State colonne
//=================================
editor.syncColumnsState = function(){

    editor.state.sections.forEach(section => {
        const $row = $(".canvas-section[data-id='"+section.id+"'] .canvas-column");
        const newOrder = [];

        $row.children(".canvas-column").each(function(){
            const id = $(this).data("id");
            const column = section.columns.find(c => c.id === id);
            if(column) newOrder.push(column);
        });

        section.columns = newOrder;
    });
};


