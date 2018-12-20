<!-- font-awesome -->
<link href="<{xoAppUrl modules/tadtools/css/font-awesome/css/font-awesome.css}>" rel="stylesheet">

<div class="container-fluid">
  <{if $now_op=="login_form"}>
      <h2><{$smarty.const._MA_GUIDE_SSH_ID}></h2>
      <div class="well">
        <form action="main.php" method="post" class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-sm-3 control-label">
              <{$smarty.const._MA_GUIDE_SSH_ID}><{$smarty.const._TAD_FOR}>
            </label>
            <div class="col-sm-9">
              <input type="text" name="ssh_id" placeholder="<{$smarty.const._MA_GUIDE_SSH_ID}>" class="form-control" value="<{$tad_adm_ssh_id}>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
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
            <button type="submit" class="btn btn-primary"><{$smarty.const._MA_GUIDE_LOGIN}>SSH</button>
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
    <form action="main.php" method="post" class="form-horizontal" role="form">
      <div class="form-group">
        <div class="col-sm-2 control-label">
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
        <div class="col-sm-1">
          <button type="submit" class="btn btn-primary"><{$smarty.const._MA_GUIDE_CREATE}></button>
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

              <td nowrap>
                <a name="<{$mod_dirname}>"> </a>
                  <a id="view_well<{$mod.module_sn}>" class="btn btn-xs btn-info" href="javascript:alert('<{$mod.update_descript}>')"><{$mod.module_sn}></a>
                <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" target="_blank"><{$mod.module_title}></a>

                <{if $mod.function!='install' and $mod.function!='install_theme'}>
                  <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" target="_blank"><{$mod_dirname}> <{$mod.version}></a>
                <{else}>
                  <a href="https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" target="_blank"><{$mod.new_version}></a>
                <{/if}>
              </td>

              <td nowrap>
                <{if $mod.function=='update'}>
                  <a href="<{$xoops_url}>/modules/<{$mod_dirname}>" class="btn btn-xs btn-info" target="_blank" alt="<{$smarty.const._MA_GUIDE_TO_MODULE}>" title="<{$smarty.const._MA_GUIDE_TO_MODULE}>"><i class="fa fa-arrow-right"></i></a>
                  <a href="main.php?op=update_module&dirname=<{$mod_dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-xs btn-danger modulesadmin"  data-fancybox-type="iframe"><{$smarty.const._MA_GUIDE_MOD_UPDATE_MODULE}> <{$mod.new_version}></a>
                <{elseif $mod.function=='last_mod'}>
                  <a href="<{$xoops_url}>/modules/<{$mod_dirname}>" class="btn btn-xs btn-info" target="_blank" alt="<{$smarty.const._MA_GUIDE_TO_MODULE}>" title="<{$smarty.const._MA_GUIDE_TO_MODULE}>"><i class="fa fa-arrow-right"></i></a>
                  <a href="main.php?op=update_module&dirname=<{$mod_dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="modulesadmin"  data-fancybox-type="iframe"><{$smarty.const._MA_GUIDE_MOD_LATEST}></a>
                <{elseif $mod.function=='install'}>
                  <a href="main.php?op=install_module&dirname=<{$mod_dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>&tad_adm_tpl=clean" class="btn btn-success btn-xs btn-block modulesadmin" data-fancybox-type="iframe">
                  <i class="fa fa-cloud-download" aria-hidden="true"></i>
                  <{$smarty.const._MA_GUIDE_MOD_INSTALL_MODULE}> <{$mod_dirname}> <{$mod.new_version}></a>  
                <{/if}>
              </td>


              <td nowrap>
                <{if $mod.function!='install'}>
                  <{if ($act_log.$mod_dirname.config=='' and $log.$mod_dirname.config_exists) or ($act_log.$mod_dirname.content_all=='' and $log.$mod_dirname.content_all_exists) or ($act_log.$mod_dirname.blocks=='' and $log.$mod_dirname.blocks_file_exists)}>
                      <a href="main.php?op=one_key&dirname=<{$mod_dirname}>&mid=<{$mod.mid}>" alt="<{$smarty.const._MA_GUIDE_ONE_KEY}>" title="<{$smarty.const._MA_GUIDE_ONE_KEY}>" class="btn btn-primary onekey" data-fancybox-type="iframe"><i class="fa fa-hand-o-up"></i></a>
                  <{else}>
                    <a href="#" alt="<{$smarty.const._MA_GUIDE_ONE_KEY}>" title="<{$smarty.const._MA_GUIDE_ONE_KEY}>" class="btn btn-primary onekey" disabled><i class="fa fa-hand-o-up"></i></a>
                  <{/if}>
                <{/if}>
              </td>

              <td style="text-align:center;">
                <{if $log.$mod_dirname.config_exists and $mod.function!='install'}>
                  <{if $act_log.$mod_dirname.config}>
                    <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=config&mid=<{$mod.mid}>" class="btn btn-success" alt="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONFIG}><{$log.$mod_dirname.config}>" title="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONFIG}><{$log.$mod_dirname.config}>"><i class="fa fa-cog"></i></a>

                    <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=restore_config&mid=<{$mod.mid}>" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_RESTORE_CONFIG}>" title="<{$smarty.const._MA_GUIDE_RESTORE_CONFIG}>"><i class="fa fa-repeat"></i></a>
                  <{else}>
                    <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=config&mid=<{$mod.mid}>" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_IMPORT_CONFIG}>" title="<{$smarty.const._MA_GUIDE_IMPORT_CONFIG}>"><i class="fa fa-cog"></i></a>
                  <{/if}>
                <{elseif $log.$mod_dirname.config_exists}>
                  <img src="<{xoAppUrl modules/tad_guide/images/1.gif}>" alt="<{$smarty.const._MA_GUIDE_CONFIG_EXIST}>" title="<{$smarty.const._MA_GUIDE_CONFIG_EXIST}>">
                <{else}>

                <{/if}>
              </td>

              <td style="text-align:center;">
                <{if $log.$mod_dirname.content_all_exists and $mod.function!='install'}>
                  <{if $act_log.$mod_dirname.content_all}>
                    <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=content_all&mid=<{$mod.mid}>" class="btn btn-success" alt="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONTENT}><{$log.$mod_dirname.content_all}>" title="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONTENT}><{$log.$mod_dirname.content_all}>"><i class="fa fa-cloud-download"></i></a>

                    <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=restore&mid=<{$mod.mid}>" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_RESTORE_CONTENT}>" title="<{$smarty.const._MA_GUIDE_RESTORE_CONTENT}>"><i class="fa fa-repeat"></i></a>
                  <{else}>
                    <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=content_all&mid=<{$mod.mid}>" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_IMPORT_CONTENT}>" title="<{$smarty.const._MA_GUIDE_IMPORT_CONTENT}>"><i class="fa fa-cloud-download"></i></a>
                  <{/if}>
                <{elseif $log.$mod_dirname.content_all_exists}>
                  <img src="<{xoAppUrl modules/tad_guide/images/1.gif}>" alt="<{$smarty.const._MA_GUIDE_CONTENT_EXIST}>" title="<{$smarty.const._MA_GUIDE_CONTENT_EXIST}>">
                <{/if}>
              </td>

              <td style="text-align:center;">
                <{if $log.$mod_dirname.blocks_file_exists and $mod.function!='install'}>
                  <{if $act_log.$mod_dirname.blocks}>
                    <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=blocks" class="btn btn-success" alt="<{$smarty.const._MA_GUIDE_RE_IMPORT_BLOCKS}><{$log.$mod_dirname.blocks}>" title="<{$smarty.const._MA_GUIDE_RE_IMPORT_BLOCKS}><{$log.$mod_dirname.blocks}>"><i class="fa fa-arrow-down"></i></a>

                    <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=restore_blocks&mid=<{$mod.mid}>" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_RESTORE_BLOCKS}>" title="<{$smarty.const._MA_GUIDE_RESTORE_BLOCKS}>"><i class="fa fa-repeat"></i></a>
                  <{else}>
                    <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=blocks" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_IMPORT_BLOCKS}>" title="<{$smarty.const._MA_GUIDE_IMPORT_BLOCKS}>"><i class="fa fa-arrow-down"></i></a>
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
                          <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=content&mid=<{$mod.mid}>&cate_sn=<{$cates.cate_sn}>" class="btn btn-success" alt="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONTENT}><{$mod_c.$c_sn}>" title="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONTENT}><{$mod_c.$c_sn}>"><i class="fa fa-cloud-download"></i></a>
                        <{else}>
                          <a href="main.php?op=import_data&dirname=<{$mod_dirname}>&act_kind=content&mid=<{$mod.mid}>&cate_sn=<{$cates.cate_sn}>" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_IMPORT_CONTENT}>" title="<{$smarty.const._MA_GUIDE_IMPORT_CONTENT}>"><i class="fa fa-cloud-download"></i></a>
                        <{/if}>
                      <{elseif $log.$mod_dirname.content_exists and $mod.function=='install'}>
                        <img src="<{xoAppUrl modules/tad_guide/images/1.gif}>" alt="<{$smarty.const._MA_GUIDE_CONTENT_EXIST}>" title="<{$smarty.const._MA_GUIDE_CONTENT_EXIST}>">
                      <{/if}>
                    </td>
                  <{elseif $cates.mid and $cates.show_cate}>
                    <td style="text-align:center;;background-color:#F1F2F0;">
                      <a href="main.php?op=create_one_cate&mid=<{$mod.mid}>&groupid=<{$groupid}>&dirname=<{$mod_dirname}>" alt="<{$cates.groupname|string_format:$smarty.const._MA_GUIDE_CREATE_CATE}>" title="<{$cates.groupname|string_format:$smarty.const._MA_GUIDE_CREATE_CATE}>" class="btn btn-default"><i class="fa fa-folder-open"></i></a>
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