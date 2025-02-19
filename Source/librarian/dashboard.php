<?php
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'home';
    include 'inc/connection.php';
    include 'inc/header.php';
 ?>
<style>

#time {
    font-size: 20px;
    float: right;

}

#date {
    font-size: 20px;
    float: right;
    margin-right: 20px;


}
.h4 {
    float:left;
}


     @media only screen and (max-width: 768px) {
        #time, #date, .h4 {
            font-size: 20px;
            float: none;
            text-align: center;
            margin: 10px auto;
        }
    }

</style>


            <main class="content px-3 py-2">
			<div class="gap-30"></div>
                <div class="container-fluid">
				<div class="mb-3">

                        <h4>Admin Dashboard
                        <p id="time"></p>

                            <p id="date"></p>
                        </h4>


                 </div>
            </div>
            <br>
                    <div class="row g-2 my-10 ">
                        <div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0 illustration" id="card1" >
                                <div class="card-body p-0 d-flex flex-fill" id="card2">
                                    <div class="row g-0 w-100">
                                        <div class="col-10 d-flex">
                                            <div class="p-3 m-1">
											<h3><span>Welcome Back Admin,</span> </h3>
						<h4>

							<?php
								$res = mysqli_query($link, "select * from lib_registration where username='".$_SESSION['username']."'");
								while ($row = mysqli_fetch_array($res)){
								$name  =  $row["name"];
								echo $name;
								}
							?>

            			</h4>

                                            </div>

                                        </div>
										<div class="align-self-end text-end">

                           			 	</div>

                                    </div>

                                </div>

                            </div>


					</div>

										<!--  -->
						<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0" id="card1">
                                <div class="card-body py-4" id="card2">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">

										<div class="box">

							<div class="icon1">
								<i class="fa fa-rocket"></i>
							</div>

							<div class="text-left">

								<h3>
                                    <span class="counter">

								    <?php
                                         $res = mysqli_query($link, "select * from issue_book");
                                         $res2 = mysqli_query($link, "select * from t_issuebook");
                                         $count2 = mysqli_num_rows($res2);
                                         $count = mysqli_num_rows($res);
                                         $result = $count + $count2;
                                        echo $result;
                                    ?>
                                    </span>
                                </h3>

								<h4><a href="issued-books.php">Borrowed Books </a></h4>

							</div>

						    </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


										<!--  -->
										<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0" id="card1">
                                <div class="card-body py-4" id="card2">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fa fa-book"></i>
							</div>
							<div class="text-left">
								<h3><span class="counter">
								<?php
                                         $res = mysqli_query($link, "select * from book_module");
                                         $count = mysqli_num_rows($res);
                                        echo $count;
                                    ?>
                                    </span></h3>
								<h4><a href="manage-book.php">Collections</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

										<!--  -->
										<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0" id="card1">
                                <div class="card-body py-4" id="card2">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
                            <i class="fa-solid fa-peso-sign"></i>
							</div>
							<div class="text-left">
								<h3><span class="counter">
                                <span> </span>
                                        <?php
                                        $total_fine = 0;
                                        $res = mysqli_query($link, "SELECT fine FROM finezone");
                                        while ($row = mysqli_fetch_array($res)) {
                                            $total_fine += $row["fine"];
                                        }
                                        echo" ";echo $total_fine;
                                        ?>

                                    </span></h3>
								<h4><a href="fine.php">Overdue</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--  -->
							<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0" id="card1">
                                <div class="card-body py-4" id="card2">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fas fa-user"></i>
							</div>
							<div class="text-left">
                            <h3>
                                <span class="counter1">
                                    <?php
                                        // Query to get the total number of returned books
                                        $res = mysqli_query($link, "SELECT * FROM return_books");
                                        $count = mysqli_num_rows($res);
                                        echo $count;
                                    ?>
                                </span>
                            </h3>

								<h4><a href="return-book.php">Returned Books</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<!--  -->
							<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0" id="card1">
                                <div class="card-body py-4" id="card2">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fas fa-book"></i>
							</div>
							<div class="text-left">

								<h4><a href="display-book-module.php">Manage Book</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




								<!--  -->
								<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0" id="card1">
                                <div class="card-body py-4" id="card2">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fab fa-staylinked"></i>
							</div>
							<div class="text-left">

								<h4><a href="status.php">User Verification</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0" id="card1" >
                                <div class="card-body py-4" id="card2">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fa fa-users"></i>
							</div>
							<div class="text-left">
								<h3><span class="counter">
                                    <?php
                                         $res = mysqli_query($link, "select * from student_archive");
                                         $res2 = mysqli_query($link, "select * from teacher_archive");
                                         $count2 = mysqli_num_rows($res2);
                                         $count = mysqli_num_rows($res);
                                         $result = $count + $count2;
                                         echo $result;
                                    ?>
                                    </span></h3>
								<h4><a href="archive-user.php">User Archive</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
										<!--  -->

							<!--  -->
							<!-- <div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0" id="card1">
                                <div class="card-body py-4" id="card2">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fas fa-book"></i>
							</div>
							<div class="text-left">

							<h4 class="mt-10"><a href="requested-books.php">Requested Books</a></h4>
							</div>

						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->




            </main>







         <script>
         window.setInterval(ut, 1000);

        function ut() {
        var d = new Date();
        document.getElementById("time").innerHTML = d.toLocaleTimeString();
        document.getElementById("date").innerHTML = d.toLocaleDateString();
        }
        </script>

<?php
		include 'inc/footer.php';
	 ?>
