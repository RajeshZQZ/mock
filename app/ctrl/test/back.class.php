<?php


class ctrl_test_back
{

    function game_reword(){

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