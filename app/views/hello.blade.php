<!doctype html>
<html lang="en">
<head>
  <title>Groceries</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <style type="text/css">
.jumbotron {
    text-align: center;
    font-family: "helvetica";
    color: black;
}
table{
	width:200px%
}
body {
	background-color: rgba(0, 0, 0, 0.5);
}
table{
	background-color: white;
}
.container {
	background-color: white;
}
</style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/boilermake/app/views/scripts.js"></script>
  <script>
				$(document).ready(function(){
					$('#add').submit(function(e){
						document.getElementById('Loading').innerHTML = 'Loading...';
						e.preventDefault();
						var $form = $( this ),
						dataFrom = $form.serialize(),
						url = $form.attr( "action"),
						method = $form.attr( "method" );
				//		$.ajax({
			//				url: "{{action('HomeController@addItem')}}",
		//					data: dataFrom,
	//						type: method,
//							success: function (response) {
	//							document.getElementById('Loading').innerHTML = '';
	//							temp = response.substring(1);
	//							console.log("items");
	//							items = JSON.parse(temp);
	//							console.log(items[0]['price']);
	//							makeTable();
	//						}
	//					});$.ajax({
						$.ajax({
								  xhrFields: {
									onprogress: function (e) {
										console.log("hasdfere");
									if (e.lengthComputable) {
										console.log("he324re");
										console.log(e.loaded / e.total * 100 + '%');
										}
									}
								},
								 type: method,
								  url: "{{action('HomeController@addItem')}}",
								  data: dataFrom,
								  success: function (response) {
								document.getElementById('Loading').innerHTML = '';
								temp = response.substring(1);
								items = JSON.parse(temp);
								makeTable();
							}
								});
					});
				});
	</script>

</head>
<body>
<div class="container">_
  <div class="jumbotron">
    <h1>Groceries</h1>      
  </div> 
  <div class="form-group">
  	{{Form::open(array('action' => 'HomeController@showHome', 'id' => 'add'))}}
  		{{Form::text('product')}}
		{{Form::submit('Add', array('class' => 'btn btn-success'))}}
		<label id="Loading"></label>
	{{Form::close()}}
	<button onclick='clearList()'>Clear</button>
	</div>   
	<div class="table-responsive">
<table border="1" id="productTable" class = "table table-striped table-hover  table-bordered"> 
	<tr>
		<td></td>
		<td onclick="sort(2)">Product</td>
		<td onclick="sort(1)">Price</td>
		<td onclick="sort(3)">Store</td>
	</tr>
	<script>
	function makeTable() {
		var table = document.getElementById("productTable");
 		var j = 0;
 		for(var i = 0; i < items.length; i++) {
 			for(var j = i; j < items.length; j++) {
 				if(items[i]['price'] > items[j]['price']) {
 					temp = items[i];
 					items[i] = items[j];
 					items[j] = temp;
 				}
 			}
 		}
    	for(var i = 0; i < items.length; i++) 
		    $('table tr:last').after("<tr><td class='deleterow'><div class='glyphicon glyphicon-remove'></div></td>"+"<td>"+items[i]['name'] +"</td><td>"+"$"+items[i]['price'] +"</td><td>"+items[i]['storeName']+"</tr>");
		$(".deleterow").on("click", function(){
		var $killrow = $(this).parent('tr');
    	$killrow.addClass("danger");
			$killrow.fadeOut(2000, function(){
    			$(this).remove();
			});
	});
	}
	function addToTable() {
		document.write(items);
		document.write("items");
		var table = document.getElementById("productTable");
			table.deleteRow(0);			
		}
	function clearList() {
			var table = document.getElementById("productTable");
		for(var i = 0; i < items.length; i++) 
			table.deleteRow(1);			
		}
		
	</script>
</table>
</div>
</body>

<body>
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	{{ HTML::style('css/style.css'); }}
</head>
<body>
	</div>
</body>
</html>