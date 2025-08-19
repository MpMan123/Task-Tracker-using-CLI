#! /usrs/bin/env php

<?php
    include __DIR__ . '/help.php';
    $data_path = __DIR__ . '/data.json';

    // Requirement required
    if (!isset($argv[1])) {
        echo "You need to add requirement";
        exit;
    }

    // If task list is empty --> table's inavailable
    if (!file_exists($data_path) && $argv[1] != 'add') {
        echo "Your To-do list is empty \n";
        echo "Please add your tasks first";
        exit;
    }
    
    // command is not a case-sensitive
    $action = strtolower($argv[1]);

    // Get date
    $now = new DateTime("now", new DateTimeZone("Asia/Ho_Chi_Minh"));
    $now = $now->format('d-m-Y H:i:s');

    // Default data form
    $data = [
        "id" => 1,
        "description" => null,
        "create at" => $now,
        "status" => "todo",
        "update time" => null
    ];

    $highest_id = 1;

    switch($action) {
        case "add":
            if (!isset($argv[2])) {
                echo "Description is required";
                exit;
            }

            $data['description'] = $argv[2];

            if (!file_exists($data_path)) {
                return file_put_contents($data_path, json_encode([$data], JSON_PRETTY_PRINT));
            }

            $data_file = file_get_contents($data_path);
            $documents = json_decode($data_file, true);

            foreach ($documents as $doc) {
                foreach($doc as $key => $val) {
                    if ($val == $data['description']) {
                        echo "Task existed! Failure adding";
                        exit;
                    }
                    if ($key === "id" && $val > $highest_id) {
                        $highest_id = $val;
                    }
                }
            }
            if (count($documents) > 0)
                $data['id'] = $highest_id + 1;
            array_push($documents, $data);
            file_put_contents($data_path, json_encode($documents, JSON_PRETTY_PRINT));
            break;
        case "update":
            
            $request_id = $argv[2];
            if (isset($argv[3]) && !($argv[3] >= '0' && $argv[3] <= '9')) {
                $request_description = $argv[3];
            }
            else {
                echo "Text is required";
                exit;
            }

            $data_file = file_get_contents($data_path);
            $documents = json_decode($data_file,true);

            $update_status = false;

            foreach($documents as &$doc) {
                if ($doc['id'] == $request_id) {
                    $doc['description'] = $request_description;
                    $doc['update time'] = $now;
                    $update_status = true;
                }
            }

            if (!$update_status) {
                echo "Task's ID does not exist";
                exit;
            }
            unset($doc);
            file_put_contents($data_path, json_encode($documents, JSON_PRETTY_PRINT));
            break;
        case "delete":
            $request_id = $argv[2];

            $data_file = file_get_contents($data_path);
            $documents = json_decode($data_file, true);

            $delete_status = false;

            foreach($documents as $i => $doc) {
                if ($doc['id'] == $request_id) {
                    array_splice($documents,$i, 1);
                    $delete_status = true;
                    break;
                }
            }

            if (!$delete_status) {
                echo "Task's ID does not exist";
                exit;
            }

            file_put_contents($data_path, json_encode($documents, JSON_PRETTY_PRINT));
            break;
        case "mark-in-progress":
            $request_id = $argv[2];

            $data_file = file_get_contents($data_path);
            $documents = json_decode($data_file, true);

            $mark_status = false;

            foreach($documents as &$doc) {
                if ($doc['id'] == $request_id) {
                    $doc['status'] = "in progress";
                    $mark_status = true;
                    unset($doc);
                    break;
                }
            }

            if (!$mark_status) {
                echo "Task's ID does not exist";
                exit;
            }
            file_put_contents($data_path, json_encode($documents, JSON_PRETTY_PRINT));
            break;
        case "mark-done":
            $request_id = $argv[2];

            $data_file = file_get_contents($data_path);
            $documents = json_decode($data_file, true);

            $mark_status = false;

            foreach($documents as &$doc) {
                if ($doc['id'] == $request_id) {
                    $doc['status'] = "done";
                    $mark_status = true;
                    unset($doc);
                    break;
                }
            }

            if (!$mark_status) {
                echo "Task's ID does not exist";
                exit;
            }
            file_put_contents($data_path, json_encode($documents, JSON_PRETTY_PRINT));
            break;
        case "list":
            $data_file = file_get_contents($data_path);
            $documents = json_decode($data_file, true);

            displayLine();
            displayData('ID','Description', 'Status');
            displayLine();

            if (!isset($argv[2])) {
                foreach($documents as $doc) {
                    $id = $doc['id'];
                    $des = $doc['description'];
                    $status = $doc['status'];
                    displayCell($id, $des, $status);
                }
                exit;
            }

            $status_opt = $argv[2];
            switch($status_opt) {
                case "done":
                    foreach($documents as $doc) {
                        if ($doc['status'] == "done") {
                            displayCell($doc['id'], $doc['description'], $doc['status']);
                        }
                    }
                    break;
                case "todo":
                    foreach($documents as $doc) {
                        if ($doc['status'] == "todo") {
                            displayCell($doc['id'], $doc['description'], $doc['status']);
                        }
                    }
                    break;
                case "in-progress":
                    foreach($documents as $doc) {
                        if ($doc['status'] == "done") {
                            displayCell($doc['id'], $doc['description'], $doc['status']);
                        }
                    }
                    break;
            }
            break;
        default:
            echo "This command is not allowed";
            exit;
    }

?>