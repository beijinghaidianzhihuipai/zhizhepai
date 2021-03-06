
<?php
class sendMSG{
    static public function baseInfo($report_id,$mobile_array,$title,$url){

        $apikey = "54cae413bd079b5fc80e601f70add178"; //修改为您的apikey(https://www.yunpian.com)登录官网后获取

        $ch = curl_init();
        /* 设置验证方式 */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept:text/plain;charset=utf-8',
            'Content-Type:application/x-www-form-urlencoded',
            'charset=utf-8')
        );

        /* 设置返回结果为流 */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        /* 设置超时时间*/
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        /* 设置通信方式 */
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // 取得用户信息
        $json_data = self::get_user($ch,$apikey);
        //$array = json_decode($json_data,true);

        // 发送模板短信
        // 需要对value进行编码
        foreach($mobile_array as $val){
            $send_check = array(
                'report_id' => $report_id ,
                'user_id' => $val['id']
            );

            $send_cehck_rel = \App\model\ZzpUserPhoneMsg::check_send_report($send_check);
            //print_r($send_cehck_rel);die;
            if(!$send_cehck_rel){
                $data=array(
                    'tpl_id'=>'1933080',
                    'tpl_value' => '#title#'.'='.urlencode($title),
                    'apikey' => $apikey,
                    'mobile' => $val['phone_num']);
                //print_r($data);die;
                $json_data = self::tpl_send($ch,$data);
                $msg_rel = json_decode($json_data,true);

                if(isset($msg_rel['msg']) && $msg_rel['msg'] == '发送成功' ){
                    $send_data = array('user_id' => $val['id'],'report_id' => $report_id);
                    \App\model\ZzpUserPhoneMsg::add($send_data);
                    echo "\n".'用户ID: '. $val['id']. ' 短信 '.$msg_rel['msg'];
                }else{
                    Log::info( "\n".'用户ID: '. $val['id']. ' 短信失败 '.$msg_rel['msg']);
                   echo  "\n".'用户ID: '. $val['id']. ' 短信失败 '.$msg_rel['msg'];
                }
            }

           // echo '<pre>';
        }


    }

    //获得账户
    static public function get_user($ch,$apikey){
        curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/user/get.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('apikey' => $apikey)));
        $result = curl_exec($ch);
        $error = curl_error($ch);
        self::checkErr($result,$error);
        return $result;
    }

    static public function tpl_send($ch,$data){
        curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/tpl_single_send.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($ch);
        $error = curl_error($ch);
        self::checkErr($result,$error);
        return $result;
    }

    static function checkErr($result,$error) {
        if($result === false) {
            echo 'Curl error: ' . $error;die;
        }else {
            //echo '操作完成没有任何错误';
            
            }
    }
}
