var text_areas = document.getElementsByClassName('code-mirror');
//Get text_areas

for(var i = 0, length = text_areas.length; i < length; i++){
  var editor = CodeMirror.fromTextArea(text_areas[i], {
      lineNumbers: true,
      styleActiveLine: true,
      matchBrackets:true
  });

  var mode = text_areas[i].attributes.mode.value;
  //Get mode and value by slug

  editor.setOption("theme","monokai");
  editor.setOption("mode", mode);
}

