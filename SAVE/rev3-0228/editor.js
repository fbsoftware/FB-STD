const editor = {};

//---------------------------------------------
// HTML colonna con toolbar 
//---------------------------------------------
function html_colonna(columnId) {
  return `
    <div class="column" data-id="${columnId}">
      <div class="toolbar">
        <button class="column-handle">☰</button>
        <button class="delete-column pink">✕</button>
      </div>
    </div>
  `;
}

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
//  Sanitizza lo stato
// ==========================================
editor.sanitizeState = function() {
  if (!editor.state.theme) editor.state.theme = {};
  if (!editor.state.widgets) editor.state.widgets = {};
  if (!editor.state.columns) editor.state.columns = {};
  if (!editor.state.sections) editor.state.sections = {};
};

// ==========================================
//  PANEL LOADER (CORE)
// ==========================================
  editor.loadPanel = function (panelName, callback) {

$('#panel-container').load(
  `/panels/+ ${panelName} +.html`,
  function (response, status) {

    if (status !== 'success') {
      console.error('Panel NON caricato:', panelName);
      return;
    }

    if (typeof callback === 'function') {
      callback();
    }
  }
);

};

//================================================  
//  DEFAULT THEME centrale
//================================================
editor.defaultTheme = function () {
  return {
    colors: {
      primary: '#3366ff',
      secondary: '#ff6633',
      accent: '#ffa500',
      text: '#000000',
      background: '#ffffff'
    },
    typography: {
      heading: { fontFamily: 'Inter', weight: 700 },
      body: { fontFamily: 'Inter', weight: 400 },
      sizes: { h1:32, h2:24, h3:20, body:16, small:10 }
    }
  };
};


//================================================  
//  reset editor
//================================================
 editor.resetEditor = function () {
  editor.state = {
    meta: {},
    sections: {},
    columns: {},
    widgets: {},
    theme: {}
  };

  $('#canvas').empty();
};

//================================================  
//  inizializzazione intelligente
//================================================
editor.initEditor = function () {

  editor.resetEditor();
 
window.EDITOR_CONFIG = window.EDITOR_CONFIG || {}; // per viewer

  if (window.INITIAL_LAYOUT) {
    editor.deserializeLayout(window.INITIAL_LAYOUT);
  } else {
    editor.createEmptyPage();
  }
};

//================================================  
//  1️⃣ deserializeLayout
//================================================
editor.deserializeLayout = function (data) {
  if (!data.widgets || Array.isArray(data.widgets)) {
  data.widgets = {};
}
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

};

//================================================  
//  🎨 APPLICA COME CSS GLOBALI
//================================================  
function applySiteConfig(cfg){
  const root = document.documentElement;

  for(let k in cfg.colors){
    root.style.setProperty(`--color-${k}`, cfg.colors[k]);
  }

  root.style.setProperty("--font-heading", cfg.fonts["heading-family"]);
  root.style.setProperty("--font-body", cfg.fonts["body-family"]);
}



//================================================  
//  2️⃣ renderFromState
//================================================
editor.renderFromState = function () {

  Object.values(editor.state.sections).forEach(section => {
    editor.addSection(section.id, { fromLoad: true });

    section.columns.forEach(colId => {
      const col = editor.state.columns[colId];
      editor.addColumn(section.id, col.id, { fromLoad: true });

      col.widgets.forEach(wid => {
        const widget = editor.state.widgets[wid];
        editor.addWidgetToColumn(col.id, widget, { fromLoad: true });
      });
    });
  });

};


//================================================  
//  Funzioni di render GREZZE
//================================================
editor.renderColumn = function (columnId, options = {}) {

  const col = editor.state.columns[columnId];
  if (!col) return;

  // 🔥 NON GENERARE NUOVI ID
  const $col = $(`<div class="column" data-id="${columnId}"></div>`);

  // props
  $col.css(col.props || {});

  // append to section
  $(`.section[data-id="${col.sectionId}"] .columns`).append($col);
};

//================================================  
//  🟢 createEmptyPage (minimale ma UX-friendly)
//================================================
editor.createEmptyPage = function () {

  editor.state.theme = editor.defaultTheme();

  editor.applyTheme();

  const sectionId = editor.addSection();
  editor.addColumn(sectionId);

};

//================================================  
//  pannello stile è pronto
//================================================
editor.initStylePanel = function () {


  editor.applyTheme(); // ✅ QUI È CORRETTO

};

//================================================
//  setta il tema
//================================================
editor.setTemaValue = function (path, value) {

  if (!editor.state.tema || typeof editor.state.tema !== "object") {
    editor.state.tema = {};
  }

  const keys = path.split('.');
  let obj = editor.state.tema;

  while (keys.length > 1) {
    const k = keys.shift();

    if (!obj[k] || typeof obj[k] !== "object") {
      obj[k] = {};   // auto-create
    }

    obj = obj[k];
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
//==============================================
// 🔤 TITOLO
if (widget.type === 'titolo') {
  const level = widget.props.level || 'h2';
  const text  = widget.props.text || '';
  const align = widget.props.align || 'center';
  const color = widget.props.color || '#000000';
  const fontFamily = widget.props.fontFamily || 'Inter';

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
  $heading.css('text-align', align ); 
  $heading.css('color' , color);
  $heading.css('font-family' , fontFamily);

}
//==============================================
// 📝 TESTO
if (widget.type === 'testo') {
  const text = widget.props.text || '';

  const $content = $el.find('.widget-content');
  if (!$content.length) return;

  $content.html(text);
}
//==============================================
 // 📝 BOTTONE
  if (widget.type === 'bottone') {
  const text = widget.props.bottone || '';
  const url  = widget.props.url || '#';
  const align = widget.props.align || 'center';

  const $a = $el.find('a');
  if (!$a.length) return;
   $a.attr('href', url);

   const $b = $el.find('button');
  if (!$b.length) return;
  $b.text(text);
  $b.css('text-align', align);
}
  //==============================================
  // 🖼️ IMMAGINE
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
//  4️⃣ Render pannello dettagli widget
//================================================
editor.renderWidgetPanel = function (widgetId) {

  const widget = editor.state.widgets[widgetId];
  if (!widget) return;

  const $panel = $('#widget-details .panel-body');
  $panel.empty();
  if (!widget && col) {
    $panel.html('<p>Seleziona un widget</p>');
    return;  }
  const $panelh = $('#widget-details .panel-header');
  $panelh.empty();

  // 🔥 qui carichi i controlli GIUSTI
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
// pannelli
  const $panelh = $('#widget-details .panel-header');
  $panelh.empty();
       $panelh.append(`
          <h3 class="pink"> ${widget.type} </h3>
       `);

  switch (widget.type) {

    case 'titolo':
      $panel.append(`
  <div id="panel-body" class="accordion">
      <h3 class="" aria-expanded="true" aria-selected="true">Layout</h3>
      <div style="display: flex;">
        <label>Testo</label>
        <input type="text"
               data-prop="text"
               value="${widget.props?.text || ''}">
      </div>         
      <h3 class="">Stile</h3>
      <div style="display: flex;">
        <label>Livello</label>
        <select data-prop="level">
          <option value="h1" ${widget.props?.level === 'h1' ? 'selected' : ''}>H1</option>
          <option value="h2" ${widget.props?.level === 'h2' ? 'selected' : ''}>H2</option>
          <option value="h3" ${widget.props?.level === 'h3' ? 'selected' : ''}>H3</option>
        </select>
      </div>

      <div style="display: flex;">
        <label>Allineamento</label>
        <select data-prop="align">
          <option value="left"   ${widget.props?.align === 'left' ? 'selected' : ''}>left</option>
          <option value="center" ${widget.props?.align === 'center' ? 'selected' : ''}>center</option>
          <option value="right"  ${widget.props?.align === 'right' ? 'selected' : ''}>right</option>
        </select>
      </div>
        </div>

      <div style="display: flex;">
        <label>Colore</label>
        <select data-prop="color">
          <option value="#3366ff"  ${widget.props?.color === 'primary' ? 'selected' : 'primary'}>Primario</option>
          <option value="#ff6633"  ${widget.props?.color === 'secondary' ? 'selected' : 'secondary'}>Secondario</option>
          <option value="#ffa500"  ${widget.props?.color === 'accent' ? 'selected' : 'accent'}>Accent</option>
          <option value="#222222"  ${widget.props?.color === 'text' ? 'selected' : ''}>Testo</option>
          <option value="#ffffff"  ${widget.props?.color === 'bg' ? 'selected' : ''}>Sfondo</option>
        </select>
      </div>
        </div>      

      <div style="display: flex;">
        <label>Font</label>
        <select data-prop="fontFamily">
          <option value="Inter"      ${widget.props?.fontFamily === 'Inter' ? 'selected' : ''}>Inter</option>
          <option value="Montserrat" ${widget.props?.fontFamily === 'Montserrat' ? 'selected' : ''}>Montserrat</option>
          <option value="Poppins"    ${widget.props?.fontFamily === 'Poppins' ? 'selected' : ''}>Poppins</option>
          <option value="Roboto"     ${widget.props?.fontFamily === 'Roboto' ? 'selected' : ''}>Roboto</option>
        </select>
      </div>
  </div> 
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
      <div class="accordion">
      <h3 class="" aria-expanded="true" aria-selected="true">Layout</h3>
      <div style="display: flex;">
        <label>URL immagine</label>
        <input type="text"
               data-prop="src"
               value="${widget.props?.src || ''}">
      </div>
      <div style="display: flex;">         
          <label>Testo altern.</label>
        <input type="text"
               data-prop="alt"
               value="${widget.props?.alt || ''}"> 
      </div> 
      </div>    
      `);
      break;

    case 'space':
      $panel.append(`
      <h3 class="" aria-expanded="true" aria-selected="true">Layout</h3>
        <p><label for="spinner">Altezza px</label>
           <input type="number"  data-prop="height" value=${widget.props?.height || 1}  step="1"></p>
      `);
      break;

    
    case 'bottone':
      $panel.append(`
      <div class="accordion">
      <h3 class="" aria-expanded="true" aria-selected="true">Layout</h3>
      <div style="display: flex;">
         <label>Testo bottone</label>
         <input type="text"
               data-prop="bottone"
               value="${widget.props?.text || ''}">
      </div>

      <div style="display: flex;">
          <label>URL</label>
        <input type="text"
                data-prop="url"
                value="${widget.props?.url || ''}">
      </div>
       <h3 class="" aria-expanded="true" aria-selected="true">Stile</h3>
            <div style="display: flex;">
        <label>Allineamento</label>
        <select data-prop="align">
          <option value="left"   ${widget.props?.align === 'left' ? 'selected' : ''}>left</option>
          <option value="center" ${widget.props?.align === 'center' ? 'selected' : ''}>center</option>
          <option value="right"  ${widget.props?.align === 'right' ? 'selected' : ''}>right</option>
        </select>
      </div>
      </div>          
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
//  7️⃣ Render widget preview (Nel canvas)
//================================================
editor.renderWidgetPreview = function (widget) {

  switch (widget.type) {
    case 'titolo':
      return `<${widget.props.level} style="text-align: ${widget.props.align}; font-family: ${widget.props.fontFamily || ''}; color: ${widget.props.color || ''}">${widget.props.text}</${widget.props.level}>`;
    case 'testo':
      return `<p>${widget.props.text}</p>`;
        case 'space':
      return `<div class="widget widget-space" style="height: ${widget.props.height}px;"></div>`;
    case 'bottone':
      return `<button class="widget-bottone" style="text-align: ${widget.props.align}"><a href="${widget.props.url}">${widget.props.text}</a></button>`;
    case 'image':
      return `<img src='${widget.props.src}' alt='${widget.props.alt}' height="200"/>`;
      case 'separator':
      return `<div class="sep1"><span class="icon"><div class="sep2">★</div></span></div>`;

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
      return { text: "Lorem ipsum dolor sit amet. At sint deserunt At odio reprehenderit vel eveniet molestiae. Quo maiores debitis ut dignissimos nulla qui eligendi voluptas aut perferendis nihil. Sed tenetur deserunt et earum enim et molestiae praesentium et tempore error ut obcaecati consequatur nam nihil velit non eius dolorem.", align: "left" , color: "#000000",fontFamily: "Inter" };
    case "titolo":
      return { text: "Titolo..." , level: "h2" , align: "center", color: "#000000" , fontFamily: "Poppins" };
    case "space":
      return { height: 1 };  
    case "bottone":
      return { text: "CERCA" , url: "#" , align: "center" , color: null , fontFamily: null};
    case "image":
      return { src: "images/image.png" , alt: "Immagine" };
    case "column":
      return {    width: '100%', background: '#fefefe' ,   padding: '0px'};  
    case "section":
      return {    width: '100%',  background: '#fefefe' ,  padding: '0px'};  
    case "separator":
      return {    width: '100%',  background: '#fefefe' ,  padding: '0px'};    
    default:
      return {};
    }
  };

// --------------------------------------------- 
// aggiunge widget alla colonna (da palette o da load)
//--------------------------------------------- 
editor.addWidgetToColumn = function (columnId, widgetData, options = {}) {

  // 🔴 sicurezza
  if (!editor.state.columns[columnId]) {
    console.error('Colonna non esiste nello state:', columnId);
    return;
  }

  const widgetId = widgetData.id ?? ('wid-' + Date.now());

  const widget = {
    id: widgetId,
    type: widgetData.type,
    props: widgetData.props || editor.getDefaultProps(widgetData.type)
  };

  // 1️⃣ STATE
  editor.state.widgets[widgetId] = widget;

  if (!editor.state.columns[columnId].widgets.includes(widgetId)) {
    editor.state.columns[columnId].widgets.push(widgetId);
  }

  // 2️⃣ DOM
  const $column = $(`.column[data-id="${columnId}"]`);
  if (!$column.length) {
    console.error('Colonna non trovata nel DOM:', columnId);
    return;
  }

  const $widgetEl = editor.renderWidget(widgetId);
  $column.append($widgetEl);

  // 3️⃣ selezione SOLO se non è load
  if (!options.fromLoad) {
    editor.selectWidget(widgetId);
  }
};



//================================================
//  COLONNA: sortable SOLO per canvas-widget
//================================================
editor.activateColumn = function ($column) {

  if ($column.data('sortable')) return;

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

      editor.addWidgetToColumn(columnId, {
        type: widgetType
      });
    }
  });

  $column.data('sortable', true);
};


//================================================
//  2️⃣ Render widget nel canvas (funzione universale)
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
//  2️⃣ Render column details in panel
//================================================
editor.renderColumnPanel = function (columnId) {
  const col = editor.state.columns[columnId];

const $p = $('#widget-details .panel-header').empty();
  $p.append(`
  <div> 
    <h3 class="pink">Colonna</h3>
  </div>  `);

const $b = $('#widget-details .panel-body').empty();
  $b.append(`
   <h3 class="" aria-expanded="true" aria-selected="true">Layout</h3>

      <div style="display: flex;">
       <label>Larghezza px</label>
           <input type="number"  data-prop="width" value=${parseInt(col.props.width)}  step="5"
           max="800" data-col-prop="width">
      </div>

    <h3 class="" aria-expanded="true" aria-selected="true">Stile</h3>

      <div style="display: flex;">
      <label>Sfondo</label>
      <input type="color"
      value="${col.props.background}"
      data-col-prop="background">
      </div>

      <div style="display: flex;">
      <label>Padding</label>
      <input type="number"
      value="${parseInt(col.props.padding)}"
      data-col-prop="padding">
      </div>
  `);
 };   


//================================================
//  2️⃣ Render section in details panel
//================================================
editor.renderSectionPanel = function (sectionId){
  const sec = editor.state.sections[sectionId];
  const $s = $('#widget-details .panel-header').empty();

       $s.append(`
       <div> 
       <h3 class="pink">Sezione</h3>
       </div>  `);

    const $d = $('#widget-details .panel-body').empty();

       $d.append(`
 <div class="accordion">      
    <h3 class="" aria-expanded="true" aria-selected="true">Layout</h3>
      <div style="display: flex;">
           <label>Larghezza px</label>
           <input type="number"  data-prop="width" value=${parseInt(sec.props.width)}  step="5"
            max="900" data-sec-prop="width">
      </div>
    <h3 class="" aria-expanded="true" aria-selected="true">Stile</h3>

      <div style="display: flex;">
      <label>Sfondo</label>
      <input type="color"
      value="${sec.props.background}"
      data-sec-prop="background">
      </div>

      <div style="display: flex;">
      <label>Padding</label>
      <input type="number"
      value="${parseInt(sec.props.padding)}"
      data-sec-prop="padding">
      </div>
   </div>
  `);
};

//================================================
//  🎯 FUNZIONE CENTRALE DI SELEZIONE
//================================================
editor.select = function ({ widgetId, columnId, sectionId }) {

  // 1️⃣ aggiorna stato
  editor.state.selected = { widgetId, columnId, sectionId };

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

  if (widgetId) {
    editor.renderWidgetPanel(widgetId);
  }
  else if (columnId) {
    editor.renderColumnPanel(columnId);
  }
  else if (sectionId) {
    editor.renderSectionPanel(sectionId);
  }
};

//================================================
//  8️⃣ Sincronizza lo stato dalle colonne (dopo drag&drop)
//================================================
editor.syncStateFromDOM = function () {

  // 🔄 Sync ordine colonne per ogni sezione
  $(".section").each(function () {

    const sectionId = $(this).attr("data-id");
    if (!editor.state.sections[sectionId]) return;

    const columnOrder = $(this)
      .find(".section-inner > .column")
      .map((_, el) => $(el).attr("data-id"))
      .get();

    editor.state.sections[sectionId].columns = columnOrder;

  });

  // 🔄 Reset widgets per colonna
  Object.values(editor.state.columns).forEach(col => {
    col.widgets = [];
  });

  // 🔄 Sync widget dentro colonne
  $(".column").each(function () {

    const colId = $(this).attr("data-id");
    if (!editor.state.columns[colId]) return;

    $(this).find(".canvas-widget").each(function () {

      const wid = $(this).attr("data-id");
      if (!wid) return;

      editor.state.columns[colId].widgets.push(wid);

    });

  });

  console.log("SYNC COMPLETO OK");
};

//================================================
//  RENDE SORTABILE LA SESSIONE
//================================================
editor.makeSectionsSortable = function () {
  if (editor.mode === "view") return; // ❗ disable in viewer

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

    }
  });

  $inner.data('columns-sortable', true);
};

//==========================================
//  WIDGET SORTABILI TRA COLONNE
//==========================================
editor.makeWidgetsSortable = function () {

  $(".column").sortable({

    items: "> .canvas-widget",
    handle: ".widget-handle", // se esiste
    connectWith: ".column",
    tolerance: "pointer",
    placeholder: "widget-placeholder",

    start: function () {
      console.log("DRAG START");
    },

    //stop: function () {
    //  console.log("DRAG STOP → sync state");
    //  editor.syncStateFromDOM();
    //}

  });

};

//======================================
//  DRAGGABLE PALETTE → COLONNE
//======================================
editor.makeWidgetsDraggable = function () {

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
editor.addSection = function (forcedId = null, options = {}) {

  const sectionId = forcedId || ('sec-' + Date.now());

  editor.state.sections[sectionId] = editor.state.sections[sectionId] || {
    id: sectionId,
    columns: [],
    props: {
      background: '#ffffff',
      padding: '0px'
    }
  };

  const $section = $(`
    <div class="section" data-id="${sectionId}">
      <div class="toolbar">
        <button class="section-handle">☰</button>
        <button class="add-column">➕ Colonna</button>
        <button class="delete-section pink">✕</button>
      </div>
      <div class="section-inner"></div>
    </div>
  `);

  $('#canvas').append($section);
  if (editor.mode === "view") {
  $(".toolbar").remove();
}

  editor.makeSectionsSortable();
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
  if (editor.mode === "view") {
  $(".toolbar").remove();
}

  editor.makeSectionsSortable();
};

//==========================================
//  2️⃣ AGGIUNGERE UNA COLONNA A UNA SEZIONE
//==========================================
editor.addColumn = function (sectionId, forcedId = null, options = {}) {

  if (!editor.state.sections[sectionId]) {
    console.error('Sezione non trovata:', sectionId);
    return;
  }

  const columnId = forcedId || ('col-' + Date.now() + '-' + Math.random().toString(36).substr(2,5));

  if (!editor.state.columns[columnId]) {
    editor.state.columns[columnId] = {
      id: columnId,
      sectionId: sectionId,
      widgets: [],
      props: { background: '#ffffff', padding: '0px' }
    };
  }

  if (!editor.state.sections[sectionId].columns.includes(columnId)) {
    editor.state.sections[sectionId].columns.push(columnId);
  }


const $column = $(html_colonna(columnId));
  $(`[data-id="${sectionId}"] .section-inner`).append($column);
  if (editor.mode === "view") {
  $(".toolbar").remove();
}

  editor.activateColumn($column);
  editor.makeColumnsSortable($(`[data-id="${sectionId}"]`));

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

//================================================  
// APPLY THEME → CSS variables
//================================================
editor.applyTheme = function () {

  // fallback robusto
  const theme = editor.state.theme || editor.defaultTheme();
  const colors = theme.colors || {};
  const typo   = theme.typography || {};

  const root = document.documentElement;

  // 🎨 colori
  if (colors.primary)   root.style.setProperty('--color-primary', colors.primary);
  if (colors.secondary) root.style.setProperty('--color-secondary', colors.secondary);
  if (colors.accent) root.style.setProperty('--color-accent', colors.accent);
  if (colors.text)      root.style.setProperty('--color-text', colors.text);
  if (colors.background)root.style.setProperty('--color-bg', colors.background);

  // 🔤 tipografia
  if (typo.heading?.fontFamily) root.style.setProperty('--font-heading', typo.heading.fontFamily);
  if (typo.heading?.weight)     root.style.setProperty('--font-heading-weight', typo.heading.weight);

  if (typo.body?.fontFamily) root.style.setProperty('--font-body', typo.body.fontFamily);
  if (typo.body?.weight)     root.style.setProperty('--font-body-weight', typo.body.weight);

  // 📏 sizes
  if (typo.sizes) {
    root.style.setProperty('--h1-size', typo.sizes.h1 + 'px');
    root.style.setProperty('--h2-size', typo.sizes.h2 + 'px');
    root.style.setProperty('--h3-size', typo.sizes.h3 + 'px');
    root.style.setProperty('--body-size', typo.sizes.body + 'px');
    root.style.setProperty('--body-small', typo.sizes.small + 'px');
  }

  console.log("🎨 Theme applied");
};

//=========================================
//  DOM sezione
//=========================================
editor.updateSectionDOM = function (sectionId) {
  const sec = editor.state.sections[sectionId];
  const $el = $(`.section[data-id="${sectionId}"]`);

  $el.css({
    backgroundColor: sec.props.background,
    padding: sec.props.padding,
    width: sec.props.width
  });
};

//=========================================
//  ULTRA ROBUST LAYOUT LOADER v3
//=========================================
editor.loadLayout = function (tema, page) {
  // ---- HARD SAFE PARAMS
  tema = tema   || editor.currentTema  || editor.state?.meta?.tema  || "default";
  page  = page  || editor.currentPage  || editor.state?.meta?.page  || "default";

  editor.currentTema = tema;
  editor.currentPage  = page;

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
        editor.initDragAndDrop?.();
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

//==========================================
//  SALVA CONFIGURAZIONE COLORE E FONT
//==========================================  
window.SITE_CONFIG = { colors: {}, fonts: {} };

$("#saveSiteConfig").on("click", function () {

  // 🎨 colori
  document.querySelectorAll("[data-site-color]").forEach(el => {
    SITE_CONFIG.colors[el.dataset.siteColor] = el.value;
  });

  // 🔤 font
  document.querySelectorAll("[data-site-font]").forEach(el => {
    SITE_CONFIG.fonts[el.dataset.siteFont] = el.value;
  });

  fetch("save-site-config.php", {
    method: "POST",
    headers: {"Content-Type":"application/json"},
    body: JSON.stringify(SITE_CONFIG)
  }).then(r=>r.json()).then(()=>{
    $("#siteConfigStatus").text("✅ Salvato");
    alert('Configurazione salvata correttamente');
  });
});



///////////////////////////////////////////
//      INIZIALIZZAZIONE EDITOR          
///////////////////////////////////////////

editor.init = function () {


  editor.resetEditor();
  
  //  📥 CARICA CONFIG ALL’AVVIO
fetch("site-config.json")
  .then(r=>r.json())
  .then(cfg=>{
    window.SITE_CONFIG = cfg;
    applySiteConfig(cfg);
    console.log("✅ Configurazione sito caricata", cfg);
  });

  editor.makeWidgetsDraggable();
  editor.makeSectionsSortable(); 
    // stato iniziale: nessun widget selezionato
  editor.clearWidgetPanel();

  $('#canvas .column').each(function () {
   editor.activateColumn($(this));    });

  // pannelli
  if (typeof editor.loadPanel === 'function') {
    editor.loadPanel('style-panel', editor.initStylePanel);
    editor.loadPanel('widget-panel', editor.initWidgetPanel);
  }

// ==============================
// EXPORT STATIC HTML (VIEWER MODE 2)
// ==============================
editor.exportHTML = function () {

  let html = "";

  Object.values(editor.state.sections).forEach(section => {
    html += `<section class="section style="width:${sec.props?.width || '100%'}">\n`;

    section.columns.forEach(colId => {
      const col = editor.state.columns[colId];
      html += `<div class="column" style="width:${col.props?.width || '100%'}">\n`;

      col.widgets.forEach(wid => {
        const w = editor.state.widgets[wid];
        html += editor.renderWidgetStatic(w);
      });

      html += `</div>\n`;
    });

    html += `</section>\n`;
  });

  return html;
};

//==========================================
//  ✅ RENDER STATICO DI OGNI WIDGET
//==========================================
editor.renderWidgetStatic = function (widget) {
  switch (widget.type) {

    case "testo":
      return `<p>${widget.props.text || ""}</p>\n`;

    case "bottone":
      return `<button>${widget.props.label || "Button"}</button>\n`;

    case "image":
      return `<img src="${widget.props.src || ""}">\n`;

    case "titolo":
      return `<h3>${widget.props.text || ""}</h3>\n`;

    case "space":
      return `<h3>${widget.props.text || ""}</h3>\n`;

    default:
      return `<!-- unknown widget ${widget.type} -->\n`;
  }
};

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

  // 🔥 C'ERA STILE GLOBALE (OBBLIGATORIO)

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
};

 //===============================================  
 //  Evento - aggiorna DOM colonna
 //=============================================== 
editor.updateColumnDOM = function (columnId) {
  const col = editor.state.columns[columnId];
  const $el = $(`.column[data-id="${columnId}"]`);

  $el.css({
    backgroundColor: col.props.background,
    padding: col.props.padding,
    width: col.props.width
      });
      console.log('+3+Colonna DOM aggiornata:', col.props);
}
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
    prop === 'background' ? val:
    prop === 'width' ? val + '%' :
    prop === 'padding' ?  val + 'px':
    val;
    console.log('+1+Colonna prop aggiornata:', prop, val);

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
    prop === 'background' ? val :
    prop === 'width' ? val + '%' :
    prop === 'padding' ?  val + 'px' : 
    val;

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
});

//======================================
// 3️⃣ CLICK SU “➕ Colonna” 
//======================================
$('#canvas').on('click', '.add-column', function (e) {

  e.stopPropagation();

  const sectionId = $(this).closest('.section').data('id');
  editor.addColumn(sectionId);
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

};

//==========================
// SAVE DEL JSON
//==========================
 $('#save-layout').on('click', function () {

  const payload = editor.serializeLayout();
  if (!payload.widgets) payload.widgets = {};
   console.log("🔄 Sync prima del salvataggio");

  editor.syncStateFromDOM();

  console.log("💾 Salvataggio stato:", editor.state);

  $.ajax({
    url: 'save_layout.php',
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify(payload),
    success: function (res) {
      alert('Layout salvato correttamente');
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
  $(".canvas-widget").removeClass("selected");

  if (!editor.state.selected.widgetId) return;

  $(`.canvas-widget[data-id="${editor.state.selected.widgetId}"]`)
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
      <label>Altezza in px:</label>
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

    $.getJSON('widgets_by_type.php', {
        type: type,         // Passa il tipo di widget
        tema: window.EDITOR_CONFIG?.tema ?? '', // Tema selezionato
        page: window.EDITOR_CONFIG?.page ?? '' // Pag. selezionata
    }, function (rows) {
        const $select = $('#widget-code-select');
        $select.empty().append('<option value="">— seleziona —</option>'); // Aggiungi la prima opzione vuota

        // Cicla i dati ricevuti (rows)
        rows.forEach(row => {
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

$(document).ready(function ()  {
  editor.init();
  editor.initEditor();
});
