var start_day = 8.00;
var end_day = 18.00;

function timeToFloat(time)
{
  var time_split = time.split(':');
  var minutes_float = parseFloat(time_split[1]) * (1/60);
  return parseFloat(time_split[0]) + minutes_float;
}

function getMargin(time_float)
{
  return 10.00 * (time_float);
}

function getColor(compatibility)
{
  switch(compatibility)
  {
    case "100" :
      return "#00ff00";
    case "75" :
      return "#ffff00";
    case "50" :
      return "#ff8000";
    case "25" :
      return "#ff0000";
    default :
      return "#808080";
  }
}

function resizeAndColor(start_time, end_time, start_compatibility, end_compatibility)
{
  var margin_start = getMargin(timeToFloat(start_time) - start_day);
  var margin_end = getMargin(end_day - timeToFloat(end_time));
  var color_start = getColor(start_compatibility);
  var color_end = getColor(end_compatibility);
  
  var rectangles = document.getElementsByClassName("DayTimeRectangle");
  for (var i = 0; i < rectangles.length; i++)
  {
    var rectangle = rectangles[i];
    rectangle.style.marginLeft = margin_start + "%";
    rectangle.style.marginRight = margin_end + "%";
    rectangle.style.background = color_start;
  }
}

/*
function resizeAndColor(width, left, backgroundColor) {
  var rectangles = document.getElementsByClassName("DayTimeRectangle");
  for (var i = 0; i < rectangles.length; i++)
  {
    var rectangle = rectangles[i];
    rectangle.style.width = width;
    rectangle.style.left = left;
    rectangle.style.background = backgroundColor;
  }
}*/