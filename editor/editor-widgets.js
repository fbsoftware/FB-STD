//===============================================================
// Editor Widgets
//==============================================================    
editor.widgets = {

    text: {
        label: "Testo",
        icon: "📝",
        create: function(){

            return {
                id: editor.generateId("w"),
                type: "text",
                content: "Nuovo testo"
            };

        }
    },
    header: {
        label: "Titolo",
        icon: "📌",
        create: function(){

            return {
                id: editor.generateId("w"),
                type: "text",
                content: "Titolo ..."
            };

        }
    },
    button: {
        label: "Bottone",
        icon: "🔘",
        create: function(){

            return {
                id: editor.generateId("w"),
                type: "button",
                text: "Click qui",
                url: "#"
            };

        }
    },

  spacer:  {
        label: "Spaziatore",
        icon: "⬇️",
        create: function(){

            return {
                id: editor.generateId("w"),
                type: "spacer",
                height: "200px"
            };

        }
    },

     image:{
        label: "Immagine",
        icon: "🖼️ ",
        create: function(){

            return {
                id: editor.generateId("w"),
                type: "image",
                src: "src='images/auto.jpg' alt='Auto'",
                height: 200
            };

        }
    }

}

//=================================
// Render widget palette
//=================================
editor.renderWidgetPalette = function(){

    const $panel = $("#widgets-panel");

    $panel.empty();

    Object.keys(editor.widgets).forEach(function(type){

        const widget = editor.widgets[type];

        const $item = $("<div>")
            .addClass("widget-item")
            .attr("draggable", true)
            .attr("data-widget", type)
            .text(widget.icon + " " + widget.label);

        $panel.append($item);

    });

};
/*=================================
// Heading widget - titolo
//=================================
editor.widgets.heading = {

    label: "Titolo",
    icon: "T",

    create(){
        return {
            id: editor.generateId("w"),
            type: "heading",
            content: "Titolo",
            level: "h2",
            align: "left"
        };
    },

    render(widget){
        return $("<" + widget.level + ">")
            .text(widget.content)
            .css("text-align", widget.align);
    },

    props: [
        { type:"text", label:"Testo", field:"content" },
        { type:"select", label:"Livello", field:"level",
            options:["h1","h2","h3","h4"]
        },
        { type:"select", label:"Allineamento", field:"align",
            options:["left","center","right"]
        }
    ]

};
*/

//=================================
//  3️⃣ Trova il widget selezionato
//=================================
editor.getSelectedWidget = function(){

    const id = editor.state.selected.id;

    for(const section of editor.state.sections){

        for(const column of section.columns){

            for(const widget of column.widgets){

                if(widget.id === id) return widget;

            }

        }

    }

    return null;

};

//=================================
// Render PROPS widget
//=================================
editor.renderProperties = function(){

    const $panel = $("#properties-panel");
    $panel.empty();

    const widget = editor.getSelectedWidget();

    if(!widget) return;

    const def = editor.widgets[widget.type];

    def.props.forEach(prop => {

        const $field = $("<div>").addClass("prop-field");

        const $label = $("<label>").text(prop.label);

        let $input;

        if(prop.type === "text"){

            $input = $("<input>")
                .val(widget[prop.field]);

        }

        if(prop.type === "select"){

            $input = $("<select>");

            prop.options.forEach(opt => {
                $input.append(
                    $("<option>")
                        .val(opt)
                        .text(opt)
                );
            });

            $input.val(widget[prop.field]);
        }

        $input.on("input change", function(){

            widget[prop.field] = $(this).val();

            editor.render();

        });

        $field.append($label).append($input);

        $panel.append($field);

    });

};