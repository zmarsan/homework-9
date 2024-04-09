<?php

namespace app\models;

class Post
{
  // get posts
    public function getAllPosts() {
        $query = "select * from posts";
        return $result->fetchAll();
    }

    // save post
    public function saveNewPost($title, $description) {
        $query = "insert into posts (post, description)";
        return $this->queryWithParams($query, ['id' => $id]);
    }    

    // update
    public function updatePost($title, $description) {
        $query = "update posts set name = 'updated' where id = :id";
        return $this->queryWithParams($query, ['id' => $id]);
    }

    // get by ID
    public function getPostById($id) {
        $query = ("select * from posts where id = :id");
        return $this->queryWithParams($query,['id' => $id]);
    }

    // delete
    public function deletePost($id) {
       $query = ("delete from posts where id = :id");
        return $this -> queryWithParams($query, ['id' => $id]);
    }

}
