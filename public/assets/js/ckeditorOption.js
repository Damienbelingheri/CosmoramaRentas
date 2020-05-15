
//option pour Ckeditor
//modification du 
CKEDITOR.replace('include');
CKEDITOR.replace('description');

CKEDITOR.on('dialogDefinition', function(e) {
  dialogName = e.data.name;
  dialogDefinition = e.data.definition;
  console.log(dialogDefinition);
  if (dialogName == "image") {
    dialogDefinition.removeContents('link');
    dialogDefinition.removeContents('advanced');
    var tabContent = dialogDefinition.getContents('info');
    tabContent.remove('txtHSpace');
    tabContent.remove('txtVSpace');
  }  
});