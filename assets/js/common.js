$(document).ready(function(){
	$('.reset').click(function()
	{
    $(this).closest('form').find(":input[type=text]:not([readonly]),:input[type=email]:not([readonly]), textarea:not([readonly])").val("");

	});
	$(".number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
   });

    $('.alpha_only').bind('keyup blur',function(){ 
        var node = $(this);
        node.val(node.val().replace(/[^a-zA-Z ]/g,'') );
    });


    $('.special_char').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9 \b]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});


});
function format_date(date)
{
        var datecheck = Date.parse(date) || 0;
        if(datecheck!=0)
        {
            var d = new Date(date);
            var curr_day = d.getDate();
            var curr_month = parseInt(d.getMonth())+1;
            var curr_year = d.getFullYear();
            if(curr_day < 10)
            {
                curr_day = '0'+curr_day;
            }
            if(curr_month < 10)
            {
                curr_month = '0'+curr_month;
            }
            var newDate = curr_day+'/'+curr_month+'/'+curr_year;
            return newDate;
        }
        else
        {
            return '-';
        }
}

function convert_date(str) {
    var date = new Date(str),
        mnth = ("0" + (date.getMonth()+1)).slice(-2),
        day  = ("0" + date.getDate()).slice(-2);
    return [ day,mnth,date.getFullYear()].join("/");
}



function select2(id_selector,url,placeholder='')
{
      $(id_selector).select2({

        placeholder: placeholder,

        ajax: {

          url: url,
          dataType: 'json',
          delay: 250,

          processResults: function (data) {

            return {

              results: data

            };

          },

          cache: true

        }

      });

}

function get_todays_date()
{
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
    dd='0'+dd;
    } 
    if(mm<10){
    mm='0'+mm;
    } 
    var today = dd+'/'+mm+'/'+yyyy;
    return today;
    // document.getElementById("DATE").value = today; 
}

