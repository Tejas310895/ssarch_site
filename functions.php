<?php

function common_get($query)
{
    include('includes/db.php');
    $data = $con->query($query)->fetch_all(MYSQLI_ASSOC);

    return $data;
}

function get_projects()
{
    $query = "SELECT project_no,c_name,c_contact FROM projects pro INNER JOIN project_enquiries pro_e ON pro.project_no=pro_e.application_no WHERE site_incharge=" . $_SESSION['user'] . " and project_status='open'";
    return common_get($query);
}

function get_measurements($project_no)
{
    $query = "SELECT * FROM mesurments WHERE project_no='" . $project_no . "' AND m_status='pending'";
    return common_get($query);
}

function get_tasks($project_no)
{
    $query = "SELECT * FROM tasks WHERE project_no='" . $project_no . "' AND task_status='pending'";
    return common_get($query);
}

function get_task_uploads($task_id)
{
    $query = "SELECT * FROM task_uploads WHERE task_id=' " . $task_id . " '";
    return common_get($query);
}

function get_site_workers()
{
    $query = "SELECT * FROM users WHERE user_role='site_staff'";
    return common_get($query);
}

function get_user($id)
{
    $query = "SELECT * FROM users WHERE user_id=" . $id;
    return common_get($query);
}

function get_worker_tasks($id)
{
    $query = "SELECT * FROM tasks WHERE task_to=" . $id;
    $data = common_get($query);
    $data = array_reduce($data, function ($carry, $val) {
        $carry[$val['project_no']] = $val;
        return $carry;
    });
    return common_get($query);
}
