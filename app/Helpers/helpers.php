<?php
require_once '_url.php';
require_once '_custom-fields.php';
require_once '_products.php';
require_once '_date-time.php';
require_once '_settings.php';

if (! function_exists('_getPageTemplate')) {
    /**
     * Get template for Page, Post, Category, ProductCategory
     * @return array
     **/
    function _getPageTemplate($type = 'Page')
    {
        $content = file_get_contents(app_path('Http/Controllers/Front/' . $type . 'Controller.php'));
        $arrTmp = explode('Template Name:', $content);
        $arrTemplate = [];
        if (count($arrTmp) > 1) {
            foreach ($arrTmp as $key => $value) {
                if ($key > 0) {
                    $arrValue = explode('*/', $value);
                    $arrValue = explode('-', $arrValue[0]);
                    array_push($arrTemplate, trim($arrValue[0]));
                }
            }
        }
        return $arrTemplate;
    }
}

if (! function_exists('_validateGoogleCaptcha')) {
    function _validateGoogleCaptcha($response = null)
    {
        $secret = env('RECAPTCHA_SECRET_KEY');
        if (!$response || !$secret) {
            return false;
        }

        $result = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response));
        return $result->success;
    }
}

if (! function_exists('_sendEmail')) {
    function _sendEmail($view, $subject, $data, $to = [], $cc = [], $bcc = [])
    {
        return \Mail::send($view, $data, function ($message) use ($subject, $to, $cc, $bcc) {
            foreach ($to as $key => $row) {
                $message->to($row['email'], $row['name'])->subject($subject);
            }
            foreach ($cc as $key => $row) {
                $message->cc($row['email'], $row['name'])->subject($subject);
            }
            foreach ($bcc as $key => $row) {
                $message->bcc($row['email'], $row['name'])->subject($subject);
            }
        });
    }
}

if (! function_exists('_stripTags')) {
    function _stripTags($data, $allowTags = '<p><a><br><br/><b><strong>')
    {
        if (!is_array($data)) {
            return strip_tags($data, $allowTags);
        }
        foreach ($data as $key => $row) {
            $data[$key] = strip_tags($row, $allowTags);
        }
        return $data;
    }
}

if (! function_exists('_resizeImage')) {
    function _resizeImage($thumb = '', $name = '')
    {
        if($name != '' && $thumb != '') {
            $CMSSettings = \App\Models\Setting::getAllSettings();
            $image = Image::make(public_path($thumb));
            /*Get size Large*/
            $large = $CMSSettings['large_image'];
            $ex_large = explode('x', $large);
            $w_large = $ex_large[0];
            $h_large = $ex_large[1];

            $image->resize($w_large, $h_large)
                            ->save(public_path('uploads/large/'.$name));

            /*Get size Normal*/
            $normal = $CMSSettings['normal_image'];
            $ex_normal = explode('x', $normal);
            $w_normal = $ex_normal[0];
            $h_normal = $ex_normal[1];

            $image->resize($w_normal, $h_normal)
                            ->save(public_path('uploads/normal/'.$name));

            /*Get size Small*/
            $small = $CMSSettings['small_image'];
            $ex_small = explode('x', $small);
            $w_small = $ex_small[0];
            $h_small = $ex_small[1];
            
            $image->resize($w_small, $h_small)
                            ->save(public_path('uploads/small/'.$name));
            
            return ;
        }
    }
}

/*UNIQUE IN ARRAY*/
if (! function_exists('_unique_multidim_array')) {
    function _unique_multidim_array($array, $key) {
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 
        
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
        return $temp_array; 
    }
}