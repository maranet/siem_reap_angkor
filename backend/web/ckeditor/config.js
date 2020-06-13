CKEDITOR.editorConfig = function(config) {
  config.toolbarGroups = [
    { name: "document", groups: ["mode", "document", "doctools"] },
    { name: "clipboard", groups: ["clipboard", "undo"] },
    {
      name: "editing",
      groups: ["find", "selection", "spellchecker", "editing"]
    },
    { name: "forms", groups: ["forms"] },
    { name: "basicstyles", groups: ["basicstyles", "cleanup"] },
    {
      name: "paragraph",
      groups: ["list", "indent", "blocks", "align", "bidi", "paragraph"]
    },
    { name: "links", groups: ["links"] },
    { name: "insert", groups: ["insert"] },
    { name: "styles", groups: ["styles"] },
    { name: "colors", groups: ["colors"] },
    { name: "tools", groups: ["tools"] },
    { name: "others", groups: ["others"] },
    { name: "about", groups: ["about"] }
  ];

  config.removeButtons =
    "Source,Templates,Save,NewPage,Preview,Print,PasteText,Paste,Copy,Cut,PasteFromWord,Redo,Undo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Select,Textarea,HiddenField,ImageButton,Button,Superscript,Subscript,Strike,CreateDiv,CopyFormatting,RemoveFormat,BidiLtr,BidiRtl,Language,Unlink,Link,Anchor,Flash,Image,Smiley,SpecialChar,Iframe,Maximize,ShowBlocks,About,Styles,Blockquote,Image";
  config.removePlugins = "easyimage,cloudservices";
  config.autoGrow_minHeight = 250;
  config.autoGrow_maxHeight = 600;
};
