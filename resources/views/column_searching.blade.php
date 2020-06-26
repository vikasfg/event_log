<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Events</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">  

      <br />
     <h3 align="center">Events Log</h3>
     <br />
   <div class="table-responsive">
    <input type="button"  name='clear' value='clear'   onclick="search(this)"></input>
    <input type="button"  name='add' value='Add Log'   onclick="addLog(this)"></input>
    <div id='res'></div>
    <table class="table table-bordered table-striped" id="product_table">
     <thead>
      <tr>
       <th>Id</th>
       <th>CreatedAt</th>
       <th>Email</th>
       <th>Environment</th>
       <th>Component</th>
       <th>Message</th>
       <th>Data</th>
      </tr>
      <tr>
       <th><input type="text" name="id" class="search" onkeydown="search(this)"></th>
       <th><input type="text" name="created_at" class="search" onkeydown="search(this)"></th>
       <th><input type="text" name="email" class="search" onkeydown="search(this)"></th>
       <th><input type="text" name="environment" class="search" onkeydown="search(this)"></th>
       <th><input type="text" name="component" class="search" onkeydown="search(this)"></th>
       <th><input type="text" name="message" class="search" onkeydown="search(this)"></th>
       <th>{{-- <input type="text" name="data" class="search" onkeydown="search(this)"> --}}</th>
       
      </tr>
     </thead>

     <tbody>
      @foreach($data as $val)
     <tr>

         <td>{{$val->id}}</td>
         <td>{{$val->created_at}}</td>
         <td>{{$val->email}}</td>
         <td>{{$val->environment}}</td>
         <td>{{$val->component}}</td>
         <td>{{$val->message}}</td>
         <td>{{json_encode($val->data)}}</td>
     </tr>

     @endforeach
     </tbody>
    </table>
   </div>
   <br />
   <br />
  </div>
 </body>
</html>


<script> 
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
 
var data={}; 
  function search(ele) {
    if(event.keyCode == 13 || ele.value=='clear') {
       data[ele.name] = ele.value;         
    if(ele.value=='clear')
      $( ".search" ).val('');
     if(event.keyCode == 13)
      delete data.clear;  // or delete person["age"];

    console.log(data);
     
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: "/api/search",
               //Data, that will be sent to "ajax.php".
               data: 
                   //Assigning value of "name" into "search" variable.
                   data
               ,
               //If result found, this funtion will be called.
               success: function(json) {
                console.log(json);
                 
                  var content = '';
                  for (var i = 0; i < json.length; i++) {
                  content += '<tr><td>' + json[i]._id + '</td>';
                  content += '<td>' + json[i].created_at + '</td>';
                  content += '<td>' + json[i].email + '</td>';
                  content += '<td>' + json[i].environment + '</td>';
                  content += '<td>' + json[i].component + '</td>';
                  content += '<td>' + json[i].message + '</td>';
                  content += '<td>' + JSON.stringify(json[i].data) + '</td>';
                  content += '</tr>';
                  }
           // content += '</tbody>';-- **superfluous**
            //$('table tbody').replaceWith(content);  **incorrect..**
            if(json.length > 0)
             $('#product_table tbody').html(content); 
                 //  $("#display").html(html).show();
               }
           });
       }
   }

   function addLog(ele){
    var today = new Date(); 
    var order = Math.floor(100000 + Math.random() * 900000);
    var amount = Math.floor(10000 + Math.random() * 90000);
    var chars = 'abcdefghijklmnopqrstuvwxyz';
email = chars[Math.floor(Math.random()*26)] + Math.random().toString(36).substring(2,11) + '@gmail.com';
    $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: "/api/store-logs",
               //Data, that will be sent to "ajax.php".
               data:       {      "email":email,
            "environment":"prod",
            "component":"order",
            "message":"the buyer #"+order+" has placed an order successfully",
            "data":{ "order_id": order, "amount":amount, "created_at":today}   }                
               ,
               //If result found, this funtion will be called.
               success: function(json) {
                $('#res').html(json);
                console.log(json);
                 
                 }
               });
   }
</script>
