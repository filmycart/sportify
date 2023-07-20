<?php require_once('../../../private/init.php'); ?>

<?php

$response = new Response();
$errors = new Errors();

if(Helper::is_post()){
    $api_token = Helper::post_val("api_token");
    if($api_token){
        $setting = new Setting();
        $setting = $setting->where(["api_token" => $api_token])->one();
        $page = Helper::post_val("page");

        if(!empty($setting)){

            $category_id = Helper::post_val("category_id");
            $categories= new Category();
            $sub_categories = new Sub_Category();
            $categories = $categories->where(["admin_id"=>$setting->admin_id])->andWhere(["status"=>1])->orderBy("id")->desc()->all();

            if(empty($categories)){

                $sub_categories = [];

            }else{

                if($category_id){

                    $sub_categories = $sub_categories->where(["admin_id"=>$setting->admin_id])
                        ->andWhere(["category_id" => $category_id])->andWhere(["status"=>1])->orderBy("id")->desc()->all();



                }else {
                    
                    $sub_categories = $sub_categories->where(["admin_id"=>$setting->admin_id])
                        ->andWhere(["category_id" => $categories[0]->id])->andWhere(["status"=>1])->orderBy("id")->desc()->all();

                }

            }



            $data["categories"] = $categories;
            $data["sub_categories"] = $sub_categories;

            $response->create(200, "Success.", $data);


        }else $response->create(201, "Invalid Api Token", null);
    }else $response->create(201, "No Api Token Found", null);
}else $response->create(201, "Invalid Request Method", null);

echo $response->print_response();

?>