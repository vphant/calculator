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

$('#submit-button').on('click', function () {
  let mainInput = $('#main-input');
  let data = {
    'inputValue': mainInput.val()
  };

  $.ajax({
    type: 'POST',
    url: '/calculate',
    data: JSON.stringify(data),
    contentType: 'application/json; charset=utf-8',
    dataType: 'json',
    success: function (data) {
      alert(data);
    },
    error: function (errMsg) {
    }
  });
})
