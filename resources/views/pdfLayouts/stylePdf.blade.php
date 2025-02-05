<!DOCTYPE html>
<html>
    <head>
        <title>@yield("title")</title>
        <style>
            #header {
                display: flex;
                align-items: center; /* This ensures both elements are vertically aligned */
                position: fixed;
                left: 0;
                top: 0; /* Add top positioning to fix the header at the top */
                width: 100%; /* Make the header take up the full width */
                padding: 0.5cm;
                background-color: white; /* Optional, for better visibility */
                z-index: 1000; /* Ensure it stays on top of other content */
            }

            .imgHeader {
                float: left;
                width: 75px;
                height: auto;
            }

            .infoHeader {
                width: 100%;
                float: left;
                margin-left: 0.3cm;
                font-size: 11px;
                padding: 0 0; /* Adjust the padding as needed */
            }

            footer {
                background-color: #bbdefb;
                padding: 0.375rem;
                text-align: center;
                bottom: 0;
                width: 100%;
                position: fixed;
                color: #111827;
                font-family: sans-serif;
            }

            @page {
                margin: 0.5cm 0.5cm;
            }

            .content {
                margin-top: 3cm;
            }
        </style>
    </head>
    <body>
        <div id="header">
            <img class="imgHeader" src="{{ public_path('/img/dd.png') }}" alt="logo" >

            <div class="infoHeader">
                <p>{{$company->company_name}}</p>
                <p >{{'Direccion. '.$company->company_address}}</p>
                <p>{{'CUIT. '.$company->company_cuit}}</p>
            </div>
        </div>

        <div class="content">
            @yield("content")
        </div>

        <footer>
            <div class="custom-footer">
                © {{ date("Y") }} Derechos Reservados:
                {{ config("app.name") }} - V.
                {{ config("app.version") }}
            </div>
        </footer>
    </body>
</html>
