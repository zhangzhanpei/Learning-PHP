// 不使用mb系列函数，截取中英混合字符串
function cut($str, $len)
{
    $j = 0;
    $k = 0;
    $n = strlen($str);
    while ($k < $len && $j < $n) {
        // 如果是中文，占3个字节
        if (ord($str[$j]) > 127) {
            $j += 3;
        } else {
            $j++;
        }
        $k++;
    }
    return substr($str, 0, $j);
}
