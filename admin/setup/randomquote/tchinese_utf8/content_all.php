<?php
function randomquote_content($cate_sn = "")
{
    global $xoopsDB;

    // $sql="delete from `".$xoopsDB->prefix("citas")."`";
    // $xoopsDB->queryF($sql) or web_error($sql,  __FILE__, __LINE__);

    $sql = "INSERT INTO `" . $xoopsDB->prefix("citas") . "` (`texto`, `autor`) VALUES
  ('◎ 脾氣嘴巴不好，心地再好也不能算好人。', '證嚴法師'),
  ('◎ 話多不如話少，話少不如話好',  '證嚴法師'),
  ('◎ 口說好話，心想好意，身行好事，腳走好路。', '證嚴法師'),
  ('◎ 口說一句好話，如口出蓮花；口說一句壞話，如口吐毒蛇。', '證嚴法師'),
  ('◎ 一句溫暖的話，就像往別人的身上灑香水，自己會沾上一兩滴。', '證嚴法師'),
  ('◎ 說人是非，傷人傷己，好話要多說，是非不要提。', '證嚴法師'),
  ('◎ 靜坐常思已過、閒談莫論人非。', '證嚴法師'),
  ('◎ 要批評別人時，先想想自己是否完美無缺。',  '證嚴法師'),
  ('◎ 不要把能說話的嘴巴，用在搬弄是非上。', '證嚴法師'),
  ('◎ 心要常常保持快樂，就必須不把人與人之間的事當成是非。', '證嚴法師'),
  ('◎ 是非當教育，讚美當警惕。', '證嚴法師'),
  ('◎ 發脾氣對內對外都是煩惱，對內是指自己生煩惱，對外是指困擾他人。',  '證嚴法師'),
  ('◎ 對人要寬心，講話要細心。', '證嚴法師'),
  ('◎ 謊言就像一朵盛開的鮮花，外表美麗，生命短暫。', '證嚴法師'),
  ('◎ 將嘲笑視同啟發，把諷刺當作激勵。', '證嚴法師'),
  ('◎ 看別人不順眼，是自己修養不夠。',  '證嚴法師'),
  ('◎ 欣賞別人就是莊嚴自己。',  '證嚴法師'),
  ('◎ 以佛心看人，則遍地都是佛。以鬼心看人，則處處是猙獰的惡鬼。',  '證嚴法師'),
  ('◎ 心美看什麼都順眼。',  '證嚴法師'),
  ('◎ 愛不是要求對方，而是要由自身的付出。', '證嚴法師'),
  ('◎ 道德是提昇自我的明燈，不該是呵斥別人的鞭子。', '證嚴法師'),
  ('◎ 一個人的快樂，不是因為他擁有的多，而是因為他計較得少。',  '證嚴法師'),
  ('◎ 地上種了菜，就不易長草；心中有善，就不易生惡。',  '證嚴法師'),
  ('◎ 生氣，就是拿別人的過錯來懲罰自己。',  '證嚴法師'),
  ('◎ 自己害自己，莫過於亂發脾氣。', '證嚴法師'),
  ('◎ 我們最大的敵人不是別人，可能是自己。', '證嚴法師'),
  ('◎ 不要小看自己，因為人有無限的可能。',  '證嚴法師'),
  ('◎ 盡多少本分，就得多少本事。',  '證嚴法師'),
  ('◎ 滴水成河，粒米成籮，勿以善小而不為。', '證嚴法師'),
  ('◎ 小事不做，大事難成。', '證嚴法師'),
  ('◎ 人生最大的成就，是從失敗中站起來。',  '證嚴法師'),
  ('◎ 為自己找藉口的人，永遠不會進步。', '證嚴法師'),
  ('◎ 信心、毅力、勇氣三者具備，則天下沒有做不成的事。', '證嚴法師'),
  ('◎ 每天無所事事，是人生的消費者，積極有用，才是人生的創造者。',  '證嚴法師'),
  ('◎ 人的心地是一漥田，土地沒有播下好種子，也長不出好的果實。', '證嚴法師'),
  ('◎ 知識要用心體會，才能變成自己的智慧。', '證嚴法師'),
  ('◎ 有智慧才能分辨善惡邪正；有謙虛才能建造美滿人生。', '證嚴法師');
  ";

    $xoopsDB->queryF($sql) or web_error($sql,  __FILE__, __LINE__);
}
