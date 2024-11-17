<{foreach from=$all_modules key=mid item=module}>
<h3><{$module.name}> (<{$module.dirname}>)</h3>
<div class="row">
    <div class="col-4">偏好設定共 <{$config_count.$mid}> 項
    <textarea name="config" id="config" class="form-control" style="font-size:12px;" placeholder="無偏好設定" rows="<{if $config_count.$mid > $block_count.$mid*2}><{$config_count.$mid}><{else}><{$block_count.$mid*2}><{/if}>"><{foreach from=$modules_config.$mid key=conf_name item=conf_value}>$new_config['<{$conf_name}>'] = '<{$conf_value}>';
<{/foreach}>
</textarea>
    </div>
    <div class="col-8">區塊共 <{$block_count.$mid}> 個
        <textarea name="block" id="block" class="form-control" style="font-size:12px;" placeholder="無區塊" rows="<{if $config_count.$mid > $block_count.$mid*2}><{$config_count.$mid}><{else}><{$block_count.$mid*2}><{/if}>"><{foreach from=$modules_block.$mid key=bid item=block}>//<{$block.name}>
$new_data[] = ['options' => '<{$block.options}>', 'title' => '<{$block.title}>', 'side' => '<{$block.side}>', 'weight' => '<{$block.weight}>', 'visible' => '<{$block.visible}>'];
<{/foreach}>
</textarea>
    </div>
</div>
<{/foreach}>