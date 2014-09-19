/**
 * @ngdoc service
 * @name cacambas_app.service:UIBaseService
 * @description
 * # UIBaseService
 * Service for install/setup the functions JS of the UI Control
 * like menus, forms, buttons effects, etc.
 */
app.service('UIBaseService', ['$rootScope', 'jquery',

    function($rootScope, jquery) {


        /** 
         * Build the jquery mmenu plugin
         */
        this.sidebar = function(id) {
 
            // ID of Sidebar
            var side_menu = jquery(id);

            // Build the Sidebar
            side_menu.mmenu({
                slidingSubmenus: false,
                dragOpen: true,
                onClick: {
                    preventDefault: false,
                    setSelected: true,
                    blockUI: true
                }
            }, 
            {
                // Block new build
                clone: false
            });


            // Event for trigger the menu open
            jquery('#open-icon-menu a').click(function(e) {
                e.stopImmediatePropagation();
                e.preventDefault();
                // Custom trigger for close and open sidebar
                side_menu.trigger(side_menu.hasClass('mm-opened') ? 'close.mm' : 'open.mm');
            });
        };



        /** 
         * Start (Make) the Functions for Interface Basis
         */
        this.start = function() {
            
            // Clear Search Input
            jquery('#search-field input, .clearable').clearSearch({
                'linkText': '<i class="fa fa-times-circle"></i> Limpar'
            });


            // Functions for delay on action buttons on table head
            jquery('.table .btn-xs')
                .mouseenter(function() {
                    jquery("span", this).fadeIn('fast', "swing", function() {
                        jquery(this).css('display', 'inline-block');
                    });
                })
                .mouseleave(function() {
                    jquery("span", this).delay(130).fadeOut('fast', function() {
                        jquery(this).css('display', 'none');
                    });
                });


             // Tips
              
                $('.tTip').tooltip({delay: { show: 400, hide: 100 }});
                //$('.vampi').tooltip({container: '#ui-base', template: '<div class="tooltip ziao" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'});
              

        };


        this.pica = function() {

        };

    }
]);

/*


 



 



  // Tips
  if($('.tTip').length){
    $('.tTip').tooltip({delay: { show: 400, hide: 100 }});
  }



  // Change page title on tabs change
  if($('#main-tabs.text-center').length){
    $('#main-tabs li a').on('shown.bs.tab', function (e) {
      var activeTitle = $(e.target).text(); // activated tab
      $('#header .navbar-brand').text(activeTitle);
      // e.relatedTarget // previous tab
    })
  }



  // Date Range
  if($('#date-range').length){
    // Remove active class from date-range
    $('#date-range').on('click', function(e){
      e.preventDefault();
      setTimeout(function(){
        $('#date-range').removeClass('active');
      }, 0);
    })
    // Call daterangepicker
    $('#date-range').daterangepicker({
      ranges: {
        'Hoje': [moment(), moment()],
        'Ontem': [moment().subtract('days', 1), moment().subtract('days', 1)],
        'Esta Semana': [moment().subtract('days', 6), moment()],
        'Nos últimos 30 dias': [moment().subtract('days', 29), moment()],
        'Este Mês': [moment().startOf('month'), moment().endOf('month')],
        'Mês Passado': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
      },
      startDate: moment().subtract('days', 29),
      endDate: moment()
    },
    function(start, end) {
      $('#date-range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
  }



  // Inline edit OBS in the table
  if($('.editable').length){
    $('.badge-primary.editable').editable({
      //url: '/post',
      type: 'text',
      pk: 1,
      name: 'username',
      title: 'Enter username',
      placement: 'bottom'
    });
  }



  // Toggle secondary table
  if($('.has-child').length){
    $('.has-child').on('click', function(){
      var $that = $(this);
      if (!$that.hasClass('open') && $that.parents('table:first').find('tr.open').length) {
        $that.parents('table:first').find('tr.open').removeClass('open').next('tr').addClass('hide');
      };
      $that.toggleClass('open').next('tr').toggleClass('hide');
    })
  }




  // Table hover and edit fields
  if($('table.show-fields').length){

    $('table.show-fields td.show-select').append('<input type="hidden" class="selectSearch" style="width:95px"/>');
    $('table.show-fields td.show-input').append('<input type="hidden" class="inputSearch" style="width:95px"/>');

    var data=[
          { id: "1", text: "João Alberto", state: "Aguardando" },
          { id: "2", text: "Fantônio da Silva", state: "Aguardando" },
          { id: "3", text: "Eunior Paulo", state: "Aguardando" }
        ];
    var numbers=[
          { id: "1", text: "1250" },
          { id: "2", text: "1500" },
          { id: "3", text: "830" }
    ];
    function formatSelect(item) { return item.text + '<br><small>' + item.state + '</small>'; }
    function formatInput(item) { return item.text; }

    $(".selectSearch").select2({
      data:{ results: data },
      formatSelection: formatSelect,
      formatResult: formatSelect,
      placeholder: "Selecione",
      allowClear: true,
      initSelection : function (element, callback) {
        var data = [];
        $(element.val().split(",")).each(function () {
            data.push({id: this, text: this, state: this});
        });
        callback(data[0]);
      }
    })
    .on("select2-opening", function() { $(this).parents('tr:first').addClass('hover'); })
    .on("select2-close", function() {  $(this).parents('tr:first').removeClass('hover'); })
    .on("select2-selecting", function(e) {
        var $that = $(this);
        color = $that.parents('table:first').data('color');

        $that.parent('td').addClass('selected').find('> span').remove();
        $that.before('<span data-id="' + e.object.id + '">' + e.object.text + '<br><small class="badge badge-' + color + '">' + e.object.state + '</small></span>');
        $that.select2("val", e.object.text);
      })
    .on("select2-removed", function(e) {
        var $that = $(this);
        $that.parent('td').find('span[data-id]').remove();
        $that.parent('td').append('<span class="text-light-grey">-------------------</span>');
    })
    ;


    $(".inputSearch").select2({
      multiple: false,
      data:{ results: numbers },
      formatSelection: formatInput,
      formatResult: formatInput,
      multiple: true,
      placeholder: "Número",
      initSelection : function (element, callback) {
        var data = [];
        $(element.val().split(",")).each(function () {
            data.push({id: this, text: this});
        });
        callback(data[0]);
      }
    })
    .on("select2-opening", function() { $(this).parents('tr:first').addClass('hover'); })
    .on("select2-close", function() {  $(this).parents('tr:first').removeClass('hover'); })
    .on("select2-selecting", function(e) {
        var $that = $(this);
        $that.parent('td').addClass('selected').find('> span').remove();
        $that.before('<span data-id="' + e.object.id + '">' + e.object.text + '</span>');
        //$that.select2("val", e.object.text);
      })
    .on("select2-removed", function(e) {
        var $that = $(this);
        $that.parent('td').find('span[data-id]').remove();
        $that.parent('td').append('<span class="text-light-grey">-------------------</span>');
    })
    ;

    $('td.selected.show-select .selectSearch').select2("val", "João Alberto");
    $('td.selected.show-input .inputSearch').select2("data", [{id: "1", text: "1250"}]);
  }




  // Fixed Elements
  if($('.make-fixed').length){
    $view = $(window);
    $view.bind('scroll resize', fixedElements);
    if($('#main-tabs').length){
      $('#main-tabs a').click(function () {
         setTimeout(fixedElements, 10);
      })
    }
    setTimeout(fixedElements, 10);
  }



function fixedElements(){
  var $view = $(window);
  var $header = $('.active .make-fixed:not(.cloned)');
  var $cloned = $('.cloned');
  if($('#main-tabs').length){
   var $tabsContainer = $('#main-tabs');
  }
  var $parent = $header.parent();
  var elemTopOffset = $header.offset().top;
  var currentOffset = $view.scrollTop();

  // Check whether table exists
  if($('.make-fixed').parents('.tab-pane').hasClass('active')){

    // Check whether tabs exists
    if($('#main-tabs').length){
      $tabsContainer.removeClass('has-shadow');
    }

    // Check whether alerts exists
    if($('.tab-pane > .alert:first-child').length){
      var alertsHeight = 0;
      $('.tab-pane > .alert:first-child').each(function(){
        var $that = $(this);
        alertsHeight = alertsHeight + $that.height() + parseInt($that.css('paddingTop')) + parseInt($that.css('paddingBottom')) + 2;
      });
      elemTopOffset -= parseInt(alertsHeight);
    }

    if (currentOffset > elemTopOffset) {
      if (!$cloned.length) {
        $header.clone().addClass('cloned hidden-xs mm-fixed-top has-shadow').css('top', elemTopOffset).prependTo($parent);
      }
    } else {
      $cloned.remove();
    }

    // Fix columns width of cloned thead
    $('thead.cloned').width($header.css('width'));
    $header.find('th').each(function(index, value){
      var $that = $(this);
      var width = $that.css('width');
      var minWidth;
      if ($that.css('minWidth') == '0px'){
        minWidth = $that.width();
      }else{
        minWidth = $that.css('minWidth');
      }
      $('thead.cloned th:eq('+index+')').css({minWidth: minWidth, width: width});
    })
  }

  // Tabled doesn't exist, so to add shadow to tabs container if it exists
  else{
    if($('#main-tabs').length){
      elemTopOffset = $tabsContainer.position().top;
      if (currentOffset > elemTopOffset) {
        $tabsContainer.addClass('has-shadow');
      } else {
        $tabsContainer.removeClass('has-shadow');
      }
    }
  }
}
*/
