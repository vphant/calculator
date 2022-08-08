// doc ready
$(function () {
  let mainInput = $('#main-input');
  mainInput.val('');
  mainInput.focus();
});

$('.input-button').on('click', function () {
  let mainInput = $('#main-input');
  var clickedBtn = $(this);
  mainInput.val(mainInput.val() + clickedBtn.attr('data-val'));
  $('#main-input').focus();
})

$('#ac-button').on('click', function () {
  let mainInput = $('#main-input');
  mainInput.val('');
  mainInput.focus();
})
