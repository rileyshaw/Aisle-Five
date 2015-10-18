<!doctype html>
<html lang="en">
	<head>
  		<title>Groceries</title>
  		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  		{{ HTML::style('css/style.css'); }}
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <script src="/boilermake/public/js/scripts.js"></script>
 <script>
 $(document).ready(function(){
	$('#add').submit(function(e){
		document.getElementById('Loading').innerHTML = 'Loading...';
		e.preventDefault();
		var $form = $( this ), dataFrom = $form.serialize(), url = $form.attr( "action"), method = $form.attr( "method" );
		$.ajax({
			xhrFields: {
				onprogress: function (e) {
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
					clearList();
					temp = response.substring(1);
					items = [];
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

		
	</script>
</table>
</div>
</body>
</html>