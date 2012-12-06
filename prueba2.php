<html>
<head>

<script type="text/javascript">
function check(txt, newTxt) {
var obj=document.form1.textarea1;
if(obj.value.search(txt)==-1) {
obj.value+=txt + "\n";
}
else {
if (txt !='This is some more text which cannot be deleted ') {
obj.value=obj.value.replace(txt,newTxt);
obj.value=obj.value.replace(/\.*(\r|\n)+/g,"\n")
}
}

}
</script>

</head>

<body>
<form name="form1">
<textarea rows="10" cols="40" name="textarea1"></textarea>
<br/><br/>

<a href="#" onclick = "check('This is some long-winded text ', 'Some Other Nonsensical Text')">Click Me 1</a><br/>
<a href="#" onclick = "check('This is some more text which cannot be deleted ', '')">Click Me 2</a><br/>
<a href="#" onclick = "check('This is yet more pointless text ', 'Yet More Incomprehensible Text')">Click Me 3</a>

</body>
</html>