<div class="content-wrapper">
    <div class="container-fluid table-container">
        <div class="row">


            <div class="modal fade view_StudentModal" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewStudentModal"><i class="fa-solid fa-address-card me-2"></i>View Student Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="input-group col-12 ">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input class="form-control" type="text" value="' . $val['name'] . '" aria-label="Disabled input example" disabled readonly>
                                </div>
                                <div class="input-group col-12 my-3">
                                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                    <input class="form-control" type="text" value="' . $val['email'] . '" aria-label="Disabled input example" disabled readonly>
                                </div>
                                <div class="input-group col-12 ">
                                    <span class="input-group-text"><i class="fa-solid fa-g"></i></span>
                                    <input class="form-control" type="text" value="Grade ' . str_replace(str_split(" g"), '' , $val['grade_level']) . '" aria-label="Disabled input example" disabled readonly>
                                        </div>
                                        <div class="input-group col-12 my-3">
                                        <span class="input-group-text"><i class="fa-solid fa-book-open"></i></span>
                                        <input class="form-control" type="text" value="' . strtoupper($val['strand']) . '" aria-label="Disabled input example" disabled readonly>
                                        </div>
                                        <div class="input-group col-12">
                                        <span class="input-group-text"><i class="fa-solid fa-s"></i></span>
                                        <input class="form-control" type="text" value="' . $val['section'] . '" aria-label="Disabled input example" disabled readonly>
                                        </div>
                                        <div class="input-group col-12 my-3">
                                        <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                        <input class="form-control" type="text" value="' . $val['id'] . '" aria-label="Disabled input example" disabled readonly>
                                        </div>
                                        <div class="input-group col-12">
                                        <span class="input-group-text"><i class="fa-solid fa-shield"></i></span>
                                        <input class="form-control" type="text" value="' . $val['unique_id'] . '" aria-label="Disabled input example" disabled readonly>
                                        </div>
                                        <div class="input-group col-12 my-2">
                                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                        <input class="form-control" type="text" value="' . $formattedDate . '" aria-label="Disabled input example" disabled readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- View Student Modal -->

                    <?php if (Session::getUserType() === "admin") : ?>
                        <div class="col col-12" id="studentTableAlert"> </div>
                <div class="col col-lg-6 col-12 py-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal" id="addStudentModalBtn">
                        <span class="fa-solid fa-plus me-2"></span>Add Student
                    </button>
                    <!-- Modal Add Student -->
                    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title text-white" id="exampleModalLabel">Add Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" id="student_form">
                                    <div class="modal-body">

                                        <input type="hidden" name="csrf_token" id="csrf_token" value="<?= Session::generateCsrfToken(); ?>">
                                        <div class="row">
                                            <div class="col col-12" id="addStudentModalAlert">
                                            </div>
                                            <hr>
                                            <div class="col ">
                                                <input type="text" class="form-control" id="fname" placeholder="First name">
                                            </div>
                                            <div class="col ">
                                                <input type="text" class="form-control" id="lname" placeholder="Last name">
                                            </div>
                                            <div class="col col-12 my-2 ">
                                                <input type="email" class="form-control" id="email" placeholder="Trace email">
                                            </div>
                                            <div class="col col-12">
                                                <input type="password" class="form-control" id="password" placeholder="Password" aria-label="Last name">
                                            </div>
                                            <div class="col col-12 my-2">
                                                <input type="password" class="form-control" id="c_password" placeholder="Confirm password" aria-label="Last name">
                                            </div>
                                            <div class="col col-6">
                                                <select id="grade_level" class="form-select" aria-label="Default select example">
                                                    <option selected disabled>Select Grade Level</option>
                                                    <option value="g11">Grade 11</option>
                                                    <option value="g12">Grade 12</option>
                                                </select>
                                            </div>
                                            <div class="col col-6">
                                                <select id="strand" class="form-select" aria-label="Default select example">
                                                    <option selected disabled>Select Strand</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="addStudentSubmit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade delete_StudentModal"  id="deleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Student Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <p class="text-secondary"> Enter <strong>' . $val['email'] . '</strong> unique ID to delete data. </p>
                                    <input class="form-control" type="text" placeholder="Enter Unique ID" name="" id="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- Delete Student Modal -->


                <div class="modal fade edit_StudentModal" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Student Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <form id="save_UpdateStudent">
                                <input type="hidden" name="student_id" id="student_id">
                            <div class="modal-body">
                                <div class="row">
                                <div class="input-group col-12 ">
                                    <span class="input-group-text">Name</span>
                                    <input class="form-control" type="text" name="student_Name" id="student_Name" >
                                </div>
                                <div class="input-group col-12 my-3">
                                    <span class="input-group-text">Email</i></span>
                                    <input class="form-control" type="text" name="student_Email" id="student_Email"  >
                                </div>
                                <div class="input-group col-12 ">
                                <label class="input-group-text" for="student_GradeLevel">Grade</label>
                                        <select class="form-select" id="student_GradeLevel">
                                            <option value="g11">Grade 11</option>
                                            <option value="g12">Grade 12</option>
                                        </select>
                                        </div>
                                        <div class="input-group col-12 my-3">
                                        <label class="input-group-text" for="student_Strand">Strand</label>
                                         <select class="form-select"  name="student_Strand" id="student_Strand">
                                            <option value="ict">ICT</option>
                                            <option value="gas">GAS</option>
                                            <option value="stem">STEAM</option>
                                        </select>
                                        </div>
                                        <div class="input-group col-12">
                                        <span class="input-group-text">Section</span>
                                        <input class="form-control" type="text" name="student_Section" id="student_Section" >
                                        </div>
                                        <div class="input-group col-12 my-3">
                                        <label class="input-group-text" for="student_Class">Class</label>
                                         <select class="form-select" name="student_Class" id="student_Class">
                                         <?php
                                            // Loop to generate options from 'A' to 'Z'
                                            for ($letter = 'A'; $letter <= 'Z'; $letter++) {
                                                echo '<option value="' . $letter . '">'.$letter.'</option>';
                                                if($letter === 'Z'){
                                                    break;
                                                }
                                            }
                                            ?>
                                        </select>
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- Modal Edit Student-->
        </div>
    <?php endif; ?>
    <hr>
    <div id="toastContainer" class=" position-fixed f-flex bottom-0 end-0 p-3 " style="z-index: 11">

    </div>
    <div class="col col-table col-12">
        <table id="studentTable">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Trace Email</th>
                <th>Grade Level</th>
                <th>Strand</th>
                <th>Action</th>
            </tr>
            <?php
            if (!empty($sd)) {

                foreach ($sd as $val) {


                    echo '<tr > <td>' . $val['id'] . '</td>';
                    echo '<td>' . $val['name'] . '</td>';
                    echo ' <td>' . $val['email'] . '</td>';
                    echo '<td>' . str_replace(str_split("g"), '', $val['grade_level']) . '</td>';
                    echo '<td>' . strtoupper($val['strand']) . '</td>';
                    echo  '<td>';
                    //view student data btn
                    echo '<button type="button" class="btn btn-sm btn-info me-2 text-white view_StudentData" value="' . $val['id'] . '" data-bs-toggle="modal" data-bs-target="#viewStudentModal"><span class="text-white fa-solid fa-eye"><span></button>';
                    if (Session::getUserType() === "admin") {
                        //edit student data button
                        echo ' <button type="button" class="btn btn-sm btn-success me-2 edit_StudentData" value="' . $val['id'] . '" data-bs-toggle="modal" data-bs-target="#editStudentModal">
                            <span class="fa-solid fa-pen-to-square"></button>';
                        //delete student data btn
                        echo '<button type="button" class="btn btn-sm btn-danger delete_StudentData" value="' . $val['id'] . '" data-bs-toggle="modal" data-bs-target="#deleteStudentModal"><i class="fa-solid fa-trash"></i></button>';
                    }
                    echo ' </td></tr>';

                    //
                    $date = $val['created_at'];
                    $dateTime = new DateTime($date);
                    $formattedDate = $dateTime->format('M d Y h:ia');
                }
            } else {
                //no student found result
                echo '<tr class="border-0 ">';
                echo '<td colspan="8" class="st_no_s">No data found.</td>';
                echo "</tr>";
            }
            ?>
    </div>
    </table>
    <hr>


    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" <?= ($page_num <= 1) ? 'disabled' :
                                                                        'href="' . baseurl() . '/admin/student_list/page/' . $previous_page . '"' ?>>Previous</a></li>
                        <?php
                        for ($i = 1; $i <= $total_num_of_pages; $i++) {
                            if ($page_num !== $i) : ?>
                                <li class="page-item"><a class="page-link" href="<?= baseurl() ?>/admin/student_list/page/<?= $i ?>"><?= $i ?></a></li>
                            <?php else : ?>
                                <li class="page-item"><a class="page-link active"><?= $i ?></a></li>
                        <?php endif;
                        } ?>

                        <li class="page-item"><a class="page-link" <?= ($page_num >= $total_num_of_pages) ? 'disabled '
                                                                        : 'href="' . baseurl() . '/admin/student_list/page/' . $next_page . '"' ?>>Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
</div>