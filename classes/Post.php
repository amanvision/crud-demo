<?php
require_once(path('classes/Database.php'));
class Post extends DataBase {

    public $tableName = "posts";

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->select($this->tableName);
    }

    /**
     * Store resource
     */
    public function store()
    {
        $id = $this->insert($this->tableName, [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'created_at' => date('Y-m-d H:i:s', time())
        ]);
        if($id) {
            $message = [
                'code' => 'success',
                'message' => 'Post created successfully!'
            ];
        } else {
            $message = [
                'code' => 'danger',
                'message' => 'Error! Something went wrong.'
            ];
        }
        return $message;
    }

    public function modify($id)
    {
        $post = $this->getById($this->tableName, $id);
        if($post == false) {
            return [
                'code' => 'danger',
                'message' => 'Error! Post not found.'
            ];
        }
        
        $result = $this->update($this->tableName, [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'updated_at' => date('Y-m-d H:i:s', time())
        ], [
            'where' => [
                'id' => $id
            ]
        ]);
        
        // OR
        // $result = $this->update($this->tableName, [
        //     'title' => $_POST['title'],
        //     'description' => $_POST['description'],
        //     'updated_at' => date('Y-m-d H:i:s', time())
        // ], [
        //     'where' => [
        //         'id = ' . $id
        //     ]
        // ]);

        if($result) {
            $message = [
                'code' => 'success',
                'message' => 'Post updated successfully!'
            ];
        } else {
            $message = [
                'code' => 'danger',
                'message' => 'Error! Something went wrong.'
            ];
        }
        return $message;
    }

    public function destory($id)
    {
        $post = $this->getById($this->tableName, $id);
        if($post) {
            $sql = "DELETE FROM `{$this->tableName}` WHERE `id` = '$id'";
            if($this->execute($sql)) {
                header('Location: ' . url('views/post'));
            } else {
                $message = [
                    'code' => 'danger',
                    'message' => 'Error! Something went wrong.'
                ];
            }
        } else {
            $message = [
                'code' => 'danger',
                'message' => 'Error! Post not found.'
            ];
        }
        return $message;
    }
}