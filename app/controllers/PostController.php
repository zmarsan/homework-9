<?php

namespace app\controllers;

use app\models\Post;

class PostController
{
    private $postModel;

    public function validatePost($inputData) {
        $errors = [];
        $title = $inputData['title'];
        $description = $inputData['description'];

        if ($title) {
            $title = htmlspecialchars($title, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($title) < 2) {
                $errors['titleShort'] = 'title is too short';
            }
        } else {
            $errors['titleRequired'] = 'title is required';
        }

        if ($description) {
            $description = htmlspecialchars($description, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($description) < 2) {
                $errors['descriptionShort'] = 'description is too short';
            }
        } else {
            $errors['descriptionRequired'] = 'description is required';
        }

        if (count($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            exit();
        }
        return [
            'title' => $title,
            'description' => $description,
        ];
    }

    public function getPosts($id) {
        header("Content-Type: application/json");
        if ($id) {
            //TODO 5-c i: get a post data by id
            $post = new Post();
            $postdata = $post->getPostById($id);
     //       $post = $this -> getPostById($id);
            echo json_encode($post);
    
        } else {
            //TODO 5-a: get all posts
            $post = $this -> getAllPosts();
            echo json_encode($post);
        }

        exit();
    }

    public function savePost() {
        $inputData = [
            'post' => $_POST['title'] ? $_POST['title'] : false,
            'description' => $_POST['description'] ? $_POST['description'] : false,
        ];
        $postData = $this->validatePost($inputData);

        //TODO 5-b: save a post
        $post -> newPost();
        $post -> addPost($postData['post'], $postData['description']);

        http_response_code(200);
        echo json_encode([
            'success' => true
        ]);
        exit();
    }

    public function updatePost($id) {
        if (!$id) {
            http_response_code(404);
            exit();
        }

        //no built-in super global for PUT
        parse_str(file_get_contents('php://input'), $_PUT);

        $inputData = [
            'title' => $_PUT['title'] ? $_PUT['title'] : false,
            'description' => $_PUT['description'] ? $_PUT['description'] : false,
        ];
        $postData = $this->validatePost($inputData);

        //TODO 5-c: update a post
        //return $this->postModel->updatePost($id, $description);
        $post = new Post();
        $post->updatePost($id, $postData['post'], $postData['description']);

        http_response_code(200);
        echo json_encode([
            'success' => true
        ]);
        exit();
    }

    public function deletePost($id) {
        if (!$id) {
            http_response_code(404);
            exit();
        }

        //TODO 5-d: delete a post

        $post = deletePost($id);
        $post->deletePost(); 

        http_response_code(200);
        echo json_encode([
            'success' => true
        ]);
        exit();
    }

    public function postsView() {
        include '../public/assets/views/post/posts-view.html';
        exit();
    }

    public function postsAddView() {
        include '../public/assets/views/post/posts-add.html';
        exit();
    }

    public function postsDeleteView() {
        include '../public/assets/views/post/posts-delete.html';
        exit();
    }

    public function postsUpdateView() {
        include '../public/assets/views/post/posts-update.html';
        exit();
    }


}
