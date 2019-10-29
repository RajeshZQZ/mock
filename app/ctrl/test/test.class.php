<?php


class test
{

    private static $base_url = 'http://47.98.188.59/game01/mock/?act=test_test&st=call_back';
    private static $mid = 938;
    public static $token = 'cc47e8894d43f260e143d70994267946';

    //test
    public function call(){

        $params = [
            'act' => 'fast_reg_utoken',
            'act_type' => 1,
            'mid' => 938,
            'resource_id' => 49,
            'from' => "h5ios",
            'version' => '2.0',
            'sign' => "800ad0b15fac87393a1e445718642a94",
        ];

        $res = CurlHelp::curlGet(self::$base_url, $params);
        // echo "<br>==========00===============<br>";
        print_r($res);
        // echo "<br>==========01===============<br>";
        //		// echo json_encode($res,JSON_UNESCAPED_UNICODE);

        $prize_lists = CurlHelp::printNx($res, ['data', 'prize_lists'], []);
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

    function call_back(){

        header('Content-Type:application/json');
        $params = [
            "code"=>1,
            "msg" => "ok",
            "data" => [
                "totize"=>0.6,
                "total_prize_coin"=>0.6,
                "prize_lists" => [
                    [
                        "name" => "赤壁斗地主iOS3期",
                        "type"=>1,
                        "prize_id"=>rand(10000000,99999999),
                        "prize_time"=>time(),
                        "task_id"=>88145,
                        "title" => "手机注册并试玩3局(新用户专享)",
                        "ad_id"=>13865,
                        "task_prize"=>0.6,
                        "task_prize_coin"=>0.6,
                        "deal_prize" => 0.6
                    ],
                    [
                        "name" => "赤壁斗地主iOS3期",
                        "type"=>1,
                        "prize_id"=>rand(10000000,99999999),
                        "prize_time"=>time(),
                        "task_id"=>88146,
                        "title" => "手机注册并试玩10局(新用户专享)",
                        "ad_id"=>13865,
                        "task_prize"=>0.8,
                        "task_prize_coin"=>0.8,
                        "deal_prize" => 0.8
                    ]
                ]
            ]
        ];

        $arr_res = json_encode($params,JSON_UNESCAPED_UNICODE);
        echo $arr_res;
    }


}