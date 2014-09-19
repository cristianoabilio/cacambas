$(function() {

  // Auto open Location modal
  if($('.modal[data-autoopen="true"]').length){
    $('.modal[data-autoopen="true"]').modal('show');
  }



  // Form submit and show loading
  $('.cacambas-form').submit(function(e){
    e.preventDefault();
    $overlay = $(this).find('.overlay');
    $overlay.removeClass('hide');
    $('.steps').addClass('previous-disabled');
    $('.wizard li.active').removeClass('active').addClass('complete');
    setTimeout(function(){
      $overlay.removeClass('loading');
    }, 2000);
  })



  // From - To Daterangepicker
  if($('#from').length){
    $('#from').daterangepicker({
      singleDatePicker: true,
      parentEl: '#location-modal',
      format: 'DD/MM/YYYY'
    },function(start, end) {
        $('#fromInput').val(start.format('DD/MM/YYYY'));
        $('#to').daterangepicker({
          minDate: start,
          singleDatePicker: true,
          parentEl: '#location-modal',
          format: 'DD/MM/YYYY'
        },function(start, end) {
            $('#toInput').val(end.format('DD/MM/YYYY'));
        });

    });

    $('#to').daterangepicker({
      singleDatePicker: true,
      parentEl: '#location-modal',
      format: 'DD/MM/YYYY'
    },function(start, end) {
        $('#toInput').val(end.format('DD/MM/YYYY'));
    });

    $('#otherDate').daterangepicker({
      singleDatePicker: true,
      parentEl: '#location-modal',
      format: 'DD/MM/YYYY',
      opens: 'left'
    },function(start, end) {
        $('#otherDateInput').val(end.format('DD/MM/YYYY'));
    });
  }


  // Other date
  if($('#pagamento').length){
    $('#pagamento').on('change',function(){
      var $that = $(this);
      var currentId = $that.attr('id');
      var classNames = "col-sm-7 col-xs-12 padding-left-0 narrow-dropdown";
      if($that.val() == 'other-date'){
        $('.dropdown[data-hidden="#' + currentId + '"]').addClass(classNames);
        $('#otherDate').removeClass('hide');
      }else{
        $('.dropdown[data-hidden="#' + currentId + '"]').removeClass(classNames);
        $('#otherDate').addClass('hide');
      }
    });
  }


  // Wizard
  if($('.wizard').length){

    // Substeps
    $('[data-target^="#substep"]').on('click', function(){
      var $that = $(this);
      var $parent = $(this).parents('.step-pane');
      var currentStep = $that.data('target');

      $parent.find('.substep').removeClass('active');
      $parent.find(currentStep).addClass('active');
    });

    // Steps
    $('[data-target^="#step"]').on('click', function(){
      var $that = $(this);
      if((!$that.parent('.steps').length || $that.hasClass('complete') || $that.hasClass('activated')) && !$('.steps').hasClass('previous-disabled') ){ 
        var $parent = $('.step-content');
        var currentStep = $that.data('target');
        var $previousStep = $('ul.steps > li.active');

        // Activate current step
        $parent.find('.step-pane').removeClass('active');
        $parent.find(currentStep).addClass('active');

        $previousStep.addClass('activated').removeClass('active');

        // Check if next step number is bigger than previous one's, add class "complete" on previous step on wizard
        var currentStepNum = currentStep.replace( /^\D+/g, '');
        var previousStepNum = $previousStep.data('target').replace( /^\D+/g, '');
        if(previousStepNum < currentStepNum){
          $previousStep.addClass('complete');
        }

        // Activate current step on wizard
        $('ul.steps [data-target="'+currentStep+'"]').addClass('active');
      }
    });

  }



  // Person type radio buttons
  if($('input[name="personType"]').length){
    $('input[name="personType"]').change(function(){
      var checked = $('input[name="personType"]:checked').val();
      $('.person-type').addClass('hide');
      $('#'+checked).removeClass('hide');
    });
    $('input[name="personType"]').change();
  }


  // Map radio buttons
  if($('input[name="chooseLocationType"]').length){
    $('input[name="chooseLocationType"]').change(function(){
      var $toggleMap = $('#toggleMap');
      var checked = $('input[name="chooseLocationType"]:checked').val();
      if(checked == 'byMap'){
        $toggleMap.removeClass('hide');
      }else{
        $toggleMap.addClass('hide');
      }
    });
    $('input[name="chooseLocationType"]').change();
  }




  // Map size toggle
  if($('.map-size-toggler').length){
    $('.map-size-toggler').on('click', function(){
      $(this).find('i').toggleClass('fa-compress');
      $(this).parents('.map-holder:first').toggleClass('full-size');
    })
  }



  // Dropdown
  $('.select-box li a').on('click', function(e){
    e.preventDefault();
    var $that = $(this);
    var $parent = $that.parents('.select-box:first');
    var hiddenField = $parent.data('hidden');
    var selectedValue = $that.data('value');
    var selectedLabel = $that.html();

    $parent.find('> a.btn > span').html(selectedLabel);
    $(hiddenField).val(selectedValue).trigger('change');
  })


});
