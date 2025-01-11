<?php 

    class Admin extends Controller{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function login($email,$password){
            $this->db->query("SELECT * FROM users WHERE email =:email AND admin = 1");
            $this->db->bind(':email',$email);
            $user = $this->db->single();
            if($user){
                $hashedPassword = $user->password;
                if(password_verify($password,$hashedPassword)){
                    return $user;
                }else{
                    return false;
                }
            }
        }

        public function show($id){
            $this->db->query("SELECT * FROM users WHERE user_id=:user_id");
            $this->db->bind(':user_id',$id);
            $user = $this->db->single();
            return $user;
        }

        public function update($id,$name,$email,$password){
            $this->db->query("UPDATE users SET full_name=:full_name
            ,email=:email,password=:password WHERE user_id=:user_id");
            $this->db->bind(':full_name',$name);
            $this->db->bind(':email',$email);
            $this->db->bind(':password',$password);
            $this->db->bind(':user_id',$id);
            $this->db->execute();
        }
        
        public function findUserByEmail($email,$id=''){
            $this->db->query("SELECT * FROM users WHERE 
            email =:email AND user_id != :user_id");
            $this->db->bind(':email',$email);
            $this->db->bind(':user_id',$id);
            $this->db->execute();
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            };
        }

         public function adminData($name,$user_id){
            $this->db->query("SELECT * FROM users WHERE user_id=:user_id AND full_name=:full_name");
            $this->db->bind(':user_id',$user_id);
            $this->db->bind(':full_name',$name);
            $user = $this->db->single();
            if($user){
                return $user;
            }else{
                return false;
            }
        }

        public function avatar($id, $img){
            $this->db->query("UPDATE users SET image = :image
            WHERE user_id=:user_id");
            $this->db->bind(':image',$img);
            $this->db->bind(':user_id',$id);
            return $this->db->execute();
        }

        public function getAllUsers() {
            // Truy vấn lấy tất cả người dùng, trừ admin
            $this->db->query("SELECT * FROM users WHERE admin = 0");  // Giả sử `admin = 0` là người dùng bình thường
            $users = $this->db->resultSet();  // Lấy tất cả kết quả và lưu vào mảng
            return $users;  // Trả về danh sách người dùng
        }

    }