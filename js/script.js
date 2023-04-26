// Отправка данных на сервер
$('.request-form').trigger('reset');
$(function() {
  'use strict';
  $('.request-form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: 'send.php',
      type: 'POST',
      contentType: false,
      processData: false,
      data: new FormData(this),
      success: function(msg) {
        console.log(msg);
        if (msg == 'ok') {
          alert('Спасибо за заявку! Мы свяжемся с Вами в ближайшее время.');
          $('.request-form').trigger('reset'); // очистка формы
        } else {
          alert('Произошла ошибка! Попробуйте повторить отправку.');
        }
      }
    });
  });
});