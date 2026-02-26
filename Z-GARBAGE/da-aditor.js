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

        (`
        <label>Colore</label>
        <select data-prop="color">
          <option value="#3366ff"  ${widget.props?.color === 'primary' ? 'selected' : 'primary'}>Primario</option>
          <option value="#ff6633"  ${widget.props?.color === 'secondary' ? 'selected' : 'secondary'}>Secondario</option>
          <option value="#ffa500"  ${widget.props?.color === 'accent' ? 'selected' : 'accent'}>Accent</option>
          <option value="#222222"  ${widget.props?.color === 'text' ? 'selected' : ''}>Testo</option>
          <option value="#ffffff"  ${widget.props?.color === 'bg' ? 'selected' : ''}>Sfondo</option>
        </select>
        `);