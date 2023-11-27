<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-0 mb-xl-0">
                <h3 class="font-weight-bold">Dashboard</h3>
                <h6 class="font-weight-normal mb-0">Complate the projects below</h6>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter the no/name" aria-label="Recipient's username">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="button">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php foreach (get_worker_tasks($_SESSION['user']) as $vals) { ?>
        <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card card-tale">
                <div class="card-body">
                    <p class="mb-0"><?php echo $vals['project_no']; ?></p>
                    <p class="mb-0"><?php echo strtoupper($vals['task_type']) . ' - ' . $vals['task_title']; ?></p>
                    <a type="button" class="btn btn-light btn-lg btn-block" href="index.php?tasks_upload=<?php echo $vals['project_no']; ?>&task=<?php echo $vals['task_id']; ?>">Uploads</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>