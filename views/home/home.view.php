<div class="col-xml-12">
	<nav class="navbar " style="border-width: 3px; border-color: gray;">
		<div style="gap: 10px;">
			<a href="/join-class" class="btn btn-success">Join class</a>
			<a href="/create-class" class="btn btn-success">Create Classroom</a>
		</div>
	</nav>
	<?php
	if (isset($_GET['classroom_id'])) {
		$id = $_GET['classroom_id'];
		die();
	}
	?>
	<div class="d-flex flex-wrap">
		<?php
		require "database/database.php";
		require "models/classroom/get_user.model.php";
		require "models/classroom/select_classrooms.model.php";
		
		$email = $_SESSION['user'][2];
		$user_id = getUserID($email)['user_id'];
		$classroom = getClassrooms($user_id);
		foreach ($classroom as $class) :
		?>
			<div class="card m-3" style="width:245px;">
				<img class="card-image-top rounded-top" src="../../assets/images/courses/4by3/<?= $class['banner'] ?>" alt="...">
				<div class="navbar  navbar-expand-lg navbar-light p-1 h-1" style="height: 25px;">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle bg-light rounded" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: -190px" >
								More
							</a>
							<div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownProfile" style='margin-top: -145px'>
								<a class="dropdown-item nav-link " href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#?id=<?= $class['classroom_id'] . '&classroom_name=' . $class['classroom_name'] . '&section=' . $class['section'] . '&subject=' . $class['subject'] . '&room=' . $class['room'] ?>">
									Edit
								</a>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownProfile">
									<div class="card col-xl-12 d-flex flex-column justify-content-center align-items-center" style="position: fixed; top:0px; left:0;  height:100vh; width:100%; background-color: rgba(0,0,0,0.2); z-index:10;">
										<div class="bg-white p-3 col-xl-6 rounded">
											<form action="../../controllers/classroom/modify.update.controller.php" method="post">
												<h4 class="text-success mt-1">Edit Classroom</h4>
												<input type="text" value="<?= $class['classroom_id'] ?>" style='display: none' name='id'>
												<input type="text" value="<?= $class['classroom_name'] ?>" class="form-control mt-3" name="className" placeholder="Class name">
												<input type="text" value="<?= $class['section'] ?>" class="form-control mt-3" name="section" placeholder="Section">
												<input type="text" value="<?= $class['subject'] ?>" class="form-control mt-3" name="subject" placeholder="Subject">
												<input type="text" value="<?= $class['room'] ?>" class="form-control mt-3" name="room" placeholder="Room">
												<div class="d-flex justify-content-end mt-2">
													<a href="/#" class="btn btn-light">Cancal</a>
													<button class="btn btn-success">Update</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<a href="../controllers/classroom/delete.class.controller.php?classroom_id=<?= $class['classroom_id']?>"class='dropdown-item nav-link'>Delete</a>
								<a href="../../controllers/classroom/change.banner.controller.php?classroom_id=<?= $class['classroom_id']?>"class='dropdown-item nav-link'>Change banner</a>
							</div>	
						</li>
					</ul>
				</div>
				<div class="card-body p-2">
					<div class="nav-list d-flex justify-content-between">
						<a href="/class?classroom_id=<?= $class['classroom_id'] ?>" style="text-decoration: none; color: black;">
							<p class="card-title"><?= $class['classroom_name'] ?></p>
						</a>
					</div>
					<p class="card-text">Section : <?= $class['section'] ?></p>
					<p class="card-text">Room : <?= $class['room'] ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>