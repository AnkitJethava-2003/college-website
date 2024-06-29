<?php include 'dbcon.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href=
"https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../media.css" />
    <script defer src="../script.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
	<link rel="stylesheet" href="style.css">
	<style>
		.card{
			z-index: -1;
		}
	</style>
</head>
<body>
<div class="navbar sticky">
      <div class="topnav container" id="nav">
        <div class="left">
          <a class="logo" href="../index.html">SmartGuide</a>
        </div>
        <div class="right">
          <a href="../College.html">My College</a>
          <div class="dropdown">
            <button class="dropbtn">
              Faculty
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
              <a href="../department/Civil.html">Civil Engineering</a>
              <a href="../department/it.html">It Engineering</a>
              <a href="../department/ce.html">Computer Engineering</a>
              <a href="../department/mech.html">Mechanical Engineering</a>
              <a href="../department/ec.html">Electrical Engineering</a>
            </div>
          </div>

          <a href="index.php">Study Material</a>
          <div class="dropdown">
            <button class="dropbtn">
              Exam
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
              <a href="https://set.gtu.ac.in/circular/">Circular</a>
              <a href="https://student.gtu.ac.in/login.aspx">Hall Ticket</a>
              <a href="https://www.gturesults.in/">GTU Results</a>
            </div>
          </div>
          <a href="../php-signup-login-main/login.php" class="login">Login</a>
          <a
            href="../php-signup-login-main/signup.html"
            id="signUpBtn"
            class="login"
            >SignUp</a
          >
        </div>
        <button class="btn-mobile-nav">
          <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
          <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
        </button>
      </div>
    </div>

	<div class="container containers" style="margin-top:30px">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12">
			<strong>Fill UserName and Upload PDF</strong>
				<form method="post" enctype="multipart/form-data">
					<?php
						// If submit button is clicked
						if (isset($_POST['submit']))
						{
						// get name from the form when submitted
						$name = $_POST['name'];					

						if (isset($_FILES['pdf_file']['name']))
						{
						// If the ‘pdf_file’ field has an attachment
							$file_name = $_FILES['pdf_file']['name'];
							$file_tmp = $_FILES['pdf_file']['tmp_name'];
							
							// Move the uploaded pdf file into the pdf folder
							move_uploaded_file($file_tmp,"./index.php".$file_name);
							// Insert the submitted data from the form into the table
							$insertquery =
							"INSERT INTO filename(username,filename) VALUES('$name','$file_name')";
							
							// Execute insert query
							$iquery = mysqli_query($con, $insertquery);	

								if ($iquery)
							{							
					?>											
								<div class=
								"alert alert-success alert-dismissible fade show text-center">
									<a class="close" data-dismiss="alert" aria-label="close">
									×
									</a>
									<strong>Success!</strong> Data submitted successfully.
								</div>
								<?php
								}
								else
								{
								?>
								<div class=
								"alert alert-danger alert-dismissible fade show text-center">
									<a class="close" data-dismiss="alert" aria-label="close">
									×
									</a>
									<strong>Failed!</strong> Try Again!
								</div>
								<?php
								}
							}
							else
							{
							?>
								<div class=
								"alert alert-danger alert-dismissible fade show text-center">
								<a class="close" data-dismiss="alert" aria-label="close">
									×
								</a>
								<strong>Failed!</strong> File must be uploaded in PDF format!
								</div>
							<?php
							}// end if
						}// end if
					?>
					
					<div class="form-input py-2">
						<div class="form-group">
							<input type="text" class="form-control"
								placeholder="Enter your name" name="name">
						</div>								
						<div class="form-group">
							<input type="file" name="pdf_file"
								class="form-control" accept=".pdf" required/>
						</div>
						<div class="form-group">
							<input type="submit"
								class="btnRegister" name="submit" value="Submit">
						</div>
					</div>
				</form>
			</div>		
			
			<div class="col-lg-6 col-md-6 col-12">
			<div class="card">
				<div class="card-header text-center">
				<h4>Records from Database</h4>
				</div>
				<div class="card-body">
				<div class="table-responsive">
					<table>
						<thead>
							<th>ID</th>
							<th>UserName</th>
							<th>FileName</th>
						</thead>
						<tbody>
						<?php
                        
							$selectQuery = "select * from filename";
							$squery = mysqli_query($con, $selectQuery);

							while (($result = mysqli_fetch_assoc($squery))) {
						?>
						<tr>
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $result['username']; ?></td>
							<td><?php echo $result['filename']; ?></td>
						</tr>
						<?php
							}
						?>
						</tbody>
					</table>			
					</div>
				</div>
			</div>
		</div>
	</div>

	
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
</body>
</html>
