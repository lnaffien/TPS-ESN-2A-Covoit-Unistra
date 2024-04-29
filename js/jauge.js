function resizeAndColor(width, left, backgroundColor) {
  var rectangles = document.getElementsByClassName("DayTimeRectangle");
  for (var i = 0; i < rectangles.length; i++)
  {
    var rectangle = rectangles[i];
    rectangle.style.width = width;
    rectangle.style.left = left;
    rectangle.style.background = backgroundColor;
  }
}
