<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-8 col-xl-8 mb-0 mb-xl-0">
                <h3 class="font-weight-bold">Task Master</h3>
                <h6 class="font-weight-normal mb-0">For <?php echo $_GET['tasks']; ?></h6>
            </div>
            <div class="col-4 col-xl-12 mb-0 mb-xl-0">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-icon float-right" data-toggle="modal" data-target="#exampleModal">
                    <i class="ti-plus"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form class="forms-sample" action="ajax_submits.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header py-3">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Tasks</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-1">
                                    <input type="hidden" name="project_no" value="<?php echo $_GET['tasks']; ?>">
                                    <div class="form-group mb-1">
                                        <input type="text" class="form-control" id="exampleInputUsername1" name="task_title" placeholder="Name">
                                    </div>
                                    <div class="form-group mb-1">
                                        <input type="text" class="form-control" id="exampleInputUsername1" name="task_desc" placeholder="Description">
                                    </div>
                                    <div class="form-group mb-1">
                                        <select class="form-control" name="task_to">
                                            <option selected disabled> Select Staff</option>
                                            <?php foreach (get_site_workers() as $vals) { ?>
                                                <option value="<?php echo $vals['user_id']; ?>"><?php echo $vals['user_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer p-0">
                                    <div class="col-12">
                                        <button type="submit" name="task_insert" class="btn btn-primary rounded-0 btn-block">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php foreach (get_tasks($_GET['tasks']) as $task) { ?>
        <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card card-tale">
                <div class="card-body">
                    <p class="mb-0"><?php echo $task['task_title']; ?></p>
                    <p class="mb-0"><?php echo $task['task_desc']; ?></p>
                    <div class="col-12 mb-2">
                        <?php foreach (get_task_uploads($task['task_id']) as $uploads) { ?>
                            <button type="button" class="btn btn-primary btn-icon m-1" data-toggle="modal" data-target="#imagemodel<?php echo $uploads['id']; ?>">
                                <i class="ti-image"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="imagemodel<?php echo $uploads['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form class="forms-sample">
                                        <div class="modal-content">
                                            <div class="modal-body p-1">
                                                <img class="img-fluid" src="<?php echo $assets_url . $uploads['upload_link']; ?>" alt="">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <a href="ajax_submits.php?delete_task=<?php echo $task['task_id']; ?>&project_no=<?php echo $_GET['tasks']; ?>" type="button" class="btn btn-danger">
                            <i class="ti-trash"></i>
                        </a>
                        <?php if (count(get_task_uploads($task['task_id'])) > 0) { ?>
                            <a href="ajax_submits.php?reset_task=<?php echo $task['task_id']; ?>&project_no=<?php echo $_GET['tasks']; ?>" type="button" class="btn btn-light">
                                <i class="ti-reload"></i>
                            </a>
                            <a href="ajax_submits.php?approve_task=<?php echo $task['task_id']; ?>&project_no=<?php echo $_GET['tasks']; ?>" type="button" class="btn btn-success">
                                <i class="ti-thumb-up"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>