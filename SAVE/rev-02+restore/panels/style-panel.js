// panels/style-panel.js
editor.initStylePanel = function () {

  console.log('Style panel inizializzato');

  // bind input
  $('#style-panel').on('input change', '[data-style]', function () {
    const key = $(this).data('style');
    const val = $(this).val();

    editor.state.theme[key] = val;
    editor.applyGlobalStyles();
  });
};



editor.initWidgetPanel = function () {
  console.log('Widget panel inizializzato');

  // reset panel all'avvio
  editor.clearWidgetPanel();
};
