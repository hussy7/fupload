<html>
	<head>
		<title>File Upload with Progress Bar jQuery and Ajax in PHP</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class='container'>
			<div class='row mt-5'>
				<div class='col-md-6 mx-auto border p-3'>
					<h4>File Upload With Progress Bar Using jQuery Ajax</h4><hr>	
					<form method='post' id='frm' enctype="multipart/form-data">
						<div class='form-group'>
							<label>Choose File:</label>
							<input type='file' name='file' class='form-control form-control-sm' required>
						</div>
						<div class='form-group'>
							<input type='submit' value='Upload File' class='btn btn-primary btn-sm'>
						</div>
						<div class="progress mt-4 mb-3">
						  <div class="progress-bar bg-success" id='progress-bar' role="progressbar" style="width:0%;" >0%</div>
						</div>
						<div id='result'></div>
					</form>
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				$("#frm").submit(function(e){
					e.preventDefault();
					var frm=new FormData(this);
					$.ajax({
						xhr:function(){ //Callback for creating the XMLHttpRequest object
							var httpReq=new XMLHttpRequest();//monitor an upload's progress. //amount of progress
							httpReq.upload.addEventListener("progress",function(ele){
								 if (ele.lengthComputable) {//property is a boolean flag indicating if the resource concerned by the ProgressEvent has a length that can be calculated.
									var percentage=((ele.loaded / ele.total) * 100); 
									$("#progress-bar").css("width",percentage+"%");
									$("#progress-bar").html(Math.round(percentage)+"%");
								 }
							});
							return httpReq;
						},
						url:"upload.php",
						type:"post",
						contentType: false,
						processData: false,//If you want to send a DOMDocument, or other non-processed data, set this option to false.
						data:frm,
						beforeSend:function(){
							$("#progress-bar").css("width","0%");
							$("#progress-bar").html("0%");
						},
						success:function(res){
							$("#result").html(res);
						},
						error:function(xhr){
							$("#result").html("Upload Failed : "+xhr.statusText);
						}
					});
				});
			});
		</script>
	</body>
</html>