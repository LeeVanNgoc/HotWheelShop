<?php 

    class Manufactures extends Controller {
        private $manufactureModel;
        public function __construct(){
            new Session;
            $this->manufactureModel = $this->model('Manufacture');
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function index(){
            Auth::adminAuth();
            $data['title1'] = 'All Brands';
            $data['manufactures'] = $this->manufactureModel->getAllMan();
            $this->view('manufactures.all', $data);
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> search <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function search(){
            Auth::adminAuth();
            $data['title1'] = 'All Brands';
            $searched = $_POST['search'];
            $results = $this->manufactureModel->search($searched);
            $data['manufactures'] = $results;
            $this->view('manufactures.search', $data);
            
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   show    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function show($id){
            Auth::adminAuth();
            $data['manufacture'] = $this->manufactureModel->show($id);
            $data['title1'] = $data['manufacture']->man_name;
            if($data['manufacture'] && is_numeric($id)){
                $this->view('manufactures.show', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('manufactures');
            }
        }

        public function add(){
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Add Manufacture';
            
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addManufacture'])) {
                $man_name = $_POST['manufacture'];
                $man_user = Session::name('admin_id');
                $description = $_POST['description'];
                $brand = $_POST['brand'];
                
                $image = $_FILES['image']['name'];
                $pro_tmp = $_FILES['image']['tmp_name'];
                $pro_type = $_FILES['image']['type'];
                
                if(!empty($image)){
                    $uploaddir = dirname(ROOT).'\public\uploads\manufactures\\';
                    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
                    $image = pathinfo($image, PATHINFO_FILENAME) . time() . '.' . $image_ext;

                    if($image_ext != "jpg" && $image_ext != "png" && $image_ext != "jpeg" && $image_ext != "gif") {
                        $data['errImg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    }
                } else {
                    $data['errImg'] = 'You must choose an image';
                }
                
                if (strlen($man_name) < 3) {
                    $data['errMan'] = 'Manufacture name must not be less than 3 characters';
                }
                if (strlen($description) < 5) {
                    $data['errDes'] = 'Manufacture description must not be less than 5 characters';
                }
                if (strlen($brand) < 3) {
                    $data['errBrand'] = 'Brand name must not be less than 3 characters';
                }

                if (empty($data['errMan']) && empty($data['errDes']) && empty($data['errBrand']) && empty($data['errImg'])) {
                    move_uploaded_file($pro_tmp, $uploaddir . $image);
                    
                    $this->manufactureModel->add($man_name, $man_user, $description, $brand, $image);
                    
                    Session::set('success', 'New manufacture added successfully');
                    Redirect::to('manufactures');
                } else {
                    $this->view('manufactures.add', $data);
                }
            } else {
                $this->view('manufactures.add');
            }
        }

        
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   edit     <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function edit($id){
            Auth::adminAuth();
            $data['title1'] = 'Edit Brand';
            $data['manufacture'] = $this->manufactureModel->show($id);
            if($data['manufacture'] && is_numeric($id)){
                $this->view('manufactures.edit', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('manufactures');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   update   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        // public function update($id){
        //     Auth::adminAuth();
        //     Csrf::CsrfToken();
        //     $data['title1'] = 'Edit Brand';
        //     if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['editManufacture']){
        //         $man_name = $_POST['manufacture'];
        //         $man_id = $_POST['man_id'];
        //         $description = $_POST['description'];
        //         $man_user = Session::name('admin_id');

        //         if (strlen($man_name) < 3) {
        //             $data['errMan'] = 'manufacture name must not be less than 3 characters';
        //         }elseif($this->manufactureModel->findManName($man_name,$man_id) > 0) {
        //             $data['errMan'] = 'This name already exist choose anthor one';
        //         }

        //         if (strlen($description) < 5) {
        //             $data['errDes'] = 'manufacture description must not be less than 5 characters';
        //         }

        //         if(empty($data['errMan']) && empty($data['errDes'])){
        //             $this->manufactureModel->update($id, $man_name,$description);
        //             Session::set('success', 'manufacture has been edited successfully');
        //             Redirect::to('manufactures');
        //         }else {
        //             $data['manufacture'] = $this->manufactureModel->show($id);
        //             $this->view('manufactures.edit', $data);
        //         }

        //     }else {
        //         Redirect::to('manufactures');
        //     }
        // }

        public function update($id) {
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Edit Brand';

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['editManufacture']) {
                $man_name = $_POST['manufacture'];
                $man_id = $_POST['man_id'];
                $description = $_POST['description'];
                $brand = $_POST['brand'];
                $man_user = Session::name('admin_id');
                $oldImg = $_POST['oldImg'];  // Lấy ảnh cũ từ form

                $image = $_FILES['image']['name'];
                $image_tmp = $_FILES['image']['tmp_name'];
                $image_type = $_FILES['image']['type'];

                if (!empty($image)) {
                    // Nếu có ảnh mới, xử lý upload
                    $uploaddir = dirname(ROOT) . '\public\uploads\manufactures\\';
                    unlink($uploaddir . $oldImg);  // Xóa ảnh cũ nếu có
                    $image = explode('.', $image);
                    $image_ext = $image[1];
                    $image = $image[0] . time() . '.' . $image_ext;

                    // Kiểm tra loại ảnh hợp lệ
                    if ($image_ext != "jpg" && $image_ext != "png" && $image_ext != "jpeg" && $image_ext != "gif") {
                        $data['errImg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    }
                } else {
                    // Nếu không có ảnh mới, giữ ảnh cũ
                    $image = $oldImg;
                }

                // Kiểm tra các lỗi đầu vào khác
                if (strlen($man_name) < 3) {
                    $data['errMan'] = 'Manufacture name must not be less than 3 characters';
                } elseif ($this->manufactureModel->findManName($man_name, $man_id) > 0) {
                    $data['errMan'] = 'This name already exists, choose another one';
                }

                if (strlen($description) < 5) {
                    $data['errDes'] = 'Manufacture description must not be less than 5 characters';
                }

                if (strlen($brand) < 3) {
                    $data['errBrand'] = 'Brand name must not be less than 3 characters';
                }

                if (empty($data['errMan']) && empty($data['errDes']) && empty($data['errBrand']) && empty($data['errImg'])) {
                    // Move ảnh vào thư mục uploads
                    move_uploaded_file($image_tmp, $uploaddir . $image);

                    // Cập nhật manufacture vào cơ sở dữ liệu
                    $this->manufactureModel->update($id, $man_name, $description, $brand, $image);
                    Session::set('success', 'Manufacture has been edited successfully');
                    Redirect::to('manufactures');
                } else {
                    // Nếu có lỗi, trả lại dữ liệu và hiển thị lỗi
                    $data['manufacture'] = $this->manufactureModel->show($id);
                    $this->view('manufactures.edit', $data);
                }
            } else {
                Redirect::to('manufactures');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  activate  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function activate($id){
            Auth::adminAuth();
            $activate =  $this->manufactureModel->activate($id);
            Session::set('success', 'Item has been activated');
            if($activate){
                Redirect::to('manufactures');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> inactivate <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function inActivate($id){
            Auth::adminAuth();
            $inActivate =  $this->manufactureModel->inActivate($id);
            if($inActivate){
                Session::set('success', 'Item has been inActivated');
                Redirect::to('manufactures');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   delete   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function delete($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            Session::set('success', 'Item has been deleted');
            $delete =  $this->manufactureModel->delete($id);
            if($delete){
                Redirect::to('manufactures');
            }
        }

    }