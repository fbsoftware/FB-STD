//===============================================================
// Editor Widgets - proprietà + campi di modifica
//==============================================================    
editor.widgets = {

    text: {

        label:"Testo",
        icon:"📝",

  defaultProps:{
     text:"Lorem ipsum dolor sit amet. Sit minus quibusdam eum error blanditiis sed suscipit minus. Sed voluptatem eaque non quam quis quo asperiores quisquam qui harum sunt.",
     align:"left",
     color:"#000000"
  },

  fields:{
    text:{
        type:"text",
        label:"Testo"},

    align:{type:"select",    
        options:{left:"Sinistra",
                center:"Centro",
                right:"Destra"} ,
        label:"Allineamento"}, 

    color:{
        type:"color",
        label:"Colore",
},
  },

    render(widget){
        const p = widget.props;

        return `
        <div style="
            text-align:${p.align || "left"};
            color:${p.color || "#000"};
        ">
            ${p.text || ""}
        </div>
        `;
    }
    },
    image: {

        label: "Immagine",
        icon: "🖼️ ",

        defaultProps: {
            src: "images/image.png",
            alt: "immagine",
            width: "150px",
            align:"center"
        },

        fields:{
            src:{
                type:"image",
                label:"Immagine"},
            alt:{
                type:"text",
                label:"Testo alternativo"},
            width:{
                type:"number",
                label:"Larghezza px"},
            align:{
                type:"select",    
                options:{left:"Sinistra",
                        center:"Centro",
                        right:"Destra"} ,
                label:"Allineamento"}, 
       },      

        render: function(widget){
            return `
            <div class="widget-image">
                <img src="${widget.props.src}" 
                     alt="${widget.props.alt}" 
                     width="${widget.props.width}" 
                     style="align-text:${widget.props.align}"/>
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
            align: "center",    
            color:"#ffa500"
        },

fields:{
    text:{
        type:"text",
        label:"Titolo"
    },
    level:{
        type:"select",
        label:"Tag",
        options:{
            h1:"H1",
            h2:"H2",
            h3:"H3"
        }
    },
    align:{
        type:"select",
        label:"Allineamento",
        options:{
            left:"Sinistra",
            center:"Centro",
            right:"Destra"   }
    },

    color:{
        type:"color",
        label:"Colore"    },
},

        render: function(widget){
            const tag = widget.props.level;
            const col = widget.props.color;
            const all = widget.props.align;
            return `
            <div class="widget-header">
                <${tag} style="text-align:${all} ; color:${col}">
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
            url: "#",
            align: "center",
            color:"#000000",
            sfondo:"#ffa500",
            bordo:"15",
            padd:"20"
        },

        fields:{
            text:{
                type:"text",
                label:"Titolo"
            },
            url:{
                type:"text",
                label:"Link"
            },
            align:{
                type:"select",
                label:"Allineamento",
                options:{
                    left:"Sinistra",
                    center:"Centro",
                    right:"Destra"
                }
            },
            color:{
                type:"color",
                label:"Colore"   },
            
            sfondo:{
                type:"color",
                label:"Sfondo"    },

            bordo:{
                type:"number",
                label:"Raggio bordo px"},
                
            padd:{
                type:"number",
                label:"Padding px"}
        },

        render: function(widget){
            return `
            <div class="widget-button" style="text-align:${widget.props.align}; background-color:${widget.props.sfondo};
            border-radius:${widget.props.bordo}px; padding:${widget.props.padd}px;">
                <a  href="${widget.props.url}" style="text-decoration: none;">
                <span  style="justify-content:center;  color:${widget.props.color};">${widget.props.text}</span></a>
            </div>    
            `;
        }

    }, 
    spacer: {

        label: "Spaziatore",
        icon: "🔘",

        defaultProps: {
                text: "",
                height: "20px"
        },

        fields:{
            text:{
                type:"text",
                label:"Testo"},
            height:{
                type:"number",
                label:"Altezza px"}
       },  

        render: function(widget){
            return `
            <div class="widget-spacer" style="height:${widget.props.height}px">
                ${widget.props.text}
            </div>    
            `;
        }

    }  
}
//=================================
// crea widget
//=================================
    editor.createWidget = function(type){
    const def = editor.widgets[type];
    if(!def){
        console.error("Widget type not found:", type);
        return null;
    }
    return {
        id: editor.uid(),
        type: type,
        props: structuredClone(def.defaultProps)
    };
};

//=================================
// editor widget uid
//=================================
editor.uid = (function(){
    let counter = 0;
    return function(){
        counter++;
        return "w" + Date.now() + "_" + counter;
    };
})();

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

//=================================
// Apre pannello dettagli widget 
//=================================
editor.openWidgetInspector = function(id){

    const widget = editor.findWidgetById(id);
    if (!widget) return;

    const def = editor.widgets[widget.type];

/*     editor.state.selectedType = "widget";
    editor.state.selectedId = id; */

    editor.renderInspector(widget, def);
};
/*
//======================================
// clic-colonna per selezione
//======================================
$(document).on("click", ".canvas-column", function(e){
console.log("-3- .canvas-column-clic");
console.log("STATE:", editor.state);
    const id = $(this).data("id");

    $(".canvas-column").removeClass("selected");
    $(this).addClass("selected");

    editor.openColumnInspector(id);
});
*/
//===============================================================
// Editor Colonne - proprietà + campi di modifica
//==============================================================    
editor.columns = {

  column: {
    label:"Colonna",
    icon:"📝",

    defaultProps:{
      width: 200
    },

    fields: {
      width: {
        type: "range",
        min: 10,
        max: 500,
        label: "Larghezza"
      }
    },

    render(column){
      const p = column.props;

      return `
      <div class="canvas-column"
           data-id="${column.id}"
           style="width:${p.width || 50}px;">
      </div>
      `;
    }
  }
}

//==================================================
// 🧱 1. openColumnInspector
//==================================================
editor.openColumnInspector = function(id){
    console.log("👉 openColumnInspector", id);

    const column = editor.findColumnById(id);

    if (!column) return;
    const def = editor.columns.column;
        editor.renderInspector(column, def);
};

//==================================================
// cerca colonna per dettagli
//==================================================
editor.findColumnById = function(id){
    for (const section of editor.state.sections){
        for (const col of section.columns){
            if (col.id == id) return col;
        }
    }
};

//==================================================
// converte formato per colori
//==================================================
function resolveColor(value) {
  if (!value) return "#000000";

  const match = value.match(/var\(--(.+?)\)/);
  if (match) {
    return getComputedStyle(document.documentElement)
      .getPropertyValue(`--${match[1]}`)
      .trim();
  }

  return value;
}