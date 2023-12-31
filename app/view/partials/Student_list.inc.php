<div class="content-wrapper" id="page_heading_title">
    <div class="container">
        <div class="row">
            <div class="col">
                <h4>Student</h4>
            </div>
        </div>
    </div>
</div>

<div class="modal fade view_StudentModal" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewStudentModal"><i class="fa-solid fa-address-card me-2"></i>View Student Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col col-12" id="viewStudentModalAlert">
                    </div>
                    <hr>
                    <div class="col view-table">
                        <table class="table table-striped ">
                            <tr>
                                <th>Name</th>
                                <td id="view_studentName"></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td id="view_studentEmail"></td>
                            </tr>
                            <tr>
                                <th>Grade Level</th>
                                <td id="view_studentGrade"></td>
                            </tr>
                            <tr>
                                <th>Strand</th>
                                <td id="view_studentStrand"></td>
                            </tr>
                            <tr>
                                <th>Class</th>
                                <td id="view_studentClass"></td>
                            </tr>
                            <tr>
                                <th>Section</th>
                                <td id="view_studentSection"></td>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <td id="view_studentId"></td>
                            </tr>
                            <tr>
                                <th>Unique ID</th>
                                <td id="view_studentUniqueId"></td>
                            </tr>
                            <tr>
                                <th><i class="fa-solid fa-calendar-days me-2"></i>Date Created</th>
                                <td id="view_studentDateCreated"></td>
                            </tr>
                        </table>
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
                            <div class="col col-12" id="updateStudentModalAlert">
                            </div>
                            <hr>
                            <div class="input-group col-12 ">
                                <span class="input-group-text">Name</span>
                                <input class="form-control" type="text" name="student_Name" id="student_Name">
                            </div>
                            <div class="input-group col-12 my-3">
                                <span class="input-group-text">Email</i></span>
                                <input class="form-control" type="text" name="student_Email" id="student_Email">
                            </div>
                            <div class="input-group col-12 ">
                                <label class="input-group-text" for="student_GradeLevel">Grade</label>
                                <select class="form-select" id="student_GradeLevel" name="student_GradeLevel">
                                    <option value="g11" disabled>Grade 11</option>
                                    <option value="g12">Grade 12</option>
                                </select>
                            </div>
                            <div class="input-group col-12 my-3">
                                <label class="input-group-text" for="student_Strand">Strand</label>
                                <select class="form-select" name="student_Strand" id="student_Strand">
                                    <option value="abm" disabled>ABM</option>
                                    <option value="gas" disabled>GAS</option>
                                    <option value="art_and_design" disabled>TVL ART & DESIGN</option>
                                    <option value="he" disabled>TVL HE</option>
                                    <option value="humss" >HUMSS</option>
                                    <option value="ict">TVL ICT</option>
                                    <option value="stem" disabled>STEM</option>
                                </select>
                            </div>
                            <div class="input-group col-12">
                                <span class="input-group-text">Section</span>
                                <input class="form-control" type="text" name="student_Section" id="student_Section">
                            </div>
                            <div class="input-group col-12 my-3">
                                <label class="input-group-text" for="student_Class">Class</label>
                                <select class="form-select" name="student_Class" id="student_Class">
                                    <?php
                                    // Loop to generate options from 'A' to 'Z'
                                    for ($letter = 'A'; $letter <= 'Z'; $letter++) {
                                        echo '<option value="' . $letter . '">' . $letter . '</option>';
                                        if ($letter === 'Z') {
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

    <div class="modal fade delete_StudentModal" id="deleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Student Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="delete_StudentData" method="POST">
                    <input type="hidden" name="delete_StudentId" id="delete_StudentId">
                    <div class="modal-body">
                        <div class="col col-12" id="deleteStudentModalAlert">
                        </div>
                        <hr>
                        <p class="text-secondary"> Enter <strong id="delete_StudentEmail"></strong> unique ID to delete student data. </p>
                        <input class="form-control" type="text" placeholder="Enter Unique ID" name="delete_StudentUniqueId" id="delete_StudentUniqueId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- Delete Student Modal -->

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
                                <input type="text" class="form-control" id="password" placeholder="Password" aria-label="Last name">
                            </div>
                            <div class="col col-12 my-2">
                                <input type="text" class="form-control" id="c_password" placeholder="Confirm password" aria-label="Last name">
                            </div>
                            <div class="col col-6">
                                <select id="grade_level" class="form-select" aria-label="Default select example">
                                    <option selected disabled>Select Grade Level</option>
                                    <option value="g11" disabled>Grade 11</option>
                                    <option value="g12">Grade 12</option>
                                </select>
                            </div>
                            <div class="col col-6">
                                <select id="strand" class="form-select" aria-label="Default select example">
                                    <option selected disabled>Select Strand</option>
                                    <option value="abm" disabled>ABM</option>
                                    <option value="gas" disabled>GAS</option>
                                    <option value="art_and_design" disabled>TVL ART & DESIGN</option>
                                    <option value="he" disabled>TVL HE</option>
                                    <option value="humss" >HUMSS</option>
                                    <option value="ict" >TVL ICT</option>
                                    <option value="stem" disabled>STEM</option>

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
    </div> <!-- Modal Add Student -->
<?php endif; ?>

<div id="toastContainer" class=" position-fixed f-flex bottom-0 end-0 p-3 " style="z-index: 11">

</div>

<div class="content-wrapper">
    <div class="container-fluid table-container">
        <div class="row">

            <?php if (Session::getUserType() === "admin") : ?>
                <div class="col col-12" id="studentTableAlert">

                </div>

                <div class="col col-lg-12 col-12 py-3 d-flex justify-content-end">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal" id="addStudentModalBtn">
                        <span class="fa-solid fa-plus me-2"></span>Add Student
                    </button>
                </div>

            <?php endif; ?>


            <hr>
            <div class="col col-12 pb-3 d-flex justify-content-end">
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <input class="form-control me-2" id="student_SearchBar" type="search" placeholder="Search" aria-label="Search">
                        </div>
                    </div>
                </div>
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
                    <tbody id="studentTb">
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
                        echo '<tr class="border-0 text-danger">';
                        echo '<td colspan="8" class="st_no_s text-center">No student data found.</td>';
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
            </table>
        </div>
            

        </div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" <?= ($page_num <= 1) ? 'disabled' :
                                                                            'href="' . baseurl() . '/' . Session::getUserType() . '/student_list/page/' . $previous_page . '"' ?>>Previous</a></li>
                            <?php
                            for ($i = 1; $i <= $total_num_of_pages; $i++) {
                                if ($page_num !== $i) : ?>
                                    <li class="page-item"><a class="page-link" href="<?= baseurl() ?>/<?= Session::getUserType() ?>/student_list/page/<?= $i ?>"><?= $i ?></a></li>
                                <?php else : ?>
                                    <li class="page-item"><a class="page-link active"><?= $i ?></a></li>
                            <?php endif;
                            } ?>

                            <li class="page-item"><a class="page-link" <?= ($page_num >= $total_num_of_pages) ? 'disabled '
                                                                            : 'href="' . baseurl() . '/' . Session::getUserType() . '/student_list/page/' . $next_page . '"' ?>>Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>