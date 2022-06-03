
var bit = 1;     //Bit to restrict duplicate child textboxes
var prior = '';  //Variable to hold the prior value

function toEditable(col_id) {
    var parent_value = document.getElementById(col_id).innerHTML;
    
    if(bit) {
        prior = parent_value;
        document.getElementById(col_id).style.backgroundColor = "lightsalmon";
        document.getElementById(col_id).innerHTML = "";

        var textBox = document.createElement('input');  //Creating a dynamic textBox
        textBox.setAttribute('type', 'text');
        textBox.setAttribute('id', col_id+'-inp');
        textBox.setAttribute('name', 'newValue');
        textBox.setAttribute('value', parent_value);

        document.getElementById(col_id).appendChild(textBox);
        document.getElementById(col_id+'-inp').focus();
        bit = 0;
    }
}
function saveValue(col_id, table) {
    ele = document.getElementById('rec-'+table+'-'+col_id);
    var r = confirm("Are you sure you want to update this value?");
    if (r == true) { 
        var newVal = document.getElementById('rec-'+table+'-'+col_id+'-inp').value;
        if(!newVal){
            newVal = '0';
        }
        connect(col_id, table, newVal);
    } else {
        ele.innerHTML = prior;   // Set TD to the prior value on cancel
        ele.style.backgroundColor = "";
        bit = 1;
    }
}

function connect(id, table, value) {

    jQuery.ajax({
        type: "post",
        // dataType: "json",
        url: ajax_object.ajax_url,
        data: {
            'action': 'my_action',
            'id': id, // or combine serialized form with action .... 
            'table': table,  
            'value': value 
        },
        beforeSend: function() {
        },
        success: function(response){
            if(response == 'success') {
                var updatedVal = document.getElementById(ele.id+'-inp').value;
                if(!updatedVal){
                    updatedVal = '0';
                }
                ele.innerHTML = updatedVal; //Set TD to the new saved value
                ele.style.backgroundColor = "";
                bit = 1;
            } else {
                alert('Something went wrong. Maybe you are trying to save the same value again.');
                location.reload(); //Refresh Edit View
            }
        },
        error: function(){
            alert('Failure Occured...!!');
            location.reload(); //Refresh Edit View
        },
    }); 
}
