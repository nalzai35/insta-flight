<?php
error_reporting(E_ERROR | E_PARSE);
require 'google-client.php';

if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}

function create_folder( $folder_name, $parent_folder_id=null ){

    $folder_list = check_folder_exists( $folder_name );

    // if folder does not exists
    if( count( $folder_list ) == 0 ){
        $service = new Google_Service_Drive( $GLOBALS['client'] );
        $folder = new Google_Service_Drive_DriveFile();

        $folder->setName( $folder_name );
        $folder->setMimeType('application/vnd.google-apps.folder');
        if( !empty( $parent_folder_id ) ){
            $folder->setParents( [ $parent_folder_id ] );
        }

        $result = $service->files->create( $folder );

        $folder_id = null;

        if( isset( $result['id'] ) && !empty( $result['id'] ) ){
            $folder_id = $result['id'];
        }

        return $folder_id;
    }

    return $folder_list[0]['id'];
}

function check_folder_exists( $folder_name ){

    $service = new Google_Service_Drive($GLOBALS['client']);

    $parameters['q'] = "mimeType='application/vnd.google-apps.folder' and name='$folder_name' and trashed=false";
    $files = $service->files->listFiles($parameters);

    $op = [];
    foreach( $files as $k => $file ){
        $op[] = $file;
    }

    return $op;
}

function insert_file_to_drive( $file_path, $file_name, $parent_file_id = null ){
    $service = new Google_Service_Drive( $GLOBALS['client'] );
    $file = new Google_Service_Drive_DriveFile();

    $file->setName( $file_name );

    if( !empty( $parent_file_id ) ){
        $file->setParents( [ $parent_file_id ] );
    }

    $result = $service->files->create(
        $file,
        array(
            'data' => file_get_contents($file_path),
            'mimeType' => 'application/octet-stream',
        )
    );

    $is_success = false;

    if( isset( $result['name'] ) && !empty( $result['name'] ) ){
        $is_success = true;
    }

    return $is_success;
}

function get_files_and_folders(){
    $service = new Google_Service_Drive($GLOBALS['client']);

    $parameters['q'] = "mimeType='application/vnd.google-apps.folder' and 'root' in parents and trashed=false";
    $files = $service->files->listFiles($parameters);

    echo "<ul>";
    foreach( $files as $k => $file ){
        echo "<li>

            {$file['name']} - {$file['id']} ---- ".$file['mimeType'];

            try {
                // subfiles
                $sub_files = $service->files->listFiles(array('q' => "'{$file['id']}' in parents"));
                echo "<ul>";
                foreach( $sub_files as $kk => $sub_file ) {
                    echo "<li&gt {$sub_file['name']} - {$sub_file['id']}  ---- ". $sub_file['mimeType'] ." </li>";
                }
                echo "</ul>";
            } catch (\Throwable $th) {
                // dd($th);
            }

        echo "</li>";
    }
    echo "</ul>";
}

var_dump(create_folder('coba permata'));