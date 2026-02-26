


//==========================================
//  riordina i widget nella colonna sortable
//==========================================
editor.syncColumnOrder = function (sectionId, columnId) {

  const section = editor.state.sections[sectionId];
  if (!section) return;

  const column = section.columns[columnId];
  if (!column) return;

  const newOrder = [];

  $(`.column[data-id="${columnId}"] .canvas-widget`).each(function () {
    newOrder.push($(this).data('id'));
  });

  column.widgets = newOrder;

  console.log('Nuovo ordine colonna', columnId, newOrder);
};

//======================================
//  RENDER COLONNA (canvas)
//======================================
editor.renderColumn = function (columnId) {

  const column = editor.state.columns[columnId];
  if (!column) return;

  const $column = $(`.column[data-id="${columnId}"]`);
  if (!$column.length) return;

  // pulizia totale canvas
  $column.empty();

  // render widgets
  column.widgets.forEach(widgetId => {

    const widget = editor.state.widgets[widgetId];
    if (!widget) return;

    const def = editor.widgetRegistry[widget.type];
    if (!def || !def.renderCanvas) return;

    const html = `
      <div class="canvas-widget"
           data-id="${widget.id}"
           data-type="${widget.type}">
        ${def.renderCanvas(widget)}
        <span class="widget-remove">✕</span>
      </div>
    `;

    $column.append(html);
  });

  // riattiva sortable (safe)
  editor.activateColumn($column);
};

// ---------------------------------------------
// 👉 Applica le proprietà al widget nel DOM:
//---------------------------------------------
function applyProps(widgetEl, data) {

    switch (data.type) {
        case "titolo":
            widgetEl
                .text(data.props.titolo)
                .css("color", data.props.color)
                .css("align", data.props.aligh);
            break;
        case "testo":
            widgetEl
                .text(data.props.testo)
                .css("color", data.props.color);
            break;

        case "bottone":
            widgetEl
                .text(data.props.label)
                .css({
                    color: data.props.color,
                    backgroundColor: data.props.background
                });
            break;

                    case "image":
            widgetEl
                .text(data.props.label)
                .css({
                    color: data.props.color,
                    backgroundColor: data.props.background
                });
            break;

                    case "space":
            widgetEl
                .text(data.props.label)
                .css({
                  backgroundColor: data.props.background
                });
            break;
    }
   
}

//================================================    
// editor.resolveWidgetProps
//================================================
editor.resolveWidgetProps = function (widget) {

  const theme = editor.state.theme;
  const props = { ...widget.props };

  if (widget.type === 'titolo') {
    props.color = props.color ?? theme.colors.text;
    props.fontFamily = props.fontFamily ?? theme.typography.heading.fontFamily;
    props.fontWeight = props.fontWeight ?? theme.typography.heading.weight;
  }

  return props;
};

//================================================
//  spinner 1:50
//================================================
$('#widget-details').on('input change', 'input[type=number]', function () {
  const value = parseInt(this.value, 10) || 0;
  // passa dal tuo bindWidgetPropsLivePreview
});

//==========================================
//  STEP 16 — Load layout da JSON
//==========================================
editor.loadLayout = function (data) {

  if (!data || !data.sections) {
    console.warn('Layout non valido');
    return;
  }

  // 1️⃣ reset totale
  editor.state.sections = {};
  editor.state.columns  = {};
  editor.state.widgets  = {};

  editor.state.selected = {
    sectionId: null,
    columnId: null,
    widgetId: null
  };

  // 2️⃣ ripristina theme (se presente)
  if (data.theme) {
    editor.state.theme = data.theme;
    editor.applyTheme();
  }

  // 3️⃣ ripristina state grezzo
  editor.state.sections = data.sections;
  editor.state.columns  = data.columns;
  editor.state.widgets  = data.widgets;

  // 4️⃣ render canvas completo
  editor.renderCanvas();

  console.log('Layout caricato correttamente');
};


//==========================================
//  Render completo del canvas
//==========================================
editor.renderCanvas = function () {

  const $canvas = $('#canvas');
  $canvas.empty();

  Object.values(editor.state.sections).forEach(section => {
    const $section = editor.renderSection(section.id);
    $canvas.append($section);
  });
console.log("==>canvas",$section);
  editor.makeSectionsSortable();
};

//================================================
//  🧩 8️⃣ Deserialize layout (core dello step)
//================================================

editor.deserializeLayout = function (data) {

  // 🔥 Theme globale
  if (data.theme) {
    editor.state.theme = data.theme;
    editor.applyTheme();
  }

  data.sections.forEach(sec => {

    editor.createSection(sec.id);

    sec.columns.forEach(col => {

      editor.addColumn(sec.id, col.id);

      col.widgets.forEach(w => {

        editor.addWidgetToColumn(col.id, {
          id: w.id,
          type: w.type,
          props: w.props
        });

      });

    });

  });

};
//==========================================
//  ⚙️ 6️⃣ JS – Load layout nell’editor
//==========================================
editor.loadLayout = function (page) {

  //$.getJSON('load-layout.php', {
  //  tema: EDITOR_CONFIG.tema,
  //  page: page
  //}, function (data) {

    editor.resetEditor();
    editor.deserializeLayout(data);

    console.log('Layout caricato:', page);
  }
//==========================
// SAVE DEL JSON
//==========================
 $('#save-layout').on('click', function () {
  const payload = editor.serializeLayout();
  const pagina  = window.EDITOR_CONFIG.pagina;findSectionByWidget
  const tema = editor.setThemeValue
  $.ajax({
    url: 'save_layout.php?pagina',
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify(payload),
    success: function (res) {
      alert('Layout salvato correttamente');
      console.log(res);
    },
    error: function () {
      alert('Errore nel salvataggio');
    }
  });
});

