<div class="content-wrapper">
    <div class="container-fluid table-container">
        <div class="row">
            <div class="col col-12 py-2">
                <a href="" class="btn btn-sm btn-success"><i class="fa-solid fa-plus me-2"></i>Add Student</a>
                <hr>
            </div>
            <div class="col col-table col-12">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Unique ID</th>
                        <th>Name</th>
                        <th>Trace Email</th>
                        <th>Grade Level</th>
                        <th>Strand</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if (!empty($sd)) {
                        foreach ($sd as $val) {
                            echo '<tr > <td>' . $val['id'] . '</td>';
                            echo '<td>' . $val['unique_id'] . '</td>';
                            echo '<td>' . $val['name'] . '</td>';
                            echo ' <td>' . $val['email'] . '</td>';
                            echo '<td>' . str_replace(str_split("g"), '', $val['grade_level']) . '</td>';
                            echo '<td>' . strtoupper($val['strand']) . '</td>';
                            echo '<td> '.$val['created_at'].'</td>';
                            echo  '<td>';
                            echo '<a href="#" class="btn btn-sm btn-success me-2"><i class="fa-solid fa-pen-to-square"></i></a>';
                            echo '<a href="#" class="btn btn-sm btn-danger "><i class="fa-solid fa-trash"></i></a> </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr class="border-0 ">';
                        echo '<td colspan="8" class="st_no_s">No data found.</td>';
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
            <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <?php for($i=1 ; $i<= $total_pages;$i++) : ?>
                         <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <?php endfor; ?>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>