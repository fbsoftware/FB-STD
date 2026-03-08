var editor = editor || {};
editor.utils = editor.utils || {};

//==============================
// Generatore ID unico
//==============================
editor.utils.uuid = function(prefix = "id") {

    return prefix + "-" +
           Date.now() + "-" +
           Math.floor(Math.random() * 1000);

};