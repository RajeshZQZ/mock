<?php


class ctrl_test_call
{
    private static $base_url = 'http://47.98.188.59/game01/mock/?act=test_back&st=game_reword';
    private static $mid = 938;
    public static $token = 'cc47e8894d43f260e143d70994267946';

    //test
    public function test(){
        $params = [
            'acts' => 'fast_reg_utoken',
            'act_type' => 1,
            'mid' => 938,
            'resource_id' => 49,
            'from' => "h5ios",
            'version' => '2.0',
            'sign' => "800ad0b15fac87393a1e445718642a94",
        ];

        $res = common_curl_help::curlGet(self::$base_url, $params);
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
            echo "<br>=============begin=============<br>";
            print_r($data);
            echo "<br>=============end=============<br>";
        }

    }

}