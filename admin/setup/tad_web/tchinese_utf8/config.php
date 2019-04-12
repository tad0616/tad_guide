<?php
$new_config['module_title']      = '班級網頁一覽';
$new_config['schedule_template'] = '<table class="table table-bordered schedule_table">
    <tbody>
        <tr>
            <td class="schedule_head"><strong>時間</strong></td>
            <td class="schedule_head"><strong>節</strong></td>
            <td class="schedule_head"><strong>一</strong></td>
            <td class="schedule_head"><strong>二</strong></td>
            <td class="schedule_head"><strong>三</strong></td>
            <td class="schedule_head"><strong>四</strong></td>
            <td class="schedule_head"><strong>五</strong></td>
            <td class="schedule_head"><strong>六</strong></td>
        </tr>
        <tr>
            <td class="schedule_time">08:00~08:40</td>
            <td class="schedule_section">&nbsp;</td>
            <td class="schedule_cell">導師時間</td>
            <td class="schedule_cell">導師時間</td>
            <td class="schedule_cell">導師時間</td>
            <td class="schedule_cell">導師時間</td>
            <td class="schedule_cell">導師時間</td>
            <td class="schedule_cell">導師時間</td>
        </tr>
        <tr>
            <td class="schedule_time">08:40~09:20</td>
            <td class="schedule_section">一</td>
            <td class="schedule_cell">{1-1}</td>
            <td class="schedule_cell">{2-1}</td>
            <td class="schedule_cell">{3-1}</td>
            <td class="schedule_cell">{4-1}</td>
            <td class="schedule_cell">{5-1}</td>
            <td class="schedule_cell">{6-1}</td>
        </tr>
        <tr>
            <td class="schedule_time">09:30~10:10</td>
            <td class="schedule_section">二</td>
            <td class="schedule_cell">{1-2}</td>
            <td class="schedule_cell">{2-2}</td>
            <td class="schedule_cell">{3-2}</td>
            <td class="schedule_cell">{4-2}</td>
            <td class="schedule_cell">{5-2}</td>
            <td class="schedule_cell">{6-2}</td>
        </tr>
        <tr>
            <td class="schedule_time">10:30~11:10</td>
            <td class="schedule_section">三</td>
            <td class="schedule_cell">{1-3}</td>
            <td class="schedule_cell">{2-3}</td>
            <td class="schedule_cell">{3-3}</td>
            <td class="schedule_cell">{4-3}</td>
            <td class="schedule_cell">{5-3}</td>
            <td class="schedule_cell">{6-3}</td>
        </tr>
        <tr>
            <td class="schedule_time">11:20~12:00</td>
            <td class="schedule_section">四</td>
            <td class="schedule_cell">{1-4}</td>
            <td class="schedule_cell">{2-4}</td>
            <td class="schedule_cell">{3-4}</td>
            <td class="schedule_cell">{4-4}</td>
            <td class="schedule_cell">{5-4}</td>
            <td class="schedule_cell">{6-4}</td>
        </tr>
        <tr>
            <td class="schedule_time">12:00~12:40</td>
            <td class="schedule_section">&nbsp;</td>
            <td class="schedule_note" colspan="6" rowspan="1">午餐時間</td>
        </tr>
        <tr>
            <td class="schedule_time">12:40~13:30</td>
            <td class="schedule_section">&nbsp;</td>
            <td class="schedule_note" colspan="6" rowspan="1">午休時間</td>
        </tr>
        <tr>
            <td class="schedule_time">13:40~14:20</td>
            <td class="schedule_section">五</td>
            <td class="schedule_cell">{1-5}</td>
            <td class="schedule_cell">{2-5}</td>
            <td class="schedule_cell">{3-5}</td>
            <td class="schedule_cell">{4-5}</td>
            <td class="schedule_cell">{5-5}</td>
            <td class="schedule_cell">&nbsp;</td>
        </tr>
        <tr>
            <td class="schedule_time">14:30~15:10</td>
            <td class="schedule_section">六</td>
            <td class="schedule_cell">{1-6}</td>
            <td class="schedule_cell">{2-6}</td>
            <td class="schedule_cell">{3-6}</td>
            <td class="schedule_cell">{4-6}</td>
            <td class="schedule_cell">{5-6}</td>
            <td class="schedule_cell">&nbsp;</td>
        </tr>
        <tr>
            <td class="schedule_time">15:20~16:00</td>
            <td class="schedule_section">七</td>
            <td class="schedule_cell">{1-7}</td>
            <td class="schedule_cell">{2-7}</td>
            <td class="schedule_cell">{3-7}</td>
            <td class="schedule_cell">{4-7}</td>
            <td class="schedule_cell">{5-7}</td>
            <td class="schedule_cell">&nbsp;</td>
        </tr>
        <tr>
            <td class="schedule_time">&nbsp;</td>
            <td class="schedule_section">八</td>
            <td class="schedule_cell">{1-8}</td>
            <td class="schedule_cell">{2-8}</td>
            <td class="schedule_cell">{3-8}</td>
            <td class="schedule_cell">{4-8}</td>
            <td class="schedule_cell">{5-8}</td>
            <td class="schedule_cell">&nbsp;</td>
        </tr>
    </tbody>
</table>';
$new_config['schedule_subjects'] = '國語;數學;社會;自然;音樂;體育;美勞;團體活動;輔導活動;鄉土教學;道德與健康';
$new_config['aboutus_cols']      = ['counter', 'web', 'schedule', 'homework'];

$new_config['cal_cols']         = ['all', 'web', 'news', 'homework'];
$new_config['user_space_quota'] = '500';
$new_config['list_web_order']   = 'WebSort';

$mod_config['name']   = '班級網頁';
$mod_config['weight'] = '16';
