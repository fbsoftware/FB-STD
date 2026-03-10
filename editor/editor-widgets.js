//===============================================================
// Editor Widgets
//==============================================================    
editor.widgets = {

    text: {
        label: "Testo",

        icon: "📝",

        defaultProps: {
            text: "Nuovo testo"
        },

        render: function(widget){
            return `
                <div class="widget-text">
                    ${widget.props.text}
                </div>
            `;
        }

    },

    image: {

        label: "Immagine",
        icon: "🖼️ ",

        defaultProps: {
            src: "https://placehold.co/150x150",
            alt: "https://placehold.co/150x150"
            
        },

        render: function(widget){
            return `
            <div class="widget-image">
                <img src="${widget.props.src}" alt="${widget.props.alt}" />
            </div>
            `;
        }

    },
header: {
        label: "Titolo",
        icon: "📌",

        defaultProps: {
            text: "Titolo ---",
            level: "h2",
            align: "center"
        },

        render: function(widget){
            const tag = widget.props.level;
            return `
            <div class="widget-header">
                <${tag} style="text-align:${widget.props.align}">
                    ${widget.props.text}
                </${tag}>
            </div>
            `;
        }

    },
button: {

        label: "Bottone",
        icon: "🔘",

        defaultProps: {
            text: "CERCA",
            url: "",
            align: "center"
        },

        render: function(widget){
            return `
            <div class="widget-button">
                <a  src="${widget.props.src}"/>
            </div>    
            `;
        }

    }, 
 spacer: {

        label: "Spaziatore",
        icon: "🔘",

        defaultProps: {
                text: "Spazio vuoto",
                height: "200px"
        },

        render: function(widget){
            return `
            <div class="widget-spacer">
                <br  src="${widget.props.src}"/>
            </div>    
            `;
        }

    }  
}
//=================================
// crea widget
//=================================
    Object.keys(editor.widgets).forEach(type => {

    const w = editor.widgets[type];

    w.create = function(){

        return {
            id: "w" + Date.now() + Math.floor(Math.random()*1000),
            type: type,
            props: {...w.defaultProps}
        };

    };

})
 
//=================================
// Render widget palette
//=================================
editor.renderWidgetPalette = function(){

    const $panel = $("#widgets-panel");

    $panel.empty();

    Object.keys(editor.widgets).forEach(function(type){

        const widget = editor.widgets[type];

        const $item = $("<div>")
            .addClass("palette-widget")
            .attr("draggable", true)
            .attr("data-widget", type)
            .text(widget.icon + " " + widget.label);

        $panel.append($item);

    });

};
 
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
//=================================
// Crea widget nel canvas
//=================================
editor.createWidget = function(type){

    const def = this.widgets[type];

    if(!def){
        console.error("Widget type not found:", type);
        return null;
    }

    return {

        id: this.uid(),

        type: type,

        props: structuredClone(def.defaultProps)

    };

};