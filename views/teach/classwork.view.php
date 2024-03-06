<?php
require_once "../../layouts/class/header.php";
require_once "../../layouts/class/navbar.php";
require_once "../../models/teach/get.assignments.model.php";
$id = $_GET['classroom_id'];
$allAssignments = getAllAssignment($id);
$email = $_SESSION['user'][1];
$user = getUser($email);
$user_id = $user[0];
?>

<div class="d-flex flex-row ml-3 border-secondary" style="margin-top: -10px;">
    <div>
        <a href="../../controllers/teach/class.controller.php?classroom_id=<?= $id ?>" class="text-dark text-decoration-none border-0 btn btn-light  ">Stream</a>
        <a href="#" class="text-dark text-decoration-none border-0 btn btn-warning">Classwork</a>
        <a href="../../controllers/teach/people.controller.php?classroom_id=<?= $id ?>" class="text-dark text-decoration-none border-0 btn btn-light  ">People</a>
        <a href="../../controllers/teach/grades.controller.php?classroom_id=<?= $id ?>" class="text-dark text-decoration-none border-0 btn btn-light  ">Grades</a>
    </div>
    <div style="padding-right: 50px;">
        <i class="fa fa-gear" style="font-size:25px; padding-right: 25px;"></i>
        <i class="fa fa-calendar-o" style="font-size:20px; padding-right: 15px;"></i>
    </div>
</div>

<div class="mt-4" style="margin-left: 15%;">

    <div class="dropdown">
        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-plus" style=" color: white; font-size:20px; "><span class="p-2">Create</span></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="../../controllers/teach/create.assignment.controller.php?classroom_id=<?= $id ?>&user_id=<?= $user_id ?>">Assignment</a></li>
            <li><a class="dropdown-item" href="../../controllers/enrollment/create.material.controller.php?classroom_id=<?= $id ?>">Material</a></li>
            <li><a class="dropdown-item" href="#">Quiz assignments</a></li>
            <li><a class="dropdown-item" href="#">Reuse post</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </div>
    <div class="d-flex flex-column mt-4">
        <?php
        if (count($allAssignments) > 0) {
            foreach ($allAssignments as $assignment) {
        ?>
                <div class="card shadow-sm bg-body  rounded mt-3 d-flex flex-row justify-content-between  col-10 border">
                    <div class="d-flex align-items-center" style="width: 250px;">
                        <div class="rounded-circle d-flex" style="background-color: #289AE3 ; padding: 7px; color: white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1z" />
                            </svg>
                        </div>
                        <p class="ml-2 mt-3"><?= $assignment['title'] ?></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mt-3 mr-2 fw-bold">
                            <?php if (!empty($assignment['dateline'])) {
                                // echo $assignment['dateline'];
                                $date = date_create($assignment['dateline']);
                                echo "Due " . date_format($date, "d - M , H:i");
                                $hour =  date_format($date, "H");
                                if ($hour > 12){
                                    echo "pm";
                                }
                                else{
                                    echo "am";
                                }
                            } else {
                                echo "No due date";
                            }
                            ?>

                        </p>
                        <div class="dropdown " style="color: blue">
                            <svg xmlns="http://www.w3.org/2000/svg" class="dropdown-toggle" type="button" id="dropdownMenuassignment" data-bs-toggle="dropdown" aria-expanded="false" width="22" height="22" fill="currentColor" class="bi bi-three-dots-vertical d-flex justify-content-center mr-5" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            </svg>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuassignment">
                                <li><a class="dropdown-item" href="../../controllers/teach/update.assignment.controller.php?classroom_id=<?= $id ?>&assignment_id=<?= $assignment['assignment_id'] ?>">Edit</a></li>
                                <li><a class="dropdown-item" href="../../controllers/enrollment/create.material.controller.php?classroom_id=<?= $id ?>">Delete</a></li>
                                <li><a class="dropdown-item" href="#">Copy Link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
    </div>
<?php
        } else {
?>
    <div class="mt-5 border-top w-75 text-center">
        <img src="../../assets/images/classroom/02.jpg" alt="" width=300px; height=300px; class="mt-4">
        <p>This is where you'll assign work</p>
        <p>You can add assignments and other work for the <br>class, then organize it into topics</p>
    </div>
<?php
        }
?>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>