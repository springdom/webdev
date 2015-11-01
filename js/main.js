var realArray = [],
    htmlArr = [];

var ExtraString = "";

var count = 0,
    count2 = 1,
    count3 = 2,
    countRider = 0,
    CurPrice = 0,
    EditRider = 0,
    ExtraVal = 0,
    PriceVal = 0;

var attrs = ['id'];
var currentdate = new Date();

var url = 'Json/bikedata.json';
var BikeData;
var BikePrice;


$(document).ready(function() {

   //test ajax
   $.getJSON(url,{ }, function (data) {
       BikeData = data.bikes;
       console.log(data);
   }).fail(function (jqXHR, textStatus, errorThrown) {
       console.log("fail " + errorThrown);
   });
//    $.getJSON(url, { },function (data) {
//            BikeData = data;
//            console.log(data);
//        }
//        .error(function (xhr) {
//            alert(xhr)
//        })
//    );
//test ajax end

//form setup
    $("#bikeOpt2_" + 1).prop("checked", true);
    $("#PriceTot").hide();
    $("#NHDinfo :input").val("");
    $("#Extras").val("");
    $("#NumDays").val("1");

    $("#NHDinfo,#repeatingSection,#AddRider2,.repeatingSec,#EditDetails,#EditDelivDetails,#EditDetails2").hide();

    $("#formDetails :input").val('');

    $(".repeatName").attr('id', "_Name" + count2);
    $(".repeatHeight").attr('id', "_Height" + count2);

    //init popovers
    $(function() {
        $('[data-toggle="popover"]').popover();
    })
});

$(function() {
    //jquery datetiime picker setup
    $("#_Date,#_EDate").datepicker({
        dateFormat: "dd/m/yy",
        minDate: new Date(),
    });
    //timepicker
    $("#_Time,#_ETime").timepicker({
        minTime: {
            hour: 8,
            minute: 00,
        },
        maxTime: {
            hour: 20,
            minute: 30,
        },
        minutes: { interval: 30 },
        showLeadingZero: true
    });

    //jquery validation
    $("#Maininfo").validate({
        rules: {
            _Name00: {
                required: true,
                lettersonly: true,
            },
            _Daddress: {
                required: true,
                validChar: true,
            },
        }
    });
    $("#EditDelivDetails").validate({
        rules: {
            _EDaddress: {
                required: true,
                validChar: true,
            },
        }
    });
});
//clear datepicker if not empty
$("#_Date").change(function() {
    if ($(this).val() != "") {
        $("#_Date").datepicker("hide");
    }
});

//get each bikeOpt id
$("[id^=bikeOpt_]").each(function() {
    var id = this.id.replace(/[^\d]/g, '');
    count3++;
    $("#description_" + id).hide();
// console.log(id);
    $(this).click(function() {
        //get bike and show/hide description, and also show border
            for (i = 0; i < count3; i++)
            {
                if(i == id)
                {
                $("#bikeOpt2_" + i).addClass('btn btn-success');
                $("#description_" + i).slideToggle("slow");
                }
                else
                {
                    $("#bikeOpt2_" + i).removeClass('btn btn-success');
                    $("#description_" + i).slideUp();
                }
            }
        populateHeight(count2);
    });
    $(this).one("click", function() {
        $("#NHDinfo").slideDown();
    });
});

$("#AddRider").click(function() {

    var timeVal = currentdate.getHours();

    var dateVal = currentdate.getDate() + "/"
    + (currentdate.getMonth()+1)  + "/"
    + currentdate.getFullYear();

    var userDate = $("#_Date").val();
    var usrDate = userDate;
    var usrTime = userDate;
    var userTime = $("#_Time").val();
    var length = 2;
    var myString =$("#_Time").val();
    var myTruncatedString = myString.substring(0,length);

    var validator = $( "#Maininfo" ).validate();

    var checkDifTime = myTruncatedString - timeVal;

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z," "]+$/i.test(value);
    }, "Letters only please");

    jQuery.validator.addMethod("validChar", function(value, element) {
        return this.optional(element) || /^[a-z," ",A-Z,0-9]+$/i.test(value);
    }, "Please enter a valid character");

    if(dateVal == userDate)
    {
        if (checkDifTime < 4){
            validator.showErrors({
                "_Time": "Time must be after current time and minimum notice 4 hours",
            });
            return false;
        }
    }
    if(usrDate == "")
    {
        validator.showErrors({
            "_Date": "Please Enter a Date",
        });
        return false;
    }
    if(usrTime == "")
    {
        validator.showErrors({
            "_Time": "Please Enter a Time",
        });
        return false;
    }

    if ($("#Maininfo").valid()) {
        $("#PriceTot").show();
        $("#repeatingSection,.repeatingSec").slideDown();
        $('#AddRider2').show();
        var CurName = $("#_Name00").val();

        $("#_Dname").val(CurName);

        //$("#_Dname,#_Dmobile,#_Demail,#Confirm").prop("disabled", false);
        $("#Confirm").prop("disabled", false);

        $(this).slideToggle();

        realArray.push({
            'DefaultTime': $("#_Time").val(),
            'Date': $("#_Date").val(),
            'NumOfDays': $("#NumDays").val(),
            'Extras': ExtraString,
            'ExtrasPrice': ExtraVal,
            'Address': $("#_Daddress").val(),
            'Comments':$("#Comments").val(),
        });

        //get each bike and update price on selec //future:look into this
        $('input[type=radio][name="bikeSelec"]:checked').each(function() {
            if (realArray[0].NumOfDays == 0.5) {

                //MODIFY HERE
//                switch ($(this).val()) {
//                    case "Standard Bike":
//                        PriceVal = 30;
//                        break;
//                    case "Full Suspension Bike":
//                        PriceVal = 50;
//                        break
//                    case "Electric Bike":
//                        PriceVal = 60;
//                        break;
//                    case "Kids Bike":
//                        PriceVal = 35;
//                        break;
//                }
                //MODIFY END

            } else {
                BikeName($(this).val());
                //MODIFY HERE
//                switch ($(this).val()) {
//                    case "Standard Bike":
//                        PriceVal = 40;
//                        break;
//                    case "Full Suspension Bike":
//                        PriceVal = 75;
//                        break
//                    case "Electric Bike":
//                        PriceVal = 80;
//                        break;
//                    case "Kids Bike":
//                        PriceVal = 35;
//                        break;
//                }
                //MODIFY END
            }
            switch ($("#Extras").val()) {
                case "":
                    ExtraVal = 0;
                    ExtraString = "None"
                    break;
                case "PBR":
                    ExtraVal = 10;
                    ExtraString = "Pannier Bags and Rack"
                    break;
                case "CCBT":
                    ExtraVal = 15;
                    ExtraString = "Childs Covered Bike Trailer"
                    break;
                case "CSFM":
                    ExtraVal = 10;
                    ExtraString = "Childs Seat Front Mounted"
                    break;
                case "CSRM":
                    ExtraVal = 10;
                    ExtraString = "Childs Seat Rear Mounted"
                    break;
                case "PEDS":
                    ExtraVal = 5;
                    ExtraString = "Clip Pedal/ Shimano spds"
                    break;
            }

            realArray[0].Extras = ExtraString;
            realArray[0].ExtrasPrice = ExtraVal;


            realArray.push({
                'Name': $("#_Name00").val(),
                'Height': $("#_Height00").val(),
                'Bike2': $(this).val(),
                'Price': PriceVal,
            });
        });
        console.log(realArray);
        TotalPrice();
        populateHandles()
        $("#NHDinfo").remove();
    }
});

$("#AddRiderDone").click(function() {

    var timeVal = currentdate.getHours();

    var dateVal = currentdate.getDate() + "/"
    + (currentdate.getMonth()+1)  + "/"
    + currentdate.getFullYear();

    var userDate = $("#_Date").val();
    var usrDate = userDate;
    var usrTime = userDate;
    var userTime = $("#_Time").val();
    var length = 2;
    var myString =$("#_Time").val();
    var myTruncatedString = myString.substring(0,length);

    var validator = $( "#Maininfo" ).validate();

    var checkDifTime = myTruncatedString - timeVal;

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z," "]+$/i.test(value);
    }, "Letters only please");

    jQuery.validator.addMethod("validChar", function(value, element) {
        return this.optional(element) || /^[a-z," ",A-Z,0-9]+$/i.test(value);
    }, "Please enter a valid character");

    if(dateVal == userDate)
    {
        if (checkDifTime < 4){
            validator.showErrors({
                "_Time": "Time must be after current time and minimum notice 4 hours",
            });
            return false;
        }
    }
    if(usrDate == "")
    {
        validator.showErrors({
            "_Date": "Please Enter a Date",
        });
        return false;
    }
    if(usrTime == "")
    {
        validator.showErrors({
            "_Time": "Please Enter a Time",
        });
        return false;
    }

    if ($("#Maininfo").valid()) {
        $("#PriceTot").show();
        $("#repeatingSection,.repeatingSec").slideDown();
        $('#AddRider2').show();
        var CurName = $("#_Name00").val();

        $("#_Dname").val(CurName);

        //$("#_Dname,#_Dmobile,#_Demail,#Confirm").prop("disabled", false);
        $("#Confirm").prop("disabled", false);

        $(this).slideToggle();

        realArray.push({
            'DefaultTime': $("#_Time").val(),
            'Date': $("#_Date").val(),
            'NumOfDays': $("#NumDays").val(),
            'Extras': ExtraString,
            'ExtrasPrice': ExtraVal,
            'Address': $("#_Daddress").val(),
            'Comments':$("#Comments").val(),
        });

        //future:look into this
        $('input[type=radio][name="bikeSelec"]:checked').each(function() {
            if (realArray[0].NumOfDays == 0.5) {

                //MODIFY HERE
                switch ($(this).val()) {
                    case "Standard Bike":
                        PriceVal = 30;
                        break;
                    case "Full Suspension Bike":
                        PriceVal = 50;
                        break
                    case "Electric Bike":
                        PriceVal = 60;
                        break;
                    case "Kids Bike":
                        PriceVal = 35;
                        break;
                }
                //MODIFY END

            } else {
                BikeName($(this).val());
                console.log($(this).val());
                //MODIFY HERE
//                switch ($(this).val()) {
//                    case "Standard Bike":
//                        PriceVal = 40;
//                        break;
//                    case "Full Suspension Bike":
//                        PriceVal = 75;
//                        break
//                    case "Electric Bike":
//                        PriceVal = 80;
//                        break;
//                    case "Kids Bike":
//                        PriceVal = 35;
//                        break;
//                }
                //MODIFY END
            }
            switch ($("#Extras").val()) {
                case "":
                    ExtraVal = 0;
                    ExtraString = "None"
                    break;
                case "PBR":
                    ExtraVal = 10;
                    ExtraString = "Pannier Bags and Rack"
                    break;
                case "CCBT":
                    ExtraVal = 15;
                    ExtraString = "Childs Covered Bike Trailer"
                    break;
                case "CSFM":
                    ExtraVal = 10;
                    ExtraString = "Childs Seat Front Mounted"
                    break;
                case "CSRM":
                    ExtraVal = 10;
                    ExtraString = "Childs Seat Rear Mounted"
                    break;
                case "PEDS":
                    ExtraVal = 5;
                    ExtraString = "Clip Pedal/ Shimano spds"
                    break;
            }

            realArray[0].Extras = ExtraString;
            realArray[0].ExtrasPrice = ExtraVal;

            realArray.push({
                'Name': $("#_Name00").val(),
                'Height': $("#_Height00").val(),
                'Bike2': $(this).val(),
                'Price': PriceVal,
            });
        });
        //console.log(realArray);
        TotalPrice();
        populateHandles()
        $("#NHDinfo").remove();
    }
});
//Divide by 2 on half days
function halfDay()
{
    
}
var ExtraVal2 = 0;
var ExtraString2 = "";

$('#AddRider2').click(function(e) {
    countRider++;
    count2++;


    $('input[type=radio][name="bikeSelec"]:checked').each(function() {

        if (realArray[0].NumOfDays == 0.5) {
            switch ($(this).val()) {
                case "Standard Bike":
                    PriceVal = 30;
                    break;
                case "Full Suspension Bike":
                    PriceVal = 50;
                    break
                case "Electric Bike":
                    PriceVal = 60;
                    break;
                case "Kids Bike":
                    PriceVal = 20;
                    break;
            }
        } else {
            switch ($(this).val()) {
                case "Standard Bike":
                    PriceVal = 40;
                    break;
                case "Full Suspension Bike":
                    PriceVal = 75;
                    break
                case "Electric Bike":
                    PriceVal = 80;
                    break;
                case "Kids Bike":
                    PriceVal = 35;
                    break;
            }
        }

        //increment name and height name attribute for multiple entries
        $(".repeatName").attr('id', "_Name" + count2);
        $(".repeatHeight").attr('id', "_Height" + count2);
        $(".repeatExtra").attr('id', "_Extras" + count2);

        //future:change to function
        //FUTURE:Look into constructors
        switch ($("#_Extras" + count2).val()) {
            case "":
                ExtraVal2 = 0;
                ExtraString2 = "None"
                break;
            case "PBR":
                ExtraVal2 = 10;
                ExtraString2 = "Pannier Bags and Rack"
                break;
            case "CCBT":
                ExtraVal2 = 15;
                ExtraString2 = "Childs Covered Bike Trailer"
                break;
            case "CSFM":
                ExtraVal2 = 10;
                ExtraString2 = "Childs Seat Front Mounted"
                break;
            case "CSRM":
                ExtraVal2 = 10;
                ExtraString2 = "Childs Seat Rear Mounted"
                break;
            case "PEDS":
                ExtraVal2 = 5;
                ExtraString2 = "Clip Pedal/ Shimano spds"
                break;
        }

        var NameVal = $("#_Name" + count2).val();

        //if the name is empty then default to first name
        if (NameVal == "") {
            NameVal = realArray[1].Name;
        }
        realArray.push({
            'Name': NameVal,
            'Height': $("#_Height" + count2).val(),
            'Bike2': $(this).val(),
            'Extra2': ExtraString2,
            'ExtraPVal': ExtraVal2,
            'Price': PriceVal,
        });
        //console.log(realArray);
        TotalPrice();
    });
    populateHandles(countRider);

    $('#_Name' + count2).val("");

    //increment rider id with array length
    for (var i = 0; i < realArray.length; i++) {
        $('#rID').html(i + 1);
    }
});

$('#EditRider2').click(function(e) {
    var SelVal = EditRider,
        Ename = $("#_Ename").val(),
        EHeight = $("#_Eheight").val();

    $('input[type=radio][name="bikeSelec"]:checked').each(function() {
        var Ebike = $(this).val();
        switch ($("#_Extras").val()) {
            case "":
                ExtraVal2 = 0;
                ExtraString2 = "None"
                break;
            case "PBR":
                ExtraVal2 = 10;
                ExtraString2 = "Pannier Bags and Rack"
                break;
            case "CCBT":
                ExtraVal2 = 15;
                ExtraString2 = "Childs Covered Bike Trailer"
                break;
            case "CSFM":
                ExtraVal2 = 10;
                ExtraString2 = "Childs Seat Front Mounted"
                break;
            case "CSRM":
                ExtraVal2 = 10;
                ExtraString2 = "Childs Seat Rear Mounted"
                break;
            case "PEDS":
                ExtraVal2 = 5;
                ExtraString2 = "Clip Pedal/ Shimano spds"
                break;
        }
        if (realArray[0].NumOfDays == 0.5) {
            switch ($(this).val()) {
                case "Standard Bike":
                    PriceVal = 30;
                    break;
                case "Full Suspension Bike":
                    PriceVal = 50;
                    break
                    case "Electric Bike":
                    PriceVal = 60;
                    break;
                case "Kids Bike":
                    PriceVal = 35;
                    break;
            }
        } else {
            switch ($(this).val()) {
                case "Standard Bike":
                    PriceVal = 40;
                    break;
                case "Full Suspension Bike":
                    PriceVal = 75;
                    break
                    case "Electric Bike":
                    PriceVal = 80;
                    break;
                case "Kids Bike":
                    PriceVal = 30;
                    break;
            }
        }
        $(".repeatName").attr('id', "_Name" + count2);
        $(".repeatHeight").attr('id', "_Height" + count2);
        $(".repeatExtra").attr('id', "_Extras" + count2);

        if (Ename == "") {
            Ename = realArray[1].Name
        }
        EditDetails(SelVal, Ename, EHeight, Ebike, PriceVal,ExtraString2,ExtraVal2);
        console.log(ExtraString3,ExtraVal3)
    });
    TotalPrice();
    populateHandles(countRider);

});

var ExtraVal3 = 0;
var ExtraString3 = "";

$('#EditRider3').click(function(e) {
    var SelVal = 1,
        Ename = $("#_Ename").val(),
        NumDay = $("#ENumDays").val(),
        EHeight = $("#_Eheight200").val();


    $('input[type=radio][name="bikeSelec"]:checked').each(function() {
        var Ebike = $(this).val();

        if (realArray[0].NumOfDays == 0.5) {
            switch ($(this).val()) {
                case "Standard Bike":
                    PriceVal = 30;
                    break;
                case "Full Suspension Bike":
                    PriceVal = 50;
                    break
                case "Electric Bike":
                    PriceVal = 60;
                    break;
                case "Kids Bike":
                    PriceVal = 35;
                    break;
            }
        } else {
            switch ($(this).val()) {
                case "Standard Bike":
                    PriceVal = 40;
                    break;
                case "Full Suspension Bike":
                    PriceVal = 75;
                    break
                case "Electric Bike":
                    PriceVal = 80;
                    break;
                case "Kids Bike":
                    PriceVal = 30;
                    break;
            }
        }
        switch ($("#EExtras").val()) {
            case "":
                ExtraVal2 = 0;
                ExtraString2 = "None"
                break;
            case "PBR":
                ExtraVal2 = 10;
                ExtraString2 = "Pannier Bags and Rack"
                break;
            case "CCBT":
                ExtraVal2 = 15;
                ExtraString2 = "Childs Covered Bike Trailer"
                break;
            case "CSFM":
                ExtraVal2 = 10;
                ExtraString2 = "Childs Seat Front Mounted"
                break;
            case "CSRM":
                ExtraVal2 = 10;
                ExtraString2 = "Childs Seat Rear Mounted"
                break;
            case "PEDS":
                ExtraVal2 = 5;
                ExtraString2 = "Clip Pedal/ Shimano spds"
                break;
        }
        if (Ename == "") {
            Ename = realArray[1].Name
        }

        EditDetails2(SelVal, Ename, EHeight, Ebike, PriceVal, NumDay, ExtraString2, ExtraVal2);
    });
    TotalPrice();
    populateHandles(countRider);

});
//Overwrite rider details
function EditDetails(i, Newname, Newheight, Newbike, Newprice,EdExtra,EdPrice) {
    realArray[i].Name = Newname;
    realArray[i].Height = Newheight;
    realArray[i].Bike2 = Newbike;
    realArray[i].Price = Newprice;
    realArray[i].Extra2 = EdExtra;
    realArray[i].ExtraPVal = EdPrice;
}

function EditDetails2(i, Newname, Newheight, Newbike, Newprice, NewDay, NewExtra, NEPrice) {
    realArray[i].Name = Newname;
    realArray[i].Height = Newheight;
    realArray[i].Bike2 = Newbike;
    realArray[i].Price = Newprice;
    realArray[0].NumOfDays = NewDay;
    realArray[0].Extras = NewExtra;
    realArray[0].ExtrasPrice = NEPrice;
}
$('#EditDelivery').click(function(e) {

    var timeVal = currentdate.getHours();

    var dateVal = currentdate.getDate() + "/"
    + (currentdate.getMonth()+1)  + "/"
    + currentdate.getFullYear();

    var editDate = $("#_EDate").val();
    var edDate = editDate;
    var editTime = $("#_ETime").val();
    var edTime= editTime;

    var length = 2;
    var myString =$("#_ETime").val();
    var myTruncatedString = myString.substring(0,length);

    var validator = $( "#EditDelivDetails" ).validate();

    var checkDifTime = myTruncatedString - timeVal;

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z," "]+$/i.test(value);
    }, "Letters only please");

    jQuery.validator.addMethod("validChar", function(value, element) {
        return this.optional(element) || /^[a-z," ",A-Z,0-9]+$/i.test(value);
    }, "Please enter a valid character");

    if(dateVal == editDate)
    {
        if (checkDifTime < 4){
            validator.showErrors({
                "_ETime": "Time must be after current time and minimum notice 4 hours",
            });
            return false;
        }
    }
    if(edDate == "")
    {
        validator.showErrors({
            "_EDate": "Please Enter a Date",
        });
        return false;
    }
    if(edTime == "")
    {
        validator.showErrors({
            "_ETime": "Please Enter a Time",
        });
        return false;
    }

    if ($("#EditDelivDetails").valid()) {
        var Eaddress = $("#_EDaddress").val(),
            Edate = $("#_EDate").val(),
            Etime = $("#_ETime").val();

        EditDelivDetails(Eaddress, Edate, Etime);

        TotalPrice();
        populateHandles();
    }

});
//overwrite delivery details
function EditDelivDetails(Newaddress, Newdate, Newtime) {
    realArray[0].Address = Newaddress;
    realArray[0].Date = Newdate;
    realArray[0].DefaultTime = Newtime;
}
$('#Done').click(function(e) {

    $("#EditDetails").slideUp();
    $("#RiderAdd").slideDown();

});
$('#Done2').click(function(e) {

    $("#EditDetails2").slideUp();
    $("#RiderAdd").slideDown();

});
$('#EDone').click(function(e) {

    $("#EditDelivDetails").slideUp();
    $("#RiderAdd").slideDown();

});

//Display current riders in #log and also delivery details
function populateHandles(n) {
    var options = '',
        options2 = '',
        div = '',
        div2 = '';
    var listCount = 1;
    for (var i = 1; i < realArray.length; i++) {
        if (realArray[0].NumOfDays == 0.5 && i == 1) {
            div += '<div id="riderInfo' + i + '" class="col-md-6 col-md-offset-3 top-buffer"><p>' +
                'Rider ' + i + ':' + realArray[i].Name + '<br>' +
                ' Height:' + realArray[i].Height + 'cm<br>' +
                ' Bike:' + realArray[i].Bike2 +
                " $" + realArray[i].Price + '/day' + '<br>' +
                ' Extras:<span>' + realArray[0].Extras + ' $' + realArray[0].ExtrasPrice + '</span>' + '<br>' +
                'Days:<span> 4 hours</span>' +
                '</div>' +
                '<div class="riderInfo' + i + ' col-md-2 col-md-offset-1 top-buffer"><button onclick="EditRiderFunct1(' + i + ')" type="button" class="btn btn-primary" id="EditRider_' + i + '">' +
                '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</button><br>' +
                ' <button onclick="DelRiderFunct(' + i + ')" type="button" class="btn btn-danger" id="DelRider_' + i + '" disabled>' +
                '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</button>' +
                '</div>' +
                '<div class="clearfix visible-md visible-lg"></div>';
        } else if (i == 1 && realArray[0].NumOfDays != 0.5) {
            div += '<div id="riderInfo' + i + '" class="col-md-6 col-md-offset-3 top-buffer"><p>' +
                'Rider ' + i + ':' + realArray[i].Name + '<br>' +
                ' Height:' + realArray[i].Height + 'cm<br>' +
                ' Bike:' + realArray[i].Bike2 +
                " $" + realArray[i].Price + '/day' + '<br>' +
                ' Extras:<span>' + realArray[0].Extras + ' $' + realArray[0].ExtrasPrice + '</span>' + '<br>' +
                'Days:<span>' + realArray[0].NumOfDays + ' day/s</span>' +
                '</div>' +
                '<div class="riderInfo' + i + ' col-md-2 col-md-offset-1 top-buffer"><button onclick="EditRiderFunct1(' + i + ')" type="button" class="btn btn-primary" id="EditRider_' + i + '">' +
                '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</button><br>' +
                ' <button onclick="DelRiderFunct(' + i + ')" type="button" class="btn btn-danger" id="DelRider_' + i + '" disabled>' +
                '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</button>' +
                '</div>' +
                '<div class="clearfix visible-md visible-lg"></div>';
        } else {
            div += '<div id="riderInfo' + i + '" class="col-md-6 col-md-offset-3 top-buffer"><p>' +
                'Rider ' + i + ':' + realArray[i].Name + '<br>' +
                ' Height:' + realArray[i].Height + 'cm<br>' +
                ' Bike:' + realArray[i].Bike2 +" $"+ realArray[i].Price +"/day<br>"  +
                ' Extra:' + realArray[i].Extra2 +" $"+ realArray[i].ExtraPVal +"/day" +
                '</div>' +
                '<div class="riderInfo' + i + ' col-md-2 col-md-offset-1 top-buffer"><button onclick="EditRiderFunct(' + i + ')" type="button" class="btn btn-primary" id="EditRider_' + i + '">' +
                '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</button><br>' +
                '<button onclick="DelRiderFunct(' + i + ')" type="button" class="btn btn-danger" id="DelRider_' + i + '">' +
                '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</button>' +
                '</div>' +
                '<div class="clearfix visible-md visible-lg"></div>';
        }
    }
    div2 += '<div id="DelivInfo" class="col-md-6 col-md-offset-3 top-buffer"><p>' +

    ' Delivery Address:<span>' + realArray[0].Address + '</span><br>' +
        ' Delivery Date:<span>' + realArray[0].Date + '</span><br>' +
        ' Delivery Time:<span>' + realArray[0].DefaultTime + '</span>' +

    '</div>' +
        '<div class="DelivInfo col-md-2  col-md-offset-1 top-buffer text-center">' +
        '<button onclick="EditDelivFunct()" type="button" class="btn btn-primary" id="EditDeliv">' +
        '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</button>' +
        '</div>' +
        '<div class="clearfix visible-md visible-lg"></div>';

    $('#log').hide().html(div).fadeIn("slow");
    $('#Delivlog').html(div2);
}

//get edited rider id and edit selected rider
function EditRiderFunct(editnum) {
    $("#EditDelivDetails :input").val("");
    $("#RiderAdd").slideUp();
    $("#EditDetails").slideDown();

    EditRider = editnum;
    $('#eID').html(editnum);
}

function EditRiderFunct1(editnum) {
    $("#EditDelivDetails2 :input").val("");
    $("#RiderAdd").slideUp();
    $("#EditDetails2").slideDown();

    EditRider = editnum;
    $('#eID2').html(editnum);
}

//get rider id and remove
function DelRiderFunct(delnum) {
    var minnum = delnum - 1;
    //console.log(delnum, minnum)
    realArray.splice( $.inArray(delnum,realArray) ,1 );

    $("#DelRider_" + delnum).remove();
    $("#EditRider_" + delnum).remove();
    $("#riderInfo" + delnum).remove();

    //console.log(realArray);
    TotalPrice();
    for (var i = 0; i < realArray.length; i++) {
        $('#rID').html(i + 1);
    }
}

//edit delivery details
function EditDelivFunct() {
    $("#EditDetails").val("");
    $("#RiderAdd").slideUp();
    $("#EditDelivDetails").slideDown();
}

//populate all height listboxes and update depending on selected bike
function populateHeight(u) {
    var HeightCount = 0;
    var Heightoptions = '';

    //console.log($('input[type=radio][name="bikeSelec"]:checked'));
    $('input[type=radio][name="bikeSelec"]:checked').each(function() {
        switch ($(this).val()) {
            case "Standard Bike":
                HeightCount = 145;
                for (var i = 0; i < 11; i++) {
                    HeightCount += 5;
                    Heightoptions += '<option value="' + HeightCount + '">' + HeightCount + 'cm' + '</option>';
                }
                break;
            case "Full Suspension Bike":
                HeightCount = 155;
                for (var i = 0; i < 9; i++) {
                    HeightCount += 5;
                    Heightoptions += '<option value="' + HeightCount + '">' + HeightCount + 'cm' + '</option>';
                }
                break
            case "Electric Bike":
                HeightCount = 155;
                for (var i = 0; i < 9; i++) {
                    HeightCount += 5;
                    Heightoptions += '<option value="' + HeightCount + '">' + HeightCount + 'cm' + '</option>';
                }
                break;
            case "Kids Bike":
                HeightCount = 110;
                for (var i = 0; i < 7; i++) {
                    HeightCount += 5;
                    Heightoptions += '<option value="' + HeightCount + '">' + HeightCount + 'cm' + '</option>';
                }
                break;
        }
    });

    $('#_Height00,#_Height1,#_Eheight,#_Eheight200').html(Heightoptions);
    $('#_Height' + u).html(Heightoptions);
    $('#_Height2').html(Heightoptions);
}

$("#Confirm").click(function() {
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z," "]+$/i.test(value);
    }, "Letters and spaces only please");
    jQuery.validator.addMethod("numValid", function(value, element) {
        return this.optional(element) || /^[0-9]+$/i.test(value);
    }, "Numbers only please");

    $("#formDetails").validate({
        rules: {
            _Dname: {
                required: true,
                lettersonly: true
            },
            _Dmobile: {
                required: true,
                numValid: true

            },
            _Demail: {
                required: true,
                email: true,
            }
        }
    });

    var validator = $( "#formDetails2" ).validate();
    //post array to same page then store it as a session in PHP
    if ($("#formDetails").valid()) {
        var request = $.ajax({
            type: 'POST',
            url: 'Bike_Select.php',
            data: {
                data: realArray,
            },
            dataType: "html",
            success: function(response) {
                $("#formDetails").submit();
            },
            error: function(xhr, status, error) {

            }
        });
    document.getElementById("#formDetails").submit();
    }
    else{
        validator.showErrors({
            "button": "Please ensure you have filled out all the details correctly",
        });
        return false;
    }
});

//calculations
function TotalPrice() {
    var total = 0;
    totaldays = realArray[0].NumOfDays;
    for (var i = 0; i < realArray.length; i++) {
        total += parseInt(realArray[i].Price || 0);
        total += parseInt(realArray[i].ExtraPVal || 0);
    }
    total += parseInt(realArray[0].ExtrasPrice || 0);
    if (totaldays >= 1) {
        total *= parseInt(totaldays || 0);
    }

    $("#_price").val(total.toFixed(2))
    $('#Tprice').html("$" + total.toFixed(2));
}

//New

function BikeName(getBike)
{

        $.each(BikeData, function (index, data) {
//            console.log(BikeData);
            if(data.Name == getBike)
            {
               PriceVal = data.Price;
            }
        });
}
