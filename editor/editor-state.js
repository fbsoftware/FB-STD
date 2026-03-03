// editor-state.
 
//================================= 
//  Editor State Structure
//================================= 
editor.state = {
    meta: {
        version: "2.0"
    },
    global: {
        colors: {},
        typography: {}
    },
    sections: []
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

//=================================
//  Select element state
//=================================
editor.state.selected = {
    type: null,   // "section" | "column" | "widget"
    id: null
};

//=================================
//  Select element
//=================================
editor.select = function(type, id) {
    editor.state.selected.type = type;
    editor.state.selected.id = id;

    console.log("SELECT:", editor.state.selected); // debug
    editor.render();
};