$(document).ready(function () {
    //Initial document - Create the tr and td elements with datasets
    $.ajax({
        type: "post",
        url: "manage_data.php",
        data: "acc=init",
        dataType: "json",
        cache: false,
        success: function (content) {
            //Defining variables for addition 
            var suma_janvier = 0;
            var suma_fevrier = 0;
            var suma_mars = 0;
            var suma_avril = 0;
            var suma_mai = 0;
            var suma_juin = 0;
            var suma_julliet = 0;
            var suma_aout = 0;
            var suma_septembre = 0;
            var suma_octobre = 0;
            var suma_novembre = 0;
            var suma_decembre = 0;
            var suma_decembre = 0;
            var suma_total = 0;
            var suma_totaltotal = 0;

            //Selection table to add content
            var tabla = $('#tabla_prestations tbody');

            //Looping through content
            $.each(content, function (index, item) {
                suma_total = 0;
                var tabla = $('#tabla_prestations tbody')
                nouvelle_data = $('<tr style="font-style:normal">');
                nouvelle_data.append($('<td>'))

                //Inserting Id datatable
                nouvelle_data.append($('<td value="' + item.id_chantier + '">').text(item.name_chantier))
                nouvelle_data.append($('<td value="' + item.id_prestation + '">').text(item.name_prestation))

                //Appending data of each month
                nouvelle_data.append($('<td>').text(item.Janvier))
                nouvelle_data.append($('<td>').text(item.Fevrier))
                nouvelle_data.append($('<td>').text(item.Mars))
                nouvelle_data.append($('<td>').text(item.Avril))
                nouvelle_data.append($('<td>').text(item.MAi))
                nouvelle_data.append($('<td>').text(item.Juin))
                nouvelle_data.append($('<td>').text(item.Julliet))
                nouvelle_data.append($('<td>').text(item.AOut))
                nouvelle_data.append($('<td>').text(item.Septembre))
                nouvelle_data.append($('<td>').text(item.Octobre))
                nouvelle_data.append($('<td>').text(item.Novembre))
                nouvelle_data.append($('<td>').text(item.Decembre))

                // Addition of  the month data 
                suma_total += parseFloat(item.Janvier)
                suma_total += parseFloat(item.Fevrier)
                suma_total += parseFloat(item.Mars)
                suma_total += parseFloat(item.Avril)
                suma_total += parseFloat(item.MAi)
                suma_total += parseFloat(item.Juin)
                suma_total += parseFloat(item.Julliet)
                suma_total += parseFloat(item.AOut)
                suma_total += parseFloat(item.Septembre)
                suma_total += parseFloat(item.Octobre)
                suma_total += parseFloat(item.Novembre)
                suma_total += parseFloat(item.Decembre)

                //Addition of all the month in all the rows
                suma_totaltotal += suma_total
                nouvelle_data.append($('<td>').text(suma_total))

                //Adding a button to remove row
                var link = $('<a>', {
                    class: 'btn btn-xs btn-danger',
                    href: '#',
                    type: 'button',
                    //adding the function remmove by id
                    onclick: 'remove(this)',
                    value: item.id_mois,
                    id: item.id_mois
                })
                var boton = $('<i>', {
                    class: 'fa fa-trash',
                });
                boton.appendTo(link)
                link = link.appendTo(nouvelle_data)
                console.log(link);
                nouvelle_data.append($('<td>').html(link))

                //Appending all the data to table
                tabla.append(nouvelle_data);

                //Addition of the total data for each month
                suma_janvier += parseFloat(item.Janvier)
                suma_fevrier += parseFloat(item.Fevrier)
                suma_mars += parseFloat(item.Mars)
                suma_avril += parseFloat(item.Avril)
                suma_mai += parseFloat(item.MAi)
                suma_juin += parseFloat(item.Juin)
                suma_julliet += parseFloat(item.Julliet)
                suma_aout += parseFloat(item.AOut)
                suma_septembre += parseFloat(item.Septembre)
                suma_octobre += parseFloat(item.Octobre)
                suma_novembre += parseFloat(item.Novembre)
                suma_decembre += parseFloat(item.Decembre)
            })

            //Appending data total of each month to table 
            nouvelle_data = $('<tr>');
            nouvelle_data.append($('<td>'))
            nouvelle_data.append($('<td>'))
            nouvelle_data.append($('<td>').html('<b>Total heures</b>'))
            nouvelle_data.append($('<td>').text(suma_janvier))
            nouvelle_data.append($('<td>').text(suma_fevrier))
            nouvelle_data.append($('<td>').text(suma_mars))
            nouvelle_data.append($('<td>').text(suma_avril))
            nouvelle_data.append($('<td>').text(suma_mai))
            nouvelle_data.append($('<td>').text(suma_juin))
            nouvelle_data.append($('<td>').text(suma_julliet))
            nouvelle_data.append($('<td>').text(suma_aout))
            nouvelle_data.append($('<td>').text(suma_septembre))
            nouvelle_data.append($('<td>').text(suma_octobre))
            nouvelle_data.append($('<td>').text(suma_novembre))
            nouvelle_data.append($('<td>').text(suma_decembre))
            nouvelle_data.append($('<td>').text(suma_totaltotal))
            tabla.append(nouvelle_data);
        }
    })
})

//Function remove by id
function remove(elemento) {
    var id_mois = $(elemento).attr('value');
    // try your id--> alert(id_mois)
    $.ajax({
        type: "post",
        url: "manage_data.php",
        data: "acc=remove&id_mois=" + id_mois,
        cache: false,
        success: function (content) {
            alert(content);
            location.reload();
        }
    });
}

//Function insert data to database
function insert() {
    //Getting data form
    var insert = $("#form-heures")
    insert = insert.serialize()
    $.ajax({
        type: "post",
        url: "manage_data.php",
        data: "acc=insert&" + insert,
        dataType: "JSON",
        cache: false,
        success: function (content) {

            if (content.statusCode == 200) {
                alert(content);
                history.go(0);
                // location.reload();
            } else if (content.statusCode == 201) {
                alert("error")
            }
        }
    });
}

//Function filter the data with jquery functions
function filter() {
    var filter1 = $('#filter1').val()
    var filter2 = $('#filter2').val()
    var tabla = $('#tabla_prestations tbody tr')
    if (filter1 == '3' && filter2 == '3') {
        tabla.show();
    } else {
        tabla.hide();
        tabla.each(function () {
            var mostrar = true;
            var filas = $(this).find('td:nth-child(2)').attr("value");
            var filas1 = $(this).find('td:nth-child(3)').attr("value");

            if (filter1 != '3') {
                mostrar = mostrar && filas == filter1;
            }
            if (filter2 != '3') {
                mostrar = mostrar && filas1 == filter2;
            }
            if (mostrar) {
                $(this).show();
            }
        })
    }
}