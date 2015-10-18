<!doctype html>
<html lang="en">
	<head>
  		<title>Groceries</title>
  		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  		{{ HTML::style('css/style.css'); }}
  		<link rel="stylesheet" href="/boilermake/public/css/style.css">
  		<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600' rel='stylesheet' type='text/css'>
  		<link rel="stylesheet" href="http://css-spinners.com/css/spinner/spinner.css" type="text/css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 		<script src="/boilermake/public/js/scripts.js"></script>
 	<script>

 		var items;
 		$(document).ready(function(){
 			document.getElementById('spinner').style.display= "none";
			$('#add').submit(function(e){
			document.getElementById('search').style.display= "none";
 			document.getElementById('spinner').style.display= "inline-block";
			e.preventDefault();
			var $form = $( this ), dataFrom = $form.serialize(), url = $form.attr( "action"), method = $form.attr( "method" );
			$.ajax({
					onprogress: function (e) {
							if (e.lengthComputable) {
								console.log("he324re");
								console.log(e.loaded / e.total * 100 + '%');
							}
						},
					type: method,
			   	 	url: "{{action('HomeController@addItem')}}",
					data: dataFrom,
					success: function (response) {
						if(items != null)
							clearList();
						temp = response.substring(1);
						items = [];
						items = JSON.parse(temp);
						document.getElementById('search').style.display= "inline-block";
 						document.getElementById('spinner').style.display= "none";
						sort(1);
					},
				});
			});
		});		
	</script>
	</head>
	<body>
		<div class="container">
  			<div class="jumbotron">
    			<h1>Aisle Five</h1>      
  			</div> 
  		</div>
  		<form method="POST" action="http://localhost/boilermake/public" accept-charset="UTF-8" id="add"><input name="_token" type="hidden" value="yBI7MpcibMJB3nUqBcG9VR9IUUKqhLYAILBrTkrP">
  			<div id="custom-search-input">
                <div class="input-group col-md-12">  				
  				<!--<input placeholder="Product Name" name="product" type="text" value="">
				<input class="btn btn-success" type="submit" value="Search">-->
                    <input placeholder="Product Name" name="product" type="text" class="form-control input-lg" />
                    <span class="input-group-btn">
                        <button id='add' type="submit" class="btn btn-info btn-lg" type="button">
                            <i id = 'search' class="glyphicon glyphicon-search"></i>
                        </button>
                        <div id = 'spinner' class="spinner-loader">
  							Loading…
						</div>
                    </span>
				</div>
			</div>   

		</form>
	
			<!--<div class="table-responsive">
				<table border="1" id="productTable" class = "table table-striped table-hover  table-bordered"> 
					<tr>
						<td onclick="clearList()">Clear List</td>
						<td onclick="sort(2)">Product</td>
						<td onclick="sort(1)">Price</td>
						<td onclick="sort(3)">Store</td>
					</tr>
				</table>
			</div>-->
	<div class="labelDiv">
		<label id="Product" onclick="sort(3)" class="titleLabelsP"></label>
		<label id="Price" onclick="sort(1)" class="titleLabels"></label>
		<label id="Store" onclick="sort(3)" class="titleLabels"></label>
	</div>

	<div style="display: table; width: 100%; height 2px;">
	</div>

	<!--$('body div:last').after("<div class=\"box\"><div><div class=\"image\"></div><div class=\"info\"><label class=\"productLabel\">"+items[i]['name']+"</label><label class=\"priceLabel\">"+"$"+items[i]['price'] +"</label><label class=\"storeLabel\">"+items[i]['storeName']+"</label></div></div></div>");

	$('body div:last').after("<tr><td class=\"imageCell\">"+items[i]['images']+"</td><td>"+items[i]['name'] +"</><td>"+"$"+items[i]['price'] +"</td><td>"+items[i]['storeName']+"</tr>");


	-->
		</body>
</html>
