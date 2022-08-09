// doc ready
$(function () {
  let mainInput = $('#main-input');
  mainInput.val('');
  mainInput.focus();
  $('#error-wrapper').hide();
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
    success: function (successResponse) {
      $('#error-wrapper').hide();
      $('#error-text').text('');
      let mainInput = $('#main-input');
      mainInput.val(successResponse.result);
      mainInput.focus();
    },
    error: function (xhr, status, error) {
      $('#error-wrapper').show();
      if (500 === xhr.status) {
        $('#error-text').text('Server error');
      } else {
        var errorResponseData = JSON.parse(xhr.responseText);
        $('#error-text').text(errorResponseData.message);
      }
    }
  });
})
