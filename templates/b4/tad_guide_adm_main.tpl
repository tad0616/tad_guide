<div class="container-fluid">
    <{if $now_op=="login_form"}>
        <h2><{$smarty.const._MA_GUIDE_SSH_ID}></h2>
        <div class="card card-body bg-light m-1">
            <form action="main.php" method="post" role="form">
            <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label text-sm-right">
                <{$smarty.const._MA_GUIDE_SSH_ID}><{$smarty.const._TAD_FOR}>
                </label>
                <div class="col-sm-9">
                <input type="text" name="ssh_id" placeholder="<{$smarty.const._MA_GUIDE_SSH_ID}>" class="form-control" value="<{$tad_adm_ssh_id}>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label text-sm-right">
                <{$smarty.const._MA_GUIDE_SSH_PASS}><{$smarty.const._TAD_FOR}>
                </label>
                <div class="col-sm-9">
                <input type="password" name="ssh_passwd" placeholder="<{$smarty.const._MA_GUIDE_SSH_PASS}>" class="form-control" value="<{$tad_adm_ssh_passwd}>">
                </div>
            </div>


            <div class="text-center">

                <input type="hidden" name="ssh_host" value="127.0.0.1" class="col-sm-12">
                <input type="hidden" name="file_link" value="<{$file_link}>">
                <input type="hidden" name="dirname" value="<{$dirname}>">
                <input type="hidden" name="act" value="<{$act}>">
                <input type="hidden" name="kind_dir" value="<{$kind_dir}>">
                <input type="hidden" name="update_sn" value="<{$update_sn}>">
                <input type="hidden" name="tad_adm_tpl" value="clean">
                <input type="hidden" name="op" value="ssh_login">
                <button type="submit" class="btn btn-sm btn-primary"><{$smarty.const._MA_GUIDE_LOGIN}>SSH</button>
            </div>
            </form>
        </div>
    <{else}>

        <script type='text/javascript'>
        $(document).ready(function(){
            $("#group_kind").change(function() {
            var kind=$("#group_kind").val();
            switch(kind){
                case "es12_school":
                $("#create_group").val('<{$smarty.const._MA_GUIDE_ES12_SCHOOL_GROUP}>');
                break;
                case "es24_school":
                $("#create_group").val('<{$smarty.const._MA_GUIDE_ES24_SCHOOL_GROUP}>');
                break;
                case "es25_school":
                $("#create_group").val('<{$smarty.const._MA_GUIDE_ES25_SCHOOL_GROUP}>');
                break;
                case "jh6_school":
                $("#create_group").val('<{$smarty.const._MA_GUIDE_JH6_SCHOOL_GROUP}>');
                break;
                case "jh7_school":
                $("#create_group").val('<{$smarty.const._MA_GUIDE_JH7_SCHOOL_GROUP}>');
                break;
            }
            });
        });
        </script>

        <form action="main.php" method="post" role="form">
            <div class="form-group row mb-3">
                <div class="col-sm-2">
                    <select id="group_kind" class="form-control">
                        <option value="custom"><{$smarty.const._MA_GUIDE_CUSTOM}></option>
                        <option value="es12_school"><{$smarty.const._MA_GUIDE_ES12_SCHOOL}></option>
                        <option value="es24_school"><{$smarty.const._MA_GUIDE_ES24_SCHOOL}></option>
                        <option value="es25_school"><{$smarty.const._MA_GUIDE_ES25_SCHOOL}></option>
                        <option value="jh6_school"><{$smarty.const._MA_GUIDE_JH6_SCHOOL}></option>
                        <option value="jh7_school"><{$smarty.const._MA_GUIDE_JH7_SCHOOL}></option>
                    </select>
                </div>
                <div class="col-sm-9">
                    <input type="text" name="create_group" id="create_group" value="" class="form-control" placeholder="<{$smarty.const._MA_GUIDE_CREATE_GROUP_PLACEHOLDER}>">
                    <input type="hidden" name="op" value="to_create_group">
                </div>
                <div class="col-sm-1 d-grid gap-2">
                    <button type="submit" class="btn btn-block btn-primary"><{$smarty.const._MA_GUIDE_CREATE}></button>
                </div>
            </div>
        </form>

        <table id="list_modules" class="table table-bordered table-hover" style="width:auto;">
        <thead>
            <tr>
            <th><{$smarty.const._MA_GUIDE_MODULES_COL}></th>
            <th><{$smarty.const._MA_GUIDE_INSTALL_COL}></th>
            <th><{$smarty.const._MA_GUIDE_ONE_KEY}></th>
            <th><{$smarty.const._MA_GUIDE_CONFIG_COL}></th>
            <th><{$smarty.const._MA_GUIDE_CONTENT_COL}></th>
            <th><{$smarty.const._MA_GUIDE_BLOCKS_COL}></th>
            <{foreach from=$group item=g}>
            <{if $g.groupid > 3}>
                <th style="text-align:center;background-color:#6C873D;">
                <{$g.name}>
                </th>
            <{/if}>
            <{/foreach}>
            </tr>
        </thead>
        <tbody>
            <{foreach from=$all_data key=mod_dirname item=mod}>
                <tr <{if $mod_dirname==$hl and $hl!=""}>style="background-color:yellow;"<{/if}>>

                <td>
                    <a name="<{$mod_dirname}>"><img src="<{$mod.logo}>" style="float:left; margin-right:6px;"></a>
                    <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" target="_blank"><{$mod.name}></a>
                    <div>
                        <{if $mod.function=='latest' or $mod.function=='upgrade'}>
                            <{$mod_dirname}> <{$mod.now_version}>
                        <{else}>
                            <{$mod_dirname}> <{$mod.new_version}>
                        <{/if}>
                    </div>
                </td>

                <td nowrap>
                    <{if $mod.function=='unable'}>
                        <div style="font-size:0.92em;line-height: 1.5;">
                            <span style="color:rgb(156, 13, 13)"><{$mod.status}></span>
                            <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" title="<{$mod.dirname}>">
                                <{$mod.name}>
                            </a>
                        </div>
                    <{elseif $mod.function=='upgrade' or $mod.function=='latest'}>
                        <a href="main.php?op=upgrade_<{$mod.kind}>&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="modulesadmin <{if $mod.function=='latest'}>latest_btn<{else}>update_btn<{/if}>"  data-fancybox-type="iframe" title="<{$mod.dirname}> <{$mod.now_version}> (<{$mod.last_update}>) to <{$mod.new_version}> (<{$mod.new_last_update}>)" style="">
                            <{if $mod.function=='latest'}>
                                <{$mod.dirname}> <{$mod.now_version}><br>
                                <{$smarty.const._MA_GUIDE_MOD_LATEST}>
                            <{else}>
                                <{$mod.dirname}> <{$mod.now_version}> <br>
                                <{$smarty.const._MA_GUIDE_CAN_UPDATE_TO}><br>
                                <{$mod.dirname}> <{$mod.new_version}>
                            <{/if}>
                        </a>

                    <{elseif $mod.function=='install'}>
                        <a href="main.php?op=install_<{$mod.kind}>&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="modulesadmin install_btn" title="<{$mod.dirname}> <{$mod.now_version}> (<{$mod.last_update}>) to <{$mod.new_version}> (<{$mod.new_last_update}>)" data-fancybox-type="iframe">
                        <{$smarty.const._MA_GUIDE_MOD_INSTALL_MODULE}>
                        <br><{$mod.dirname}> <{$mod.new_version}>
                    <{/if}>
                </td>


                <td nowrap>
                    <{if $mod.function!='install'}>
                    <{if ($act_log.$mod_dirname.config=='' and $log.$mod_dirname.config_exists) or ($act_log.$mod_dirname.content_all=='' and $log.$mod_dirname.content_all_exists) or ($act_log.$mod_dirname.blocks=='' and $log.$mod_dirname.blocks_file_exists)}>
                        <a href="main.php?op=one_key&dirname=<{$mod_dirname}>&mid=<{$mod.mid}>" alt="<{$smarty.const._MA_GUIDE_ONE_KEY}>" title="<{$smarty.const._MA_GUIDE_ONE_KEY}>" class="btn btn-sm btn-primary onekey" data-fancybox-type="iframe"><i class="fa fa-hand-o-up"></i></a>
                    <{else}>
                        <a href="#" alt="<{$smarty.const._MA_GUIDE_ONE_KEY}>" title="<{$smarty.const._MA_GUIDE_ONE_KEY}>" class="btn btn-sm btn-primary onekey disabled" disabled><i class="fa fa-hand-o-up"></i></a>
                    <{/if}>
                    <{/if}>
                </td>

                <td style="text-align:center;">
                    <{if $log.$mod_dirname.config_exists and $mod.function!='install'}>
                    <{if $act_log.$mod_dirname.config}>
                        <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=config&mid=<{$mod.mid}>" class="btn btn-sm btn-success" alt="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONFIG}><{$log.$mod_dirname.config}>" title="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONFIG}><{$log.$mod_dirname.config}>"><i class="fa fa-cog"></i></a>

                        <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=restore_config&mid=<{$mod.mid}>" class="btn btn-sm btn-info " alt="<{$smarty.const._MA_GUIDE_RESTORE_CONFIG}>" title="<{$smarty.const._MA_GUIDE_RESTORE_CONFIG}>"><i class="fa fa-repeat"></i></a>
                    <{else}>
                        <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=config&mid=<{$mod.mid}>" class="btn btn-sm btn-info " alt="<{$smarty.const._MA_GUIDE_IMPORT_CONFIG}>" title="<{$smarty.const._MA_GUIDE_IMPORT_CONFIG}>"><i class="fa fa-cog"></i></a>
                    <{/if}>
                    <{elseif $log.$mod_dirname.config_exists}>
                    <img src="<{xoAppUrl modules/tad_guide/images/1.gif}>" alt="<{$smarty.const._MA_GUIDE_CONFIG_EXIST}>" title="<{$smarty.const._MA_GUIDE_CONFIG_EXIST}>">
                    <{else}>

                    <{/if}>
                </td>

                <td style="text-align:center;">
                    <{if $log.$mod_dirname.content_all_exists and $mod.function!='install'}>
                    <{if $act_log.$mod_dirname.content_all}>
                        <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=content_all&mid=<{$mod.mid}>" class="btn btn-sm btn-success" alt="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONTENT}><{$log.$mod_dirname.content_all}>" title="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONTENT}><{$log.$mod_dirname.content_all}>"><i class="fa fa-cloud-download"></i></a>

                        <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=restore&mid=<{$mod.mid}>" class="btn btn-sm btn-info " alt="<{$smarty.const._MA_GUIDE_RESTORE_CONTENT}>" title="<{$smarty.const._MA_GUIDE_RESTORE_CONTENT}>"><i class="fa fa-repeat"></i></a>
                    <{else}>
                        <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=content_all&mid=<{$mod.mid}>" class="btn btn-sm btn-info " alt="<{$smarty.const._MA_GUIDE_IMPORT_CONTENT}>" title="<{$smarty.const._MA_GUIDE_IMPORT_CONTENT}>"><i class="fa fa-cloud-download"></i></a>
                    <{/if}>
                    <{elseif $log.$mod_dirname.content_all_exists}>
                    <img src="<{xoAppUrl modules/tad_guide/images/1.gif}>" alt="<{$smarty.const._MA_GUIDE_CONTENT_EXIST}>" title="<{$smarty.const._MA_GUIDE_CONTENT_EXIST}>">
                    <{/if}>
                </td>

                <td style="text-align:center;">
                    <{if $log.$mod_dirname.blocks_file_exists and $mod.function!='install'}>
                    <{if $act_log.$mod_dirname.blocks}>
                        <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=blocks" class="btn btn-sm btn-success" alt="<{$smarty.const._MA_GUIDE_RE_IMPORT_BLOCKS}><{$log.$mod_dirname.blocks}>" title="<{$smarty.const._MA_GUIDE_RE_IMPORT_BLOCKS}><{$log.$mod_dirname.blocks}>"><i class="fa fa-arrow-down"></i></a>

                        <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=restore_blocks&mid=<{$mod.mid}>" class="btn btn-sm btn-info " alt="<{$smarty.const._MA_GUIDE_RESTORE_BLOCKS}>" title="<{$smarty.const._MA_GUIDE_RESTORE_BLOCKS}>"><i class="fa fa-repeat"></i></a>
                    <{else}>
                        <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=blocks" class="btn btn-sm btn-info " alt="<{$smarty.const._MA_GUIDE_IMPORT_BLOCKS}>" title="<{$smarty.const._MA_GUIDE_IMPORT_BLOCKS}>"><i class="fa fa-arrow-down"></i></a>
                    <{/if}>
                    <{elseif $log.$mod_dirname.blocks_file_exists}>
                    <img src="<{xoAppUrl modules/tad_guide/images/1.gif}>" alt="<{$smarty.const._MA_GUIDE_BLOCKS_EXIST}>" title="<{$smarty.const._MA_GUIDE_BLOCKS_EXIST}>">
                    <{/if}>



                </td>

                <{foreach from=$log.$mod_dirname.cates item=cates key=groupid}>

                    <{assign var="mod_c" value=$log.$mod_dirname.content}>
                    <{assign var="c_sn" value=$cates.cate_sn}>

                    <{if $groupid > 3}>
                    <{if $cates.cate_title}>
                        <td style="text-align:center;background-color:#F1F2F0;">
                        <div><a href="<{$xoops_url}>/modules/<{$cates.dirname}>/<{$cates.file}>?<{$cates.col}>=<{$cates.cate_sn}>"><{$cates.cate_title}></a></div>
                        <{if $log.$mod_dirname.content_exists and $mod.function!='install'}>
                            <{if $mod_c.$c_sn}>
                            <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=content&mid=<{$mod.mid}>&cate_sn=<{$cates.cate_sn}>" class="btn btn-sm btn-success" alt="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONTENT}><{$mod_c.$c_sn}>" title="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONTENT}><{$mod_c.$c_sn}>"><i class="fa fa-cloud-download"></i></a>
                            <{else}>
                            <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=content&mid=<{$mod.mid}>&cate_sn=<{$cates.cate_sn}>" class="btn btn-sm btn-info " alt="<{$smarty.const._MA_GUIDE_IMPORT_CONTENT}>" title="<{$smarty.const._MA_GUIDE_IMPORT_CONTENT}>"><i class="fa fa-cloud-download"></i></a>
                            <{/if}>
                        <{elseif $log.$mod_dirname.content_exists and $mod.function=='install'}>
                            <img src="<{xoAppUrl modules/tad_guide/images/1.gif}>" alt="<{$smarty.const._MA_GUIDE_CONTENT_EXIST}>" title="<{$smarty.const._MA_GUIDE_CONTENT_EXIST}>">
                        <{/if}>
                        </td>
                    <{elseif $cates.mid and $cates.show_cate}>
                        <td style="text-align:center;;background-color:#F1F2F0;">
                        <a href="main.php?op=create_one_cate&mid=<{$mod.mid}>&groupid=<{$groupid}>&dirname=<{$mod_dirname}>" alt="<{$cates.groupname|string_format:$smarty.const._MA_GUIDE_CREATE_CATE}>" title="<{$cates.groupname|string_format:$smarty.const._MA_GUIDE_CREATE_CATE}>" class="btn btn-sm btn-info "><i class="fa fa-folder-open"></i></a>
                        </td>
                    <{else}>
                        <td style="text-align:center;background-color:#F1F2F0;">

                        </td>
                    <{/if}>
                    <{/if}>
                <{/foreach}>


                </tr>
            <{/foreach}>
        </tbody>
        </table>
    <{/if}>
</div>