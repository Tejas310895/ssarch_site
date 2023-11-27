<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-8 col-xl-8 mb-0 mb-xl-0">
                <h3 class="font-weight-bold">Task Summary</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12 mb-2">
        <?php foreach (get_projects() as $proj) { ?>
            <div id="accordion" class="accordion accordion-flush">
                <div class="card">
                    <div class="card-header p-1" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-block" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <?php echo $proj['project_no']; ?>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body bg-inverse-info p-1">
                            <?php foreach (get_tasks($proj['project_no']) as $task) { ?>
                                <h4 class="card-title mt-2 ml-2 text-uppercase"><u><?php echo $task['task_title']; ?></u></h4>
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
                                                        <img class="img-fluid" src="../uploads/<?php echo $uploads['upload_link']; ?>" alt="">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>