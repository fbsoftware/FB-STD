//=================================
//  Editor Render
//================================= 
editor.render = function() {

    const $canvas = $("#canvas");
    $canvas.empty();

    editor.state.sections.forEach(function(section) {

        const $section = editor.renderSection(section);
console.log("RENDER SECTION:", section); // debug
        $canvas.append($section);

    });

    editor.initSortableWidgets();
};

//=================================
// Render section
//=================================
editor.renderSection = function(section) {

    const $section = $("<div>")
        .addClass("canvas-section")
        .attr("data-id", section.id);

    if (
        editor.state.selected &&
        editor.state.selected.type === "section" &&
        editor.state.selected.id === section.id
    ) 
    {
        $section.addClass("selected");

        const $toolbar = $("<div>")
            .addClass("section-toolbar")
            .html(`
                <button class="move-up">
                <span class="material-symbols-outlined">arrow_upward</span>
                </button>

                <button class="move-down">
                <span class="material-symbols-outlined">arrow_downward</span>
                </button>

                <button class="duplicate">
                <span class="material-symbols-outlined">content_copy</span>
                </button>

                <button class="delete-section">
                <span class="material-symbols-outlined">delete</span>
                </button>
            `);

        $section.prepend($toolbar);
    }

    // ===== colonne =====
    const $columns = $("<div>").addClass("section-columns");

    if(section.columns){
        section.columns.forEach(col => {
            $columns.append(editor.renderColumn(col));
        });
    }

    $section.append($columns);

    // ===== bottone aggiungi colonna =====
    const $addColumn = $("<button>")
        .addClass("add-column")
        .text("+ Colonna")
        .on("click", function(){

            section.columns.push({
                id: editor.utils.uuid("col"),
                width:200,
                widgets:[]
            });

            editor.render();
        });

    $section.append($addColumn);

    return $section;
};
///=================================
// Render column
//=================================
editor.renderColumn = function(column){

    const $column = $("<div>")
        .addClass("canvas-column")
        .attr("data-id", column.id);

    // colonna selezionata
    if(
        editor.state.selected &&
        editor.state.selected.type === "column" &&
        editor.state.selected.id === column.id
    ){

        $column.addClass("selected");

        const $toolbar = $("<div>")
            .addClass("column-toolbar")
            .html(`
                <button class="move-left">
                    <span class="material-symbols-outlined">arrow_back</span>
                </button>

                <button class="move-right">
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>

                <button class="delete-column">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            `);

        $column.prepend($toolbar);
    }

    // render widget
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
        widget.id === editor.state.selectedWidgetId ? "selected" : "";
    const content = def.render(widget);

    return `
        <div class="canvas-widget ${selected}" data-id="${widget.id}">
            <div class="widget-toolbar">
                <button class="widget-delete"><span class="material-symbols-outlined">delete</span></button>
            </div>

            ${content}

        </div>
    `;
};

//=================================     
//  colonne sortable
//================================= 
editor.initSortableColumns = function(){

    $(".canvas-columns").sortable({
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

        const $row = $(".canvas-section[data-id='"+section.id+"'] .canvas-columns");

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

editor.renderInspector = function(widget, def){

    const $panel = $("#widget-inspector");

    if(!$panel.length) return;

    $panel.empty();

    $panel.append(`
        <div class="inspector-title">
            <h4>Dettagli ${def.label}</h4>
        </div>
        <div class="inspector-body">Valori ${def.valori}</div>
    `);

};
//===========================================
//  legge fields e genera gli input
//===========================================
editor.renderInspector = function(widget, def){

    const $panel = $("#widget-inspector");

    $panel.empty();

    if(!def.fields) return;
    //------------------------------------------------
    //  testata dettagli
    //------------------------------------------------
    $panel.append(`
        <div class="inspector-title">
            <h4>Dettagli ${def.label}</h4>
        </div>
        <div class="inspector-body">Valori ${def.valori}</div>
    `);

    //------------------------------------------------
    //  campi modificabili
    //------------------------------------------------
    Object.keys(def.fields).forEach(fieldName => {

        const field = def.fields[fieldName];

        const value = widget.props[fieldName] ?? "";

        let input = "";

        if(field.type === "text"){

            input = `
                <input type="textarea"
                       data-field="${fieldName}"
                       value="${value}">
            `;

        }

        if(field.type === "color"){

            input = `
                <input type="color"
                       data-field="${fieldName}"
                       value="${value}">
            `;

        }

        if(field.type === "select"){

            let options = "";

            Object.keys(field.options).forEach(k => {

                const selected =
                    k === value ? "selected" : "";

                options += `
                    <option value="${k}" ${selected}>
                        ${field.options[k]}
                    </option>
                `;

            });

            input = `
                <select data-field="${fieldName}">
                    ${options}
                </select>
            `;

        }

        const row = `
            <div class="inspector-row">

                <label>
                    ${field.label}
                </label>

                ${input}

            </div>
        `;

        $panel.append(row);

    });

};

