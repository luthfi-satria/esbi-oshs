<!DOCTYPE html>
<html>
    <?php include('header.php');?>
    <body>
        <div id="content_wrapper" class="responsive">
            <div class="container-fluid">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($params as $key => $val){
                                echo '<tr>';
                                    echo '<td>'.($key+1).'</td>';
                                    echo '<td>'.$val['username'].'</td>';
                                    echo '<td>'.$val['email'].'</td>';
                                    echo '<td>';
                                        echo '<a href="/edit/'.$val['id'].'" target="_blank" class="btn btn-sm btn-primary">Edit</a>';
                                        echo '<a class="btn btn-sm btn-danger" onclick="deleteUser('.$val['id'].')">Delete</a>';
                                    echo '</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    <?php include('footer.php');?>   
</html>