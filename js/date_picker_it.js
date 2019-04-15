// JavaScript Document
$(function() 
{
     $("#datepicker1").datepicker(
        {
            showOn: "button",
            buttonImage: "images/calen.jpg",
            buttonImageOnly: true,
            dateFormat: 'dd-mm-yy', firstDay: 1,
            changeYear: true,
            changeMonth: true ,
            monthNames: ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno',
               'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
          monthNamesShort: ['Gen','Feb','Mar','Apr','Mag','Giu',
          'Lug','Ago','Set','Ott','Nov','Dic'],
          dayNames: ['Domenica','Luned&#236','Marted&#236','Mercoled&#236','Gioved&#236','Venerd&#236','Sabato'],
          dayNamesShort: ['Dom','Lun','Mar','Mer','Gio','Ven','Sab'],
          dayNamesMin: ['Do','Lu','Ma','Me','Gio','Ve','Sa']
        });
}); 
$(function() 
{
     $("#datepicker2").datepicker(
        {
            showOn: "button",
            buttonImage: "images/calen.jpg",
            buttonImageOnly: true,
            dateFormat: 'dd-mm-yy', firstDay: 1,
            changeYear: true,
            changeMonth: true ,
            monthNames: ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno',
               'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
          monthNamesShort: ['Gen','Feb','Mar','Apr','Mag','Giu',
          'Lug','Ago','Set','Ott','Nov','Dic'],
          dayNames: ['Domenica','Luned&#236','Marted&#236','Mercoled&#236','Gioved&#236','Venerd&#236','Sabato'],
          dayNamesShort: ['Dom','Lun','Mar','Mer','Gio','Ven','Sab'],
          dayNamesMin: ['Do','Lu','Ma','Me','Gio','Ve','Sa']
        });
}); 

