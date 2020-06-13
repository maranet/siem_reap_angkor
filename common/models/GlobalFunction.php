<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Image\Box;
use DateTime;


class GlobalFunction 
{

   

    public static function calculateProgress($current, $all){
        $result = ($current / max($all, 1)) * 100;
        return number_format($result,2);
    }

    public static function WorkingGroup() {
        $id_employee = Yii::$app->user->identity->id_employee;

        $id_working_group = 0;
        $employee_profile = \backend\models\EmployeeProfile::find()
            ->where(['id'=> $id_employee])
            ->one();
        if(!empty($employee_profile)){
            $id_working_group = $employee_profile->id_working_group;
        }        

        $working_group = \backend\models\WorkingGroupData::find()
            ->select('id_user')
            ->where(['id_working_group'=> $id_working_group])
            ->all();

        array_push($working_group, ['id_user'=>Yii::$app->user->identity->id]);

        $arr_working_group = array('');
        foreach ($working_group as $row)
        {
            $explode =  explode(",", $row["id_user"]);
            foreach ($explode as $ex){
                array_push($arr_working_group,$ex);
            }
        }
        return $arr_working_group;
    }

    public function GenerateDocumentID($tbl,$fieldname){

        $format = \backend\models\CompanyProfile::find()->where(['company_id'=>$_SESSION['company_id']])->one();
        $date = date('ym');

        $db_name = explode('=', Yii::$app->db->dsn)[2];

        $created_date = Yii::$app->db->createCommand("SELECT created_date from $tbl order by created_date desc limit 1")->queryScalar();

        if($format == ""){
            $name = "";           
        }else{ 
            if($fieldname == "proposal"){
                $name = $format->proposal;
            }elseif($fieldname == "quotation"){
                $name = $format->quotation;
            }elseif($fieldname == "contract"){
                $name = $format->contract;
            }elseif($fieldname == "expense"){
                $name = $format->expense;
            }elseif($fieldname == "receipt"){
                $name = $format->receipt;
            }elseif($fieldname == "invoice"){
                $name = $format->invoice;
            }else{
                $name = "";           
            }
          
        }        
        
        if($created_date ==""){
            $id = 1;
            return $name.$date . str_pad($id, 4, '0', STR_PAD_LEFT);
        }else{
            $last_date = date_create($created_date);
            $format_date = date_format($last_date,'ym');   

            if($format_date != $date){
                $id = 1;
                return $name.$date . str_pad($id, 4, '0', STR_PAD_LEFT);
            }else{
                $id = Yii::$app->db->createCommand('SELECT AUTO_INCREMENT as id
                                FROM information_schema.TABLES
                                WHERE TABLE_SCHEMA = "'.$db_name.'"
                                AND TABLE_NAME = "'.$tbl.'"')->queryScalar();
                
                return $name.$date . str_pad($id, 4, '0', STR_PAD_LEFT);
            }
        }
    
    }

    public function OfficialDocumentHeader(){
        $base_url = Yii::getAlias('@web');
        $company_profile = \backend\models\CompanyProfile::find()->select(['names','logo','address','vattin','website','email','tel'])->one();
        if(!empty($company_profile)){

            $id_logo = $company_profile->logo;

            $logo = Yii::$app->db->createCommand("SELECT filename FROM uploaded_file WHERE id = :id")->bindParam(':id',$id_logo)->queryOne();
            if(empty($logo)){
                $img = "backend/uploads/NoPicAvailable.png";
            }else{
                if($logo['filename'] == ''){
                    $img = "backend/uploads/NoPicAvailable.png";    
                }else{
                    $img = $logo['filename'];    
                }                
            }
            
            $url = filter_var($company_profile->website, FILTER_VALIDATE_URL) ? $company_profile->website : 'http://'. $company_profile->website;
            // $image_path = $this->resizeImage($img,115,115);
            // $image_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $img);
            $image_path = $base_url.'/'.$img;
            return '<header style="border-bottom: 1px solid #ccc; padding-bottom:5px; margin-top:0px; position:absoluted; top:5px;">
                    <table style="color:#1c3550;" width="100%">
                        <tr>
                            <td valign="top">
                                <table>
                                    <tr>
                                        <td style="margin: 0; font-style: normal; font-size:25px;">
                                            '.$company_profile->names.'
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td height = "15px"; style="font-size: 12px;">Tel: <a style="color: #0391d1; text-decoration: none;" href="tel:'.$company_profile->tel.'">'.$company_profile->tel.'</a></td>
                                    </tr>   
                                    <tr>
                                        <td height = "15px"; style="font-size: 12px;">Email: <a style="color: #0391d1; text-decoration: none;" href="mailto:'.$company_profile->email.'">'.$company_profile->email.'</a></td>
                                    </tr>                                 
                                    <tr>
                                        <td height = "15px"; style="font-size: 12px;">Website: <a style="color: #0391d1; text-decoration: none;" href="'.$url.'" target="_blank">'.$url.'</a></td>
                                    </tr>
                                    <tr>
                                        <td height = "15px"; style="font-size: 12px; max-width: 200px;">Address: '.$company_profile->address.'</td>
                                    </tr>                               
                                </table>
                            </td>
                            <td valign="top" align="right" style="padding-top: 25px;" height="60px" width="170px">
                                <img height="60px" width="170px" style="position:relative;" src="'.$image_path.'">
                            </td>
                        </tr>
                    </table>
                </header>';
            // return '<header style="border-bottom: 1px solid #ccc; padding-bottom:5px; margin-top:0px; position:absoluted; top:5px;">
            //         <table style="color:#1c3550;">
            //             <tr>
            //                 <td valign="top" style="padding-top: 25px;" height="60px" width="170px">
            //                     <img height="60px" width="170px" style="position:relative;" src="'.$image_path.'">
            //                 </td>
            //                 <td valign="top" style="padding-left: 20px;">
            //                     <table>
            //                         <tr>
            //                             <td style="margin: 0; font-style: normal; font-size:25px;">
            //                                 '.$company_profile->names.'
            //                             </td>
            //                         </tr>
            //                         <tr>
            //                             <td height = "15px";  style="font-size: 12px;">VATTIN : '.$company_profile->vattin.' </td>
            //                         </tr>
            //                         <tr>
            //                             <td height = "15px"; style="font-size: 12px;">Address: '.$company_profile->address.'</td>
            //                         </tr>
            //                         <tr>
            //                             <td height = "15px"; style="font-size: 12px;">Tel: <a style="color: #0391d1; text-decoration: none;" href="tel:'.$company_profile->tel.'">'.$company_profile->tel.'</a></td>
            //                         </tr>   
            //                         <tr>
            //                             <td height = "15px"; style="font-size: 12px;">Email: <a style="color: #0391d1; text-decoration: none;" href="mailto:'.$company_profile->email.'">'.$company_profile->email.'</a></td>
            //                         </tr>                                 
            //                         <tr>
            //                             <td height = "15px"; style="font-size: 12px;">Website: <a style="color: #0391d1; text-decoration: none;" href="'.$url.'" target="_blank">'.$url.'</a></td>
            //                         </tr>
            //                     </table>
            //                 </td>
            //             </tr>
            //         </table>
            //     </header>';
        }else{
            return '<center><h2>Have no Company Profile</h2></center> ';
        }
        
    }

    public function resizeImage($image_server_path,$width,$height){

        $image_path = $image_server_path;


        $server_path = $_SERVER['DOCUMENT_ROOT']. Yii::getAlias('@web').'/backend';
        $directory = $server_path. "/uploads/temps/";
        $filePath = Yii::getAlias("@web/backend/uploads/temps/");
        $thumbDir =$server_path. "/uploads/thumb/temps/";
        $thumbPath = Yii::getAlias("@web/backend/uploads/thumb/temps/");
        $db_path = "uploads/temps/";

        $imagine = Image::getImagine();
        $image = $imagine->open($_SERVER['DOCUMENT_ROOT']. Yii::getAlias('@web').'/'.$image_path);
        $file_extension = explode('.',$image_path);
        if(!empty($file_extension)){

        
            $file_extension =strtolower($file_extension[1]);

        
                
            if (!is_dir($directory)) {
                FileHelper::createDirectory($directory); 
                    
            }
        
            
        
            if($file_extension == "jpg"  || $file_extension=="png"){
                // Image::thumbnail($file_path, 240, 240)->save($file_thumb, ['quality' => 100]);
                // $file_thumb = $thumbPath .  $fileName;
                $uid = uniqid(time(), true);
                $fileName = $uid.'logo_temp.'.$file_extension;
                $image->resize(new Box($width, $height))->save($directory. $fileName, ['quality' => 100]);
                
                $db_thumbnail_path  = "uploads/". "temps"."/". $fileName;

                $current_date = new DateTime(Date('Y-m-d H:i:s'));
                $current_date->modify('-1 Day');
                $current_date = $current_date->format('Y-m-d H:i:s');
                $current_date = strtotime($current_date);

                $find_temp_file = glob($directory."*.*");
                
                foreach($find_temp_file as $key => $filename){
                    $file_date = date ("Y-m-d H:i:s", filemtime($filename));
                    $file_date = strtotime($file_date);

                    if($file_date <= $current_date){
                        if(file_exists($filename) && $filename != Url::to('@web/backend/'.$db_thumbnail_path,true)){
                            try{
                                unlink($filename);
                            }catch(\Exception $e){

                            }
                        }
                    }

                }
                

                // echo "<img alt='logo' width='".$width."' height='".$height."' src='".Url::to('@web/backend/'.$db_thumbnail_path,true)."'>";
                return Url::to('@web/backend/'.$db_thumbnail_path,true);

                
                
                
            }else{
                return Url::to('@web/backend/uploads/NoPicAvailable.png',true);
                // echo "<img alt='logo' width='".$width."' height='".$height."' src='".Url::to('@web/backend/uploads/NoPicAvailable.png',true)."'>";
                
            }

        }else{
            return Url::to('@web/backend/uploads/NoPicAvailable.png',true);
            // echo "<img alt='logo' width='".$width."' height='".$height."' src='".Url::to('@web/backend/uploads/NoPicAvailable.png',true)."'>";
                
        }
    }

    //function read money to be letter
        public function readMoneytoLetter($money){
            $length = strlen($money);
            $length = (int)$length;
            $cent = $length - 3;
            $cent = (int)$cent;

            $usd = substr($money,0,$cent);

            $cent = substr($money,-2);
            $cent = (int)$cent;

            $usd = $this->convertNumberToWord($usd);

            if ($cent == 1){
                $cent = $this->convertNumberToWord($cent);
                echo strtoupper( substr( $usd, 0, 2 ) ).substr($usd, 2 )." and ".$cent."cent US dollar";
            }else if($cent > 1){
                $cent = $this->convertNumberToWord($cent);
                echo strtoupper( substr( $usd, 0, 2 ) ).substr($usd, 2 )." and ".$cent."cents US dollar";
            }else{                                    
                echo strtoupper( substr( $usd, 0, 2 ) ).substr($usd, 2 )." US dollar";
            }                                        
        }

        function convertNumberToWord($num)
            {
                $num = str_replace(array(',', ' '), '' , trim($num));
                if(! $num) {
                    return false;
                }
                $num = (int) $num;
                $words = array();
                $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
                    'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
                );
                $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
                $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
                    'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
                    'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
                );
                $num_length = strlen($num);
                $levels = (int) (($num_length + 2) / 3);
                $max_length = $levels * 3;
                $num = substr('00' . $num, -$max_length);
                $num_levels = str_split($num, 3);
                for ($i = 0; $i < count($num_levels); $i++) {
                    $levels--;
                    $hundreds = (int) ($num_levels[$i] / 100);
                    $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
                    $tens = (int) ($num_levels[$i] % 100);
                    $singles = '';
                    if ( $tens < 20 ) {
                        $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
                    } else {
                        $tens = (int)($tens / 10);
                        $tens = ' ' . $list2[$tens] . '';
                        $singles = (int) ($num_levels[$i] % 10);
                        
                        //show 66 = sixty six
                        $singles = ' ' . $list1[$singles] . ' ';

                        //to show 66 = sixty-six
                        // if($singles != 0){
                        //     $singles = '-' . $list1[$singles] . ' ';
                        // }else{
                        //     $singles = ' ' . $list1[$singles] . ' ';
                        // }
                        
                    }
                    $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
                } //end for loop

                $commas = count($words);
                if ($commas > 1) {
                    $commas = $commas - 1;
                }
                return implode(' ', $words);
            }
    //end function read money to be letter

    public function getColumnListAsArray(){ //return an array just put string items as argument
        $num_fild = func_num_args();
        $arg_list = func_get_args();
        $arr = [];

        for ($i=0; $i < $num_fild ; $i++) { 
            $arr[$i] = $arg_list[$i];            
        }
        return $arr;
    }

    private function getTableNames($dbname,$fieldname)
    {
        $table_name = Yii::$app->db->createCommand('
                SELECT DISTINCT
                    TABLE_NAME as tbl_name 
                FROM
                    INFORMATION_SCHEMA.COLUMNS 
                WHERE
                    COLUMN_NAME IN ("'.$fieldname.'") 
                    AND TABLE_SCHEMA = :db
            ')
        ->bindParam(':db', $dbname)        
        ->queryAll();

        return $table_name;
    }    

//function check data inuse that will return 0 if un-use and 1 or bigger if in-use
    public function getDataInUse($id,$arr){  

        //arr get from function getColumnListAsArray()     
        
        $exist = 0;
        
        $db_name = explode('=', Yii::$app->db->dsn)[2];
        
        foreach ($arr as $key => $value) {
            
            $table_name = $this->getTableNames($db_name,$value);

            if(!empty($table_name)){

                foreach ($table_name as $key => $field) {
                    $table = $field['tbl_name'];
                    $exist_field = Yii::$app->db->createCommand('
                            SELECT EXISTS( SELECT * FROM '.$table.' WHERE '.$value.' = '.$id.') as exist
                        ')->queryScalar();                   

                    $exist += $exist_field;
                                                      
                }                   
            }            
        }
        return $exist;

    }

    public static function UploadSingleImage($path)
    {   

        /*
            $path should be "/controller_name/sub_folder/"
        */
        if($path ===''){
            $path = "/other//".Date('Y-m-d_H:i:s');
        }
      


        /*

            *file must pass from Yii2 UploadedFile:: (Get Instant)
            https://www.yiiframework.com/doc/api/2.0/yii-web-uploadedfile


            example: 
                $file = \yii\web\UploadedFile::getInstanceByName('file');
                $uploaded_file = \common\models\GlobalFunction::UploadSingleImage($file,$path);
         

        */
        $file = \yii\web\UploadedFile::getInstanceByName('file');

        if(empty($file)) return false;


       
        $original_fileName = strtolower($file->name);
        $file_size = $file->size; // file size in bytes
        

        // $server_path = $_SERVER['DOCUMENT_ROOT']. Yii::getAlias('@web').'/backend';
        $server_path = $_SERVER['DOCUMENT_ROOT']. Yii::getAlias('@web');

        $directory = $server_path. "/uploads$path";
        $filePath = Yii::getAlias("@web/backend/uploads$path");
        $thumbDir =$server_path. "/uploads/thumb$path";
        $thumbPath = Yii::getAlias("@web/backend/uploads/thumb$path");
        $db_path = "uploads$path";
       
         
        if (!is_dir($directory)) {
           FileHelper::createDirectory($directory); 
               
        }
        if (!is_dir($thumbDir)) {
            FileHelper::createDirectory($thumbDir); 
        }
       
        if (isset($file)) {
            $file_extension = $file->extension;

            $uid = uniqid(time(), true);
            
            $fName = str_replace("." . $file_extension,"",$original_fileName);
            $nUid = str_replace(".","",$uid);
            $fileName = $fName . '-' . $nUid . '.' . $file_extension;
            $filePath = $directory . $fileName;
            if ($file->saveAs($filePath)) {

                $path = $filePath;

                $file_path = $directory .  $fileName;

                $file_thumb = $thumbDir .  $fileName;

                $db_thumbnail_path = "";
                if($file_extension == "gif" || $file_extension == "jpg"  || $file_extension=="png"){
                    // Image::thumbnail($file_path, 240, 240)->save($file_thumb, ['quality' => 100]);
                    // $file_thumb = $thumbPath .  $fileName;

                    $imagine = Image::getImagine();
                    $image = $imagine->open($filePath);
                    $image->resize(new Box(250, 125))->save($file_thumb, ['quality' => 100]);
                    
                    $db_thumbnail_path  = "uploads/thumb". $path;

                    
                    
                }elseif(
                //file extenstion words
                $file_extension == "doc" ||
                $file_extension == "dot" ||
                $file_extension == "wbk" ||
                $file_extension == "docx" ||
                $file_extension == "docm" ||
                $file_extension == "dotx" ||
                $file_extension == "dotm" ||
                $file_extension == "docb" 
            
                ){

                $db_thumbnail_path  = "uploads/thumb/". 'icon-word.png';
            }
            elseif(
                //file extenstion excel
                $file_extension == "xls" ||
                $file_extension == "xlt" ||
                $file_extension == "xlm" ||
                $file_extension == "xlsx" ||
                $file_extension == "xlsm" ||
                $file_extension == "xltx" ||
                $file_extension == "xltm" ||
                $file_extension == "xlsb" ||
                $file_extension == "xla" ||
                $file_extension == "xlam" ||
                $file_extension == "xll" ||
                $file_extension == "xlw" 
                ){

                $db_thumbnail_path  = "uploads/thumb/". 'icon-excel.png';
            }
            elseif(
                //file extenstion power point
                $file_extension == "ppt" ||
                $file_extension == "pot" ||
                $file_extension == "pps" ||
                $file_extension == "pptx" ||
                $file_extension == "pptm" ||
                $file_extension == "potx" ||
                $file_extension == "potm" ||
                $file_extension == "ppam" ||
                $file_extension == "ppsx" ||
                $file_extension == "ppsm" ||
                $file_extension == "sldx" ||
                $file_extension == "sldm" 
            
                ){
                $db_thumbnail_path  = "uploads/thumb/". 'icon-powerpoint.png';
                
            }
            elseif(
                //file extenstion access
                $file_extension == "accdb" ||
                $file_extension == "accde" ||
                $file_extension == "accdt" ||
                $file_extension == "accdr" 
                ){
                $db_thumbnail_path  = "uploads/thumb/". 'icon-access.png';
                
            }
            elseif(
                //file extenstion publisher
                $file_extension == "pub" ||
                $file_extension == "xps" 
                
                ){

                $db_thumbnail_path  = "uploads/thumb/". 'icon-publisher.png';
            }
            elseif(
                //file extenstion publisher
                $file_extension == "pdf" ||
                $file_extension == "html"
                
                ){

                $db_thumbnail_path  = "uploads/thumb/". 'icon-pdf.png';
            }else {
                    
                    $db_thumbnail_path = "uploads/thumb/icon-default.jpg";
            }
                // Save file to database
                $model_file = new \backend\modules\v1\models\UploadedFile();
                $model_file->file_path =$db_path . $fileName;
                $model_file->thumbnail = $db_thumbnail_path;
                $model_file->size = $file_size;
                $model_file->name = $original_fileName;
                $model_file->type = $file_extension;
                $model_file->status = 1;
            if($model_file->save()){
                    $item = ['id'=>$model_file->id,'file'=>$model_file->getAttributes()];
                    return $item;
                }else{
                    return  false;
                }
            
            }else{
                return false;
            }
            
        }  
       
        
    }
    
}
 