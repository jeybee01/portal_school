<?php include 'php/view_reciept.php';?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
		<link href="default.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/main.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../datatable/dataTable.bootstrap.min.css">
	<style>
		.height10{
			height:10px;
		}
		.mtop10{
			margin-top:10px;
		}
		.modal-label{
			position:relative;
			top:7px
		}
	</style>

</head>
<body>
     <div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="window.history.back()">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Amkadamiyya Student Receipt (<?=$session_name?>)</h4></center>
            </div>
            <div class="modal-body">	
            	
			<div class="container-fluid">

					<form action="print_payment.php" method="POST" class="form-horizontal form-label-left">
									<div class="container-fluid" style="border: 2px solid">
										<div class="tab-content">
											
											<!-- Personal info tab -->
											<div id="pds" class="tab-pane fade in active">
												<div class="row">
													<div class="col-md-3">
															<img src="../image/logo.jpg">
													</div>
													<div class="col-md-6">
														<center><h3><strong>AMKADAMIYYA SCHOOL JALINGO</strong></h3>
														<small>Samunaka Junction, Along Wuro Sembe Road, Jalingo. Taraba State.</small><br>
														<small>E-mail: amkadamiyyaschool@gmail.com</small>
													</center>
													</div>
													<div class="col-md-3">
														<center>
															<h5>0052</h5><br>
														<span class="glyphicon glyphicon-phone"></span>
														<small>07037272170,</small><br>
														<small>07037272170</small>
														</center>
													</div>
												</div>
								
												<div class="row">
												  	<div class="col-md-6">
														<center>
															<br />
															    <?=$student_name?>
															<p>________________________<br />
															<small>Full Name</small>
															</p>
														</center>
													</div>
														<div class="col-md-6">
														<center>
															<br />
															   <?=$term_name?> Term
															<p>________________________<br />
															<small>Term</small>
															</p>
														</center>
													</div>

					                           </div>

					                           	<div class="row">
												  	<div class="col-md-6">
														<center>
															<br />
															<?php
                                                              if($school_fees != ''){
                                                              	?>
                                                              	&#8358; <?=$school_fees?>
                                                              <?php } ?>
															<p>________________________<br />
															<small>Amount</small>
															</p>
														</center>
													</div>

														<div class="col-md-6">
														<center>
															<br />
															 <?=$class_name.' ('.$short.')'?> 
															<p>________________________<br />
															<small>Class</small>
															</p>
														</center>
													</div>

														
					                           </div>
					</div>


												</div>													
													
													<div class="col-md-6">
														<center>
															<br />
															<p>________________________<br />
															<small>Receiver's Sign</small>
															</p>
														</center>
													</div>
													
													
													
													<div class="col-md-6">
														<center>
															<br />
															 <?=$date_payed?>
															<p>________________________<br />
															<small>Cashier's Sign & Date</small>
															</p>
														</center>
													</div>
											</div>
											<!--/ Personal info tab -->
										</div>
									</div>
									<div class="pull-left">
									<button onclick="window.print()" id="btnPrint" class="btn btn-primary btn-m " >
										Print
									</button>
								</div>
								<div class="pull-right">
									<input class="btn btn-primary" button="submit" value="cancel" onclick="window.history.back()">
								</div>
								</form>

			</div>

        </div>
    </div>
</div>
<script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../datatable/jquery.dataTables.min.js"></script>
<script src="../datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->
<script>

		function printReceipt() {
			window.print();
		}
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});
</script>
<script src="../assets/js/jquery-3.1.1.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/main.js"></script>

</body>
</html>