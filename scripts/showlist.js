$(document).ready(function() {
  // how many results to display at a time
  var step = 5;
  
  // shows next x items in list, where x is the step size 
  function showNext(list) {
    var current = list.children(':visible').length;
    list
      .find('li:lt(' + (current + step) + ')')
        .slideDown();
  }

  // show initial set
  $.each($('ul'), function(index) {
    showNext($(this));
  });

  // clicking on the 'load more' link:
  $('.more').click(function(e) {
    e.preventDefault();
    showNext($(this).siblings('ul'));
  });
});