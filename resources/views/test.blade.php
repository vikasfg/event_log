<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Promo</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="ms.css" rel="stylesheet"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <form class="form-horizontal container">
<fieldset>

<!-- Form Name -->
<legend>Send Promotions</legend>

<!-- Select Multiple -->
<div class="row">
    <div class="col-xs-3">
      <label for="selectmultiple1">Customer Type</label>
      <div>
        <select id="selectmultiple1" name="selectmultiple1" class="form-control msbox1" multiple="multiple">
          <option value="Online Registered">Online Registered</option>
          <option value="Online Subscribed">Online Subscribed</option>
          <option value="Exhibition Subscribed">Exhibition Subscribed</option>
          <option value="Exhibition Buyer">Exhibition Buyer</option>
          <option value="5 time Buyer">1 time Buyer</option>
          <option value="6 time Buyer">2 time Buyer</option>
          <option value="7 time Buyer">3 time Buyer</option>
          <option value="8 time Buyer">4 time Buyer</option>
          <option value="9 time Buyer">5 time Buyer</option>
          <option value="10 time Buyer">6 time Buyer</option>
          <option value="11 time Buyer">7 time Buyer</option>
          <option value="12 time Buyer">8 time Buyer</option>
          <option value="13 time Buyer">9 time Buyer</option>
          <option value="14 time Buyer">10 time Buyer</option>
          <option value="15 time Buyer">11 time Buyer</option>
          <option value="16 time Buyer">12 time Buyer</option>
          <option value="17 time Buyer">13 time Buyer</option>
          <option value="18 time Buyer">14 time Buyer</option>
          <option value="19 time Buyer">15 time Buyer</option>
          <option value="20 time Buyer">16 time Buyer</option>
          <option value="21 time Buyer">17 time Buyer</option>
          <option value="22 time Buyer">18 time Buyer</option>
          <option value="23 time Buyer">19 time Buyer</option>
          <option value="24 time Buyer">20 time Buyer</option>
          <option value="25 time buyer">20+ time buyer</option>
        </select>
      </div>
    </div>
    
    <!-- Select Multiple -->
    <div class="col-xs-3">
      <label for="selectmultiple2">City</label>
      <div>
        <select id="selectmultiple2" name="selectmultiple2" class="form-control msbox2" multiple="multiple">
          <option value="2">Delhi</option>
          <option value="3">Mumbai</option>
          <option value="4">Pune</option>
          <option value="5">Bangalore</option>
        </select>
      </div>
    </div>
    
    <!-- Prepended checkbox -->
    <div class="col-xs-2">
      <label for="prependedcheckbox">Pincode</label>
      <div>
        <div class="input-group">
          <span class="input-group-addon">     
              <input type="checkbox" checked="checked">     
          </span>
          <input id="prependedcheckbox" name="prependedcheckbox" class="form-control" type="text" placeholder="Use CSV">
        </div>
        <p class="help-block">Uncheck to exclude</p>
      </div>
    </div>
    
    <!-- Select Multiple -->
    <div class="col-xs-2">
      <label for="selectmultiple3">Gallery Name</label>
      <div>
        <select id="selectmultiple3" name="selectmultiple3" class="form-control msbox3" multiple="multiple">
          <option value="2">Royal Park, Delhi</option>
          <option value="3">OYO, Noida</option>
          <option value="4">OYO, gurgaon</option>
          <option value="5">Aga Khan, Delhi</option>
        </select>
      </div>
    </div>
    
    <!-- Select Multiple -->
    <div class="col-xs-2">
      <label for="selectmultiple4">Size</label>
      <div>
        <select id="selectmultiple4" name="selectmultiple4" class="form-control msbox4" multiple="multiple">
          <option value="2">XS</option>
          <option value="3">S</option>
          <option value="4">M</option>
          <option value="5">L</option>
          <option value="6">XL</option>
          <option value="7">XXL</option>
          <option value="8">3XL</option>
        </select>
      </div>
    </div>
</div>
<!-- Button (Double) -->
<div class="form-group" style="
    margin-top: 50px;
">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
    <button id="button1id" type="submit" name="button1id" class="btn btn-success">Get Count</button>
    <button id="button2id" name="button2id" class="btn btn-primary">Send Directly</button>
  </div>
</div>

</fieldset>
</form>

<div class="result"></div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="ms.js"></script>
    <script>
        $('#selectmultiple1').multiselect();
        $('#selectmultiple2').multiselect();
        $('#selectmultiple3').multiselect();
        $('#selectmultiple4').multiselect();
        $('form').on('submit', function(event){
          event.preventDefault();
          var res = $( this ).serialize();
          var result = '';
          $('#selectmultiple1_itemList li.active input').each(function(){
            result = result + $(this).data('val');
          })
          $(".result").text(res);
        })
    </script>
  
</body>
</html>