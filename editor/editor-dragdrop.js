//===============================================================
// Editor Drag & Drop
//==============================================================    
$(document).on("dragstart", ".widget-item", function(e){

    const type = $(this).data("widget");

    e.originalEvent.dataTransfer.setData("widget-type", type);

});

//=================================
// Drop su colonna
//================================= 
$(document).on("dragover", ".canvas-column", function(e){

    e.preventDefault();

});

//=================================
// 2️⃣ Rende le colonne "sortable"
//================================= 
editor.initSortable = function(){

    $(".canvas-column").sortable({
        placeholder: "widget-placeholder",

        stop: function(event, ui){
            const columnId = $(this).data("id");
            const newOrder = [];

            $(this).children(".canvas-widget").each(function(){
                newOrder.push($(this).data("id"));
            });

            editor.updateWidgetOrder(columnId, newOrder);

        }

    });

};

//=================================
// 3️⃣ Aggiorna lo state
//=================================
editor.updateWidgetOrder = function(columnId, newOrder){

    editor.state.sections.forEach(section => {

        section.columns.forEach(column => {

            if(column.id === columnId){

                const reordered = [];

                newOrder.forEach(widgetId => {

                    const widget =
                        column.widgets.find(w => w.id === widgetId);

                    if(widget) reordered.push(widget);

                });

                column.widgets = reordered;

            }

        });

    });

};

//=================================
// Colori colonne "droppabili"
//=================================
$(document).on("dragover", ".canvas-column", function(e){
    e.preventDefault();
});
$(document).on("dragenter", ".canvas-column", function(){
    $(this).addClass("drag-over");
});

$(document).on("dragleave", ".canvas-column", function(){
    $(this).removeClass("drag-over");
});

$(document).on("drop", ".canvas-column", function(){
    $(this).removeClass("drag-over");
});

//=================================
// widgets sortable
//=================================
editor.initSortableWidgets = function () {

    $(".canvas-column").sortable({
        items: ".canvas-widget",
        connectWith: ".canvas-column",
        placeholder: "widget-placeholder",

        start: function (event, ui) {
            ui.placeholder.height(ui.item.height());
        },
        stop: function (event, ui) {
            editor.syncWidgetsState();
        }
    });
};

//=================================
// Sync widget order in state
//=================================
editor.syncWidgetsState = function () {

    editor.state.sections.forEach(section => {

        section.columns.forEach(column => {

            const columnId = column.id;

            const $column = $(".canvas-column[data-id='" + columnId + "']");

            const newWidgets = [];

            $column.children(".canvas-widget").each(function () {

                const widgetId = $(this).data("id");

                const widget = editor.findWidgetById(widgetId);

                if (widget) newWidgets.push(widget);

            });

            column.widgets = newWidgets;

        });

    });

};

//=================================
// Find widget by ID
//=================================
editor.findWidgetById = function (id) {

    for (const section of editor.state.sections) {

        for (const column of section.columns) {

            const widget = column.widgets.find(w => w.id === id);

            if (widget) return widget;

        }

    }

    return null;

};