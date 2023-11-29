<div class="content-wrapper">
    <div class="container-fluid table-container">
        <div class="row">
            <div class="col col-12 py-2">
                <a href="" class="btn btn-sm btn-success">Add Student</a>
                <hr>
            </div>
            <div class="col col-table col-12 ">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Unique ID</th>
                        <th>Name</th>
                        <th>Trace Email</th>
                        <th>Create At</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($fd as $val) {
                        echo '<tr >';
                        echo '<td>' . $val['id'] . '</td>';
                        echo '<td>4564</td>';
                        echo '<td>' . $val['name'] . '</td>';
                        echo ' <td>' . $val['email'] . '</td>';
                        echo '<td> </td>';
                        echo  '<td>';
                        echo '<a href="#" class="btn btn-sm btn-success me-2">Edit</a>';
                        echo '<a href="#" class="btn btn-sm btn-danger ">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                    } ?>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <nav>
                    <ul class="pagination pagination-sm">
                        <li class="page-item ">
                            <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item " aria-current="page">
                            <span class="page-link">2</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>