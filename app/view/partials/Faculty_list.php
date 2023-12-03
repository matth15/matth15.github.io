<div class="content-wrapper">
    <div class="container-fluid table-container">
        <div class="row">
            <div class="col col-lg-6 col-12 py-3">
                <a href="" class="btn btn-sm btn-success"><i class="fa-solid fa-plus me-2"></i>Add Faculty</a>
              
            </div>
            <!-- <div class="col col-lg-6 col-12 d-flex justify-content-end">
                <nav class="navbar navbar-light">
                    <div class="container-fluid">
                        <form class="d-flex">
                            <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-secondary" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div> -->
            <hr>
            <div class="col col-table col-12 ">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Unique ID</th>
                        <th>Name</th>
                        <th>Trace Email</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($fd as $val) {
                        echo '<tr >';

                        echo '<td>' . $val['id'] . '</td>';
                        echo '<td>'.$val['unique_id'].'</td>';
                        echo '<td>' . $val['name'] . '</td>';
                        echo ' <td>' . $val['email'] . '</td>';
                        echo '<td>' . $val['department'] . ' </td>';
                        echo  '<td>';
                        echo '<a href="#" class="btn btn-sm btn-success me-2"><i class="fa-solid fa-pen-to-square"></i></a>';
                        echo '<a href="#" class="btn btn-sm btn-danger "><i class="fa-solid fa-trash"></i></a>';
                        echo '</td>';

                        echo '</tr>';
                    } ?>

                </table>
            </div>
        </div>
    </div>
    <!-- PAGINATION  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="?id=">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>