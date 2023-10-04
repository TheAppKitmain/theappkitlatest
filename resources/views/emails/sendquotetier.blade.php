@component('mail::message')

Hey {{$dataList['business_name']}},
<!DOCTYPE html>
<html>
<head>
<style>
#quoteTier td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 15px;
  color: #fff;
}
#quoteTier a{
  color:#fff;
}
</style>
</head>
<body>


<table id="quoteTier" style="font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  box-sizing: border-box;
  font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';
    width: 100%;
    padding: 0px 10px;
    margin-bottom: 15px;
    border: 1px solid #e2e2e2;
    background: linear-gradient(to right,#611fd6 0%,#48cfe3 100%);">
  <tr>
    <th>Invoice Link</th>
    <th>Price</th>
    <th>Due Date</th>
  </tr>
  <?php 

  $total_prices = count($dataList['date']);
  $invoice_url  = $dataList['invoice_url'];
  $quote_price  = $dataList['quote_price'];
  $date  = $dataList['date'];
  if($total_prices > 0){
  for ($n=0; $n < $total_prices; $n++) { 
   ?>
  <tr>
    <td>{{$invoice_url[$n]}}</td>
    <td>{{$quote_price[$n]}}</td>
    <td>{{$date[$n]}}</td>
  </tr>
   <?php }  } ?>
</table>

</body>
</html>

Many Thanks<br>
The App Kit
@endcomponent