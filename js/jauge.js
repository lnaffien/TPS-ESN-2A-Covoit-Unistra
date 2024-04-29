var start_day = 8.00;
var end_day = 18.00;

function timeToFloat(time)
{
  var time_split = time.split(':');

  if(time_split[0] === "00" && time_split[1] === "00" &&  time_split[2] === "00")
  {
    return 0;
  }

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

function resizeAndColor(start_time, end_time, start_compatibility, end_compatibility, element_id)
{
  //console.log("%s : %s %s %s %s", element_id, start_time, end_time, start_compatibility, end_compatibility);
  var start_time_float = timeToFloat(start_time);
  var end_time_float = timeToFloat(end_time);

  var margin_start = 0;
  var margin_end = 0;
  var color_start = "transparent";
  var color_end = "transparent";

  if(start_time_float != 0)
  {
    margin_start = getMargin(start_time_float - start_day);
    color_start = getColor(start_compatibility);
  }

  if(end_time_float != 0)
  {
    margin_end = getMargin(end_day - end_time_float);
    color_end = getColor(end_compatibility);
  }

 // console.log("ml : %s mr : %s color : %s", margin_start, margin_end, color_start);

  var element = document.getElementById(element_id);
  console.log(element);
  element.style.backgroundColor = color_start;
 /* element.style.borderColor = 'black';
  element.style.borderStyle = 'solid';
  element.style.borderWidth = '6px';*/
  element.style.marginLeft = margin_start + "%";
  element.style.marginRight = margin_end + "%";
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