var BBCode = {
bold: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[b]", "[/b]");},
italic: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[i]", "[/i]");},
strikethrough: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[s]", "[/s]");},
header: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[h]", "[/h]");},
link: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[url=https://example.com]", "[/url]", "https://example.com", "Link Text");},
image: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[img]", "[/img]", "", "https://example.com/image.jpg");},
map: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[map]", "[/map]", "", "Google embeded map link");},
fixed: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[code]", "[/code]");},
center: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[center]", "[/center]");},
textcolor: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[color=red]", "[/color]", "red", "Color Text");},
};