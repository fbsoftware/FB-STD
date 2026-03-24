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
                <span class="material-symbols-outlined">add</span>
                <span style="font-size:50%; text-transform: lowercase;">col</span>
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
// Render column
//=================================
editor.renderColumn = function(column){

    const $column = $("<div>")
        .addClass("canvas-column")
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
};//=================================
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

//==========================================
// render pannello dettagli
//==========================================
editor.renderInspector = function(item, def){

    let html = `<div class="inspector">`;

    html += `<h3>${def.label || "Proprietà"}</h3>`;

    for (const fieldName in def.fields){

        const field = def.fields[fieldName];
        const value = item.props?.[fieldName] ?? "";

        html += `<div class="field">`;
        html += `<label>${field.label}</label>`;

        // TEXT
        if (field.type === "text"){
            html += `
                <input type="text"
                    value="${value}"
                    data-field="${fieldName}">
            `;
        }

        // SELECT
        if (field.type === "select"){
            html += `<select data-field="${fieldName}">`;

            for (const k in field.options){
                const selected = k == value ? "selected" : "";
                html += `<option value="${k}" ${selected}>${field.options[k]}</option>`;
            }

            html += `</select>`;
        }

        // RANGE
        if (field.type === "range"){
            html += `
                <input type="range"
                    min="${field.min}"
                    max="${field.max}"
                    value="${value}"
                    data-field="${fieldName}">
            `;
        }

        // COLOR (con fix var())
        if (field.type === "color"){
            html += `
                <input type="color"
                    value="${resolveColor(value)}"
                    data-field="${fieldName}">
            `;
        }

        html += `</div>`;
    }

    html += `</div>`;

    $("#inspector").html(html);
};

//=============================================
//  SELEZIONE/DESELEZIONE CENTRALIZZATA
//=============================================
editor.clearSelection = function(){
    editor.state.selectedType = null;
    editor.state.selectedId = null;
};

editor.selectSection = function(id){
    editor.clearSelection();
    editor.state.selectedType = "section";
    editor.state.selectedId = id;
console.log("SEZIONE STATE:", editor.state);
    editor.render();
};

editor.selectColumn = function(id){
    editor.clearSelection();
    editor.state.selectedType = "column";
    editor.state.selectedId = id;
console.log("COLONNA STATE:", editor.state);
    editor.render();
};

editor.selectWidget = function(id){
    editor.clearSelection();
    editor.state.selectedType = "widget";
    editor.state.selectedId = id;
    editor.render();
    editor.openWidgetInspector(id);
};
