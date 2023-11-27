<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-8 col-xl-8 mb-0 mb-xl-0">
                <h3 class="font-weight-bold">Uploads</h3>
                <h6 class="font-weight-normal mb-0">For <?php echo $_GET['tasks_upload']; ?></h6>
            </div>
            <div class="col-4 col-xl-12 mb-0 mb-xl-0">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-icon float-right" data-toggle="modal" data-target="#exampleModal">
                    <i class="ti-plus"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php foreach (get_task_uploads($_GET['task']) as $uploads) { ?>
        <div class="col-md-2 col-sm-12 col-lg-2">
            <div class="card">
                <img src="../uploads/<?php echo $uploads['upload_link']; ?>" class="card-img-top img-responsive" height="200px" alt="...">
                <div class="card-body">
                    <p class="card-text"><?php echo $uploads['task_note']; ?></p>
                    <a href="ajax_submits.php?delete_task_uploads=<?php echo $uploads['id']; ?>" class="btn btn-danger float-right">
                        <i class="ti-trash"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="forms-sample" action="ajax_submits.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="project_id" value="<?php echo $_GET['tasks_upload'] ?>">
                <input type="hidden" name="task_id" value="<?php echo $_GET['task'] ?>">
                <div class="modal-body p-1">
                    <div class="form-group mb-1">
                        <input class="form-control btn btn-outline-primary" type="file" id="formFile" name="task_file">
                    </div>
                    <div class="form-group mb-1">
                        <input type="text" class="form-control" id="edit_category" placeholder="Note" name="task_note">
                    </div>
                </div>
                <div class="modal-footer p-0">
                    <div class="col-12">
                        <button type="submit" name="task_upload" class="btn btn-primary rounded-0 btn-block">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function edit_mesure_data($val) {
        $.ajax({
            type: "post",
            url: "http://localhost/ssarchindia/field/ajax_submits.php",
            data: {
                'measure_id': $val
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#m_id').val(data['m_id']);
                $('#edit_title').val(data['m_title']);
                $('#edit_category').val(data['m_category']);
                $('#edit_length').val(data['m_length']);
                $('#edit_width').val(data['m_width']);
                $('#edit_height').val(data['m_height']);
                $('#edit_qty').val(data['m_qty']);
                $('#edit_unit').val(data['m_unit']);
            }
        });
    }

    function edit_mesure(e) {
        e.preventDefault();
        var data = $(e.target).serializeArray();
        $.ajax({
            type: "post",
            url: "http://localhost/ssarchindia/field/ajax_submits.php",
            data: {
                'measure_edit': data
            },
            success: function(response) {
                if (response == 1) {
                    alert('Updated Successfully');
                    location.reload();
                }
            }
        });
    }
</script>