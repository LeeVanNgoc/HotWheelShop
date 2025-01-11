<?php

class UserManagerment extends Controller {

    private $db;

    public function __construct() {
        $this->db = new Database(); // Tạo đối tượng Database
    }

    // Lấy tất cả người dùng
    public function getAllUsers() {
        $this->db->query("SELECT * FROM users");
        return $this->db->resultSet();
    }

    // Thêm người dùng mới
    public function addUser($name, $email, $password, $admin = 0) {
        $this->db->query("INSERT INTO users (full_name, email, password, admin) VALUES (:full_name, :email, :password, :admin)");
        $this->db->bind(':full_name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', password_hash($password, PASSWORD_DEFAULT));
        $this->db->bind(':admin', $admin); // Truyền admin vào
        return $this->db->execute();
    }

    // Chỉnh sửa người dùng
    public function updateUser($user_id, $name, $email, $password, $role, $active) {
        $this->db->query("UPDATE users SET full_name = :full_name, email = :email, password = :password, admin = :admin, active = :active WHERE user_id = :user_id");
        $this->db->bind(':full_name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        $this->db->bind(':admin', $role);
        $this->db->bind(':active', $active);
        $this->db->bind(':user_id', $user_id);
        return $this->db->execute();
    }


    // Tìm kiếm người dùng theo email (tránh trùng lặp email)
    public function findUserByEmail($email, $excludeId = null) {
        if ($excludeId) {
            $this->db->query("SELECT * FROM users WHERE email = :email AND user_id != :user_id");
            $this->db->bind(':user_id', $excludeId);
        } else {
            $this->db->query("SELECT * FROM users WHERE email = :email");
        }
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->rowCount() > 0; // Nếu có người dùng với email đó, trả về true
    }

    // Lấy thông tin người dùng theo ID
    public function getUserById($id) {
        $this->db->query("SELECT * FROM users WHERE user_id = :user_id");
        $this->db->bind(':user_id', $id);
        return $this->db->single(); // Trả về một bản ghi (dữ liệu người dùng)
    }


    // Xóa người dùng
    public function deleteUser($id) {
        $this->db->query("DELETE FROM users WHERE user_id = :user_id");
        $this->db->bind(':user_id', $id);
        return $this->db->execute();
    }

    // Thay đổi trạng thái kích hoạt của người dùng
    public function toggleUserStatus($id) {
        $this->db->query("UPDATE users SET active = NOT active WHERE user_id = :user_id");
        $this->db->bind(':user_id', $id);
        return $this->db->execute();
    }
}

