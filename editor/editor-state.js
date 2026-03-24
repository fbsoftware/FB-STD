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

    sections: [],
    selectedType: null,
    selectedId: null
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
 editor.createSection = function(){
console.log("Crea sezione+col+win");
    const section = {
        id: editor.utils.uuid("sec"),
        columns: [
            {
                id: editor.utils.uuid("col"),
                width: 100,
                widgets: []
            }
        ]
    };

    editor.state.sections.push(section);

    editor.state.selectedType = "section";
    editor.state.selectedId = section.id;

    editor.render();
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

//=================================
//  Duplicate section
//=================================
editor.duplicateSection = function(sectionId){

    const index = editor.state.sections.findIndex(
        s => s.id === sectionId
    );

    if(index === -1) return;

    const original = editor.state.sections[index];

    // copia profonda
    const copy = JSON.parse(JSON.stringify(original));

    // nuovi ID
    copy.id = editor.utils.uuid("sec");

    copy.columns.forEach(col => {

        col.id = editor.utils.uuid("col");

        col.widgets.forEach(w => {
            w.id = editor.utils.uuid("wid");
        });

    });

    // inserisce sotto la sezione originale
    editor.state.sections.splice(index + 1, 0, copy);

    editor.render();

};