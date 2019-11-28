<?php


class ctrl_test_call
{
    private static $base_url = 'http://47.98.188.59/game01/mock/?act=test_back&st=game_reword';
    private static $mid = 938;
    public static $token = 'cc47e8894d43f260e143d70994267946';

    //test
    public function call(){
        echo "01:call=====<br>";
        $params = [
            'acts' => 'fast_reg_utoken',
            'act_type' => 1,
            'mid' => 938,
            'resource_id' => 49,
            'from' => "h5ios",
            'version' => '2.0',
            'sign' => "800ad0b15fac87393a1e445718642a94",
        ];
        echo "02:call=========<br>";
        var_dump($params);
        $res = common_curl_help::curlGet(self::$base_url, $params);
        echo "<br>==========00===============<br>";
        print_r($res);
        // echo "<br>==========01===============<br>";
        //		// echo json_encode($res,JSON_UNESCAPED_UNICODE);

        $prize_lists = common_curl_help::printNx($res, ['data', 'prize_lists'], []);
        if (empty($prize_lists)) echo ('有效数据为空~！');

        foreach ($prize_lists as $v) {
            $data['prize_id'] = $v['prize_id'];
            $data['title'] = $v['title'];
            $data['task_id'] = $v['task_id'];
            $data['task_type'] = $v['type'];
            $data['task_prize'] = $v['task_prize'];
            $data['deal_prize'] = $v['deal_prize'];
            $data['task_prize_coin'] = $v['task_prize_coin'];
            echo "=============begin=============";
            print_r($data);
            echo "=============end=============";
        }

    }

    function curl(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://test-task.handtoutiao.com/user/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "sign=4C2E68D3A547445CB34391D095752D4E&timestamp=1574327829&phone=17612119533&verify_code=463198&ali_device_token=",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Accept-Language: zh-Hans-CN;q=1",
                'Appinfo: {"net_type":"wifi","market":"appStore","idfa":"49FD70BF-6CEF-43AE-9A4F-A592D4E5670","source":"1","os":"ios","platform":"iPhone9,2","ver":"2.0.0","device_id":"2486aaaaaaaaaaaaaaabbbbbbbbbb","os_ver":"12.3.1","device":"iPhone 7 Plus","os_type":"ios","name":"mmjz"}',
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: 113",
                "Content-Type: application/x-www-form-urlencoded",
                "Cookie: _csrf=9b7ffe5dd9512de78a931b4025b8c0962ab20b87e9c2d670ef18c1f81afe9e0ca%3A2%3A%7Bi%3A0%3Bs%3A5%3A%22_csrf%22%3Bi%3A1%3Bs%3A32%3A%22vN7e-UCFeoLwcSv4X8ClC-f2qv0XDdEq%22%3B%7D",
                "Host: test-task.handtoutiao.com",
                "Postman-Token: a5f09dc5-321c-49cc-831d-0c6f47cb6f8b,fabebcbd-1995-49a5-8b02-6ee9798ca834",
                "User-Agent: kdxj/2.0.0",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
}