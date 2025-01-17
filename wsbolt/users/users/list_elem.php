<?
include($_SERVER['DOCUMENT_ROOT']."/73naasfalteon.php");
include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/templates/lte/header.php");
include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/lock.php");
include("settings.php"); 
if( $User->InGroup($_params['access']) ){ 
    include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/templates/lte/left_menu.php");
    ?>
    
    <div class="content-wrapper">
            <section class="content-header">
                <h1 class="pull-left"><?=$_params['title']?></h1>

                <? if( $User->InGroup( array(1)) ){  ?>
                <div class="btn-group wgroup pull-right size13">
                    <a class="btn btn-default btn-xs size14" href="add_elem.php"> <i class="fa fa-user-plus"></i> <?=$GLOBALS['CPLANG']['ADD_ELEM']?> </a>
                </div>
                <? } ?>
                <div class="both"></div>
            </section>

            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

                            <div class="box-header">
                                <?
                                $fieldToSearch = array();
                                if(isset($_GET['search']) && $_GET['search'] != '') {
                                    $colums = $Db->getall(" select *  from information_schema.columns where table_schema = '" . $DB_NAME . "'  and table_name = '" . $_params['table'] . "' ");
                                    foreach ($colums as $ee => $data) {
                                        $haystack = $data['DATA_TYPE'];
                                        $needle = 'varchar';
                                        $pos = strripos($haystack, $needle);

                                        $needle = 'text';
                                        $pos2 = strripos($haystack, $needle);

                                        if ($pos !== false || $pos2 !== false) {
                                            $fieldToSearch[] = " `".$data['COLUMN_NAME']."` LIKE '%". trim( $_GET['search'] ) ."%' ";
                                        }
                                    }
                                }


                                $query = "SELECT id FROM `".$_params['table']."` WHERE usergroup >='".$User->user_group."' ";

                                if( !empty( $fieldToSearch ) ) {
                                    $fieldToSearch = " ( ". implode(" OR ", $fieldToSearch ) ." ) ";
                                    $haystack = $query;
                                    $needle = 'WHERE';
                                    $pos = strripos($haystack, $needle);

                                    $needle = 'where';
                                    $pos2 = strripos($haystack, $needle);

                                    if ($pos === false && $pos2 === false) {
                                        $fieldToSearch = " WHERE " . $fieldToSearch;
                                    }
                                    else {
                                        $fieldToSearch = " AND " . $fieldToSearch;
                                    }
                                }
                                else {
                                    $fieldToSearch = " ";
                                }

                                $query = "SELECT id FROM `".$_params['table']."` WHERE usergroup >='".$User->user_group."' $fieldToSearch ";
                                $Paginator = pagination($query, $_params['num_page']);
                                ?>

                                <form method="get">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input type="text" name="search" required class="form-control input-sm"/>
                                            <?
                                            foreach ($_GET as $key => $value) {
                                                if($key=='search'){continue;}
                                                ?>
                                                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                                                <?
                                            }
                                            ?>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="glyphicon glyphicon-search"></i> <?=$GLOBALS['CPLANG']['SEARCH_WORD']?>
                                            </button>

                                            <? if(isset($_GET['search']) && $_GET['search'] != '') { ?>
                                                <div class="btn-group backbutton">
                                                    <a class="btn btn-block btn-info btn-xs" href="?"> <?=$GLOBALS['CPLANG']['GO_BACK']?></a>
                                                </div>
                                            <? } ?>
                                        </div>
                                    </div>
                                </form>

                            </div>


                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover table-striped dataTable">
                                    <tr>
                                        <th width="30"> <?=$GLOBALS['CPLANG']['ID_WORD']?> </th>
                                        <th><?=$GLOBALS['CPLANG']['LOGIN_WORD']?></th> 
                                        <th><?=$GLOBALS['CPLANG']['IMAGE']?></th>          
                                        <th><?=$GLOBALS['CPLANG']['USERNAME']?></th>
                                        <th class="actioncolumn" style="text-align: center"><?=$GLOBALS['CPLANG']['ACTIONS']?></th>
                                    </tr>
                                    <?
                                    /** менять SQL во всех переменных $query */
                                    $subcatalog = mysqli_query($db, 
                                    "SELECT * FROM `".$_params['table']."` WHERE usergroup >='".$User->user_group."' $fieldToSearch ORDER BY `id` ASC LIMIT ".$Paginator['from'].", ".$Paginator['per_page']);
                                    while ( $Elem = mysqli_fetch_assoc($subcatalog) ){
                                        $listAct = 'label-success';
                                        if($Elem['active']==0){
                                            $listAct = 'label-default';
                                        } 
                                        ?>
                                        <tr class="<?if($Elem['active']==0){?>disabled<?}?>">
                                            <td align="center" class="title_line"><?=$Elem['id']?></td>
                                            <td class="title_line">
                                                <b><?=$Elem['login']?></b> 
                                            </td>
                                            <td align="left">
                                                <img class="imgpreview" style="max-width: 50px" src="<?=$_params['image'].$Elem['image']?>">
                                            </td>
                                            <td align="left" class="title_line"><?=$Elem['user_name']?></td>
                                            <td align="center" width="210">
                                                <div class="btn-group wgroup">
                                                    <a onclick="refresh_elem(<?=$Elem['id']?>, '<?=$_params['table']?>')" class="btn btn-default <?=$listAct?>">
                                                        <i class="glyphicon glyphicon-refresh"></i>
                                                    </a>
                                                    <a href="edit_elem.php?id=<?=$Elem['id']?>" class="btn btn-default" title="<?=$GLOBALS['CPLANG']['EDIT_ELEM']?>">
                                                        <i class="glyphicon glyphicon-pencil"></i>
                                                    </a>
                                                    <?if( $User->InGroup($_params['access_delete']) && $Elem['id']>1  ):?>
                                                    <a 
                                                        href="delete_elem.php?id=<?=$Elem['id']?>" class="btn btn-default btn-danger" 
                                                        title="<?=$GLOBALS['CPLANG']['DELETE_ELEM']?>"
                                                        onclick="return confirm ('<?=$GLOBALS['CPLANG']['SURE_TO_DELETE']?>')"
                                                        >
                                                        <i class="glyphicon glyphicon-remove-circle wglyph"></i>
                                                    </a>
                                                    <?endif;?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?
                paginate($Paginator);  
                ?>
            </section>

        </div>

    
    <? 
    
    ?>  
      

    
    
    <? 
    
}
?>
<?include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/templates/lte/footer.php");?>