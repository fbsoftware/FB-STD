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
                width:100,
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

//=====================================
// widget header
//=====================================
editor.renderHeaderWidget = function(widget){

    const text = widget.props?.header || "Header widget";

    return `
        <div class="widget-header">
            ${text}
        </div>
    `;

}
//=====================================
// widget testo
//=====================================
editor.renderTextWidget = function(widget){

    const text = widget.props?.text || "Text widget";

    return `
        <div class="widget-text">
            ${text}
        </div>
    `;

}

//=====================================
// widget image
//=====================================
editor.renderImageWidget = function(widget){

    const text = widget.props?.image || "Image widget";

    return `
        <div class="widget-image">
            ${text}
        </div>
    `;

}

//=====================================
// widget spacer
//=====================================
editor.renderSpacerWidget = function(widget){

    const text = widget.props?.spacer || "Spacer widget";

    return `
        <div class="widget-spacer">
            ${text}
        </div>
    `;

}

//=====================================
// widget button
//=====================================
editor.renderButtonWidget = function(widget){

    const text = widget.props?.button || "Button widget";

    return `
        <div class="widget-button">
            ${text}
        </div>
    `;

}
//=================================
// Render widget
//================================= 
editor.renderWidget = function(widget){

    const def = this.widgets[widget.type];

    if(!def){
        return "";
    }

    const content = def.render(widget);

    return `
    <div class="canvas-widget" data-id="${widget.id}">

        <div class="widget-toolbar">
            <button class="widget-edit" data-id="${widget.id}">✏️</button>
            <button class="widget-delete" data-id="${widget.id}">🗑</button>
        </div>

        <div class="widget-body">
            ${content}
        </div>

    </div>
    `;

};

/*
  editor.renderWidget = function(widget){

    const $w = $("<div>")
        .addClass("canvas-widget")
        .attr("data-id", widget.id);

    if(widget.type === "text"){

        $w.text(widget.content);

    }

    if(widget.type === "button"){

        const $btn = $("<button>")
            .text(widget.text)
            .attr("href", widget.url);

        $w.append($btn);

    }

     if(widget.type === "header"){
        const $header = $("<h2>")
            .text(widget.text);

        $w.append($header);

    }

 if(widget.type === "image"){

        const $img = $("<img>")
            .attr("src", widget.src)
            .attr("alt", widget.alt);

        $w.append($img);

    }

      if(widget.type === "spacer"){
        const $spacer = $("<div>")
        .attr("style", `height:${widget.height}px;`);
        $w.append($spacer);

    }

    return $w;

};
*/
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
