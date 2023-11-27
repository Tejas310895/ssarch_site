<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-8 col-xl-8 mb-0 mb-xl-0">
                <h3 class="font-weight-bold">Measurements Summary</h3>
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
                        <div class="card-body bg-inverse-info py-2">
                            <div class="row">
                                <?php foreach (get_measurements($proj['project_no']) as $mesur) {  ?>
                                    <div class="col-lg-3 mb-2">
                                        <h4 class="card-title text-light mb-0 align-text-bottom"><?php echo $mesur['m_title']; ?> <span class="badge badge-light"><?php echo $mesur['m_category']; ?></span> </h4>
                                        <p class="mb-0">Length : <span><?php echo $mesur['m_length']; ?></span> </p>
                                        <p class="mb-0">Width : <span><?php echo $mesur['m_width']; ?></span> </p>
                                        <p class="mb-0">Height : <span><?php echo $mesur['m_height']; ?></span> </p>
                                        <p class="mb-0">Quantity : <span><?php echo $mesur['m_qty']; ?></span> </p>
                                        <p class="mb-0">Unit : <span><?php echo $mesur['m_unit']; ?></span> </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>