// editor-state.
 
//================================= 
//  Editor State Structure
//================================= 
editor.state = {

    meta:{
        tema: window.EDITOR_CONFIG.tema,
        page: window.EDITOR_CONFIG.page,
        version: "2.0",
        updated_at: null
    },

    global:{
        colors:{},
        typography:{},
        fonts:{}

    },

    sections:[],

    selected:{
        type:null,
        id:null
    }

};

//================================= 
//  State genera Id
//=================================
editor.generateId = function(prefix) {
    return prefix + "-" + Date.now() + "-" + Math.floor(Math.random() * 1000);
};

//=================================
//  Create new section
//=================================
editor.createSection = function() {

    const newSection = {
        id: editor.generateId("sec"),
        settings: {
            background: "#ffffff",
            paddingTop: 40, 
            paddingBottom: 40
        },
        columns: [
            {
                id: editor.generateId("col"),
                width: 100,
                widgets: []
            }
        ]
    };

    editor.state.sections.push(newSection);
};
/*
//=================================
//  Select element state - widget
//=================================
editor.state.selected = {
    type: "widget",
    id: widget.id
};
*/
//=================================
//  Select element
//=================================
editor.select = function(type, id) {
    editor.state.selected.type = type;
    editor.state.selected.id = id;

    console.log("SELECT:", editor.state.selected); // debug
    editor.render();
};