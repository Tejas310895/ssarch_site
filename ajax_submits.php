<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
include("includes/db.php");

function common_insert($data, $table)
{
    $query = "INSERT INTO $table ";
    $cols = '';
    $values = '';
    $counter = 0;
    foreach ($data as $key => $vals) {
        ++$counter;
        $cols .= $key;
        $values .= '"' . $vals . '"';
        if ($counter < count($_POST)) {
            $cols .= ',';
            $values .= ',';
        }
    }
    $query .= '(' . $cols . ')';
    $query .= ' values ';
    $query .= '(' . $values . ')';
    include("includes/db.php");
    return $con->query($query);
}

function common_update($data, $table, $where)
{
    $query = "UPDATE $table SET ";
    $values = '';
    $counter = 0;
    foreach ($data as $key => $vals) {
        ++$counter;
        $values .= $key . '="' . $vals . '"';
        if ($counter < count($data)) {
            $values .= ',';
        }
    }
    $query .= $values . ' WHERE ' . $where . ';';
    include("includes/db.php");
    return $con->query($query);
}

function common_delete($table, $where)
{
    $query = 'DELETE FROM ' . $table . ' WHERE ' . $where . ';';
    include("includes/db.php");
    return $con->query($query);
}


if (isset($_POST['measure_insert'])) {
    unset($_POST['measure_insert']);
    $_POST['m_status'] = 'pending';
    $_POST['entered_by'] = $_SESSION['user'];
    $_POST['created_at'] = date('Y-m-d H:i:i');
    $_POST['updated_at'] = date('Y-m-d H:i:i');
    $_POST['m_id'] = 'default';
    $data_in = common_insert($_POST, 'mesurments');
    echo "<script>alert('Mesurement Updated')</script>";
    echo "<script>window.open('index.php?measurements=" . $_POST['project_no'] . "','_self')</script>";
}

if (isset($_POST['measure_edit'])) {
    $mesure_update = array_reduce($_POST['measure_edit'], function ($carry, $vals) {
        $carry[$vals['name']] = $vals['value'];
        return $carry;
    });
    $m_id = $mesure_update['m_id'];
    unset($mesure_update['m_id']);
    $mesure_update['entered_by'] = $_SESSION['user'];
    $mesure_update['updated_at'] = date('Y-m-d H:i:i');
    $data_in = common_update($mesure_update, 'mesurments', 'm_id=' . $m_id);
    echo 1;
}

if (isset($_GET['mesure_delete'])) {
    $data_in = common_delete('mesurments', 'm_id=' . $_GET['mesure_delete']);
    echo "<script>alert('Mesurement Deleted')</script>";
    echo "<script>window.open('index.php?measurements=" . $_GET['project_no'] . "','_self')</script>";
}

if (isset($_POST['measure_id'])) {
    $id = $_POST['measure_id'];
    $sql = "SELECT * FROM mesurments WHERE m_id=$id";
    $data = $con->query($sql)->fetch_all(MYSQLI_ASSOC);

    echo json_encode(array_shift($data));
}

if (isset($_POST['task_insert'])) {
    unset($_POST['task_insert']);
    $_POST['task_status'] = 'pending';
    $_POST['task_by'] = $_SESSION['user'];
    $_POST['task_type'] = 'site';
    $_POST['created_at'] = date('Y-m-d H:i:i');
    $_POST['updated_at'] = date('Y-m-d H:i:i');
    $_POST['task_id '] = 'default';
    $data_in = common_insert($_POST, 'tasks');
    echo "<script>alert('Tasks Updated')</script>";
    echo "<script>window.open('index.php?tasks=" . $_POST['project_no'] . "','_self')</script>";
}

if (isset($_GET['delete_task'])) {
    $data_in = common_delete('tasks', 'task_id=' . $_GET['delete_task']);
    echo "<script>alert('Task Deleted')</script>";
    echo "<script>window.open('index.php?tasks=" . $_GET['project_no'] . "','_self')</script>";
}

if (isset($_GET['reset_task'])) {
    $data_in = common_delete('task_uploads', 'task_id=' . $_GET['reset_task']);
    echo "<script>alert('Task Reset Successful')</script>";
    echo "<script>window.open('index.php?tasks=" . $_GET['project_no'] . "','_self')</script>";
}

if (isset($_GET['approve_task'])) {
    $task_update = [];
    $task_update['task_status'] = 'approved';
    $task_update['updated_at'] = date('Y-m-d H:i:i');
    $data_in = common_update($task_update, 'tasks', 'task_id=' . $_GET['approve_task']);
    echo "<script>alert('Task Updated')</script>";
    echo "<script>window.open('index.php?tasks=" . $_GET['project_no'] . "','_self')</script>";
}

if (isset($_POST['task_upload'])) {
    $target_dir = "../uploads/";
    $task_file_name =  "TU_" . random_int(10000000, 99999999) . basename($_FILES["task_file"]["name"]);
    $task_file = $target_dir . $task_file_name;
    $task_note = $_POST['task_note'];
    $project_id = $_POST['project_id'];
    $task_id = $_POST['task_id'];
    $task_check = $_FILES["task_file"]["tmp_name"];
    if (!empty($task_check)) {
        if (move_uploaded_file($_FILES["task_file"]["tmp_name"], $task_file)) {

            $sql = "INSERT INTO task_uploads VALUES ('default','$task_id','$task_file_name','$task_note',NOW(),NOW())";

            if ($con->query($sql)) {
                echo "<script>alert('Files uploaded succesfully')</script>";
                echo "<script>window.open('index.php?tasks_upload=$project_id&task=$task_id','_self')</script>";
            } else {
                echo "<script>alert('File upload failed! Try again')</script>";
                echo "<script>window.open('index.php?tasks_upload=$project_id&task=$task_id','_self')</script>";
            }
        } else {
            echo "<script>alert('File upload failed Try again')</script>";
            echo "<script>window.open('index.php?tasks_upload=$project_id&task=$task_id','_self')</script>";
        }
    } else {
        echo "<script>alert('File upload failed ! Try again')</script>";
        echo "<script>window.open('index.php?tasks_upload=$project_id&task=$task_id','_self')</script>";
    }
}

if (isset($_GET['delete_task_uploads'])) {
    $data_in = common_delete('task_uploads', 'id=' . $_GET['delete_task_uploads']);
    echo "<script>alert('Upload Deleted')</script>";
    echo "<script>window.history.go(-1)</script>";
}
