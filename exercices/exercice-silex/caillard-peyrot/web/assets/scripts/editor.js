var $editor = $('.codemirror');
var codeMirror;
if ($editor.length) {
  $('.codemirror').each(function(index) {
    $(this).attr('id', 'code-' + index);
    codeMirror = CodeMirror.fromTextArea(document.getElementById('code-' + index), {
      lineNumbers: "true",
      theme: "monokai",
      path: "modes/",
    });
    // category slug
    switch ($(this).attr('class')) {
      case 'codemirror html':
        codeMirror.setOption("mode", 'htmlmixed');
        break;
      case 'codemirror css':
        codeMirror.setOption("mode", 'css');
        break;
      case 'codemirror javascript':
        codeMirror.setOption("mode", 'javascript');
        break;
      case 'codemirror php':
        codeMirror.setOption("mode", 'php');
        break;
      case 'codemirror nodejs':
        codeMirror.setOption("mode", 'javascript');
        break;
      default:
        codeMirror.setOption("mode", 'htmlmixed');
        break;
    }
  });



  // when writing snippet
  if ($('#category').length) {
    $('#category').change(function() {
      switch (parseInt($(this).val())) {
        case 1:
          codeMirror.setOption("mode", 'htmlmixed');
          break;
        case 2:
          codeMirror.setOption("mode", 'css');
          break;
        case 3:
          codeMirror.setOption("mode", 'javascript');
          break;
        case 4:
          codeMirror.setOption("mode", 'php');
          break;
        case 5:
          codeMirror.setOption("mode", 'javascript');
          break;
        default:
          break;
      }

    });
  }

}