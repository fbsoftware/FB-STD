const editor = {};

//================================================
// 5️⃣ Escape HTML
//================================================
editor.escapeHTML = function (str) {
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;");
};

// ==========================================
//  PANEL LOADER (CORE)
// ==========================================
  editor.loadPanel = function (panelName, callback) {
  console.log('loadPanel chiamato con:', panelName);

$('#panel-container').load(
  `/panels/+ ${panelName} +.html`,
  function (response, status) {

    console.log('LOAD STATUS:', status);

    if (status !== 'success') {
      console.error('Panel NON caricato:', panelName);
      return;
    }

    console.log('Panel caricato:', panelName);

    if (typeof callback === 'function') {
      callback();
    }
  }
);

};

//================================================  
//  reset editor
//================================================
editor.resetEditor = function () {

  editor.state = {
    sections: {},
    columns: {},
    widgets: {},
    theme: {}
  };

  $('#canvas').empty();

  console.log('Editor resettato');
};


//================================================  
//  1️⃣ deserializeLayout
//================================================
editor.deserializeLayout = function (data) {

  if (!data || !data.sections) {
    console.warn('Layout non valido');
    return;
  }

  editor.state = {
    sections: data.sections || {},
    columns:  data.columns  || {},
    widgets:  data.widgets  || {},
    theme:    data.theme    || {}
  };

  console.log('State caricato:', editor.state);
};

//================================================  
//  2️⃣ renderFromState
//================================================
editor.renderFromState = function () {

  const $canvas = $('#canvas');
  $canvas.empty();

  console.log('Render sezioni');

  Object.values(editor.state.sections).forEach(section => {
  console.log('→ sezione', section.id);
  editor.renderSection(section.id);

  section.columns.forEach(colId => {
    console.log('→ colonna', colId);
    editor.renderColumn(colId);

    editor.state.columns[colId].widgets.forEach(widgetId => {
      editor.renderWidget1(widgetId, colId);
      console.log('→ widget', widgetId);
    });
  });
});


  console.log('Canvas ricostruito');
};

//================================================  
//  Funzioni di render GREZZE
//================================================
editor.renderSection = function (sectionId) {
  const section = editor.state.sections[sectionId];
  if (!section) return null;

  const $section = $(`
    <div class="section" data-id="${sectionId}">
      <div class="section-handle">☰</div>
      <div class="section-inner"></div>
    </div>
  `);

  $('#canvas').append($section);
  return $section;
};

editor.renderColumn = function (columnId) {
  const column = editor.state.columns[columnId];
  if (!column) return null;

  const $column = $(`
    <div class="column" data-id="${columnId}">
      <div class="column-inner"></div>
    </div>
  `);

  $(`[data-id="${column.sectionId}"] .section-inner`).append($column);
  return $column;
};

editor.renderWidget1 = function (widgetId, columnId) {
  const widget = editor.state.widgets[widgetId];
  if (!widget) return null;

  let html = '';

  if (widget.type === 'titolo') {
    const level = widget.props.level || 'h2';
    html = `<${level}>${widget.props.text || ''}</${level}>`;
  }

  const $widget = $(`
    <div class="canvas-widget" data-id="${widgetId}">
      ${html}
    </div>
  `);

  $(`[data-id="${columnId}"] .column-inner`).append($widget);
  return $widget;
};


//================================================  
//  Costante di test (OBBLIGATORIA)
//================================================
const LAYOUT_TEST = {
  sections: {
    "sec-1": {
      id: "sec-1",
      columns: ["col-1"]
    }
  },
  columns: {
    "col-1": {
      id: "col-1",
      sectionId: "sec-1",
      widgets: ["wid-1"]
    }
  },
  widgets: {
    "wid-1": {
      id: "wid-1",
      type: "titolo",
      props: {
        text: "Hello world",
        level: "h2"
      }
    }
  }
};



//================================================  
//  3️⃣ Funzione di test (OBBLIGATORIA)
//================================================
editor.testLoad = function () {
  editor.resetEditor();
  editor.deserializeLayout(LAYOUT_TEST);
  editor.renderFromState();
};





//================================================  
//  pannello stile è pronto
//================================================
editor.initStylePanel = function () {
  editor.renderStylePanel();
  editor.bindStylePanelEvents();

  editor.applyTheme(); // ✅ QUI È CORRETTO

  console.log('Style panel inizializzato');
};

//================================================
//  setta il tema
//================================================
editor.setThemeValue = function (path, value) {
  const keys = path.split('.');
  let obj = editor.state.theme;

  while (keys.length > 1) {
    obj = obj[keys.shift()];
  }

  obj[keys[0]] = value;
};

//================================================
//  aggiorna DOM del widget
//================================================
editor.updateWidgetDOM = function (widgetId) {
  const widget = editor.state.widgets[widgetId];
  if (!widget) return;

  const $el = $(`.canvas-widget[data-id="${widgetId}"]`);
  if (!$el.length) return;

// 🔤 TITOLO
if (widget.type === 'titolo') {
  const level = widget.props.level || 'h2';
  const text  = widget.props.text || '';
  const align = widget.props.align || 'center';

  let $heading = $el.find('h1, h2, h3');

  // se cambia il livello → ricrea il tag
  if (!$heading.is(level)) {
    const $new = $(`<${level}>`).text(text);
    $heading.replaceWith($new);
    $heading = $new;
  } else {
    $heading.text(text);
  }

  // 🔥 allineamento = CSS
  $heading.css('text-align', align);
}

// 📝 TESTO
if (widget.type === 'testo') {
  const text = widget.props.text || '';

  const $content = $el.find('.widget-content');
  if (!$content.length) return;

  $content.html(text);
}
//==============================================
 // 📝 BOTTONE
//==============================================
  
  if (widget.type === 'bottone') {
  const text = widget.props.bottone || '';
  const url  = widget.props.url || '#';

  const $a = $el.find('a');
  if (!$a.length) return;

  $a.text(text);
  $a.attr('href', url);
console.log('Update DOM', widget.type, $el.html());

}

  //==============================================
  // 🖼️ IMMAGINE
  //==============================================
  if (widget.type === 'image') {
  const src = widget.props.src || '';
  const alt = widget.props.alt || '';

  const $img = $el.find('img');
  if (!$img.length) return;

  $img.attr('src', src);
  $img.attr('alt', alt);
}
    //==============================================
  //  ⬜ SPAZIATORE
  //==============================================
if (widget.type === 'space') {
  const height = widget.props.height || 1;
  const $space = $el.find('.widget-space');
  if (!$space.length) return;
  $space.css('height', height + 'px');
}   

};

//================================================
//  Annulla selezione
//================================================
editor.clearSelection = function () { 
  editor.state.selected = {
    sectionId: null,
    columnId: null,
    widgetId: null
    }
  };

//================================================
//  4️⃣ Render pannello widget
//================================================
editor.renderWidgetPanel = function (widgetId) {

  const widget = editor.state.widgets[widgetId];
  if (!widget) return;

  const $panel = $('#widget-details .panel-body');
  $panel.empty();
  if (!widget) {
    $panel.html('<p>Seleziona un widget</p>');
    return;
  }

  // 🔥 qui carichi i controlli GIUSTI
   console.log('Render controls:', widget.type);
  editor.renderWidgetControls(widget, $panel);
 
};
//================================================
//  5️⃣ Render controlli widget 
//================================================
editor.renderWidgetControls = function (widget, $panel) {

  if (!widget || !widget.type) {
    $panel.html('<p>Widget non valido</p>');
    return;
  }
// panel-header
       $panel.append(`
          <h3 class="pink">Dettagli widget ${widget.type} </h3>
       `);
  switch (widget.type) {

    case 'titolo':
      $panel.append(`
      
        <label>Testo</label>
        <input type="text"
               data-prop="text"
               value="${widget.props?.text || ''}">

        <label>Livello</label>
        <select data-prop="level">
          <option value="h1" ${widget.props?.level === 'h1' ? 'selected' : ''}>H1</option>
          <option value="h2" ${widget.props?.level === 'h2' ? 'selected' : ''}>H2</option>
          <option value="h3" ${widget.props?.level === 'h3' ? 'selected' : ''}>H3</option>
        </select>
        
        <label>Allineamento</label>
        <select data-prop="align">
          <option value="left"     ${widget.props?.align === 'left' ? 'selected' : ''}>left</option>
          <option value="center" ${widget.props?.align === 'center' ? 'selected' : ''}>center</option>
          <option value="right"   ${widget.props?.align === 'right' ? 'selected' : ''}>right</option>
        </select>
       
      `);
      break;

    case 'testo':
      $panel.append(`
        <label>Contenuto</label>
        <textarea name="" data-prop="text">${widget.props?.text}</textarea>
      `);
      break;

    case 'image':
      $panel.append(`
        <label>URL immagine</label>
        <input type="text"
               data-prop="src"
               value="${widget.props?.src || ''}">
          <label>Testo altern.</label>
        <input type="text"
               data-prop="alt"
               value="${widget.props?.alt || ''}">      
      `);
      break;

    case 'space':
      $panel.append(`
        <p><label for="spinner">Altezza px</label>
           <input type="number" name="spinner" data-prop="height" value=${widget.props?.height || 1}  step="5"></p>
      `);
      break;

    
    case 'bottone':
      $panel.append(`
         <label>Testo bottone</label>
         <input type="text"
               data-prop="bottone"
               value="${widget.props?.text || ''}">

          <label>URL</label>
        <input type="text"
                data-prop="url"
                value="${widget.props?.url || ''}">
                      `);
     break; 

    default:
      $panel.html('<p>Nessun controllo disponibile</p>');
  }
};

//================================================    
//  nessun widget è selezionato = pannello vuoto
//================================================
editor.clearWidgetPanel = function () {
  $('#widget-details .panel-body').html(
    '<div class="panel-placeholder">Seleziona un widget</div>'
  );
};
  

//================================================
//  7️⃣ Render widget preview 
//================================================
editor.renderWidgetPreview = function (widget) {

  switch (widget.type) {
    case 'titolo':
      return `<${widget.props.level} style="text-align: ${widget.props.align}">${widget.props.text}</${widget.props.level}>`;
    case 'testo':
      return `<p>${widget.props.text}</p>`;
        case 'space':
      return `<div class="widget widget-space" style="height: ${widget.props.height}px;"></div>`;
    case 'bottone':
      return `<a href="${widget.props.url}" class="widget-bottone">${widget.props.text}</a>`;
    case 'image':
      return `<img src='${widget.props.src}' alt='${widget.props.alt}' height="200"/>`;
    default:
      return `<div>${widget.type}</div>`;
  }
};

//================================================
//  1️⃣ Palette = sortable “finta”
//================================================
editor.makePaletteSortable = function () {
  $('#palette').sortable({
    items: '.palette-widget',
    connectWith: '.column',
    helper: 'clone',
    revert: true,
    start: function (e, ui) {
      ui.item.addClass('palette-clone');
    }
  });
};
// --------------------------------------------- 
// proprietà di default 
//--------------------------------------------- 
editor.getDefaultProps = function (type) {
  if (!type) return {};

  switch (type) {
    case "testo":
      return { text: "Lorem ipsum dolor sit amet. At sint deserunt At odio reprehenderit vel eveniet molestiae. Quo maiores debitis ut dignissimos nulla qui eligendi voluptas aut perferendis nihil. Sed tenetur deserunt et earum enim et molestiae praesentium et tempore error ut obcaecati consequatur nam nihil velit non eius dolorem."};
    case "titolo":
      return { text: "Titolo..." , level: "h2" , align: "center"};
    case "space":
      return { height: 1 };  
    case "bottone":
      return { text: "Clicca qui" , url: "#" };
    case "image":
      return { src: "images/image.png"};
    case "column":
      return {    width: '100%',    padding: '0px'};  
    case "section":
      return {    width: '100%',  background: '#fefefe' ,  padding: '0px'};   
    default:
      return {};
    }
  };
//=============================================
// ➕ STEP 10.3 – Inserimento widget in colonna
//=============================================
editor.addWidgetToColumn = function (columnId, widgetData) {

  const widgetId = 'wid-' + Date.now();
console.log('Creato widget:', widgetId);

  const widget = {
    id: widgetId,
    type: widgetData.type,
    props: editor.getDefaultProps(widgetData.type)
  };

  // 1️⃣ salva nello state
  editor.state.widgets[widgetId] = widget;

  editor.state.columns[columnId].widgets.push(widgetId);

  // 2️⃣ CREA SOLO IL NODO WIDGET (non tutta la colonna)
  const $column = $(`.column[data-id="${columnId}"]`);

  const $widgetEl = editor.renderWidget(widgetId);
  $column.append($widgetEl);

  // 3️⃣ seleziona
  editor.selectWidget(widgetId);
};


//================================================
//  COLONNA: sortable SOLO per canvas-widget
//================================================
editor.activateColumn = function ($column) {

  if ($column.data('sortable')) return;
  console.log('Attivo colonna:', $column.data('id'));

  $column.sortable({
    items: '.canvas-widget',
    connectWith: '.column',
    placeholder: 'widget-placeholder',
    tolerance: 'pointer'
  });

  // 🔥 SOLO DROPPABLE PER LA PALETTE
  $column.droppable({
    accept: '.palette-widget',
    hoverClass: 'column-hover',

    drop: function (e, ui) {

      const widgetType = ui.draggable.data('type');
      const columnId   = $column.data('id');

      console.log('DROP DA PALETTE:', widgetType, columnId);

      editor.addWidgetToColumn(columnId, {
        type: widgetType
      });
    }
  });

  $column.data('sortable', true);
};


//================================================
//  2️⃣ Render widget nel canvas (1 funzione universale)
//================================================
editor.renderWidget = function (widgetId) {

  const widget = editor.state.widgets[widgetId];
  if (!widget) return null;

  return $(`
    <div class="canvas-widget" data-id="${widgetId}">
      <div class="widget-header">
        <button class="delete-widget pink">✖</button>
      </div>
      <div class="widget-content">
        ${editor.renderWidgetPreview(widget)}
      </div>
    </div>
  `);

};

//================================================
//  2️⃣ Render column nel canvas 
//================================================
editor.renderColumnPanel = function (columnId) {
  const col = editor.state.columns[columnId];

const $p = $('#widget-details .panel-body').empty();
  $p.append(`
  <div> 
    <h3 class="pink">Dettagli Colonna</h3>
  </div>
  <div>
    <label>Larghezza</label>
    <input type="range" min="20" max="100"
      value="${parseInt(col.props.width)}"
      data-col-prop="width">
  </div>
    <div>
    <label>Padding</label>
    <input type="number"
      value="${parseInt(col.props.padding)}"
      data-col-prop="padding">
        </div>
  `);
};

//================================================
//  2️⃣ Render section in canvas 
//================================================
editor.renderSectionPanel = function (sectionId){
  const sec = editor.state.sections[sectionId];
  const $s = $('#widget-details .panel-body').empty();

       $s.append(`
          <h3 class="pink">Dettagli Sezione</h3>
       `);

  $s.append(`
    <div>
    <label>Larghezza</label>
    <input type="range" min="20" max="100"
      value="${parseInt(sec.props.width)}"
      data-sec-prop="width">
  </div>
  <div>
    <label>Sfondo</label>
    <input type="color"
      value="${sec.props.background}"
      data-sec-prop="background">
  </div>
    <div>
    <label>Padding</label>
    <input type="number"
      value="${parseInt(sec.props.padding)}"
      data-sec-prop="padding">
        </div>
  `);
};

//================================================
//  🎯 FUNZIONE CENTRALE DI SELEZIONE
//================================================
editor.select = function ({ widgetId, columnId, sectionId }) {
  console.log('Funzione select chiamata con:', { widgetId, columnId, sectionId });

  // 1️⃣ aggiorna stato
  editor.state.selected = { widgetId, columnId, sectionId };
  console.log('Aggiornato stato:', editor.state.selected);

  // 2️⃣ pulizia selezioni visive
  $('.selected').removeClass('selected');

  if (widgetId) {
    $(`.canvas-widget[data-id="${widgetId}"]`).addClass('selected');
  }
  else if (columnId) {
    $(`.column[data-id="${columnId}"]`).addClass('selected');
  }
  else if (sectionId) {
    $(`.section[data-id="${sectionId}"]`).addClass('selected');
  }

  // 3️⃣ popolamento pannelli
  console.log('popolamento dettagli:', { widgetId, columnId, sectionId });

  if (widgetId) {
    console.log('Pannello widget attivato');
    editor.renderWidgetPanel(widgetId);
  }
  else if (columnId) {
    console.log('Pannello colonna attivato');
    editor.renderColumnPanel(columnId);
  }
  else if (sectionId) {
    console.log('Pannello sezione attivato');
    editor.renderSectionPanel(sectionId);
  }
};



//================================================
//  RENDE SORTABILE LA SESSIONE
//================================================
editor.makeSectionsSortable = function () {

  console.log('>>> makeSectionsSortable chiamata');

  const $canvas = $('#canvas');

  if (!$canvas.length) {
    console.warn('Canvas non trovato');
    return;
  }

  if ($canvas.data('sections-sortable')) {
    $canvas.sortable('refresh');
    return;
  }

  $canvas.sortable({
    items: '> .section',          // 🔥 FIX QUI
    handle: '.section-handle',
    axis: 'y',
    tolerance: 'pointer',
    placeholder: 'section-placeholder',
    cancel: '.column, .canvas-widget, button'
  });

  $canvas.data('sections-sortable', true);
  console.log('Sections sortable ATTIVO');
};


//==========================================
//  COLONNE SORTABILI CON HANDLE
//==========================================
editor.makeColumnsSortable = function ($section) {

  const $inner = $section.find('.section-inner');

  if ($inner.data('columns-sortable')) return;

  $inner.sortable({
    items: '> .column',
    handle: '.column-handle',
    tolerance: 'pointer',
    placeholder: 'column-placeholder',
    axis: 'x', // ⬅️ SOLO ORIZZONTALE
    cancel: '.canvas-widget',

    stop: function () {
      const sectionId = $section.data('id');

      // 🔄 sync ordine colonne nello state
      editor.state.sections[sectionId].columns =
        $inner.children('.column')
          .map((_, el) => $(el).data('id'))
          .get();

      console.log(
        'Ordine colonne aggiornato:',
        editor.state.sections[sectionId].columns
      );
    }
  });

  $inner.data('columns-sortable', true);
};


//======================================
//  DRAGGABLE PALETTE → COLONNE
//======================================
editor.makeWidgetsDraggable = function () {
  console.log('Palette draggable ATTIVA');

  $('#palette .palette-widget').draggable({
    helper: 'clone',
    appendTo: 'body',
    cursor: 'move',
    revert: true
  });
};


//==========================================
//  STEP 15.1 — SERIALIZZAZIONE CORRETTA
//==========================================
editor.serializeLayout = function () {

  const data = {
    meta: {
      tema: window.EDITOR_CONFIG?.tema ?? null,
      page: window.EDITOR_CONFIG?.page ?? null,
      version: 1,
      updated_at: new Date().toISOString()
    },

    // 🔥 stato puro
    sections: editor.state.sections,
    columns: editor.state.columns,
    widgets: editor.state.widgets,
    theme: editor.state.theme ?? {}
  };
  return data;
};


//==========================================
//  AGGIUNGERE UNA NUOVA SEZIONE
//==========================================
editor.addSection = function (forcedSectionId = null, forcedColumnId = null) {

  const sectionId = forcedSectionId || ('sec-' + Date.now());
  const columnId  = forcedColumnId  || ('col-' + Date.now());

  // 1️⃣ STATE
  editor.state.sections[sectionId] = {
    id: sectionId,
    columns: [columnId],
    props: {
      width: '100%',
      background: '#ffffff',
      padding: '0px'
    }
  };

  editor.state.columns[columnId] = {
    id: columnId,
    sectionId: sectionId,
    widgets: [],
    props: {
      width: '100%',
      padding: '0px'
    }
  };

  // 2️⃣ DOM
  const $section = $(`
    <div class="section" data-id="${sectionId}">

      <div class="toolbar">
        <button class="section-handle">☰</button>
        <button class="add-column">➕ Colonna</button>
        <button class="delete-section pink">✕</button>
      </div>

      <div class="section-inner">
        <div class="column" data-id="${columnId}">
          <div class="toolbar">
            <button class="column-handle">☰</button>
            <button class="delete-column pink">✕</button>
          </div>
        </div>
      </div>

    </div>
  `);

  $('#canvas').append($section);

  console.log('Sezione creata:', sectionId);

  // 3️⃣ ATTIVAZIONI (⚠️ fondamentali)
  editor.makeSectionsSortable($('#canvas'));
  editor.activateColumn($section.find('.column'));
  editor.makeColumnsSortable($section);

  return sectionId;
};

//==========================================
//  CREARE UNA NUOVA SEZIONE DA JSON
//==========================================
editor.createSectionFromState = function (section) {

  editor.state.sections[section.id] = {
    id: section.id,
    columns: [],
    props: section.props || {}
  };

  const $section = $(`
    <div class="section" data-id="${section.id}">
      <div class="toolbar">
        <button class="section-handle">☰</button>
        <button class="add-column">➕ Colonna</button>
        <button class="delete-section pink">✕</button>
      </div>
      <div class="section-inner"></div>
    </div>
  `);

  $('#canvas').append($section);
  editor.makeSectionsSortable();
};



//==========================================
//  2️⃣ AGGIUNGERE UNA COLONNA A UNA SEZIONE
//==========================================
editor.addColumn = function (sectionId, forcedColumnId = null) {

  if (!editor.state.sections[sectionId]) {
    console.warn('Sezione non trovata:', sectionId);
    return;
  }

  const columnId = forcedColumnId || ('col-' + Date.now());
  console.log('+ colonna:', sectionId, columnId);

  // 1️⃣ STATE
  editor.state.sections[sectionId].columns.push(columnId);

  editor.state.columns[columnId] = {
    id: columnId,
    sectionId: sectionId,
    widgets: [],
    props: {
      width: '100%',
      padding: '0px'
    }
  };

  // 2️⃣ DOM
  const $column = $(`
    <div class="column" data-id="${columnId}">
      <div class="toolbar">
        <button class="column-handle">☰</button>
        <button class="delete-column pink">✕</button>
      </div>
    </div>
  `);

  const $section = $(`[data-id="${sectionId}"]`);
  $section.find('.section-inner').append($column);

  // 3️⃣ ATTIVAZIONI
  editor.activateColumn($column);
  editor.makeColumnsSortable($section);

  console.log('Colonna SORTABILE aggiunta:', columnId);

  return columnId;
};

//============================================
//  1️⃣ Binding UNICO per tutti i widget
//============================================
editor.bindWidgetPropsLivePreview = function () 
{
  // 🔒 widget props
  $('#widget-details')
    .off('input change', '[data-prop]')
    .on('input change', '[data-prop]', function (e)  
  {
     e.stopPropagation();

    const selected = editor.state.selected;
    if (!selected || !selected.widgetId) return;

    const widget = editor.state.widgets[selected.widgetId];
    if (!widget) return;

    const prop  = $(this).data('prop');
    const value = $(this).val();

    widget.props = widget.props || {};
    widget.props[prop] = value;

    editor.updateWidgetDOM(widget.id);       
    console.log('Proprietà widget aggiornata:', widget.id, prop, value);
     });

   // 🎨 global style
  $('#style-panel')
    .off('input change', '[data-theme]')
    .on('input change', '[data-theme]', function (e)
  {
      e.stopPropagation();

      const path = $(this).data('theme'); // es: colors.primary
      const value = $(this).val();

    editor.setThemeValue(path, value);
    editor.applyTheme(); // 🔥 live preview
  });
};

//==========================
//  APPLICA TEMI  
//==========================
editor.applyTheme = function () {
  const theme = editor.state.theme;
  const root = document.documentElement;

  /* 🎨 Colori */
  root.style.setProperty('--color-primary', theme.colors.primary);
  root.style.setProperty('--color-secondary', theme.colors.secondary);
  root.style.setProperty('--color-text', theme.colors.text);
  root.style.setProperty('--color-bg', theme.colors.background);

  /* 🔤 Tipografia */
  root.style.setProperty('--font-heading', theme.typography.heading.fontFamily);
  root.style.setProperty('--font-heading-weight', theme.typography.heading.weight);

  root.style.setProperty('--font-body', theme.typography.body.fontFamily);
  root.style.setProperty('--font-body-weight', theme.typography.body.weight);

  /* 📏 Dimensioni */
  root.style.setProperty('--h1-size', theme.typography.sizes.h1);
  root.style.setProperty('--h2-size', theme.typography.sizes.h2);
  root.style.setProperty('--h3-size', theme.typography.sizes.h3);
  root.style.setProperty('--body-size', theme.typography.sizes.body);
  root.style.setProperty('--small-size', theme.typography.sizes.small);
};

//=========================================
//  DOM sezione
//=========================================
editor.updateSectionDOM = function (sectionId) {
  const sec = editor.state.sections[sectionId];
  const $el = $(`.section[data-id="${sectionId}"]`);

  $el.css({
    width: sec.props.width + '%',
    backgroundColor: sec.props.color,
    padding: sec.props.padding
  });
};


///////////////////////////////////////////
//      INIZIALIZZAZIONE EDITOR          
///////////////////////////////////////////

editor.init = function () {

  editor.makeWidgetsDraggable();
  editor.makeSectionsSortable(); 
  console.log('>>> makeSectionsSortable chiamata');
    // stato iniziale: nessun widget selezionato
  editor.clearWidgetPanel();

  $('#canvas .column').each(function () {
   editor.activateColumn($(this));    });

  // pannelli
  if (typeof editor.loadPanel === 'function') {
    editor.loadPanel('style-panel', editor.initStylePanel);
    editor.loadPanel('widget-panel', editor.initWidgetPanel);
  }

  console.log('Editor inizializzato');

//==========================
// STATE GLOBALE 
//==========================
editor.state = {
  selected: {
    sectionId: null,
    columnId: null,
    widgetId: null
  },

  sections: {},
  columns: {},
  widgets: {},

  // 🔥 STILE GLOBALE (OBBLIGATORIO)
  theme: {
    colors: {
      primary: '#3366ff',
      secondary: '#ff6633',
      text: '#000000',
      background: '#ffffff'
    },

    typography: {
      heading: {
        fontFamily: 'Inter',
        weight: 700
      },
      body: {
        fontFamily: 'Inter',
        weight: 400
      },
      sizes: {
        h1: 32,
        h2: 24,
        h3: 20,
        body:16,
        small:10
      }
    }
  }
};

  editor.bindWidgetPropsLivePreview();

 //===============================================  
 //  Cancella sezione
 //=============================================== 
editor.deleteSection = function (sectionId) {
  const section = editor.state.sections[sectionId];
  if (!section) return;

  // 1️⃣ elimina colonne + widget
  section.columns.forEach(colId => {
    editor.deleteColumn(colId);
  });

  // 2️⃣ elimina sezione dallo state
  delete editor.state.sections[sectionId];

  // 3️⃣ DOM
  $(`.section[data-id="${sectionId}"]`).remove();

  // 4️⃣ reset selezione
  editor.clearSelection();

  console.log('Sezione eliminata:', sectionId);
};


 //===============================================  
 //  Cancella colonna
 //=============================================== 
editor.deleteColumn = function (columnId) {
  const column = editor.state.columns[columnId];
  if (!column) return;

  // 1️⃣ elimina widget
  column.widgets.forEach(widgetId => {
    delete editor.state.widgets[widgetId];
  });

  // 2️⃣ rimuovi colonna da sezione
  Object.values(editor.state.sections).forEach(sec => {
    sec.columns = sec.columns.filter(id => id !== columnId);
  });

  // 3️⃣ elimina dallo state
  delete editor.state.columns[columnId];

  // 4️⃣ DOM
  $(`.column[data-id="${columnId}"]`).remove();

  editor.clearSelection();
  console.log('Colonna eliminata:', columnId);
};

 //===============================================  
 //  Evento - aggiorna DOM colonna
 //=============================================== 
editor.updateColumnDOM = function (columnId) {
  const col = editor.state.columns[columnId];
  const $el = $(`.column[data-id="${columnId}"]`);

  $el.css({
    width: col.props.width + '%',
    padding: col.props.padding
      });
};

 //===============================================  
 //  Evento - Seleziona colonna
 //===============================================
$('#canvas').on('click', '.column', function (e) {
  // ❗ se ho cliccato un widget → lascia gestire al widget
  if ($(e.target).closest('.canvas-widget').length) return;

  e.stopPropagation();

  editor.select({
    widgetId: null,
    columnId: $(this).data('id'),
    sectionId: $(this).closest('.section').data('id')
  });

  console.log('Colonna selezionata');
});


 //===============================================  
 //  Evento - Seleziona sezione
 //=============================================== 
$('#canvas').on('click', '.section', function (e) {
  // ❗ se ho cliccato colonna o widget → esci
  if (

    $(e.target).closest('.canvas-widget').length
  ) return;

  e.stopPropagation();

  editor.select({
    widgetId: null,
    columnId: null,
    sectionId: $(this).data('id')
  });

  console.log('Sezione selezionata');
});


 //===============================================  
 //  Evento - Cancella colonna
 //=============================================== 
$('#canvas').on('click', '.delete-column', function (e) {
  e.stopPropagation();

  const $col = $(this).closest('.column');
  editor.deleteColumn($col.data('id'));
});


//======================================
//  🖱️ EVENTI - dettagli colonna
//======================================
$('#widget-details').on('input', '[data-col-prop]', function () {
  const colId = editor.state.selected.columnId;
  const prop = $(this).data('col-prop');
  const val = $(this).val();

  editor.state.columns[colId].props[prop] =
    prop === 'width' ? val + '%' : val + '%';
    prop === 'padding' ?  val + 'px' : val + 'px';

  editor.updateColumnDOM(colId);
});

//======================================
//  🖱️ EVENTI - dettagli sezione
//======================================
$('#widget-details').on('input', '[data-sec-prop]', function () {
  const secId = editor.state.selected.sectionId;
  const prop = $(this).data('sec-prop');
  const val = $(this).val();

  editor.state.sections[secId].props[prop] =
    prop === 'background' ? val + '#ffffff' : val + '';
    prop === 'padding' ?  val + 'px' : val + 'px';

  editor.updateSectionDOM(secId);
});
//======================================
//  🖱️ EVENTI - clic su widget
//======================================
$('#canvas').on('click', '.canvas-widget', function (e) {
 
  e.stopPropagation();
 
   editor.select({
    widgetId: $(this).data('id'),
    columnId: $(this).closest('.column').data('id'),
    sectionId: $(this).closest('.section').data('id')
  });
      console.log('Widget cliccato:', $(this).data('id'));
});

//======================================
//  🔸 Click colonna
//======================================
$('#canvas').on('click', '.column', function (e) {
  if ($(e.target).closest('.canvas-widget').length) return;

  e.stopPropagation();

  editor.select({
    columnId: $(this).data('id'),
    sectionId: $(this).closest('.section').data('id')
  });
});

//======================================
//  🔸 Click sezione
//======================================
$('#canvas').on('click', '.section', function (e) {
  if ($(e.target).closest('.column').length) return;

  e.stopPropagation();

  editor.select({
    sectionId: $(this).data('id')
  });
});

 //===============================================  
 //  Evento - cancella sezione
 //===============================================  
$('#canvas').on('click', '.delete-section', function (e) {
  e.stopPropagation();

  const $section = $(this).closest('.section');
  const sectionId = $section.data('id');

  editor.deleteSection(sectionId);
});
//======================================
//  🔸 Click canvas vuoto → deselezione
//======================================
$('#canvas').on('click', function (e) {

  // se clicco dentro un widget o pannello → ignora
  if ($(e.target).closest('.canvas-widget, #widget-panel, #style-panel').length) {
    return;
  }

  editor.clearSelection();
  console.log('Selezione cancellata (canvas vuoto)');
});

//======================================
// 3️⃣ CLICK SU “➕ Colonna” 
//======================================
$('#canvas').on('click', '.add-column', function (e) {

  e.stopPropagation();

  const sectionId = $(this).closest('.section').data('id');
  editor.addColumn(sectionId);
  console.log("Sezione + colonna",sectionId,)
});

///======================================
// 3️⃣ CLICK SU aggiugi sezione
//======================================
$('#add-section').on('click', function () 
{
  editor.addSection();
});

///======================================
// ❌ STEP 12 — Delete widget
//======================================
$('#canvas').on('click', '.delete-widget', function (e) {

  e.stopPropagation();

  const $widget = $(this).closest('.canvas-widget');
  const widgetId = $widget.data('id');

  // rimuove da stato
  Object.values(editor.state.columns).forEach(col => {
    col.widgets = col.widgets.filter(id => id !== widgetId);
  }); 
  editor.clearWidgetPanel();
  delete editor.state.widgets[widgetId];
  $widget.remove();
});


//======================================
// 🧠 Delete widget + sync state
//======================================
editor.deleteWidget = function (sectionId, columnId, widgetId) {

  const section = editor.state.sections[sectionId];
  if (!section) return console.warn('Section mancante', sectionId);

  const column = section.columns[columnId];
  if (!column) return console.warn('Column mancante', columnId);

  if (!editor.state.widgets[widgetId]) {
    return console.warn('Widget mancante', widgetId);
  }

  // 1️⃣ rimuovi dallo state colonna
  column.widgets = column.widgets.filter(id => id !== widgetId);

  // 2️⃣ rimuovi dallo state globale
  delete editor.state.widgets[widgetId];

  // 3️⃣ rimuovi dal DOM
  $(`.canvas-widget[data-id="${widgetId}"]`).remove();

  console.log('Widget eliminato:', widgetId);
};
/*
//==========================
// SAVE DEL JSON
//==========================
 $('#save-layout').on('click', function () {
  console.log("Pubblica layout:");
  editor.saveLayout();
});

//==========================================================  
// 🖼️ Salva layout con PHP
//==========================================================
editor.saveLayout = function () {
  let page = EDITOR_CONFIG.page;


  if (!page) {
    page = prompt('Nome della nuova pagina:');
    if (!page) return;
    EDITOR_CONFIG.page = page;
  }

  const data = editor.serializeLayout();
console.log("Dati da salvare:", data);
  $.post('save-layout.php', {
    tema: EDITOR_CONFIG.tema,
    page: EDITOR_CONFIG.page,
    json: JSON.stringify(data)
  }, () => {
    console.log('Layout salvato:', page);
  });
};*/
//==========================
// SAVE DEL JSON
//==========================
 $('#save-layout').on('click', function () {

  const payload = editor.serializeLayout();

  console.log('LAYOUT JSON:', payload);

  $.ajax({
    url: 'save_layout.php',
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
//==========================================================  
// 🖼️ STEP 6 — Aggiorna UI selezione (DOM = riflesso) 
//==========================================================
editor.updateSelectionUI = function () {
  $(".widget").removeClass("selected");

  if (!editor.state.selected.widgetId) return;

  $(`.widget[data-id="${editor.state.selected.widgetId}"]`)
    .addClass("selected");
    c
};


///////////////////////////////////////////
//   A Z I O N I   E D   E V E N T I     //  
/////////////////////////////////////////// 

// =================================================
// 🧩 STEP 5 — selectWidget (gerarchica + editor)
// =================================================
editor.selectWidget = function (widgetId) {

  const widget = editor.state.widgets[widgetId];
  console.log('X-widget selezionato:', widgetId, widget);
  if (!widget) return;

  // 1️⃣ aggiorna stato
  editor.state.selected = {
    widgetId,
  };

 // 2️⃣ evidenzia canvas
  $('.canvas-widget').removeClass('selected');
  $(`.canvas-widget[data-id="${widgetId}"]`).addClass('selected');

   // 3️⃣ 🔥 RENDER DETTAGLI
  editor.renderWidgetPanel(widgetId);

};

//=====================================================    
//  🧩 Dispatcher editor (JS)
//=====================================================    
function renderWidgetProps(widgetId) {
  const widget = editor.state.widgets[widgetId];
  if (!widget) return;

  const type = widget.type;

  $('#widget-details').html('');

  switch (type) {
    case 'testo':
      renderTestoProps(widget);
      break;

    case 'image':
      renderImageProps(widget);
      break;

    case 'bottone':
      renderButtonProps(widget);
      break;
      
    case 'titolo':
      renderTitoloProps(widget);
      break;
      
    case 'space':
      renderSpaceProps(widget);
      break;
  }
}

//=====================================================
//  render titolo props
//=====================================================
function renderTitoloProps(widget) {

  const content = widget.props.content ?? '';

  const html = ` <h3>${content}</h3>   `;

  $('#widget-details').html(html);

  $('#prop-content').on('input', function () {
    widget.props.content = this.value;
  });
}
//=====================================================
//  render text props
//=====================================================
function renderTestoProps(widget) {

  const content = widget.props.content ?? '';

  const html = `
    <label>Testo</label>
    <textarea id="prop-content">${content}</textarea>
  `;

  $('#widget-details').html(html);

  $('#prop-content').on('input', function () {
    widget.props.content = this.value;
  });
}
//=====================================================
//  render space props
//=====================================================
function renderSpaceProps(widget) {

  const content = widget.props.content ?? '';
  const html = `
      <label for="spinner">Altezza in px:</label>
           <input type="number" data-prop="paddingTop" min="${widget.props?.height || 1}" step="5"/>
     `;

  $('#widget-details').html(html);

  $('#prop-content').on('input', function () {
    widget.props.height = this.value;
  });
}
//=====================================================
//  render image props
//=====================================================
function renderImageProps(widget) {

  const src = widget.props.src ?? '';

  const html = `
    <label>URL image</label>
    <input type="text" id="prop-src" value="${src}">
  `;

  $('#widget-details').html(html);

  $('#prop-src').on('input', function () {
    widget.props.src = this.value;
  });
}

//=====================================================
//  render button props
//=====================================================
function renderButtonProps(widget) {

  const bottone = widget.props.bottone ?? '';

  const html = `
    <label>URL image</label>
    <input type="text" id="prop-bottone" value="${text}">
    <input type="text" id="prop-url" value="${url}">
  `;

  $('#widget-details').html(html);

  $('#prop-bottone').on('input', function () {
    widget.props.bottone = this.value;
  });
}

//=====================================================    
//  Carica i codici widget per il tipo specificato
//=====================================================

function loadWidgetCodes(type, selectedCode = null) {
    console.log('Richiesta GET per caricare i codici widget');

    $.getJSON('widgets_by_type.php', {
        type: type,         // Passa il tipo di widget
        tema: window.EDITOR_CONFIG?.tema ?? '', // Tema selezionato
        page: window.EDITOR_CONFIG?.page ?? '' // Pag. selezionata
    }, function (rows) {
        const $select = $('#widget-code-select');
        $select.empty().append('<option value="">— seleziona —</option>'); // Aggiungi la prima opzione vuota

        // Cicla i dati ricevuti (rows)
        rows.forEach(row => {
             console.log('Rows ricevuti:', rows); // Debug: mostra i dati ricevuti
            // Trova dinamicamente i campi che terminano con 'cod' e 'des'
            const codeKey = Object.keys(row).find(k => k.endsWith('cod'));
            const descKey = Object.keys(row).find(k => k.endsWith('des'));

            if (codeKey && descKey) {
                const code = row[codeKey];    // Estrai il valore del codice (campo che termina con 'cod')
                const desc = row[descKey];    // Estrai il valore della descrizione (campo che termina con 'des')

                // Crea una nuova opzione per il select
                const $opt = $('<option>')
                    .val(code)         // Imposta il valore del codice
                    .text(desc)        // Imposta il testo da visualizzare (descrizione)
                    .attr('data-desc', desc); // Aggiungi un attributo data-desc per la descrizione

                // Se il codice corrisponde al codice selezionato, imposta questa opzione come selezionata
                if (code === selectedCode) {
                    $opt.prop('selected', true);
                }

                $select.append($opt);  // Aggiungi l'opzione al select
            }
        });
    });
}

};      // fine init



$(function () {
    editor.init();
});
