<div ng-controller="ModalPaymentInstanceCtrl" >

    <script type="text/ng-template" id="ModalPayment.html">
        <div class="modal-header">
            <h3>Payment</h3>
        </div>
        <div class="modal-body">
	
	Important : le site est tout récent. Bien que testé de nombreuses fois si vous constatez un souci pendant le rechargement <a href="mailto:sabrina.webdev@gmail.com">faites le moi savoir</a>
			<table  class="table table-striped table-bordered">
<tr><th>Crédits </th><th> Montant</th></tr>
<tr><td>250</td><td> 2,50€ </td></tr>
<tr><td>500</td><td> 4,00€ </td></tr>
<tr><td>750</td><td>6,00€</td></tr>
<tr><td>1000</td><td>7,50€</td></tr>
<tr><td>1500</td><td>10,00€</td></tr>
<tr><td>2000</td><td>13,00€</td></tr>
</table>
<div class="row">


<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="DKZ42GE3PB9JE">
<table class="table table-striped table-bordered">
<tr>
    <td><input type="hidden" name="on0" value="Credits">Credits</td>
     <td><select name="os0">
	<option value="250">250 crédits - €2,50 EUR</option>
	<option value="500">500 crédits - €4,00 EUR</option>
	<option value="750">750 crédits - €6,00 EUR</option>
	<option value="1000">1000 crédits - €7,50 EUR</option>
	<option value="1500">1500 crédits - €10,00 EUR</option>
	<option value="2000">2000 crédits - €13,00 EUR</option>
</select></td>
</tr>
<tr>
    <td><input type="hidden" name="on1" value="Email AdopteUnMec">Email AdopteUnMec</td>
     <td><input type="text" name="os1" maxlength="200" value="{{mail}}"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="hidden" name="currency_code" value="EUR">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_XC/i/scr/pixel.gif" width="1" height="1"></td></tr>

</table>

</form>



</div>


        <div class="modal-footer">
           
            <button class="btn btn-warning" ng-click="close()">Close</button>
        </div>
    </script>

   
</div>
