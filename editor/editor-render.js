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
                <button class="delete-section">🗑</button>
            `);

        $section.prepend($toolbar);
    }

    const $columns = $("<div>").addClass("section-columns");

    section.columns.forEach(col => {
        $columns.append(editor.renderColumn(col));
    });

    $section.append($columns);


    const $addColumn = $("<button>")
        .addClass("add-column")
        .text("+ Colonna")
        .on("click", function(){

        section.columns.push({
        id: editor.utils.uuid("col"),
        width: 100,
        widgets: []
});

            editor.render();
        });

    $section.append($addColumn);

    return $section;
};

//=================================
// Render column
//=================================
editor.renderColumn = function(column){

    const $column = $("<div>")
        .addClass("canvas-column")
        .attr("data-id", column.id);

    column.widgets.forEach(function(widget){
        const $widget = editor.renderWidget(widget);
        $column.append($widget);
    });

    return $column;
};
//=================================
// Render widget
//================================= 
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