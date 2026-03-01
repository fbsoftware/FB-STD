//////////////////////////////////////////////////
//  Costante di test (OBBLIGATORIA)
//////////////////////////////////////////////////
const LAYOUT_TEST = {
    "meta": {
        "tema": "blog",
        "page": "home",
        "version": 1,
        "updated_at": "2026-02-07T23:25:30.093Z"
    },
    "sections": {
        "sec-1770506710528": {
            "id": "sec-1770506710528",
            "columns": [
                "col-1770506710528",
                "col-1770506720030"
            ],
            "props": {
                "width": "100%",
                "background": "#ffffff",
                "padding": "0px"
            }
        }
    },
    "columns": {
        "col-1770506710528": {
            "id": "col-1770506710528",
            "sectionId": "sec-1770506710528",
            "widgets": [],
            "props": {
                "width": "100%",
                "padding": "0px"
            }
        },
        "col-1770506720030": {
            "id": "col-1770506720030",
            "sectionId": "sec-1770506710528",
            "widgets": [],
            "props": {
                "width": "100%",
                "padding": "0px"
            }
        }
    },
    "widgets": [],
    "theme": {
        "colors": {
            "primary": "#3366ff",
            "secondary": "#ff6633",
            "accent": "#ffa500",
            "text": "#000000",
            "background": "#ffffff"
        },
        "typography": {
            "heading": {
                "fontFamily": "Inter",
                "weight": 700
            },
            "body": {
                "fontFamily": "Inter",
                "weight": 400
            },
            "sizes": {
                "h1": 32,
                "h2": 24,
                "h3": 20,
                "body": 16,
                "small": 10
            }
        }
    }
}



//================================================  
//  3️⃣ Funzione di test (OBBLIGATORIA)
//================================================
editor.testLoad = function () {
  editor.resetEditor();
  editor.deserializeLayout(LAYOUT_TEST);
  editor.renderFromState();
};
//////////////////////////////////////////////////