function enablefirstbutton() {
    document.getElementById("conf").disabled = false;
}
function check()
{
  "use strict";
   var d = new Date();
   var umonth = document.form1.selectmonth.value;
   var uday = document.form1.selectday.value;
   var uyear = document.form1.selectyear.value;

   var cmonth = (d.getMonth()+1);
   var cday =  d.getDay();
   var cyear = d.getFullYear();
    if(uyear > cyear){
    return true;
    }
    else if((umonth<cmonth) || (uday < cday))
       {
       alert("Past dates are not valid");
       return false;
       }
    return true;
}
function isNumberKey(evt) {
"use strict";
var charCode = (evt.which) ? evt.which : event.keyCode;
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}

//$('#btnAdd').click(function() {
//    $('#btnDel').removeAttr('disabled',true);
//}
