<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SubscriberRepository;
use Repositories\PostHistoryRepository;
use App\Repositories\ProductRepository;
use Repositories\NewsRepository;
use Repositories\GalleryRepository;
use Repositories\MarketingRepository;
use Repositories\ConstructionRepository;
use Repositories\TagRepository;
use App\Repositories\ContactRepository;
use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Auth;
use Repositories\ReviewPersonRepository;
use App\Repositories\MemberRepository;
use Mail;
use Illuminate\Support\Facades\File; 
use DB;

class FrontendController extends Controller {

    //
    public function __construct(MemberRepository $memberRepo,ConstructionRepository $constructionRepo, MarketingRepository $marketingRepo, SubscriberRepository $subscriberRepo, PostHistoryRepository $postHistoryRepo, ProductRepository $productRepo, NewsRepository $newsRepo, GalleryRepository $galleryRepo, TagRepository $tagRepo, ContactRepository $contactRepo, ReviewPersonRepository $reviewPersonRepo) {
        $this->subscriberRepo = $subscriberRepo;
        $this->postHistoryRepo = $postHistoryRepo;
        $this->productRepo = $productRepo;
        $this->newsRepo = $newsRepo;
        $this->galleryRepo = $galleryRepo;
        $this->marketingRepo = $marketingRepo;
        $this->constructionRepo = $constructionRepo;
        $this->contactRepo = $contactRepo;
        $this->tagRepo = $tagRepo;
        $this->reviewPersonRepo = $reviewPersonRepo;
        $this->memberRepo = $memberRepo;
    }

    public function registerMarketing(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->marketingRepo->validateCreate());
        if ($validator->fails()) {
            return response()->json(['success' => false]);
        }
        $count = $this->marketingRepo->countUser();
        $input['ref'] = str_random(8) . "" . $count;
        $password = $request->get('password');
        $input['password'] = bcrypt($password);
        $input['activation'] = str_random(15);
        $input['alias'] = StringHelper::getAlias($input['username']);
        $this->marketingRepo->create($input);
        $email = $input['email'];
        $name = $input['full_name'];
        Mail::send('mail.index', array('link' => $request->root() . '/marketing/activation/' . $input['activation']), function($message) use ($email, $name) {
            $message->to($email, $name)->subject('Xác thực tài khoản tiếp thị liên kết Alagreen');
        });
        return response()->json(['success' => true]);
    }

    public function registerConstruction(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->constructionRepo->validateCreate());
        if ($validator->fails()) {
            return response()->json(['success' => false]);
        }
        $password = $request->get('password');
        $input['password'] = bcrypt($password);
        $input['alias'] = StringHelper::getAlias($input['username']);
        $input['activation'] = str_random(15);
        $this->constructionRepo->create($input);
        $email = $input['email'];
        $name = $input['full_name'];
        Mail::send('mail.index', array('link' => $request->root() . '/construction/activation/' . $input['activation']), function($message) use ($email, $name) {
            $message->to($email, $name)->subject('Xác thực tài khoản thi công Alagreen');
            $message->from('alagreen123@gmail.com','Alagreen');
        });
        return response()->json(['success' => true]);
    }
    public function registerMember(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->memberRepo->validateCreate());
        if ($validator->fails()) {
            return response()->json(['success' => false]);
        }
        $password = $request->get('password');
        $input['password'] = bcrypt($password);
        $input['activation'] = str_random(15);
        $this->memberRepo->create($input);
        $email = $input['email'];
        $name = $input['full_name'];
        Mail::send('mail.index', array('link' => $request->root() . '/member/activation/' . $input['activation']), function($message) use ($email, $name) {
            $message->to($email, $name)->subject('Xác thực tài khoản khách hàng Alagreen');
        });
        return response()->json(['success' => true]);
    }

    public function addSubscriber(Request $request) {
        $input = $request->all();
        $this->subscriberRepo->create($input);
        return response()->json(['success' => true]);
    }

    public function checkUserMarketing(Request $request) {
        $check = $this->marketingRepo->checkUser($request->get('username'));
        if ($check) {
            return response()->json(['success' => false]);
        } else {
            return response()->json(['success' => true]);
        }
    }

    public function getProducts(Request $request) {
        $data = $this->productRepo->getProductByKeyword($request->get('keyword'));
        return response()->json($data);
    }

    public function checkUserConstruction(Request $request) {
        $check = $this->constructionRepo->checkUser($request->get('username'));
        if ($check) {
            return response()->json(['success' => false]);
        } else {
            return response()->json(['success' => true]);
        }
    }

    public function getRecentPost(Request $request) {
       // $data = $this->postHistoryRepo->readRecentPost($request->get('page'));
        $html = '';

       // foreach ($data as $key => $val) {
//            switch ($val['module']) {
//                case 'product':
//                    $record = $this->productRepo->find($val['item_id']);
//                    $data[$key]['html'] = '
//                        <div class="strip grid">
//                            <figure>
//                                <a href="' . $record->url() . '"><img src="' . $record->getImage() . '" class="img-fluid" alt="' . $record->title . '">
//                                    <div class="read_more"><span>Xem thêm</span></div>
//                                </a>' . ($val->sale_price > 0 ? '<small>SALE</small>' : '') . '
//                            </figure>
//                            <div class="wrapper">
//                                <h3 class="product-title"><a href="' . $record->url() . '">' . $record->title . '</a></h3>
//                                ' . ($record->sale_price ?
//                            '<p>Giá: <span class="price">' . $record->getSalePrice() . '</span> <span class="original-price">' . $record->getPrice() . '</span></p>' :
//                            '<p>Giá: <span class="price">' . $record->getPrice() . '</span> </p>') . '
//                            </div>
//                        </div>';
//                    break;
//                case 'gallery':
                    $gallerys = $this->galleryRepo->readRecentGalery($request->get('page'));
                    if($gallerys[0]->project_id > 0){
                        if($gallerys[0]->construction){
                            $avatar = $gallerys[0]->construction->avatar;
                            $full_name = $gallerys[0]->construction->full_name;
                        }else{
                            $avatar='';
                            $full_name='';
                        }
                    }else{
                        if($gallerys[0]->user){
                            $avatar = $gallerys[0]->user->avatar;
                            $full_name = $gallerys[0]->user->full_name;
                        }else{
                            $avatar='';
                            $full_name='';
                        }
                    }
                    $html .= '
                        <div class="col-md-12 full-image">
                            <article class="blog">
                                <figure>
                                    <a href="' . $gallerys[0]->url() . '"><img src="' . $gallerys[0]->getImage() . '" alt="' . $gallerys[0]->title . '">
                                        <div class="preview"><span>Xem thêm</span></div>
                                    </a>
                                </figure>
                                <div class="post_info">
                                    <h3><a href="' . $gallerys[0]->url() . '">' . $gallerys[0]->title . '</a></h3>
                                    <ul>
                                        <li>
                                            <div class="thumb"><img src="' . $avatar . '" alt="' . $full_name . '"></div> ' . $full_name . '
                                        </li>
                                        <li><i class="ti-eye"></i>'.$gallerys[0]->view_count.'</li>
                                    </ul>
                                </div>
                            </article>
                        </div>';
//                    break;
                    /*
                      case 'news':
                      $news = $this->newsRepo->find($val['item_id']);
                      $data[$key]['html'] = '
                      <article class="blog">
                      <figure>
                      <a href="' . $news->url() . '"><img src="' . $news->getImage() . '" alt="' . $news->title . '">
                      <div class="preview"><span>Xem thêm</span></div>
                      </a>
                      </figure>
                      <div class="post_info">
                      <h3><a href="' . $news->url() . '">' . $news->title . '</a></h3>
                      <ul>
                      <li>
                      <div class="thumb"><img src="' . $news->createdBy->avatar . '" alt="' . $news->createdBy->full_name . '"></div> ' . $news->createdBy->full_name . '
                      </li>
                      <li><i class="ti-eye"></i>' . $news->view_count . '</li>
                      </ul>
                      </div>
                      </article>'; */
//                    break;
//            }
       //}
                    
//        foreach ($data as $key => $val) {
//            if ($val['module'] != 'news') {
//                if ($key == 0) {
//                    $html .= '<div class="col-md-12 full-image">' . $data[$key]['html'] . '</div>';
//                } else {
//                    $html .= '<div class="col-md-4">' . $data[$key]['html'] . '</div>';
//                }
//            }
//        }
        $htmls=[];
        $count = 1;
        foreach($gallerys as $key=>$val){
            if($key > 0){
                if($gallerys[$key]->project_id > 0){
                        if($gallerys[$key]->construction){
                            $avatar = $gallerys[$key]->construction->avatar;
                            $full_name = $gallerys[$key]->construction->full_name;
                        }else{
                            $avatar='';
                            $full_name='';
                        }
                    }else{
                        if($gallerys[$key]->user){
                            $avatar = $gallerys[$key]->user->avatar;
                            $full_name = $gallerys[$key]->user->full_name;
                        }else{
                            $avatar='';
                            $full_name='';
                        }
                }
                $htmls[$count] = '
                    <div class="col-md-4">
                        <article class="blog">
                            <figure>
                                <a href="' . $gallerys[$key]->url() . '"><img src="' . $gallerys[$key]->getImage() . '" alt="' . $gallerys[$key]->title . '">
                                    <div class="preview"><span>Xem thêm</span></div>
                                </a>
                            </figure>
                            <div class="post_info">
                                <h3><a href="' . $gallerys[$key]->url() . '">' . $gallerys[$key]->title . '</a></h3>
                                <ul>
                                    <li>
                                        <div class="thumb"><img src="' . $avatar . '" alt="' . $full_name . '"></div> ' . $full_name . '
                                    </li>
                                    <li><i class="ti-eye"></i>'.$gallerys[$key]->view_count.'</li>
                                </ul>
                            </div>
                        </article>
                    </div>';
                $count ++;
            }
        }
        $products = $this->productRepo->readRecentProduct($request->get('page'));
        foreach($products as $key=>$product){
            if($product->createdBy){
                $avatar = $product->createdBy->avatar;
                $full_name = $product->createdBy->full_name;
            }else{
                $avatar='';
                $full_name='';
            }
        
         $htmls[$count] = '
            <div class="col-md-4">
                <div class="strip grid">
                    <figure>
                       <a href="' . $product->url() . '"><img src="' . $product->getImage() . '" class="img-fluid" alt="' . $product->title . '">
                            <div class="read_more"><span>Xem thêm</span></div>
                        </a>' . ($product->sale_price > 0 ? '<small>SALE</small>' : '') . '
                    </figure>
                    <div class="wrapper">
                       <h3 class="product-title"><a href="' . $product->url() . '">' . $product->title . '</a></h3>
                       ' . ($product->sale_price ?
                    '<p>Giá: <span class="price">' . $product->getSalePrice() . '</span> <span class="original-price">' . $product->getPrice() . '</span></p>' :
                   '<p>Giá: <span class="price">' . $product->getPrice() . '</span> </p>') . '
                   </div>
               </div>
            </div>';
         $count++;
        }
        $htmls[] = shuffle($htmls);
        foreach($htmls as $key=>$val){
            if($key < 9){
                $html .=$val;
            }
        }
        return response()->json(array('html' => $html));
    }

    public function getRecentPostMobile(Request $request) {
        $gallerys = $this->galleryRepo->readRecentGalery($request->get('page'));
        $html = '';
        $htmls=[];
        $count = 1;
        foreach($gallerys as $key=>$val){
            $htmls[$count] = '
                <div class="row bottom-15">
                        <article class="recent-post">
                            <figure>
                                <a href="' . $val->url() . '">
                                    <img src="' . $val->getImage() . '" alt="' . $val->title . '" class="img-cover">
                                </a>
                            </figure>
                            <div class="post_info">
                                <h2 class="post-title text-left"><a href="' . $val->url() . '">' . $val->title . '</a></h2>
                            </div>
                        </article>
                    </div>';
            $count ++;
        }
        $products = $this->productRepo->readRecentProduct($request->get('page'));
        foreach($products as $key=>$product){
            if($product->createdBy){
                $avatar = $product->createdBy->avatar;
            }else{
                $avatar='';
            }
        $htmls[$count]= '
            <div class="row bottom-15">
                <article class="recent-post">
                    <figure>
                        <a href="' . $product->url() . '">
                            <img src="' . $product->getImage() . '" alt="' . $product->title . '">
                        </a>
                    </figure>
                    <div class="post_info">
                        <h2 class="post-title text-left"><a href="' . $product->url() . '">' . $product->title . '</a></h2>
                        <div class="post-price"><b>Giá:</b> <span class="price">' . ($product->price ? $product->getPrice() : 'Liên hệ') . '</span></div>
                    </div>
                </article>
            </div>';
           $count++;
        }
        $htmls[] = shuffle($htmls);
        foreach($htmls as $key=>$val){
            if($key < 10){
                $html .=$val;
            }
        }
        return response()->json(array('html' => $html));
    }

    public function loginMarketing(Request $request) {
        $input = [
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'status' => '1'
        ];
        if (Auth::guard('marketing')->attempt($input)) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function loginConstruction(Request $request) {
        $input = [
            'username' => $request->get('username'),
            'password' => $request->get('password'),
             'status' => '1'
                
        ];
        if (Auth::guard('construction')->attempt($input)) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
    public function loginMember(Request $request) {
        $input = [
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'status' => '1'
        ];
        if (Auth::guard('member')->attempt($input)) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function getProductsByTag(Request $request) {
        $tag_title = $request->get('tag_title');
        $data = $this->productRepo->getProductsByTag($tag_title);
        foreach ($data as $key => $val) {
            $data[$key]->url = route('product.detail', ['alias' => $val->alias]);
            $data[$key]->image = explode(',', $val['images'])[0];
        }
        return response()->json(array('success' => true, 'records' => $data));
    }

    public function getTags(Request $request) {
        $gallery_id = $request->get('gallery_id');
        $data = $this->tagRepo->getTagsByGalleryId($gallery_id);
        return response()->json(array('success' => true, 'records' => $data));
    }

    public function sendContact(Request $request) {
        $input = $request->all();
        $input['is_read'] = 0;
        $this->contactRepo->create($input);
        return response()->json(array('success' => true));
    }

    public function checkUser(Request $request) {
        $userData = $request->all();
        if (!empty($userData)) {
            $userData['full_name'] = $userData['name'];
            $userData['facebook_id'] = $userData['id'];
            $user = \DB::table('review_person')->where('facebook_id', $userData['id'])->first();
            if (!$user) {
                $user = $this->reviewPersonRepo->create($userData);
            }
            session_start();
            session(['_review_person' => $user]);
        }
        return response()->json(array('success' => true, 'user' => $user));
    }
    public function upload(Request $request){
        $targetDir = "/public/upload/images2/";
        $allowTypes = array('jpg','png','jpeg','gif', 'PNG', 'GIF', 'JPG', 'pdf', 'docx', 'xslx');
        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
        foreach($_FILES['file']['name'] as $key=>$val){
            $fileName = basename($val);
            if(strlen($fileName)!=0){
                $fileType = pathinfo($fileName);
                $fileName = time().'_'.$fileName;
                if(in_array($fileType['extension'], $allowTypes)){
                    // Upload file to server
                    move_uploaded_file($_FILES['file']['tmp_name'][$key],'upload/images2/'.$fileName);
                }elseif(in_array($fileType['extension'], $allowTypes)){
                    move_uploaded_file($_FILES['file']['tmp_name'][$key],'upload/images2/'.$fileName);
                }
                $targetFilePath = $targetDir . $fileName;
                $images[] = $targetFilePath;
                $name[] = $fileName;
            }
        }
        return response()->json(array('success' => true, 'image' => $images,'name'=>$name));
    }
    public function uploadImage(Request $request){
        $targetDir = "/public/upload/images2/";
        $allowTypes = array('jpg','png','jpeg','gif', 'PNG', 'GIF', 'JPG', 'pdf', 'docx', 'xslx');
        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
        $fileName = basename($_FILES['file']['name']);
        if(strlen($fileName)!=0){
            $fileName = time().'_'.$fileName;
            $targetFilePath = $targetDir . $fileName;
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath);
            if(in_array($fileType['extension'], $allowTypes)){                   
                // Upload file to server
                move_uploaded_file($_FILES['file']['tmp_name'],'upload/images2/'.$fileName);
            }else{
                return response()->json(array('success' => false));
            }
            $images=$targetFilePath;
        }
        return response()->json(array('success' => true, 'image' => $images,'name'=>$fileName));
    }
    public function delete_image(Request $request){
         File::delete('..'.$request->get('link'));
    }
    public function panigate(Request $request){
         $curent_page = $request->page;
         $limit = 10;
         $data= DB::table('import')->count();
         $total_page = ceil($data/$limit);    
          
          if($curent_page>$total_page){
            $curent_page = $total_page;
          }
          elseif ($curent_page<1) {
            $curent_page = 1;
          }

          $start = ($curent_page-1)*$limit;
          $import=DB::table('import')->limit($limit)->offset($start)->get();
          return response()->json(array("import"=>$import,'total_page'=>$total_page,'curent_page',$curent_page));
          
    }

}
