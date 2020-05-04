<?php
?>
<html>
  <head></head>

  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  
  <body>
    <!--
    BEFORE RUNNING:
    ---------------
    1. If not already done, enable the Google Sheets API
       and check the quota for your project at
       https://console.developers.google.com/apis/api/sheets
    2. Get access keys for your application. See
       https://developers.google.com/api-client-library/javascript/start/start-js#get-access-keys-for-your-application
    3. For additional information on authentication, see
       https://developers.google.com/sheets/api/quickstart/js#step_2_set_up_the_sample
    -->
    <script>
    function makeApiCall() {
      var params = {
        // The ID of the spreadsheet to retrieve data from.
        spreadsheetId: '1WzoeNWDBkIVLW07IPX54GVBONGebdB64U2Ih2kU1_bc',  // TODO: Update placeholder value.

        // The A1 notation of the values to retrieve.
        ranges: ['Sheet1','Sheet2'],  // TODO: Update placeholder value.

        // How values should be represented in the output.
        // The default render option is ValueRenderOption.FORMATTED_VALUE.
        //valueRenderOption: '',  // TODO: Update placeholder value.

        // How dates, times, and durations should be represented in the output.
        // This is ignored if value_render_option is
        // FORMATTED_VALUE.
        // The default dateTime render option is [DateTimeRenderOption.SERIAL_NUMBER].
        // dateTimeRenderOption: '',  // TODO: Update placeholder value.
      };

      var request = gapi.client.sheets.spreadsheets.values.batchGet(params); //gapi.client.sheets.spreadsheets.values.get(params);
      request.then(function(response) {
        // TODO: Change code below to process the `response` object:
        console.log("response.result");
        console.log("response.result");
        console.log("response.result");
        console.log("response.result");
        console.log("response.result");
        console.log(response);

        return false;
        var result = response.result['values'];
        result.splice(0,1);
        var table = $('#example').DataTable( {
          data: result,
          "aLengthMenu": [[50,100, 200, 300, 500,1000], [50,100, 200, 300,500, 1000]],
          "iDisplayLength": 50,
          "aaSorting": [
            [0, "desc"]
          ],
          "columnDefs": [
            {"className": "dt-center", "targets": "_all"}
          ],
          initComplete : function() {
              $("#example_filter").detach().appendTo('#new-search-area');
          },
          "rowCallback": function(row, data, index){

            if(data[2]  == "No"){
                $(row).find('td:eq(2)').css('background-color', 'red');
                $(row).find('td:eq(2)').css('color', 'white');
            }

            for (var i = 0 ; i < 8 ; i++) {
               var j = i+3;
              if(data[j]  == "Yes"){
                  $(row).find('td:eq('+j+')').css('background-color', 'red');
                  $(row).find('td:eq('+j+')').css('color', 'white');
              }

              if(data[j]  != "Yes" && data[j]  != "No" && data[j] != '' && j < 9){
                  $(row).find('td:eq('+j+')').css('background-color', 'yellow');
                  $(row).find('td:eq('+j+')').css('color', 'black');
              }
            }
          },
          "createdRow": function ( row, data, index ) {
            $('td', row).eq(11).addClass('comments');
          }
        });

        // $('#example tbody').on( 'click', 'tr', function () {
        //   console.log( table.row( this ).data() );
        // });

      }, function(reason) {
        console.error('error: ' + reason.result.error.message);
      });
    }

    function initClient() {
      var API_KEY = 'AIzaSyDMXTezgWD7_7uTv6JeRLZNQAIhhXLDRQU';  // TODO: Update placeholder with desired API key.

      var CLIENT_ID = '582700123765-okalrpacbjp44ksl5cd1ivr96081fsm8.apps.googleusercontent.com';  // TODO: Update placeholder with desired client ID.

      // TODO: Authorize using one of the following scopes:
      //   'https://www.googleapis.com/auth/drive'
      //   'https://www.googleapis.com/auth/drive.file'
      //   'https://www.googleapis.com/auth/drive.readonly'
      //   'https://www.googleapis.com/auth/spreadsheets'
      //   'https://www.googleapis.com/auth/spreadsheets.readonly'
      var SCOPE = 'https://www.googleapis.com/auth/spreadsheets';

      gapi.client.init({
        'apiKey': API_KEY,
        'clientId': CLIENT_ID,
        'scope': SCOPE,
        'discoveryDocs': ['https://sheets.googleapis.com/$discovery/rest?version=v4'],
      }).then(function() {
        gapi.auth2.getAuthInstance().isSignedIn.listen(updateSignInStatus);
        updateSignInStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
      });
    }

    function handleClientLoad() {
      gapi.load('client:auth2', initClient);
    }

    function updateSignInStatus(isSignedIn) {
      if (isSignedIn) {
        makeApiCall();
      }
    }

    function handleSignInClick(event) {
      gapi.auth2.getAuthInstance().signIn();
    }

    function handleSignOutClick(event) {
      gapi.auth2.getAuthInstance().signOut();
    }

    function refresh_page(){
      location.reload();
    }

    </script>
    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>


    <button id="signin-button" onclick="handleSignInClick()">Sign in</button>
    <button id="signout-button" onclick="handleSignOutClick()">Sign out</button>

    <style type="text/css">
      .long-table {
          min-width: 3000px !important;
      }

      /*#example_filter input {
        border-radius: 5px;
        margin-bottom: 10px;
      }*/

      #example_length{
        margin-bottom: 10px;
      }

      #new-search-area {
        width: 100%;
        clear: both;
        padding-top: 20px;
        padding-bottom: 20px;
      }
      #new-search-area input {
        width: 600px;
        font-size: 16px;
        padding: 5px;
      }
    </style>

    <div style="margin-top:10px;">
      <button id="refresh_page" onclick="refresh_page()">Fetch Latest</button>  
    </div>
    

    <div id="new-search-area"></div>
  
    <table class="long-table" id="example" width="100%" border="all">
      <thead>
        <th style="width:5%;">Date</th>
        <th style="width:10%;">Email Address</th>
        <th style="width:7%;">Do you have permission from your line manager or another authority for you to come to the office?</th>
        <th style="width:7%;">Do you have a fever, or have you had a fever at any point in the last two weeks?</th>
        <th style="width:7%;">Does anyone in your place of residence have a fever or any other COVID-19 symptoms (e.g. cough, difficulty breathing)?</th>
        <th style="width:7%;">Have you met or otherwise interacted with a COVID-19 patient or their family in person? </th>
        <th style="width:7%;">Have you met anyone who has traveled from abroad in the past two weeks?</th>
        <th style="width:7%;">Do you live in an area that is sealed or is in lockdown per government orders?</th>
        <th style="width:7%;">Have you been to a gathering of 5 or more people in the last two weeks? (This does not include your family at home or visits to grocery stores) s</th>
        <th style="width:5%;">EMP ID</th>
        <th style="width:5%;">Temperature</th>
        <th style="width:10%;">Comments</th>
      </thead>
      <tbody id="employee_data">
        
      </tbody>
    </table>

  </body>
</html>