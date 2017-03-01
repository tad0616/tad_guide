<!-- font-awesome -->
<link href="<{xoAppUrl modules/tadtools/css/font-awesome/css/font-awesome.css}>" rel="stylesheet">
<div class="container-fluid">
  <{if $now_op=="login_form"}>

    <div class="row">
      <div class="col-sm-6">
        <h2><{$smarty.const._MA_GUIDE_SSH_ID}></h2>
        <div class="well">
          <form action="main.php" method="post">
            <div class="row">
              <label class="col-sm-5 text-right"><{$smarty.const._MA_GUIDE_SSH_HOST}><{$smarty.const._TAD_FOR}></label>
              <div class="col-sm-7">
                <input type="text" name="ssh_host" placeholder="<{$smarty.const._MA_GUIDE_SSH_HOST}>" value="<{$tad_adm_ssh_host}>" class="col-sm-12">
              </div>
            </div>
            <div class="row">
              <label class="col-sm-5 text-right"><{$smarty.const._MA_GUIDE_SSH_ID}><{$smarty.const._TAD_FOR}></label>
              <div class="col-sm-7">
                <input type="text" name="ssh_id" placeholder="<{$smarty.const._MA_GUIDE_SSH_ID}>" class="col-sm-12" value="<{$tad_adm_ssh_id}>">
              </div>
            </div>
            <div class="row">
              <label class="col-sm-5 text-right"><{$smarty.const._MA_GUIDE_SSH_PASS}><{$smarty.const._TAD_FOR}></label>
              <div class="col-sm-7">
                <input type="password" name="ssh_passwd" placeholder="<{$smarty.const._MA_GUIDE_SSH_PASS}>" class="col-sm-12" value="<{$tad_adm_ssh_passwd}>">
              </div>
            </div>

            <div class="text-center">
              <input type="hidden" name="file_link" value="<{$file_link}>">
              <input type="hidden" name="dirname" value="<{$dirname}>">
              <input type="hidden" name="act" value="<{$act}>">
              <input type="hidden" name="kind_dir" value="<{$kind_dir}>">
              <input type="hidden" name="update_sn" value="<{$update_sn}>">
              <input type="hidden" name="op" value="ssh_login">
              <button type="submit" class="btn btn-primary"><{$smarty.const._MA_GUIDE_LOGIN}>SSH</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-sm-6">
        <h2><{$smarty.const._MA_GUIDE_FTP_ID}></h2>
        <div class="well">
          <form action="main.php" method="post">
            <div class="row">
              <label class="col-sm-5 text-right"><{$smarty.const._MA_GUIDE_FTP_HOST}><{$smarty.const._TAD_FOR}></label>
              <div class="col-sm-7">
                <input type="text" name="ftp_host" placeholder="<{$smarty.const._MA_GUIDE_FTP_HOST}>" value="<{$tad_adm_ftp_host}>" class="col-sm-12">
              </div>
            </div>
            <div class="row">
              <label class="col-sm-5 text-right"><{$smarty.const._MA_GUIDE_FTP_ID}><{$smarty.const._TAD_FOR}></label>
              <div class="col-sm-7">
                <input type="text" name="ftp_id" placeholder="<{$smarty.const._MA_GUIDE_FTP_ID}>" class="col-sm-12" value="<{$tad_adm_ftp_id}>">
              </div>
            </div>
            <div class="row">
              <label class="col-sm-5 text-right"><{$smarty.const._MA_GUIDE_FTP_PASS}><{$smarty.const._TAD_FOR}></label>
              <div class="col-sm-7">
                <input type="password" name="ftp_passwd" placeholder="<{$smarty.const._MA_GUIDE_FTP_PASS}>" class="col-sm-12" value="<{$tad_adm_ftp_passwd}>">
                <{$smarty.const._MA_GUIDE_FTP_NOTE}>
              </div>
            </div>

            <div class="text-center">
              <input type="hidden" name="file_link" value="<{$file_link}>">
              <input type="hidden" name="dirname" value="<{$dirname}>">
              <input type="hidden" name="act" value="<{$act}>">
              <input type="hidden" name="kind_dir" value="<{$kind_dir}>">
              <input type="hidden" name="update_sn" value="<{$update_sn}>">
              <input type="hidden" name="op" value="ftp_login">
              <button type="submit" class="btn btn-primary"><{$smarty.const._MA_GUIDE_LOGIN}>FTP</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <{else}>

    <{$fancybox_code}>
    <{$onekey_fancybox_code}>
    <{$stickytableheaders_code}>

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
        <{foreach from=$all_data item=mod}>
          <{assign var="mod_dirname" value=$mod.dirname}>
          <{if $mod.dirname|in_array:$school_mod_arr}>
            <tr <{if $mod.dirname==$hl and $hl!=""}>style="background-color:yellow;"<{/if}>>

              <td nowrap>
                <a name="<{$mod.dirname}>"> </a>
                <{if $mod.kind=="module"}>
                  <a id="view_well<{$mod.module_sn}>" class="btn btn-xs btn-info" href="javascript:alert('<{$mod.descript}>')"><{$smarty.const._MA_GUIDE_MODULE}></a>
                <{elseif $mod.kind=="theme"}>
                  <a id="view_well<{$mod.module_sn}>" class="btn btn-xs btn-success" href="javascript:alert('<{$mod.descript}>')"><{$smarty.const._MA_GUIDE_THEME}></a>
                <{elseif $mod.kind=="fix"}>
                  <a id="view_well<{$mod.module_sn}>" class="btn btn-xs btn-warning" href="javascript:alert('<{$mod.descript}>')"><{$smarty.const._MA_GUIDE_FIX}></a>
                <{/if}>

                <a href="http://120.115.2.90/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" target="_blank"><{$mod.name}></a>

                <{if $mod.function!='install' and $mod.function!='install_theme'}>
                  <a href="http://120.115.2.90/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" target="_blank"><{$mod.dirname}> <{$mod.version}></a>
                <{else}>
                  <a href="http://120.115.2.90/modules/tad_modules/index.php?module_sn=<{$mod.module_sn}>" target="_blank"><{$mod.new_version}></a>
                <{/if}>
              </td>

              <td nowrap>
                <{if $mod.function=='install'}>
                  <a href="main.php?op=install_module&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" class="btn btn-xs btn-primary modulesadmin" data-fancybox-type="iframe"><{$smarty.const._MA_GUIDE_MOD_INSTALL_MODULE}></a>
                <{elseif $mod.function=='update'}>
                  <a href="<{$xoops_url}>/modules/<{$mod.dirname}>" class="btn btn-xs btn-info" target="_blank" alt="<{$smarty.const._MA_GUIDE_TO_MODULE}>" title="<{$smarty.const._MA_GUIDE_TO_MODULE}>"><i class="fa fa-arrow-right"></i></a>
                  <a href="main.php?op=update_module&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" class="btn btn-xs btn-danger modulesadmin"  data-fancybox-type="iframe"><{$smarty.const._MA_GUIDE_MOD_UPDATE_MODULE}> <{$mod.new_version}></a>
                <{elseif $mod.function=='update_theme'}>
                    <a href="main.php?op=update_theme&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" class="btn btn-xs btn-danger" ><{$smarty.const._MA_GUIDE_MOD_UPDATE_THEME}> <{$mod.new_version}></a>
                <{elseif $mod.function=='install_theme'}>
                    <a href="main.php?op=install_theme&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" class="btn btn-xs btn-primary" ><{$smarty.const._MA_GUIDE_MOD_INSTALL_THEME}></a>
                <{elseif $mod.function=='last_mod'}>
                  <a href="<{$xoops_url}>/modules/<{$mod.dirname}>" class="btn btn-xs btn-info" target="_blank" alt="<{$smarty.const._MA_GUIDE_TO_MODULE}>" title="<{$smarty.const._MA_GUIDE_TO_MODULE}>"><i class="fa fa-arrow-right"></i></a>
                  <a href="main.php?op=update_module&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" class="modulesadmin"  data-fancybox-type="iframe"><{$smarty.const._MA_GUIDE_MOD_LATEST}></a>
                <{elseif $mod.function=='last_theme'}>
                    <a href="main.php?op=update_theme&dirname=<{$mod.dirname}>&file_link=<{$mod.file_link}>&update_sn=<{$mod.update_sn}>" ><{$smarty.const._MA_GUIDE_MOD_LATEST}></a>
                <{elseif $mod.new_last_update}>
                  <{$smarty.const._MA_GUIDE_MOD_LATEST}>
                <{/if}>
              </td>


              <td nowrap>
                <{if $mod.function!='install'}>
                  <a href="main.php?op=one_key&dirname=<{$mod.dirname}>&mid=<{$mod.mid}>" alt="<{$smarty.const._MA_GUIDE_ONE_KEY}>" title="<{$smarty.const._MA_GUIDE_ONE_KEY}>" class="btn btn-primary onekey" data-fancybox-type="iframe"><i class="fa fa-hand-o-up"></i></a>
                <{/if}>
              </td>

              <td style="text-align:center;">
                <{if $log.$mod_dirname.config_exists and $mod.function!='install'}>
                  <{if $log.$mod_dirname.config.0}>
                    <a href="main.php?op=import_data&dirname=<{$mod.dirname}>&act_kind=config&mid=<{$mod.mid}>" class="btn btn-success" alt="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONFIG}><{$log.$mod_dirname.config.0}>" title="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONFIG}><{$log.$mod_dirname.config.0}>"><i class="fa fa-cog"></i></a>

                    <a href="main.php?op=import_data&dirname=<{$mod.dirname}>&act_kind=restore_config&mid=<{$mod.mid}>" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_RESTORE_CONFIG}>" title="<{$smarty.const._MA_GUIDE_RESTORE_CONFIG}>"><i class="fa fa-repeat"></i></a>
                  <{else}>
                    <a href="main.php?op=import_data&dirname=<{$mod.dirname}>&act_kind=config&mid=<{$mod.mid}>" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_IMPORT_CONFIG}>" title="<{$smarty.const._MA_GUIDE_IMPORT_CONFIG}>"><i class="fa fa-cog"></i></a>
                  <{/if}>
                <{elseif $log.$mod_dirname.config_exists}>
                  <img src="<{xoAppUrl modules/tad_guide/images/1.gif}>" alt="<{$smarty.const._MA_GUIDE_CONFIG_EXIST}>" title="<{$smarty.const._MA_GUIDE_CONFIG_EXIST}>">
                <{else}>
                <{/if}>
              </td>

              <td style="text-align:center;">
                <{if $log.$mod_dirname.content_all_exists and $mod.function!='install'}>
                  <{if $log.$mod_dirname.content_all.0}>
                    <a href="main.php?op=import_data&dirname=<{$mod.dirname}>&act_kind=content_all&mid=<{$mod.mid}>" class="btn btn-success" alt="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONTENT}><{$log.$mod_dirname.content_all.0}>" title="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONTENT}><{$log.$mod_dirname.content_all.0}>"><i class="fa fa-cloud-download"></i></a>

                    <a href="main.php?op=import_data&dirname=<{$mod.dirname}>&act_kind=restore&mid=<{$mod.mid}>" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_RESTORE_CONTENT}>" title="<{$smarty.const._MA_GUIDE_RESTORE_CONTENT}>"><i class="fa fa-repeat"></i></a>
                  <{else}>
                    <a href="main.php?op=import_data&dirname=<{$mod.dirname}>&act_kind=content_all&mid=<{$mod.mid}>" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_IMPORT_CONTENT}>" title="<{$smarty.const._MA_GUIDE_IMPORT_CONTENT}>"><i class="fa fa-cloud-download"></i></a>
                  <{/if}>
                <{elseif $log.$mod_dirname.content_all_exists}>
                  <img src="<{xoAppUrl modules/tad_guide/images/1.gif}>" alt="<{$smarty.const._MA_GUIDE_CONTENT_EXIST}>" title="<{$smarty.const._MA_GUIDE_CONTENT_EXIST}>">
                <{/if}>
              </td>

              <td style="text-align:center;">
                <{if $log.$mod_dirname.blocks_file_exists and $mod.function!='install'}>
                  <{if $log.$mod_dirname.blocks.0}>
                    <a href="main.php?op=import_data&dirname=<{$mod.dirname}>&act_kind=blocks" class="btn btn-success" alt="<{$smarty.const._MA_GUIDE_RE_IMPORT_BLOCKS}><{$log.$mod_dirname.blocks.0}>" title="<{$smarty.const._MA_GUIDE_RE_IMPORT_BLOCKS}><{$log.$mod_dirname.blocks.0}>"><i class="fa fa-arrow-down"></i></a>

                    <a href="main.php?op=import_data&dirname=<{$mod.dirname}>&act_kind=restore_blocks&mid=<{$mod.mid}>" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_RESTORE_BLOCKS}>" title="<{$smarty.const._MA_GUIDE_RESTORE_BLOCKS}>"><i class="fa fa-repeat"></i></a>
                  <{else}>
                    <a href="main.php?op=import_data&dirname=<{$mod.dirname}>&act_kind=blocks" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_IMPORT_BLOCKS}>" title="<{$smarty.const._MA_GUIDE_IMPORT_BLOCKS}>"><i class="fa fa-arrow-down"></i></a>
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
                          <a href="main.php?op=import_data&dirname=<{$mod.dirname}>&act_kind=content&mid=<{$mod.mid}>&cate_sn=<{$cates.cate_sn}>" class="btn btn-success" alt="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONTENT}><{$mod_c.$c_sn}>" title="<{$smarty.const._MA_GUIDE_RE_IMPORT_CONTENT}><{$mod_c.$c_sn}>"><i class="fa fa-cloud-download"></i></a>
                        <{else}>
                          <a href="main.php?op=import_data&dirname=<{$mod.dirname}>&act_kind=content&mid=<{$mod.mid}>&cate_sn=<{$cates.cate_sn}>" class="btn btn-default" alt="<{$smarty.const._MA_GUIDE_IMPORT_CONTENT}>" title="<{$smarty.const._MA_GUIDE_IMPORT_CONTENT}>"><i class="fa fa-cloud-download"></i></a>
                        <{/if}>
                      <{elseif $log.$mod_dirname.content_exists and $mod.function=='install'}>
                        <img src="<{xoAppUrl modules/tad_guide/images/1.gif}>" alt="<{$smarty.const._MA_GUIDE_CONTENT_EXIST}>" title="<{$smarty.const._MA_GUIDE_CONTENT_EXIST}>">
                      <{/if}>
                    </td>
                  <{elseif $cates.mid and $cates.show_cate}>
                    <td style="text-align:center;;background-color:#F1F2F0;">
                      <a href="main.php?op=create_one_cate&mid=<{$mod.mid}>&groupid=<{$groupid}>&dirname=<{$mod.dirname}>" alt="<{$cates.groupname|string_format:$smarty.const._MA_GUIDE_CREATE_CATE}>" title="<{$cates.groupname|string_format:$smarty.const._MA_GUIDE_CREATE_CATE}>" class="btn btn-default"><i class="fa fa-folder-open"></i></a>
                    </td>
                  <{else}>
                    <td style="text-align:center;background-color:#F1F2F0;">

                    </td>
                  <{/if}>
                <{/if}>
              <{/foreach}>


            </tr>
          <{/if}>
        <{/foreach}>
      </tbody>
    </table>
  <{/if}>
</div>