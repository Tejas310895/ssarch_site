<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-8 col-xl-8 mb-0 mb-xl-0">
                <h3 class="font-weight-bold">Measurements</h3>
                <h6 class="font-weight-normal mb-0">For <?php echo $_GET['measurements']; ?></h6>
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
    <?php foreach (get_measurements($_GET['measurements']) as $vals) { ?>
        <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card card-tale">
                <div class="card-body">
                    <h4 class="card-title text-light mb-2 align-text-bottom"><?php echo $vals['m_title']; ?> <span class="badge badge-light"><?php echo $vals['m_category']; ?></span> </h4>
                    <p class="mb-0">Length : <span><?php echo $vals['m_length']; ?> <?php echo $vals['m_unit']; ?></span> </p>
                    <p class="mb-0">Width : <span><?php echo $vals['m_width']; ?> <?php echo $vals['m_unit']; ?></span> </p>
                    <p class="mb-0">Height : <span><?php echo $vals['m_height']; ?> <?php echo $vals['m_unit']; ?></span> </p>
                    <p class="mb-0">Quantity : <span><?php echo $vals['m_qty']; ?></span> </p>
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModaledit" onclick="edit_mesure_data(<?php echo $vals['m_id']; ?>)">
                            <i class="ti-pencil"></i>
                        </button>
                        <a href="ajax_submits.php?mesure_delete=<?php echo $vals['m_id']; ?>&project_no=<?php echo $_GET['measurements']; ?>" type="button" class="btn btn-danger">
                            <i class="ti-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="forms-sample" action="ajax_submits.php" method="post">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h5 class="modal-title" id="exampleModalLabel">Add Measurement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-1">
                    <input type="hidden" name="project_no" value="<?php echo $_GET['measurements']; ?>">
                    <div class="form-group mb-1">
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Title" name="m_title">
                    </div>
                    <div class="form-group mb-1">
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Category" name="m_category">
                    </div>
                    <div class="form-group mb-1">
                        <input type="number" class="form-control" id="exampleInputUsername1" placeholder="Length" name="m_length">
                    </div>
                    <div class="form-group mb-1">
                        <input type="number" class="form-control" id="exampleInputUsername1" placeholder="Width" name="m_width">
                    </div>
                    <div class="form-group mb-1">
                        <input type="number" class="form-control" id="exampleInputUsername1" placeholder="Height" name="m_height">
                    </div>
                    <div class="form-group mb-1">
                        <input type="number" class="form-control" id="exampleInputUsername1" placeholder="Quantity" name="m_qty">
                    </div>
                    <div class="form-group mb-1">
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Unit" name="m_unit">
                    </div>
                </div>
                <div class="modal-footer p-0">
                    <div class="col-12">
                        <button type="submit" name="measure_insert" class="btn btn-primary rounded-0 btn-block">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="forms-sample" action="" method="post" onsubmit="edit_mesure(event)">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h5 class="modal-title" id="exampleModalLabel">Add Measurement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-1">
                    <input type="hidden" name="m_id" id="m_id">
                    <div class="form-group mb-1">
                        <input type="text" class="form-control" id="edit_title" placeholder="Title" name="m_title">
                    </div>
                    <div class="form-group mb-1">
                        <input type="text" class="form-control" id="edit_category" placeholder="Category" name="m_category">
                    </div>
                    <div class="form-group mb-1">
                        <input type="number" class="form-control" id="edit_length" placeholder="Length" name="m_length">
                    </div>
                    <div class="form-group mb-1">
                        <input type="number" class="form-control" id="edit_width" placeholder="Width" name="m_width">
                    </div>
                    <div class="form-group mb-1">
                        <input type="number" class="form-control" id="edit_height" placeholder="Height" name="m_height">
                    </div>
                    <div class="form-group mb-1">
                        <input type="number" class="form-control" id="edit_qty" placeholder="Quantity" name="m_qty">
                    </div>
                    <div class="form-group mb-1">
                        <input type="text" class="form-control" id="edit_unit" placeholder="Unit" name="m_unit">
                    </div>
                </div>
                <div class="modal-footer p-0">
                    <div class="col-12">
                        <button type="submit" name="measure_edit" class="btn btn-primary rounded-0 btn-block">Update</button>
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