<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Betreiesbsführung - Bosten</title>
    <script href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<!-- CSS -->
<style>
    .heading {
        padding-top:20px;
        padding-left:40px;
    }
    /* class applies to select element itself, not a wrapper element */
    .select-css {
        display: block;
        font-size: 14px;
        font-family: sans-serif;
        font-weight: 700;
        color: #444;
        line-height: 1.3;
        padding: .6em 1.4em .5em 3em;
        box-sizing: auto;
        margin: 0;
        box-shadow: 0 1px 0 1px rgba(0,0,0,.04);
        border-radius: .5em;
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;
        background-color: #fff;
        /* note: bg image below uses 2 urls. The first is an svg data uri for the arrow icon, and the second is the gradient. 
            for the icon, if you want to change the color, be sure to use `%23` instead of `#`, since it's a url. You can also swap in a different svg icon or an external image reference
            
        */
        background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
        linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
        background-repeat: no-repeat, repeat;
        /* arrow icon position (1em from the right, 50% vertical) , then gradient position*/
        background-position: right .7em top 50%, 0 0;
        /* icon size, then gradient */
        background-size: .65em auto, 100%;
    }
    /* Hide arrow icon in IE browsers */
    .select-css::-ms-expand {
        display: none;
    }
    /* Hover style */
    .select-css:hover {
        border-color: #888;
    }
    /* Focus style */
    .select-css:focus {
        border-color: #aaa;
        /* It'd be nice to use -webkit-focus-ring-color here but it doesn't work on box-shadow */
        box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
        box-shadow: 0 0 0 3px -moz-mac-focusring;
        color: #222; 
        outline: none;
    }
    /* Set options to normal weight */
    .select-css option {
        font-weight:normal;
    }
    /* Support for rtl text, explicit support for Arabic and Hebrew */
    *[dir="rtl"] .select-css, :root:lang(ar) .select-css, :root:lang(iw) .select-css {
        background-position: left .7em top 50%, 0 0;
        padding: .6em .8em .5em 1.4em;
    }
    /* Disabled styles */
    .select-css:disabled, .select-css[aria-disabled=true] {
        color: graytext;
        background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22graytext%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
        linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
    }
    .select-css:disabled:hover, .select-css[aria-disabled=true] {
        border-color: #aaa;
    }
    .datatable {
        font-size: 12px;
        display:block;
        overflow: auto;
        border-collapse: collapse;
        white-space: nowrap;
        margin:40px;
    }
    td
    {
        border: 1px solid black;
        padding:2px;
    }
    th
    {
        border: 1px solid black;
        padding: 2px 8px;
    }
    .pp {
        margin-left:40px;
        float:left;
    }
    .sp {
        margin-left:40px;
    }
    .selection h6 {
        font-weight:bold;
    }

</style>

<body>
	<h2 class="heading">Betreiesbsführung</h2>
    <br>
    <div class="selection">
        <div class="form-input-select pp">
        <h6>Choose a Power Plant: </h6>
        <select class="select-css powerplant" name="powerplant" id="powerplant" (change)="getSubplants($event)" style="max-width:80%;">
            <option selected="false">  </option>
            @foreach ($powerplants as $item)
                <option value="{{ $item->PlantID }}">{{ $item->Projektname }}</option>
            @endforeach
        </select>
        </div>

        <div class="sp" id="subdiv">
        <h6>Choose a Sub-Power Plant: </h6>
        <select class="select-css subpowerplants" name="subpowerplants" id="subpowerplants" (change)="getCustomer($event)" style="max-width:80%;">
            <option selected="false">  </option>
        </select>
        </div>
    </div>

    <!-- Display Company Details here: -->
    <table class="datatable" id="datatable"><col style="width:auto"></table>


    <!--JS script-->
    <!--script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
        //$('#subpowerplants').style.visibility = "hidden";
        $( document ).ready(function() {
            console.log( "ready!" );
            $('#subdiv').hide();
        });
        //Fucntion to obtion Powerplant selection and display Sub-Powerplants correspondingly
        $(function() {
            $('select[name="powerplant"]').on('change', function () {
                var PlantID = $(this).val();
                var select = $("#powerplant option:selected").text();
                console.log("Powerplant selected");
                console.log("PlantID: " + PlantID);
                console.log("Projektname: " + select);
                $('#datatable').empty();

                if (PlantID) {
                    $.get('/getSubplants/' + PlantID, function(data) {
                        $('#subdiv').show();
                        $('#powerplantdetail').empty();
                        $('#powerplantdetail').append('PlantID: ' + PlantID + ' Data: ' + data);
                        $('select[name="subpowerplants"]').empty();
                        $('#subpowerplants').append('<option selected="false">  </option>');
                        $.each(data,function(key, value) {
                            $('select[name="subpowerplants"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }, 'json');
                } else {
                    $('#subdiv').hide();
                    $('select[name="subpowerplants"]').empty();
                    $('#datatable').empty();
                }
            });
        });
        
        //Function to obtain Sub-Powerplant selection
        $(function() {
            $('select[name="subpowerplants"]').on('change', function () {
                var select = $("#subpowerplants option:selected").text();
                var Suplant = $(this).val();
                console.log("Sub-Powerplant selected");
                console.log("SubplantID: " + Suplant);
                console.log("Sub-Powerplant: " + select);
                if (select != " Select A Sub-Powerplant ") {
                    $('#datatable').empty();
                    //Valid Subplant selected! Now displaying information
                    @foreach ($company as $item)
                        if ('{{ $item->Suplant }}' == select) 
                        {
                            $('.datatable').append('<tr><th> Customer ID </th><th> Suplant  </th><th> Company Name </th><th> Street </th><th> PLZ </th><th> Ort </th><th> State </th><th> Country </th><th> Email </th><th> Telephone 1 </th><th> Telephone 2 </th><th> Bosten DEB </th><th> Sunfactory DEB </th><th> EMA DEB </th><th> EMA Kred </th><th> KontoIBAN </th><th> KontoBIC </th><th> CC Empf </th><th> Steuerberater</th><th> Gruss1 </th><th> Gruss2 </th></tr>');
                            $('#datatable').append('<tr><td>{{ $item->Customer_ID }}</td><td>{{ $item->Suplant }}</td><td>{{ $item->Company_Name }}</td><td>{{ $item->Street }}</td><td>{{ $item->PLZ }}</td><td>{{ $item->Ort }}</td><td>{{ $item->State }}</td><td>{{ $item->Country }}</td><td>{{ $item->Email4_sonstige }}</td><td>{{ $item->Tel_1 }}</td><td>{{ $item->Tel_2 }}</td><td>{{ $item->bosten_DEB }}</td><td>{{ $item->sunfactory_DEB }}</td><td>{{ $item->EMA_DEB }}</td><td>{{ $item->EMA_Kred }}</td><td>{{ $item->KontoIBAN }}</td><td>{{ $item->KontoBIC }}</td><td>{{ $item->CC_Empf }}</td><td>{{ $item->Steuerberater }}</td><td>{{ $item->Gruss1 }}</td><td>{{ $item->Gruss2 }}</td>');
                        }
                    @endforeach
                } else {
                    $('#datatable').empty();
                }
            });
        });
    </script>
    
</body>
</html>