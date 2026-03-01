
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

//=========================================
//  ULTRA ROBUST LAYOUT LOADER v3
//=========================================
editor.loadLayout = function (tema, page) {
  // ---- HARD SAFE PARAMS
  tema = tema   || editor.currentTema  || editor.state?.meta?.tema  || "default";
  page  = page  || editor.currentPage  || editor.state?.meta?.page  || "default";

  editor.currentTema = tema;
  editor.currentPage  = page;
console.log("✅ Layout loaded:", tema, page );

  const url = `siti/${tema}/${page}.json`;

  return $.getJSON(url)
    // ===========================
    // ✅ SUCCESS
    // ===========================
    .done(function (data) {

      // ---- HARD RESET
      editor.resetData?.();
      $("#canvas").empty();

      // ---- HARD SANITIZE ROOT
      editor.state = data && typeof data === "object" ? data : {};
      editor.state.meta    = editor.state.meta    || { tema, page };
      editor.state.sections= editor.state.sections|| {};
      editor.state.columns = editor.state.columns || {};
      editor.state.widgets = editor.state.widgets || {};
      editor.state.theme   = editor.state.theme   || {};

      // ---- FIX widgets array -> object
      if (Array.isArray(editor.state.widgets)) {
        const obj = {};
        editor.state.widgets.forEach(w => w?.id && (obj[w.id] = w));
        editor.state.widgets = obj;
      }

      // ---- FIX columns widgets missing array
      Object.values(editor.state.columns).forEach(c => {
        if (!Array.isArray(c.widgets)) c.widgets = [];
      });

      // ===========================
      // RENDER PIPELINE (SAFE ORDER)
      // ===========================

      // 1️⃣ Sections
      Object.values(editor.state.sections).forEach(sec => {
        editor.addSection(sec.id, { fromLoad: true });
      });

      // 2️⃣ Columns
      Object.values(editor.state.columns).forEach(col => {
        editor.addColumn(col.sectionId, col.id, { fromLoad: true });
      });

      // 3️⃣ Widgets (bind to real columns)
      Object.values(editor.state.widgets).forEach(widget => {
        const col = Object.values(editor.state.columns)
          .find(c => c.widgets.includes(widget.id));

        if (!col) {
          console.warn("⚠ Widget without column:", widget.id);
          return;
        }

        editor.addWidgetToColumn(col.id, widget, { fromLoad: true });
      });

      // ===========================
      // FINAL SYNC FRAME
      // ===========================
      requestAnimationFrame(() => {
  editor.applyStateToCanvas();
});

    })

    // ===========================
    // ❌ FAIL SAFE MODE
    // ===========================
    .fail(function (xhr) {
      console.error("❌ Layout load failed:", url, xhr.status);

      editor.state = {
        meta: { tema, page },
        sections: {},
        columns: {},
        widgets: {},
        theme: {}
      };

      $("#canvas").empty();
      console.warn("⚠ Empty layout initialized");
    });
};