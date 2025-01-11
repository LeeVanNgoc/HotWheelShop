<?php 

    class Admins extends Controller {
        
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> construct  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        private $adminModel;
        private $vkey ;
        public function __construct(){
            
            
            $this->adminModel = $this->model('Admin');
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   login    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function login(){
            $data['title1'] = 'Admin Login';
            Auth::adminGuest();
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['login']){
                Csrf::CsrfToken();
                   $email = $_POST['email'];
                   $password = $_POST['password'];
                  
                   if (empty($email)) {
                        $data['errEmail'] = 'Email Must Has Value.';
                    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        $data['errEmail'] = 'Enter Valid Email';
                    }elseif($this->adminModel->findUserByEmail($email) == false){
                        $data['errEmail'] = 'This Email Is Not Exist';
                    }

                    if (empty($password)) {
                        $data['errPassword'] = "Password Must Has Value.";
                    }

                    if(empty($data['errEmail']) && empty($data['errPassword'])){
                        $admin = $this->adminModel->login($email,$password);
                        if($admin){
                    
                            Session::set('admin_name',$admin->full_name);
                            Session::set('admin_id',$admin->user_id);
                            Redirect::to('admins/dashboard');                           
                        }else {
                            $data['errPassword'] = "Password Not Valid OR not admin";
                            $this->view('admins.login', $data);
                        }
                    }else{
                        $this->view('admins.login', $data);

                    }

            }else {
                $this->view('admins.login',$data);
            }
        }
        
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->    update  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function update($id){
            Auth::adminAuth();
            $data['title1'] = 'Edit Profile';

            if($_SERVER['REQUEST_METHOD']=='POST'){
                if($_POST['editProfile']){
                    // Sanitize inputs
                    $fullname = filter_var($_POST['full_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    $password = $_POST['password'];
                    $oldPass = $_POST['oldPass'];
                    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    if (empty($fullname)) {
                        $data['errName'] = 'Name is required.';
                    }

                    if(empty($password)){
                        $hashedPassword = $oldPass; // Retain old password if new password is empty
                    }

                    if (empty($email)) {
                        $data['errEmail'] = 'Email is required.';
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $data['errEmail'] = 'Please enter a valid email address.';
                    }
                     elseif($this->adminModel->findUserByEmail($email, $id)){
                        $data['errEmail'] = 'This email is already in use.';
                    }

                    if(empty($data['errEmail']) && empty($data['errName']) && empty($data['errPassword'])){
                        // Update the admin profile
                        $this->adminModel->update($id, $fullname, $email, $hashedPassword);
                        Session::set('user_name', $fullname);
                        Session::set('success', 'Your profile has been updated.');
                        Redirect::to('admins/profile');
                    } else {
                        $data['user'] = $this->adminModel->show($id);
                        $this->view('admins.edit', $data);
                    }
                }
            } else {
                $data['user'] = $this->adminModel->show($id);
                $this->view('admins.edit', $data);
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   edit     <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function edit($id){
            Auth::adminAuth();
            $data['title1'] = 'Edit Profile';
            $data['user'] = $this->adminModel->show($id);
            if($data['user'] && is_numeric($id)){
                $this->view('admins.edit', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('admins');
            }
        }


        
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   logout   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function logout(){
            Auth::adminAuth();
            Session::clear('admin_name');
            Session::destroy();
            Redirect::to('admins/login');
        }

         /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  profile   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function profile(){
            Auth::adminAuth();
            $data['title1'] = 'Profile';
            $name = Session::name('user_name');
            $admin_id = Session::name('user_id');
            $admin = $this->adminModel->adminData($name,$admin_id);
            
            $data['admin'] = $admin;
            if(Session::existed('email')){
                Session::clear('email');
            }
            $this->view('admins.profile', $data);
            
        }

        
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> add avatar <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function avatar($id){
        
            Auth::adminAuth();
            $data['title1'] = 'Edit Avatar';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['addAvatar']){

                echo $pro_img = $_FILES['image']['name'];
                $pro_tmp = $_FILES['image']['tmp_name'];
                $pro_type = $_FILES['image']['type'];
                if(!empty($pro_img)){
                    $uploaddir = dirname(ROOT).'\public\uploads\\' ;
                    $pro_img = explode('.',$pro_img);
                    $pro_img_ext = $pro_img[1];
                    $pro_img = $pro_img[0].time().'.'.$pro_img[1];

                    if($pro_img_ext != "jpg" && $pro_img_ext != "png" && $pro_img_ext != "jpeg"
                        && $pro_img_ext != "gif" ) {
                            $data['errImg']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        }
                }else {
                    $data['errImg'] = 'You must choose an image';
                }
                

                if(empty($data['errImg'])){
                    move_uploaded_file($pro_tmp, $uploaddir.$pro_img);
                    unlink($uploaddir.Session::name('user_img'));
                    $this->adminModel->avatar($id,$pro_img);
                    Session::set('user_img',$pro_img );
                    Session::set('success', 'Your avatar has been uploaded successfully');
                    Redirect::to('admins/profile');
                }else {
                    $this->view('admins.avatar', $data);
                }
             }else {
                 $this->view('admins.avatar',$data);
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> dashboard  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function dashboard(){
            Auth::adminAuth();
            $data['title1'] = 'Dashboard';
            $arrayName = explode(' ', Session::name('admin_name'));
            $data['admin_name'] = $arrayName[0];
            $this->view('admins.dashboard', $data);
        }

         public function usersList() {
            $users = $this->adminModel->getAllUsers();  // Gọi phương thức lấy tất cả người dùng
            $data['users'] = $users;  // Lưu kết quả vào biến `$data`
            $this->view('admins.usersList', $data);  // Truyền dữ liệu vào view để hiển thị
        }
    }
    